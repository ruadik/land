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

Route::group([],function (){
    Route::match(['get','post'], '/', ['uses'=>'IndexController@execute', 'as'=>'general']);
    Route::get('/page/{alias}', ['uses'=>'PageController@execute', 'as'=>'page']);
    Route::auth();
});




/////////////////////////////////////////////////////////////////////////////////////
//admin    //для админки
Route::prefix('admin')->middleware('auth')->group(function(){
    Route::get('/', ['uses'=>'AdminController@execute', 'as'=>'adminPage']);


    //admin/pages
    Route::prefix('pages')->group(function (){
        Route::get('/', ['uses'=>'PagesController@execute', 'as'=>'pages']);
        ////admin/pages/add
        Route::match(['get', 'post'], '/add', ['uses'=>'PagesAddController@execute', 'as'=>'pagesAdd']);
        ////admin/pages/edit
        Route::match(['get', 'post', 'delete'], '/edit/{page}', ['uses'=>'PagesEditController@execute', 'as'=>'pagesEdit']);
    });

    Route::prefix('services')->group(function (){
        Route::get('/', ['uses'=>'ServicesController@execute', 'as'=>'services']);
        Route::match(['get', 'post'], '/add', ['uses'=>'ServicesAddController@execute', 'as'=>'servicesAdd']);
        Route::match(['get', 'post', 'delete'], '/edit/{service}', ['uses'=>'ServicesEditController@execute', 'as'=>'servicesEdit']);
    });

    Route::prefix('portfolios')->group(function (){
        Route::get('/', ['uses'=>'PortfoliosController@execute', 'as'=>'portfolios']);
        Route::match(['get', 'post'], '/add', ['uses'=>'PortfoliosAddController@execute', 'as'=>'portfoliosAdd']);
        Route::match(['get', 'post', 'delete'], '/edit/{portfolio}', ['uses'=>'PortfoliosEditController@execute', 'as'=>'portfoliosEdit']);
    });

    Route::prefix('peoples')->group(function (){
        Route::get('/',['uses'=>'PeoplesController@execute', 'as'=>'peoples']);
        Route::match(['get','post'], '/add', ['uses'=>'PoplesAddController@execute', 'as'=>'peoplesAdd']);
        Route::match(['get','post','delete'], '/edit/{people}', ['uses'=>'PeoplesEditController@execute', 'as'=>'peoplesEdit']);
    });

});
/////////////////////////////////////////////////////////////////////////////////////




/*
//admin
Route::group(['prefix'=>'admin', 'middleware'=>'auth'], function (){

    //admin
    Route::get('/', function (){
         if(view()->exists('admin.index')){
             $data = ['title'=>'Панель админимтсратора'];
             return view('admin.index')->with($data);
         }
    });


    //admin/pages
    Route::group(['prefix'=>'pages'], function () {
        //admin/pages
        Route::get('/', ['uses' => 'PagesController@execute', 'as' => 'pages']);
        //admin/pages/add
        Route::match(['get', 'post'], '/add', ['uses' => 'PagesAddController@execute', 'as' => 'pagesAdd']);
        //admin/pages/edit
        Route::match(['get', 'post', 'delete'], '/edit/{pages}', ['uses' => 'PagesEditController@execute', 'as' => 'pagesEdit']);
    });

    Route::group(['prefix'=>'portfolio'], function (){
        Route::get('/', ['uses'=>'PortfolioController@execute', 'as'=>'portfolio']);
        Route::match(['get','post'], '/add', ['uses'=>'PortfolioAddController@execute', 'as'=>'addPortfolio']);
        Route::match(['get', 'post', 'delete'], '/edit', ['uses'=>'PortfolioEditController@execute', 'as'=>'editPortfolio']);
    });

    Route::group(['prefix'=>'services'], function (){
        Route::get('/', ['uses'=>'ServicesController@execute', 'as'=>'services']);
        Route::match(['get', 'post'], '/add', ['uses'=>'ServicesAddController@execute', 'as'=>'addServices']);
        Route::match(['get', 'post', 'delete'], '/edit', ['uses'=>'ServicesEditController@execute', 'as'=>'editServices']);
    });

});
*/
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
