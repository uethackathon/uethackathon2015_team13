<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/
/*
Route::get('/', function () {
    return view('welcome');
});*/

Route::group(['prefix' => '/'], function () {

	Route::get('/', ['as' => 'frontend.welcome', 'uses' => 'Frontend\WelcomeController@index']);

	Route::resource('feedbacks', 'Frontend\FeedbackController');
	Route::resource('comments', 'Frontend\CommentController');

	Route::group(['middleware' => ['auth', 'backend']], function () {

	    Route::group(['prefix' => '/backend'], function () {
	    	Route::get('/', ['as' => 'backend.dashboard', 'uses' => 'Backend\DashboardController@index']);
	    	Route::resource('feedbacks', 'Backend\FeedbackController');
	    	Route::resource('comments', 'Backend\CommentController');
	    });
	});
});

Route::get('/sentence-processing', function () {
	return '[{"content":"first content","classification":"neutral"},{"content":"second content","classification":"negative"},{"content":"third content","classification":"positive"}]';
});
