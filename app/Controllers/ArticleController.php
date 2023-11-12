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

    public function index(): Response
    {
        $country = $_GET['country'] ?? 'lv';
        $articles = $this->api->defaultArticles($country);

        return new Response('articles/index',
            [
                'articles' => $articles,
                'header' => 'Articles'
            ]);
    }

    public function search()
    {
        $topic = $_GET['topic'] ?? 'news';
        $fromDate = $_GET['from'] ?? '';
        $toDate = $_GET['to'] ?? '';


        $articlesBySearch = $this->api->fetchArticles($topic, $fromDate, $toDate);

        return new Response('articles/search',
            [
                'articlesBySearch' => $articlesBySearch,
                'header' => 'Results'
            ]);
    }
}