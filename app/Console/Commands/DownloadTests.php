<?php

namespace App\Console\Commands;

use App\Services\Retriver;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class DownloadTests extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'tests:download';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Download CSV covid_19 tests';

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
        $this->info('Start download file : ' . date('d-m-Y H:i:s'));

        try {
            

            $retriver = new Retriver();
            $retriver->getTests();

            Log::debug(var_export('Download done !', true));

            $this->info('End download file : ' . date('d-m-Y H:i:s'));

        } catch(\Exception $e) {
            $error = 'Tests download : ' . $e->getFile(). ' -> ' . 'Ligne ' . $e->getLine() . ' -> '  . $e->getMessage();
            Log::debug(var_export($error, true));
            $this->error($error);
        }

    }
}
