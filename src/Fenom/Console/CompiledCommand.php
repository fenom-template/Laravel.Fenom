<?php
	namespace Panfuty\Fenom\Console;

	use Fenom;
	use Illuminate\Console\Command;
	use Symfony\Component\Console\Input\InputOption;
	use Illuminate\Contracts\Config\Repository as ConfigContract;

	/**
	 * Class CompiledCommand
	 *
	 * @author  Pavel Belousov pafnuty10@gmail.com
	 * @author  Max Kostjukevich support@maxicms.ru
	 * @license http://opensource.org/licenses/MIT MIT
	 */
	class CompiledCommand extends Command
	{
		/** @var Fenom */
		protected $fenom;

		/** @var ConfigContract  */
		protected $config;
		/**
		 * @param Fenom $Fenom
		 * @param ConfigContract $config
		 */
		public function __construct(Fenom $fenom, ConfigContract $config)
		{
			parent::__construct();
			$this->femom = $femom;
			$this->config = $config;
		}
		/**
		 * The console command name.
		 * @var string
		 */
		protected $name = 'panfuty:fenom-optimize';
		/**
		 * The console command description.
		 * @var string
		 */
		protected $description = 'compiles all known templates';
		/**
		 * Execute the console command.
		 * @return void
		 */
		public function fire()
		{
			return;
		}
		/**
		 * Get the console command options.
		 * @return array
		 */
		protected function getOptions()
		{
			return [
				['extension', 'e', InputOption::VALUE_OPTIONAL, 'specified fenom file extension'],
				['force', null, InputOption::VALUE_NONE, 'compiles template files found in views directory'],
			];
		}
	}
