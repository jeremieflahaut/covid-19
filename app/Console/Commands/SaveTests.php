<?php

namespace App\Console\Commands;

use App\Models\Test;
use App\Tools\FileReader;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use MongoDB\BSON\UTCDateTime;

class SaveTests extends Command
{
    protected $headers;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'tests:save';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Save covid_19 tests in mongo db';

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
        $this->info('Start read file : ' . date('d-m-Y H:i:s'));


        try{

            Test::truncate();

            $reader = new FileReader(Storage::disk('private')->path('tests.csv'));
            $reader->each(function ($row) {

                if (!$this->headers) {
                    $this->headers = explode(';', trim(strtolower($row)));
                } else {
                    $row = explode(';', trim($row));

                    if(count($this->headers ) == count($row)) {
                        $test = array_combine($this->headers, $row);

                        if ($test['cl_age90'] != 0) {

                            $test['jour'] = new UTCDateTime(new \DateTime($test['jour']));
                            $test['p'] = (int)$test['p'];
                            $test['t'] = (int)$test['t'];

                            Test::create($test);
                        }
                    }
                }
            });

            Log::debug(var_export('Save done !', true));
            $this->info('End read file : ' . date('d-m-Y H:i:s'));

        } catch(\Exception $e) {
            $error = 'Tests save : ' . $e->getFile(). ' -> ' . 'Ligne ' . $e->getLine() . ' -> '  . $e->getMessage();
            Log::debug(var_export($error, true));
            $this->error($error);
        }
    }
}
