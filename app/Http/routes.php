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

Route::post('/sentence-processing', ['as' => 'sentence.processing', 'uses' => function () {
	$data = \Request::all();
	$result = preg_split('/(?<=[.?!;:])\s+/', $data['content'], -1, PREG_SPLIT_NO_EMPTY);
	$classifications = ["neutral", "positive", "negative"];
	$collection = collect([]);
	foreach ($result as $sentence) {
		$sentenceObj = new stdClass;
		$sentenceObj->content = $sentence;
		$sentenceObj->classification = $classifications[0];
		shuffle($classifications);
		$collection->push($sentenceObj);
	}
	return $collection->toJson();
}]);
