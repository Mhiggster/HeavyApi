<?php
namespace Pool\Acme\RequestTypes;

use GuzzleHttp\Client;
use Pool\Contracts\Cache;
use Pool\Contracts\HeavyRequest;

/**
 * TODO rename this class to HeavyRequest
 * TODO make like inteface and implements Example ApiRequest
 */
class ExampleRequest implements HeavyRequest
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
     *
     * @param Cache $cache
     * @param Client $client
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
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function makeRequest(string $message) : void
    {
        $moviesOutput = [];

        for ($i = 1; $i < 90; $i++) {
            $movies = $this->guzzle->request('GET', 'http://api.themoviedb.org/3/discover/movie?api_key=' . $this->api_key . '&primary_release_date.gte=2018-01-03&page=' . $i);
            $results = json_decode( $movies->getBody()->getContents() )->results;
            $lastMovieInThisPage = $results[count($results) - 1];
            $moviesOutput[] = $lastMovieInThisPage;
        }
        $this->cache->set('movies', json_encode($moviesOutput));
        // $this->cache->clear('movies');
    }
}
