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

Route::get('/test','TestsController@test');
Route::name('admin.')
    ->namespace('Admin')
    ->prefix(admin_route_prefix())
    ->middleware(['admin.check_permission'])
    ->group(function ($route){
    // users
    $route->get('/login','UsersController@loginView')->name('users.login_view');
    $route->post('/login','UsersController@loginAction')->name('users.login_post');
    $route->get('/logout','UsersController@logout')->name('users.logout');
    $route->group(['middleware'=>['auth']],function ($route){
        // users
        $route->resource('users','UsersController');
        $route->get('/edit','UsersController@editMine')->name('users.edit_mine');
        $route->post('/update','UsersController@updateMine')->name('users.update_mine');

        // indexs
        $route->get('/',"IndexsController@index")->name('indexs.index');
        $route->get('/welcome',"IndexsController@welcome")->name('indexs.welcome');
        $route->post('/destroy_file',"IndexsController@destroyFile")->name('indexs.destroy_file');

        //config
        $route->get('configs/edit','ConfigsController@editConfig')->name('configs.edit_config');
        $route->post('configs/save_config','ConfigsController@saveConfig')->name('configs.save_config');
        $route->post('configs/upload','ConfigsController@upload')->name('configs.upload');
        $route->resource('configs','ConfigsController');

        // columns
        $route->resource('columns','ColumnsController');
        $route->post('columns/upload','ColumnsController@upload')->name('columns.upload');

        // models
        $route->resource('models','ModelsController');

        // fields
        $route->resource('fields','FieldsController');

        //article
        $route->get('articles/index/{column}','ArticlesController@index')->name('articles.index');
        $route->get('articles/create/{column}','ArticlesController@create')->name('articles.create');
        $route->get('articles/edit/{article}','ArticlesController@edit')->name('articles.edit');
        $route->post('articles/store/{column}/{model}','ArticlesController@store')->name('articles.store');
        $route->patch('articles/update/{article}','ArticlesController@update')->name('articles.update');
        $route->patch('articles/destroy/{article}','ArticlesController@destroy')->name('articles.destroy');
        $route->post('articles/upload','ArticlesController@upload')->name('articles.upload');

        // roules
        $route->resource('roles','RolesController');

        // permissions
        $route->resource('permissions','PermissionsController');

        // menus
        $route->resource('menus','MenusController');
    });
});
