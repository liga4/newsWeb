<?php

return [
    ['GET', '/', ['App\Controllers\ArticleController', 'index']],
    ['GET', '/search', ['App\Controllers\ArticleController', 'search']],

//    ['GET', '/episodes', ['App\Controllers\EpisodeController', 'index']],
//    ['GET', '/seasons', ['App\Controllers\SeasonController', 'index']],
//    ['GET', '/season/{id}', ['App\Controllers\SeasonController', 'show']],
//    ['GET', '/episode/{id}', ['App\Controllers\EpisodeController', 'show']],
//    ['GET', '/search', ['App\Controllers\EpisodeController', 'search']]

];