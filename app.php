<?php

require __DIR__ . '/vendor/autoload.php';

ini_set("display_errors", 1);
error_reporting(E_ALL);

$app = new Seyfer\SocketChat\Application(include __DIR__ . '/config.php');

$app->get('/', function () use ($app) {
    return $app->render('chat.phtml', [
                'user' => $app['user'],
    ]);
})->bind('index');

$app->get('/logout', function () use ($app) {
    $app['session']->set('user', null);
    $app['facebook']->destroySession();
    return $app->redirect($app->url('index'));
})->bind('logout');

$app->run();

