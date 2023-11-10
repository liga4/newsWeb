<?php

namespace App\Controllers;

use App\Api;
use App\Response;

class ArticleController
{
    private Api $api;
    public function __construct()
    {
        $this->api = new Api;
    }

    public function search(){
        $topic = $_GET['topic'] ?? '';
        $fromDate = $_GET['from'] ?? '';
        $toDate = $_GET['to'] ?? '';
        $country = $_GET['country'] ?? 'lv';

        $articlesBySearch = $this->api->fetchArticles($topic, $fromDate, $toDate, $country);

        return new Response('articles/search',
        [
            'articlesBySearch'=>$articlesBySearch
        ]);
    }
    public function index():Response
    {
        $articles = $this->api->defaultArticles();

        return new Response('articles/index',
        [
            'articles'=>$articles,
            'header'=>'Articles'
        ]);
    }

}