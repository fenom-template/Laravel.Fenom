<?php

    namespace Pafnuty\Fenom;

    use Illuminate\Contracts\View\Factory as FactoryContract;
    use Illuminate\Contracts\Container\Container;
    use Illuminate\Foundation\Application;

    /**
     * Class FenomFactory
     *
     * @author  Pavel Belousov pafnuty10@gmail.com
     * @author  Max Kostjukevich support@maxicms.ru
     * @license http://opensource.org/licenses/MIT MIT
     */
    class FenomFactory implements FactoryContract
    {

        /**
         * @var string  version
         */
        const VERSION = '0.1.0-dev';

        /**
         * Fenom environment
         *
         * @var Fenom_Environment
         * */
        private $fenom;

        /**
         * The event dispatcher instance.
         *
         * @var \Illuminate\Contracts\Events\Dispatcher
         */
        protected $events;

        /**
         * The view composer events.
         *
         * @var array
         */
        protected $composers = array();

        /**
         * The IoC container instance.
         *
         * @var \Illuminate\Contracts\Container\Container
         */
        protected $container;

        /**
         * @param \Illuminate\Foundation\Application $app
         */
        public function __construct(Application $app)
        {
            $this->fenom = $app['fenom'];
            $this->config = $app['config'];
            $this->events = $app['events'];

        }

        /**
         * @return string
         */
        public function getVersion()
        {
            return self::VERSION;
        }

        /**
         * @param string $path
         *
         * @return bool
         */
        public function exists($path)
        {
            if (!file_exists($path)) {
                return false;
            }

            return true;
        }
        /**
         * Get the IoC container instance.
         *
         * @return \Illuminate\Contracts\Container\Container
         */
        public function getContainer()
        {
            return $this->container;
        }

        /**
         * Set the IoC container instance.
         *
         * @param  \Illuminate\Contracts\Container\Container  $container
         * @return void
         */
        public function setContainer(Container $container)
        {
            $this->container = $container;
        }
        /**
         * Get the evaluated view contents for the given path.
         *
         * @param  string $path
         * @param  array $data
         * @param  array $mergeData
         * @return \Illuminate\Contracts\View\View
         */
        public function file($path, $data = [], $mergeData = [])
        {
            // or maybe use the String loader
            if (!file_exists($path)) {
                return false;
            }

            $filePath = dirname($path);
            $fileName = basename($path);

            return new FenomView($this, $fileName, $data);
        }

        /**
         * @param string $view
         * @param array  $data
         * @param array  $mergeData
         *
         * @return \Pafnuty\Fenom\FenomView
         */
        public function make($view, $data = [], $mergeData = [])
        {
            $data = array_merge($mergeData, $data);

            return new FenomView($this, $view, $data);
        }

        /**
         * @param string $key
         * @param null   $value
         */
        public function share($key, $value = null)
        {
            $this->fenom->{$key} = $value;
            $this->fenom->addAccessorSmart($key, '$tpl->getStorage()->'.$key, \Fenom::ACCESSOR_VAR);
        }

        /**
         * @param $view
         * @param $data
         *
         * @return mixed
         */
        public function render($view, $data)
        {
            $syntax = $this->config->get('view-fenom.controller_syntax');
            if ($syntax == 'blade') {
                $view = str_replace('.','/',$view).'.'.$this->config->get('view-fenom.extension');
            }

            return $this->fenom->fetch($view, $data);
        }

        /**
         * Register multiple view composers via an array.
         *
         * @param  array  $composers
         * @return array
         */
        public function composers(array $composers)
        {
            $registered = array();

            foreach ($composers as $callback => $views)
            {
                $registered = array_merge($registered, $this->composer($views, $callback));
            }

            return $registered;
        }

        /**
         * Register a view composer event.
         *
         * @param  array|string    $views
         * @param  \Closure|string $callback
         * @param  int|null        $priority
         *
         * @return array
         */

        public function composer($views, $callback, $priority = null)
        {
            $composers = array();

            foreach ((array) $views as $view)
            {
                $composers[] = $this->addViewEvent($view, $callback, 'composing: ', $priority);
            }

            return $composers;
        }

        protected function addViewEvent($view, $callback, $prefix = 'composing: ', $priority = null)
        {
            if ($callback instanceof Closure)
            {
                $this->addEventListener($prefix.$view, $callback, $priority);
                return $callback;
            }
            elseif (is_string($callback))
            {
                return $this->addClassEvent($view, $callback, $prefix, $priority);
            }
        }

        /**
         * Register a class based view composer.
         *
         * @param  string    $view
         * @param  string    $class
         * @param  string    $prefix
         * @param  int|null  $priority
         * @return \Closure
         */
        protected function addClassEvent($view, $class, $prefix, $priority = null)
        {
            $name = $prefix.$view;

            // When registering a class based view "composer", we will simply resolve the
            // classes from the application IoC container then call the compose method
            // on the instance. This allows for convenient, testable view composers.
            $callback = $this->buildClassEventCallback($class, $prefix);

            $this->addEventListener($name, $callback, $priority);

            return $callback;
        }

        /**
         * Add a listener to the event dispatcher.
         *
         * @param  string    $name
         * @param  \Closure  $callback
         * @param  int      $priority
         * @return void
         */
        protected function addEventListener($name, $callback, $priority = null)
        {
            if (is_null($priority))
            {
                $this->events->listen($name, $callback);
            }
            else
            {
                $this->events->listen($name, $callback, $priority);
            }
        }

        /**
         * Build a class based container callback Closure.
         *
         * @param  string  $class
         * @param  string  $prefix
         * @return \Closure
         */
        protected function buildClassEventCallback($class, $prefix)
        {
            list($class, $method) = $this->parseClassEvent($class, $prefix);

            // Once we have the class and method name, we can build the Closure to resolve
            // the instance out of the IoC container and call the method on it with the
            // given arguments that are passed to the Closure as the composer's data.
            return function() use ($class, $method)
            {
                $callable = array($this->container->make($class), $method);

                return call_user_func_array($callable, func_get_args());
            };
        }

        /**
         * Parse a class based composer name.
         *
         * @param  string  $class
         * @param  string  $prefix
         * @return array
         */
        protected function parseClassEvent($class, $prefix)
        {
            if (str_contains($class, '@'))
            {
                return explode('@', $class);
            }

            $method = str_contains($prefix, 'composing') ? 'compose' : 'create';

            return array($class, $method);
        }

        /**
         * Call the composer for a given view.
         *
         * @param  \Illuminate\View\View  $view
         * @return void
         */
        public function callComposer(FenomView $view)
        {
            $this->events->fire('composing: '.$view->getName(), array($view));
        }

        /**
         * Register a view creator event.
         *
         * @param  array|string    $views
         * @param  \Closure|string $callback
         *
         * @return array
         */
        public function creator($views, $callback)
        {

        }

        /**
         * Add a new namespace to the loader.
         *
         * @param  string       $namespace
         * @param  string|array $hints
         *
         * @return void
         */
        public function addNamespace($namespace, $hints)
        {

        }


    }
