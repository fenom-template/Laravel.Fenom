<?php

	namespace Panfuty\Fenom\Console;

	use Fenom;
	use Illuminate\Console\Command;
	use Symfony\Component\Console\Input\InputOption;

	/**
	 * Class CompiledClearCommand
	 *
	 * @author  Pavel Belousov pafnuty10@gmail.com
	 * @author  Max Kostjukevich support@maxicms.ru
	 * @license http://opensource.org/licenses/MIT MIT
	 */
	class CompiledClearCommand extends Command
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
		protected $name = 'panfuty:fenom-clear-compiled';
		/**
		 * The console command description.
		 * @var string
		 */
		protected $description = 'Remove the compiled fenom file';
		/**
		 * Execute the console command.
		 * @return void
		 */
		public function fire()
		{
			$this->info('done.');

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
				['compile_id', 'compile', InputOption::VALUE_OPTIONAL, 'specified compile_id'],
			];
		}
	}
