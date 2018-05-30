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

$router->get('/', function () use ($router) {
    return $router->app->version();
});

// These routes are simple rest endpoints to get user data from selected db
// Todo: Extend these endpoints to proper CRUD endpoints to allow api clients to manipulate their personal info directly
// Todo: Create Authentication micro-service (OAuth) to protect these routes
$router->get('users/{id}/bio',				['as' => 'profile', 		'uses' => 'UserController@getBio']);
$router->get('users/{id}/education', 		['as' => 'education', 		'uses' => 'UserController@getEducation']);
$router->get('users/{id}/skills', 			['as' => 'skills', 			'uses' => 'UserController@getSkills']);
$router->get('users/{id}/work-experience', 	['as' => 'work_experience', 'uses' => 'UserController@getWorkExperience']);
$router->get('users/{id}/projects', 	    ['as' => 'projects',        'uses' => 'UserController@getProjects']);