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


Route::post('send/email',           'SendEmailController@send');

Route::group([
    'prefix'     => 'auth',
    'namespace'  => 'Auth',
    'middleware' => ['message'],
], function(){


    Route::get('nickname/check/{nickname}', 'RegisterController@nickname');
    Route::get('email/check/{email}',       'RegisterController@email');
    Route::get('login',                     'LoginController@getLogin');
    Route::get('register',                  'RegisterController@getRegister');
    Route::get('reset',                     'ForgetController@getReset');
    Route::get('logout',                    'LogoutController@logout');

    Route::post('register',                 'RegisterController@register');
    Route::post('login',                    'LoginController@login');
    Route::post('reset',                    'ForgetController@reset');
});




Route::group([
    'prefix'    => 'home',
    'namespace' => 'Home',
    'middleware'=> ['user.share', 'message'],
], function() {

    Route::get('index',                     'IndexController@index');
    Route::get('painting/work',             'PaintingController@getWork');
    Route::get('painting/show/{painting_id}', 'PaintingController@show');
    Route::get('bulletin/index',            'BulletinController@index');
    Route::get('bug/index',                 'BugController@index');


    Route::post('comment',              'PaintingController@comment')->middleware(['login.check']);
    Route::post('bug',                  'BugController@postBug')->middleware(['login.check']);



    // 用户中心路由组
    Route::group([
        'prefix' => 'user',
        'middleware' => ['login.check'],
    ], function() {
        Route::get('info/edit',             'UserController@getEdit');
        Route::get('painer',                'UserController@getApply');
        Route::get('message',               'MessageController@index');

        Route::post('info/edit',            'UserController@edit');
        Route::post('apply',                'UserController@apply');


    });

    Route::get('user/info/{nickname}',        'UserController@userInformation');


    // 作品路由组
    Route::group([
        'prefix' => 'painting',
        'middleware' => ['login.check'],
    ], function(){

        Route::get('release',               'PaintingController@getRelease');


        Route::post('release',              'PaintingController@release');


    });
});



// 后台登录路由组
Route::group([
    'prefix' => '/admin/auth',
    'namespace' => 'Admin',
    'middleware'=> ['message', 'user.share'],
],function(){
    Route::get('login',                        'LoginController@getLogin');
    Route::get('logout',                       'UserController@logout');
    Route::post('login',                       'LoginController@login');
});



// 后台路由组
Route::group([
    'prefix' => 'admin',
    'namespace' => 'Admin',
    'middleware'=> ['message', 'user.share', 'admin.check']
], function(){



    Route::get('index',                             'IndexController@index');


    // bug 路由组
    Route::group([
        'prefix' => 'bug'
    ], function(){
        Route::get('index',                         'BugController@index');
        Route::get('show/{bug}',                    'BugController@show');
    });

    //用户路由组
    Route::group([
        'prefix' => 'user'
    ], function() {
        Route::get('index',                         'UserController@index');
        Route::get('status/{user}/{status}',        'UserController@setStatus');
        Route::get('deprivation/{user}',            'UserController@deprivation');
    });

    //画家申请路由组
    Route::group([
        'prefix' => 'apply'
    ], function() {
        Route::get('index',                         'PainerApplyController@index');
        Route::get('show/{apply}',                  'PainerApplyController@show');
        Route::get('review/{apply}/{status}',       'PainerApplyController@review');
    });



    // 公告路由组
    Route::group([
        'prefix' => 'bulletin'
    ], function() {
        Route::get('index',                         'BulletinController@index');
        Route::get('show/{bulletin}',               'BulletinController@show');
        Route::get('add',                           'BulletinController@add');


        Route::post('store',                        'BulletinController@store');
    });


    // 画画类型路由组
    Route::group([
        'prefix' => 'painting/type'
    ], function() {
        Route::get('index',                         'PaintingTypeController@index');
        Route::get('add',                           'PaintingTypeController@add');
        Route::get('edit/{type}',                   'PaintingTypeController@edit');
        Route::get('delete/{type}',                 'PaintingTypeController@delete');

        Route::post('store',                        'PaintingTypeController@store');
        Route::post('update',                       'PaintingTypeController@update');
    });


    // 作品路由组
    Route::group([
        'prefix' => 'painting'
    ], function() {
        Route::get('index',                         'PaintingController@index');
        Route::get('show/{painting}',               'PaintingController@show');
        Route::get('delete/{painting}',             'PaintingController@delete');
    });


    // 图片管路路由组
    Route::group([
        'prefix' => 'image'
    ], function(){
        Route::get('index',                         'ImageController@index');
        Route::get('show/{image}',                  'ImageController@show');
        Route::get('reset/{image}',                 'ImageController@reset');
    });


});




// ajax组..
Route::group([
    'prefix' => 'ajax',
    'middleware' => [],
], function(){
    Route::get('work/{page}',                      'Home\PaintingController@workAjax');
});


// 文件上传组
Route::group([
    'prefix' => 'image',
    'namespace' => 'Home'
], function(){

    Route::post('apply',                 'FileController@applyUpload');
    Route::post('avatar',                'FileController@avatarUpload');
    Route::post('release',               'FileController@releaseUpload');

    Route::post('crop/cover',            'FileController@postCropCover');

});


Route::any("/", function() {
    return redirect()->to('/home/index');
});


