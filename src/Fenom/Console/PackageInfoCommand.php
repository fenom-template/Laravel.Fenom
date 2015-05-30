<?php

	namespace Pafnuty\Fenom\Console;

	use Fenom;
	use Illuminate\Console\Command;
	use Pafnuty\Fenom\FenomFactory;

	/**
	 * Class FenomInfoCommand
	 *
	 * @author  Pavel Belousov pafnuty10@gmail.com
	 * @author  Max Kostjukevich support@maxicms.ru
	 * @license http://opensource.org/licenses/MIT MIT
	 */
	class PackageInfoCommand extends Command
	{
		/**
		 * The console command name.
		 * @var string
		 */
		protected $name = 'panfuty:fenom-package-info';
		/**
		 * The console command description.
		 * @var string
		 */
		protected $description = 'information about panfuty/laravel-fenom';
		/**
		 * Execute the console command.
		 * @return void
		 */
		public function fire()
		{
			$this->line('<info>Fenom</info> version <comment>' . Fenom::VERSION . '</comment>');
			$this->line('<info>panfuty/laravel-fenom</info> version <comment>' . FenomFactory::VERSION . '</comment>');
		}
	}
