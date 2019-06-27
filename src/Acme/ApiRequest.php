<?php
namespace App\Acme;

use GuzzleHttp\Client;
use Predis\Client as Cache;

class ApiRequest
{
    private $api_key;

    private $release_date;

    private $cache;

    private $guzzle;

    public function __construct()
    {
        $this->cache = new Cache;
        $this->guzzle = new Client;
    }

    public function makeRequest($msgIndex)
    {
        $moviesOutput = [];
            
        for ($i=1; $i < 90; $i++) { 
            $movies = $this->guzzle->request('GET', 'http://api.themoviedb.org/3/discover/movie?api_key=075d47c45127e490b135a1b151a5b596&primary_release_date.gte=2018-01-03&page=' . $i);

            $results = json_decode( $movies->getBody()->getContents() )->results;
            $lastMovieInThisPage = $results[count($results) - 1];

            $moviesOutput[$i] = $lastMovieInThisPage;
        }


        $this->cache->set('red', json_encode($moviesOutput));
    }
}