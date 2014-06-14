<?php

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class InstallCommand extends Command {

	/**
	 * The console command name.
	 *
	 * @var string
	 */
	protected $name = 'pos:install';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Custom command to run all migration.';

	/**
	 * Create a new command instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		parent::__construct();
	}

	/**
	 * Execute the console command.
	 *
	 * @return mixed
	 */
	public function fire()
	{
      	$this->info("Initiating installation.");

         if(!Schema::hasTable('migrations'))
            Artisan::call('migrate:install');

      	if($this->option('reset')) {
         	Artisan::call('migrate:reset');
         	$this->info("=> Reset installation successfully.");
      	}

         Artisan::call('migrate', [
            '--package' => 'cartalyst/sentry'
         ]);

         $this->info("=> Migration table created successfully.");

         Artisan::call('migrate');

         $this->info("=> All migration executed successfully.");

         if($this->option('seed')) {
            Artisan::call('db:seed');
            $this->info("=> Database table seeded successfully.");
         }
	}

	/**
	 * Get the console command arguments.
	 *
	 * @return array
	 */
	protected function getArguments()
	{
		return array(
			// array('example', InputArgument::REQUIRED, 'An example argument.'),
		);
	}

	/**
	 * Get the console command options.
	 *
	 * @return array
	 */
	protected function getOptions()
	{
		return array(
			array('reset', null, InputOption::VALUE_OPTIONAL, 'Reset installer and run again.', true),
         array('seed', null, InputOption::VALUE_OPTIONAL, 'Run seeder.', true),
		);
	}

}
