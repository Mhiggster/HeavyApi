<?php
namespace Pool\Acme;

use GuzzleHttp\Client;
use Predis\Client as Cache;

class ApiRequest
{
    private $api_key;

    private $release_date;

    private $cache;

    private $guzzle;

    /**
     * Undocumented function
     */
    public function __construct()
    {
        $this->cache = new Cache;
        $this->guzzle = new Client;
    }

    /**
     * Undocumented function
     *
     * @param [type] $msgIndex
     * @return void
     */
    public function makeRequest($msgIndex)
    {
        $moviesOutput = [];
        

        // писать в лог если придут пустые данные
        for ($i = 1; $i < 90; $i++) { 
            $movies = $this->guzzle->request('GET', 'http://api.themoviedb.org/3/discover/movie?api_key=075d47c45127e490b135a1b151a5b596&primary_release_date.gte=2018-01-03&page=' . $i);

            $results = json_decode( $movies->getBody()->getContents() )->results;
            $lastMovieInThisPage = $results[count($results) - 1];

            $moviesOutput[] = $lastMovieInThisPage;
        }


        $this->cache->set('movies', json_encode($moviesOutput));
    }
}