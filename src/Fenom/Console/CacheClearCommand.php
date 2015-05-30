<?php
	namespace Panfuty\Fenom\Console;

	use Fenom;
	use Illuminate\Console\Command;
	use Symfony\Component\Console\Input\InputOption;

	/**
	 * Class CacheClearCommand
	 *
	 * @author  Pavel Belousov pafnuty10@gmail.com
	 * @author  Max Kostjukevich support@maxicms.ru
	 * @license http://opensource.org/licenses/MIT MIT
	 */
	class CacheClearCommand extends Command
	{

		/** @var Fenom */
		protected $fenom;

		/**
		 * @param Fenom $fenom
		 */
		public function __construct(Fenom $fenom)
		{
			parent::__construct();
			$this->fenom = $fenom;
		}

		/**
		 * The console command name.
		 * @var string
		 */
		protected $name = 'panfuty:fenom-clear-cache';

		/**
		 * The console command description.
		 * @var string
		 */
		protected $description = 'Flush the fenom cache';

		/**
		 * Execute the console command.
		 * @return void
		 */
		public function fire()
		{
			$this->info('specified file was cache cleared!');
			return;
		}

		/**
		 * Get the console command options.
		 * @return array
		 */
		protected function getOptions()
		{
			return [
				['file', 'f', InputOption::VALUE_OPTIONAL, 'specify file'],
				['time', 't', InputOption::VALUE_OPTIONAL, 'clear all of the files that are specified duration time'],
				['cache_id', 'cache', InputOption::VALUE_OPTIONAL, 'specified cache_id groups'],
			];
		}
	}
