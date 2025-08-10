<?php

use Illuminate\Support\Facades\Route;
try {
    Route::group([
    'prefix' => implode('/', [LaravelLocalization::setLocale(), '']),
    'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ]],
    function() {
        Route::get('/', 'HomeController@index')->name('index');
        Route::get('/about', 'HomeController@about')->name('about');
        Route::get('/projects', 'HomeController@projects')->name('projects');
        Route::get('/project-detail/{slug}', 'HomeController@projectDetail')->name('projectDetail');
        Route::get('/service-detail/{slug}', 'HomeController@serviceDetail')->name('serviceDetail');
        Route::get('/blogs', 'HomeController@blogs')->name('blogs');
        Route::get('/blog-detail/{slug}', 'HomeController@blogDetail')->name('blogDetail');
        Route::get('/contact', 'HomeController@contact')->name('contact');
        Route::get('/404', 'HomeController@notPage')->name('404');
    });
//    Route::fallback(function () {
//        abort(404);
//    });
}catch (\Exception $exception){
    return response($exception->getMessage(), 500);
}
