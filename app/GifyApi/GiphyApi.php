<?php

namespace App\GifyApi;
use App\Giphy\Giphy;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;

class GiphyApi
{
public Client $client;
public function __construct()
{
    $this->client = new Client();
}

    /**
     * @throws GuzzleException
     */
    public function fetchTrending(int $limit): array
{
    $response = $this->client->get('api.giphy.com/v1/gifs/trending', [
        'query' => [
            'api_key' => $_ENV['API_KEY'],
            'limit' => $limit,
            'offset' => floor(rand(0, 499))
        ]
    ]);
    $giphyData = json_decode($response->getBody()->getContents());
    $collection = [];
    foreach ($giphyData->data as $gif)
    {
        $collection[] = new Giphy(
            $gif->title,
            $gif->images->fixed_width->url
        );
    }
    return $collection;
}
}