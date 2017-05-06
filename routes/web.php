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

Route::get('/', function () {
     return view('index');
});

Route::get('sec', function () {
    return view('sec');
});

Route::group(['prefix' => 'api' ], function()
{
    Route::resource('authenticate', 'AuthenticateController', ['only' => ['index']]);
    Route::post('authenticate', 'AuthenticateController@authenticate');
    Route::get('authenticate/user', 'AuthenticateController@getAuthenticatedUser');


    Route::post('/register','UserController@create');///////////////////////route for register

    Route::resource('videos', 'VideoController', ['only' => ['index']]);
    Route::get('videos', 'VideoController@index');

    Route::get('video/{id}', 'VideoController@getVideo');


    Route::resource('dashVid', 'DashVideoController', ['only' => ['index']]);
    Route::get('dashVid', 'DashVideoController@index');

    Route::get('dashVid/{id}', 'DashVideoController@getVideo');


    Route::resource('lives', 'LiveController', ['only' => ['index']]);
    Route::get('lives', 'LiveController@index');

    Route::get('live/{id}', 'LiveController@getLive');

    Route::resource('livesctm', 'CtmLiveController', ['only' => ['index']]);
    Route::get('livesctm', 'CtmLiveController@index');

    Route::get('livectm/{id}', 'CtmLiveController@getLive');


    Route::resource('dashlive', 'DashLiveController', ['only' => ['index']]);
    Route::get('dashlive', 'DashLiveController@index');

    Route::get('dashlive/{id}', 'DashLiveController@getLive');


    Route::post('comments/{video_id}', 'CommentController@store');
    Route::get('comments/{video_id}', 'CommentController@index');

    Route::resource('comments', 'CommentController',
        array('only' => array('index', 'store', 'destroy')));


    # Profile
    Route::get('profile', 'ProfileController@profiledetails');
    Route::post('profile', 'ProfileController@update_avatar');


    Route::post('video_upload', 'ProfileController@video_upload');

    Route::post('upload-file', 'ProfileController@uploadImage');

    Route::post('uploadProduct', 'ProfileController@store');

    Route::post('logout', 'LogoutController@update');

});

    // Password Reset Routes
    Route::get('password/reset/{token? }', 'Auth\PasswordController@showResetForm');
    Route::post('password/email', 'Auth\PasswordController@sendResetLinkEmail');
    Route::post('password/reset', 'Auth\PasswordController@reset');



    Route::group(['middleware' => ['web']], function () {
    Route::resource('eShop', 'ProductController');
});

    Route::group(['middleware' => ['web']], function () {
    Route::resource('dashVideos', 'VideoController');

});
    Route::group(['middleware' => ['web']], function () {
    Route::resource('dashLive', 'LiveController');

});

    Route::group(['middleware' => ['web']], function () {
    Route::resource('ctmDashLive', 'CtmLiveController');

});
// Templates
    Route::group(array('prefix'=>'templates/'),function(){
    Route::get('{template}', array( function($template)
    {
        $template = str_replace(".html","",$template);
        View::addExtension('html','php');
        return View::make('templates.'.$template);
    }));
});



Route::get('first', function() {
    // this doesn't do anything other than to
    // tell you to go to /fire
    return "go to /fire";
});

Route::get('fire', function () {
    // this fires the event
    event(new App\Events\EventSocket());
    return "event fired";
});

Route::get('test', function () {
    // this checks for the event
    return view('test');
});

Route::get('emit', function () {
    // this checks for the event
    return view('emit');
});

Route::get('visual', function () {
    // this checks for the event
    return view('visual');
});

Route::get('storing', function () {

    echo 123;

    $s3 = Storage::disk('s3');

    $content = 'This is another variable test!';

    $s3->put('newfile.txt', $content);

});

Route::auth();

Route::get('/home', 'HomeController@index');

