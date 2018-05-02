<?php
/**
 * Created by PhpStorm.
 * User: gurachek
 * Date: 5/2/18
 * Time: 2:24 AM
 */

require 'vendor/autoload.php';

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
use Slim\Views\PhpRenderer;

$container = [
    'settings' => [
        'displayErrorDetails' => true,
        'debug' => true,
    ],
    'url' => 'http://simple.rest',
    'db' => function () {
        try {
            $db = new PDO('mysql:dbname=simple-rest;host=127.0.0.1', 'root', '');
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $db->exec("SET NAMES utf8 COLLATE utf8_unicode_ci");
        } catch(Exception $e) {
            return $e->getMessage();
        }

        return $db;
    },
];

$app = new \Slim\App($container);

$container = $app->getContainer();
$container['renderer'] = new PhpRenderer("views");
$container['template'] = 'layouts/main.php';

$url = $container['url'];

require 'api/users.php';

function getApiData($uri) {
    global $url;
    return json_decode(file_get_contents($url . $uri), 1);
}

$app->get('/', function (Request $request, Response $response, array $args) use ($container) {

    $data = getApiData('/api/users');

    return $this->renderer->render($response, $container['template'], [
        'content' => 'index',
        'data' => $data,
        'c' => $container
    ]);

});

$app->get('/search', function (Request $request, Response $response, array $args) use ($container) {

    $data = getApiData('/api/users');

    return $this->renderer->render($response, $container['template'], [
        'content' => 'search',
        'data' => $data,
        'c' => $container
    ]);

});

$app->get('/update', function (Request $request, Response $response, array $args) use ($container) {

    $data = getApiData('/api/users');

    return $this->renderer->render($response, $container['template'], [
        'content' => 'update',
        'data' => $data,
        'c' => $container
    ]);

});

$app->get('/delete', function (Request $request, Response $response, array $args) use ($container) {

    $data = getApiData('/api/users');

    return $this->renderer->render($response, $container['template'], [
        'content' => 'delete',
        'data' => $data,
        'c' => $container
    ]);

});

$app->run();