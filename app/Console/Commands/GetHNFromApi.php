<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class GetHNFromApi extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'scrape:fromapi';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Get data from Hacker News website by using official api';

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
     * @return int
     */
    public function handle()
    {
        return 0;
    }
}
