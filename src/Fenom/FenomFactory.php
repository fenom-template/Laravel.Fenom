<?php

    namespace Pafnuty\Fenom;

    use Illuminate\Contracts\View\Factory as FactoryContract;
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
	     * @param \Illuminate\Foundation\Application $app
	     */
	    public function __construct(Application $app)
        {
            $this->fenom = $app['fenom'];
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
            $this->fenom->addAccessor($key, $value);
        }

	    /**
	     * @param $view
	     * @param $data
	     *
	     * @return mixed
	     */
	    public function render($view, $data)
        {
            return $this->fenom->fetch($view, $data);
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
