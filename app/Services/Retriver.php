<?php

namespace App\Services;


use GuzzleHttp\Client;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class Retriver
{
    protected $client;

    public function __construct()
    {
        $client = new Client();

        $this->client = $client;
    }

    public function getTests()
    {
        $url = $this->getUrl();
        $this->download($url);
    }


    protected function getUrl()
    {
        try {

            $response = $this->client->request('GET', config('covid.data_gouv_tests_url', 'http://localhost'));
            return collect(json_decode($response->getBody()->getContents(), true)['resources'])->first()['url'];

        } catch(\Exception $e) {
            Log::debug($e->getMessage());
        }
    }

    protected function download($url)
    {
        try{

            $this->client->request('GET', $url, ['sink' => Storage::disk('private')->path('tests.csv')]);

        } catch(\Exception $e) {
            Log::debug($e->getMessage());
        }
    }

}
