<?php

return [
    ['GET', '/', ['App\Controllers\ArticleController', 'index']],
    ['GET', '/search', ['App\Controllers\ArticleController', 'search']],

];