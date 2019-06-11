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

$router->get('/memeapi', [
    'uses' => 'MemeController@memeapiRandom',
    'as' => 'memeapi.random'
]);

$router->get('/memeload', [
    'uses' => 'MemeController@memeloadapiRandom',
    'as' => 'memeloadapi.random'
]);

$router->get('/giphy', [
    'uses' => 'MemeController@giphyapiRandom',
    'as' => 'giphyapi.random'
]);

$router->get('/get/{url}', [
    'uses' => 'MemeController@get',
    'as' => 'meme.get'
]);
