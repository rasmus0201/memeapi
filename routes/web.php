<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->get('/', [
    'uses' => 'MemeController@index',
    'as' => 'meme'
]);

$router->get('/random', [
    'uses' => 'MemeController@random',
    'as' => 'random'
]);

$router->get('/memeapi', [
    'uses' => 'MemeController@memeapiRandom',
    'as' => 'memeapi.random'
]);

$router->get('/memeload', [
    'uses' => 'MemeController@memeloadapiRandom',
    'as' => 'memeloadapi.random'
]);

$router->get('/9gag', [
    'uses' => 'MemeController@ninegagapiRandom',
    'as' => '9gagapi.random'
]);

$router->get('/gif', [
    'uses' => 'MemeController@giphygifapiRandom',
    'as' => 'giphygifapi.random'
]);

$router->get('/sticker', [
    'uses' => 'MemeController@giphystickerapiRandom',
    'as' => 'giphystickerapi.random'
]);

$router->get('/get/{url}', [
    'uses' => 'MemeController@get',
    'as' => 'meme.get'
]);
