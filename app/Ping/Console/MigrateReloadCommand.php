<?php namespace Ping\Console;

use Config;
use DB;
use Illuminate\Console\Command;
use Schema;

class MigrateReloadCommand extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'migrate:reload';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Drop All Tables Systematically.';

    /**
     * Create a new command instance.
     *
     * @return \Iodop\Console\MigrateReloadCommand
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
        $tables = DB::select('SHOW TABLES');
        $tables_in_database = "Tables_in_" . Config::get('database.connections.mysql.database');

        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        foreach ($tables as $table) {
            if (!starts_with($table->$tables_in_database, 'tracker_')) {
                Schema::drop($table->$tables_in_database);
                $this->info("<info>Dropped: </info>" . $table->$tables_in_database);
            } else {
                $this->info("<info>Kept: </info>" . $table->$tables_in_database);
            }
        }
        exec('php artisan migrate');
        $this->info('Migrated');
        exec('php artisan db:seed');
        $this->info('Seeded');
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
