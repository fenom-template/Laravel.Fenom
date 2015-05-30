<?php

	namespace Pafnuty\Fenom;

	use Fenom;
	use Illuminate\Filesystem;
	use Illuminate\Support\ServiceProvider;
	use Pafnuty\Fenom\Cache\Storage;

	/**
	 * Class FenomViewServiceProvider
	 *
	 * @author  Pavel Belousov pafnuty10@gmail.com
	 * @author  Max Kostjukevich support@maxicms.ru
	 * @license http://opensource.org/licenses/MIT MIT
	 */
	class FenomViewServiceProvider extends ServiceProvider
	{
		/**
		 * boot process
		 */
		public function boot()
		{
			$this->publishes([
				__DIR__ . '/../views' => base_path('resources/views'),
			]);

			$this->registerFenom();
		}

		public function registerFenom()
		{

			// register template cache driver
			$this->registerCacheStorage();

			$this->app->singleton('fenom', function ($app) {

				$fenom = Fenom::factory(
					$this->app['config']->get('view-fenom.template_path'),
					$this->app['config']->get('view-fenom.compile_path'),
					$this->app['config']->get('view-fenom.options')
				);

				return $fenom;
			});
		}

		/**
		 * @return Storage
		 */
		protected function registerCacheStorage()
		{
			\File::makeDirectory($this->app['config']->get('view-fenom.compile_path'), 0777, true, true);
		}

		/**
		 * Register the service provider.
		 *
		 * @return void
		 */
		public function register()
		{
			$configPath = __DIR__ . '/../config/view-fenom.php';
			$this->mergeConfigFrom($configPath, 'view-fenom');
			$this->publishes([$configPath => config_path('view-fenom.php')]);

			$this->app->bind('view', function ($app) {
				return new FenomFactory($app);
			});
		}

		/**
		 * Get the services provided by the provider.
		 *
		 * @return array
		 */
		public function provides()
		{
			return [
				'command.pafnuty.laravel-fenom.clear.compiled',
				'command.pafnuty.laravel-fenom.clear.cache',
				'command.pafnuty.laravel-fenom.optimize',
				'command.pafnuty.laravel-fenom.info',
			];
		}

		/**
		 * @return void
		 */
		protected function registerCommands()
		{
			// Package Info command
			$this->app['command.pafnuty.laravel-fenom.info'] = $this->app->share(
				function () {
					return new Console\PackageInfoCommand;
				}
			);
			// cache clear
			$this->app['command.pafnuty.laravel-fenom.clear.cache'] = $this->app->share(function ($app) {
				return new Console\CacheClearCommand($app['fenom']);
			}
			);
			// clear compiled
			$this->app['command.pafnuty.laravel-fenom.clear.compiled'] = $this->app->share(function ($app) {
				return new Console\CompiledClearCommand($app['fenom']);
			}
			);
			// clear compiled
			$this->app['command.pafnuty.laravel-fenom.optimize'] = $this->app->share(function ($app) {
				return new Console\CompiledCommand($app['fenom'], $app['config']);
			}
			);
			$this->commands(
				[
					'command.pafnuty.laravel-fenom.clear.compiled',
					'command.pafnuty.laravel-fenom.clear.cache',
					'command.pafnuty.laravel-fenom.optimize',
					'command.pafnuty.laravel-fenom.info',
				]
			);
		}

	}

