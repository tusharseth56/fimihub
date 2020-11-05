<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use UsersTableSeeder;

class SeederCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:seed {limit}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
    public function handle(UsersTableSeeder $seeder)
    {
        $limit = $this->argument('limit');
        $seeder->run($limit);
    }
}
