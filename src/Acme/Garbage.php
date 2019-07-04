<?php
namespace Pool\Acme;

use GuzzleHttp\Client;
use Pool\Contracts\Cache;

/**
 * TODO rename this class to Garbage
 * TODO make like inteface and implements Example ApiRequest
 */
class Garbage
{
    /**
     * Undocumented variable
     *
     * @var [type]
     */
    private $api_key = '075d47c45127e490b135a1b151a5b596';

    /**
     * Undocumented variable
     *
     * @var [type]
     */
    private $cache;

    /**
     * Undocumented variable
     *
     * @var [type]
     */
    private $guzzle;

    /**
     * Undocumented function
     */
    public function __construct(Cache $cache, Client $client)
    {
        $this->cache = $cache;
        $this->guzzle = $client;
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
        
        // Логика будет немного другой
        // писать в лог если придут пустые данные
        for ($i = 1; $i < 90; $i++) {
            
            $movies = $this->guzzle->request('GET', 'http://api.themoviedb.org/3/discover/movie?api_key=' . $this->api_key . '&primary_release_date.gte=2018-01-03&page=' . $i);
            // Если ответ пришел с 200 ответом
            $results = json_decode( $movies->getBody()->getContents() )->results;
            $lastMovieInThisPage = $results[count($results) - 1];

            $moviesOutput[] = $lastMovieInThisPage;
        }

        // write cache
        $this->cache->set('movies', json_encode($moviesOutput));
        // $this->cache->clear('movies');
    }
}