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
/*================================
=            Question            =
================================*/

Route::get('/', 'QuestionController@index');
Route::get('/question/save/{id}', 'QuestionController@SaveQuestion');
Route::get('/question/unsave/{id}', 'QuestionController@UnSaveQuestion');
Route::post('/question', 'QuestionController@create');
Route::put('/question/{id}', 'QuestionController@edit');
Route::get('/question/{id}/{slug?}', 'QuestionController@show');
Route::delete('/question/{id}', 'QuestionController@destroy');
Route::post('question/upvote', 'QuestionController@upvote');
Route::post('question/downvote', 'QuestionController@downvote');

/*=====  End of Question  ======*/

/*==============================
=            Answer            =
==============================*/
Route::post('/answer', 'AnswerController@CreateAnswer');
Route::get('/makebest/{id}', 'AnswerController@MakeBest');
Route::delete('/answer/{id}'  , 'AnswerController@destroy');
Route::post('answer/upvote', 'AnswerController@upvote');
Route::post('answer/downvote', 'AnswerController@downvote');

/*=====  End of Answer  ======*/
/*============================
=            user            =
============================*/
Route::get('/profile/{id}', 'UserController@profile');
Route::get('/profile/{id}/saved', 'UserController@savedQuestion');
Route::get('/profile/{id}/answers', 'UserController@UserAnswers');
Route::get('/profile/{id}/votes', 'UserController@UserVotes');
Route::get('/settings/information', 'UserController@settings');
Route::put('/settings1', 'UserController@updateUserSettings');
Route::put('/settings/password', 'UserController@updateUserPassword');
Route::get('/settings', 'UserController@informationSetting');
Route::put('/settings', 'UserController@update');
/*===============================
=            website            =
===============================*/
Route::get('/notification', 'HomeController@Notification');
Route::get('/terms', 'HomeController@Terms');
Route::get( '/contact', 'ContactController@index');
Route::post('/contact', 'ContactController@save');




/*=====  End of website  ======*/


/*=====  End of user  ======*/
/*==============================
=            search            =
==============================*/
Route::get('search', 'SearchController@search')->name('search');

/*=====  End of search  ======*/


Route::get('/category/{slug}' , 'CategoryController@index');

/*=============================
=            login            =
=============================*/

Auth::routes(['verify' => true]);
// OAuth Routes

Route::get('/login/{SocialProvider}', 'Auth\LoginController@redirectToProvider');
Route::get('/login/{SocialProvider}/callback', 'Auth\LoginController@handleCallback');
/*=====  End of login  ======*/
Route::get('/setLanguage/{lang}', 'LanguagesController@set')->name('set.language');




/*================================
=            dashbord            =
================================*/

Route::get('/dashbord' , 'DashbordController@index');
Route::get('/dashbord/setting' , 'SiteSettingController@index');
Route::put('/dashbord/setting' , 'SiteSettingController@update');

/*----------  user  ----------*/
Route::get('/dashbord/users/{id?}' , 'DashbordController@users');
Route::get('/dashbord/users/{id?}/delete' , 'UserController@destroy');
Route::put('/dashbord/users/{id?}/delete' , 'UserController@destroy');



/*----------  categories  ----------*/

Route::get('/dashbord/categories' , 'CategoryController@dashIndex');
Route::post('/dashbord/category' , 'CategoryController@create');
Route::get('/dashbord/category/{id}/delete' , 'CategoryController@destroy');
Route::put('user/admin/{id}' , 'UserController@MakeAdmin');
/*----------  contact  ----------*/

Route::get('/dashbord/messages' , 'ContactController@dashbordIndex');
Route::get('/dashbord/messages/{id}' , 'ContactController@show');




/*=====  End of dashbord  ======*/
auth()->login(\App\User::find(1));


//});
