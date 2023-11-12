<?php


use App\Response;
use App\Router\Router;
use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;
use Twig\Extension\DebugExtension;
use Twig\Loader\FilesystemLoader;

use Carbon\Carbon;

require_once __DIR__ . '/../vendor/autoload.php';

$loader = new FilesystemLoader(__DIR__ . '/../app/Views');
$twig = new Environment($loader);
$twig->addExtension(new DebugExtension());
$currentDate = new DateTime();
$routeInfo = Router::dispatch();
$twig->addGlobal('month', carbon::now()->subMonth());
$twig->addGlobal('imagelv', 'https://cdn.countryflags.com/thumbs/latvia/flag-3d-round-250.png');
$twig->addGlobal('imageus', 'https://media.istockphoto.com/id/955320026/vector/united-states-flag-icon.jpg?s=612x612&w=0&k=20&c=H_7queZAVZk-Qp30pAbM-bfh64aO4bXBEC6ws_l6wNI=');
$twig->addGlobal('imageuk', 'https://media.istockphoto.com/id/175600066/vector/badge-british-flag.jpg?s=612x612&w=0&k=20&c=C4C5TG9uWaU6vExJ_uyusUhHlmKe8GmVSUWfXBL9Zag=');

switch ($routeInfo[0]) {
    case FastRoute\Dispatcher::NOT_FOUND:
        echo '404 Not Found';
        break;
    case FastRoute\Dispatcher::METHOD_NOT_ALLOWED:
        $allowedMethods = $routeInfo[1];
        break;
    case FastRoute\Dispatcher::FOUND:
        [$className, $method] = $routeInfo[1];
        $vars = $routeInfo[2];

        $response = (new $className())->{$method}($vars);

        /** @var Response $response */

        echo $twig->render($response->getViewName() . '.twig', $response->getData());

        break;
}