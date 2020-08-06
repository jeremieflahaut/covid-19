<?php

namespace App\Console\Commands;

use App\Http\Controllers\TestsController;
use Illuminate\Console\Command;

class dev extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'dev';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '';

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
    public function handle()
    {
        $this->info('start : ' . date('d-m-Y H:i:s'));
        
        $request = request();

        resolve(TestsController::class)->dep($request, '06');


        $this->info('end : ' . date('d-m-Y H:i:s'));
    }
}
