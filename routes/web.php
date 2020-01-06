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

Route::get('/', [
    'as' => 'accueil',
    'uses' => 'VideosController@showAllVideos'
]);

Route::get('/video/watch/{id}', [
    'as' => 'video_show',
    'uses' => 'VideosController@show'
]);

Route::get('/profile/user/{slug}', [
    'as' => 'profile_show',
    'uses' => 'ProfileController@show'
]);

Auth::routes(['verify' => true]);

Route::middleware(['auth', 'verified'])->group(function () {

    Route::get('/dashboard/', [
        'as' => 'home',
        'uses' => 'HomeController@index'
    ]);

    Route::get('/profile/edit/', [
        'as' => 'profile_edit',
        'uses' => 'ProfileController@edit'
    ]);
    Route::post('/profile/update/', [
        'as' => 'profile_update',
        'uses' => 'ProfileController@update'
    ]);
    Route::get('/profile/destroy/', [
        'as' => 'profile_destroy',
        'uses' => 'ProfileController@destroy'
    ]);

    Route::get('/video/', [
        'as' => 'video_form',
        'uses' => 'VideosController@index'
    ]);
    Route::post('/video/upload/', [
        'as' => 'video_upload',
        'uses' => 'VideosController@create'
    ]);
    Route::get('/video/destroy/{id}', [
        'as' => 'video_destroy',
        'uses' => 'VideosController@destroy'
    ]);
    Route::get('/video/edit/{id}', [
        'as' => 'video_edit',
        'uses' => 'VideosController@edit'
    ]);
    Route::post('/video/upload/{id}', [
        'as' => 'video_update',
        'uses' => 'VideosController@update'
    ]);
    Route::post('/video/report/{id}', [
        'as' => 'video_report',
        'uses' => 'ReportingController@index'
    ]);

    Route::post('/comments/add/video/{id}', [
        'as' => 'comments_post',
        'uses' => 'CommentsController@create'
    ]);

    Route::get('/video/like/{id}', [
        'as' => 'video_like',
        'uses' => 'ReactionsController@like'
    ]);

    Route::get('/video/dislike/{id}', [
        'as' => 'video_dislike',
        'uses' => 'ReactionsController@dislike'
    ]);

    Route::get('/profile/suscribe/{id}', [
        'as' => 'profile_suscribe',
        'uses' => 'SuscribersController@suscribe'
    ]);
});


Route::middleware(['role:administrateur', 'verified'])->group(function () {
    Route::get('/profile/all', [
        'as' => 'profile_all',
        'uses' => 'ProfileController@showAll'
    ]);
    Route::get('admin/profile/destroy/{id}', [
        'as' => 'admin_profile_destroy',
        'uses' => 'ProfileController@m_destroy'
    ]);
});

Route::middleware(['role:administrateur|moderateur', 'verified'])->group(function () {
    Route::get('/admin/reportings', [
        'as' => 'reportings',
        'uses' => 'ReportingController@show'
    ]);

    Route::get('/admin/video/destroy/{id}', [
        'as' => 'reportings_destroy',
        'uses' => 'ReportingController@v_destroy'
    ]);
    Route::get('/admin/comments/destroy/{id}', [
        'as' => 'comments_destroy',
        'uses' => 'CommentsController@destroy'
    ]);

    Route::get('/admin/video/approve/{id}', [
        'as' => 'video_approve',
        'uses' => 'VideosController@approveVideo'
    ]);
});

Route::middleware(['role:moderateur'])->group(function () {

});

Route::middleware(['role:yourtubeur'])->group(function () {

});

