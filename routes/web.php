<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/correct/order/{tableName}/{colName}/{startvalue}/{stopvalue}/{changestartnumber}', function($tableName, $colName, $startvalue, $stopvalue = 0, $changestartnumber = 0) {
	$tableRowsCount = ($stopvalue == 0) ? \DB::table($tableName)->get()->count() : $stopvalue;
	$changestartnumber = ($changestartnumber == 0) ? $startvalue : $changestartnumber;
	// dd($tableName, $colName, $startvalue, $stopvalue, $changestartnumber);
	for ($i = $startvalue; $i <= $tableRowsCount; $i++) {
		\DB::update("update {$tableName} set {$colName}={$changestartnumber} where {$colName}={$i}");
		$changestartnumber++;
	}
	echo "{$tableName} {$colName} update successfully.";
});

Route::get('/', function () {
    return view('quiz.index');
})->name('index');

Route::post('/getrollno', 'QuizController@getRollNums');
Route::post('/getsection', 'QuizController@getSection');
Route::post('/getname', 'QuizController@getName');

Route::post('/startquiz', 'QuizController@check');
Route::post('/questions', 'QuizController@index');
Route::post('/submit', 'QuizController@updateRecord');

// Route::get('/allquestion', 'QuizController@allquest');


Route::group(['prefix' => 'admin'], function() {

Route::get('/record-search', ['as' => 'record-search', 'uses' => 'ManageQuestionsController@search']);
Route::post('/fetch-records', ['as' => 'fetch-records', 'uses' => 'ManageQuestionsController@fetch']);
Route::get('/manage-questions', ['as' => 'manage-questions', 'uses' => 'ManageQuestionsController@manage']);
Route::get('/manage-students', ['as' => 'get-students', 'uses' => 'ManageStudentsController@manage']);
Route::post('/manage-students', ['as' => 'post-students', 'uses' => 'ManageStudentsController@addorupdate']);

Route::get('/Add', ['as' => 'getAdd', 'uses' => 'ManageQuestionsController@showAdd']);
Route::post('/Add', ['as' => 'postAdd', 'uses' => 'ManageQuestionsController@add']);
Route::get('/Edit/{id}', ['as' => 'getEdit', 'uses' => 'ManageQuestionsController@show']);
Route::post('/Edit/{id}', ['as' => 'postEdit', 'uses' => 'ManageQuestionsController@edit']);
Route::get('/Delete/{id}', ['as' => 'delete', 'uses' => 'ManageQuestionsController@delete']);
Route::get('/DeleteAll', ['as' => 'deleteAll', 'uses' => 'ManageQuestionsController@deleteAll']);
Route::get('/Backup', ['as' => 'createBackup', 'uses' => 'ManageQuestionsController@backup']);
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');