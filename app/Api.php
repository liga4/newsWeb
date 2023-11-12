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
    private const API2 = 'https://newsapi.org/v2/everything';
    private string $apiKey;
    private string $defaultImage;

    public function __construct()
    {
        $dotenv = Dotenv::createImmutable(__DIR__ . '/..');
        $dotenv->load();
        $this->client = new Client(['verify' => 'C:\Windows\cacert.pem']);
        $this->apiKey = $_ENV["API_KEY"];
        $this->defaultImage = "https://free4kwallpapers.com/uploads/originals/2019/12/02/a-more-purple-ish-version-of-the-mac-os-mojave--wallpaper.jpg";
    }

    public function fetchArticles(
        string $topic,
        string $fromDate,
        string $toDate
    ): array
    {
        $url = self::API2 . "?q={$topic}&from={$fromDate}&to={$toDate}&apiKey={$this->apiKey}";
        $response = $this->client->get($url);
        $data = json_decode((string)$response->getBody());

        $collection = [];
        foreach ($data->articles as $value) {
            $collection [] = new Article(

                $value->title,
                $value->description,
                $value->urlToImage ?? $this->defaultImage,
                $value->publishedAt,
                $value->url
            );
        }
        return $collection;
    }

    public function defaultArticles(string $country): array
    {
        $url2 = self::API . "?country=$country&category=&apiKey={$this->apiKey}";
        $answer = $this->client->get($url2);
        $data = json_decode((string)$answer->getBody());

        $collection = [];
        foreach ($data->articles as $value) {
            $collection [] = new Article(
                $value->title,
                $value->description,
                $value->urlToImage !== null ? $value->urlToImage : $this->defaultImage,
                $value->publishedAt,
                $value->url
            );
        }
        return $collection;
    }


}


//$apiKey = "9a897c8b1ba84c67afea4dcc6e923219";
