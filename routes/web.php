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
    return view('welcome');
});

Route::post('/Connection', 'Wechat\WechatController@Connection');
Route::get('/Connection', 'Wechat\WechatController@Verify');


Route::get('/OauthCallback', 'Common\CommonController@OauthCallback');


Route::group(['prefix' => ''],function ($router)
{
    Route::group(['prefix' => 'teacher','namespace' => 'Teacher'],function ($router){
        $router->get('bind','TeacherController@Bind')->name('teacher.bind');
        $router->post('bind','TeacherController@DoBind')->name('teacher.dobind');
    });
});