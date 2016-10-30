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
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Credentials: true');
header('Access-Control-Allow-Methods: POST, GET, OPTIONS, PUT, DELETE, PATCH');
header("Access-Control-Allow-Headers: Authorization, X-Requested-With,  Content-Type, Accept");

$api = app('Dingo\Api\Routing\Router');

$api->version(['v1', 'middleware' => 'api|cors'], function($api){
    $api->post('authenticate', [
        'as' => 'authenticate.user',
        'uses' => 'App\Http\Controllers\Api\LoginController@authenticate'
    ]);

    $api->get('currentAuthUser',[
        'as' => 'currentAuthUser',
        'uses' => 'App\Http\Controllers\Api\LoginController@getAuthenticatedUser'
    ]);

    $api->get('enrollee/getChildren/{id}', [
        'as' => 'getChildren',
        'uses' => 'App\Http\Controllers\Api\EnrolleeController@getChildren'
    ]);

    $api->get('state', [
        'as' => 'state',
        'uses' => 'App\Http\Controllers\Api\PlacesController@getState'
    ]);

    $api->get('lg',[
        'as' => 'lg',
        'uses' => 'App\Http\Controllers\Api\PlacesController@getLgs'
    ]);

    $api->post('uploadImage/{id}',[
        'as' => 'uploadImage',
        'uses' => 'App\Http\Controllers\Api\EnrolleeController@storeEnrolleeImage'
    ]);

    $api->post('parseFile',[
        'as' => 'parseFile',
        'uses' => 'App\Http\Controllers\Api\FileParseController@store'
    ]);


    $api->resource('enrollees','App\Http\Controllers\Api\EnrolleeController');
    $api->resource('organizations','App\Http\Controllers\Api\OrganizationController');
    $api->resource('plans','App\Http\Controllers\Api\PlanController');

    $api->resource('organizations.enrollees','App\Http\Controllers\Api\OrganizationEnrolleeController');
    $api->resource('organizations.plans','App\Http\Controllers\Api\OrganizationPlanController');
});

