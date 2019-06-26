<?php
namespace App\Acme;

use GuzzleHttp\Client;
use Predis\Client as Cache;

class ApiRequest
{
    public function makeRequest($msgIndex)
    {
        $client = new Client();

        $moviesOutput = [];
            

        for ($i=1; $i < 90; $i++) { 
            $movies = $client->request('GET', 'http://api.themoviedb.org/3/discover/movie?api_key=075d47c45127e490b135a1b151a5b596&primary_release_date.gte=2018-01-03&page=' . $i);

            $results = json_decode( $movies->getBody()->getContents() )->results;
            $lastMovieInThisPage = $results[count($results) - 1];

            $moviesOutput[$i] = $lastMovieInThisPage;
        }


        $redis = new Cache();
        $redis->set('red', json_encode($moviesOutput));
    }
}