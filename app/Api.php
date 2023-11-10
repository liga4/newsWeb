<?php

namespace App;


use App\Models\Article;
use Dotenv\Dotenv;
use GuzzleHttp\Client;

class Api
{
    //'https://newsapi.org/v2/everything?q=cats&from=2023-10-09&sortBy=publishedAt&apiKey=9a897c8b1ba84c67afea4dcc6e923219'
    private Client $client;
    private const API = 'https://newsapi.org/v2/top-headlines';
    private string $apiKey;
    private string $defaultImage;

    public function __construct()
    {
        $dotenv = Dotenv::createImmutable(__DIR__.'/..');
        $dotenv->load();
        $this->client = new Client(['verify' => 'C:\Windows\cacert.pem']);
        $this->apiKey = $_ENV["API_KEY"];
        $this->defaultImage = "https://images.app.goo.gl/jXcFyL9PFb2eKsw78";
    }
    public function fetchArticles(string $topic, string $fromDate, string $toDate, string $country):array
    {
//        if(empty($country)){
//            $url = ;
//        }
        $url = self::API . "?country=$country&q=$topic&from=$fromDate&to=$toDate&apiKey=$this->apiKey";
        $response = $this->client->get($url);
        $data = json_decode((string)$response->getBody());

        $collection = [];
        foreach ($data->articles as $value) {
            $collection []=  new Article(
                $value->title,
                $value->description,
                $value->urlToImage !== null ? $value->urlToImage : $this->defaultImage
            );
        }
        return $collection;
    }
    public function defaultArticles(){
        $url = self::API . "?country=lv&q=&from=&to=&apiKey=$this->apiKey";
        $response = $this->client->get($url);
        $data = json_decode((string)$response->getBody());

        $collection = [];
        foreach ($data->articles as $value) {
            $collection []=  new Article(
                $value->title,
                $value->description,
                $value->urlToImage !== null ? $value->urlToImage : $this->defaultImage
            );
        }
        return $collection;
    }


}


//$apiKey = "9a897c8b1ba84c67afea4dcc6e923219";
