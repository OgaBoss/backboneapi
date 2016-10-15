<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
$api = app('Dingo\Api\Routing\Router');

$api->version(['v1', 'middleware' => 'api'], function($api){
    $api->post('authenticate', [
        'as' => 'authenticate.user',
        'uses' => 'App\Http\Controllers\Api\LoginController@authenticate'
    ]);

    $api->get('currentAuthUser',[
        'as' => 'currentAuthUser',
        'uses' => 'App\Http\Controllers\Api\LoginController@getAuthenticatedUser'
    ]);
});

