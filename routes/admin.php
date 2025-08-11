<?php
use Illuminate\Support\Facades\Route;

try {
    Route::get('/captcha', 'AuthController@generateCaptcha')->name( 'generateCaptcha');
    Route::get('/admin/login', 'AuthController@login')->name('login');
    Route::post('/admin/loginAccept', 'AuthController@loginAccept')->name('loginAccept');
    Route::group([
        'prefix' => implode('/', [LaravelLocalization::setLocale(), 'admin']),
        'middleware' => ['admin', 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ]],
        function()  {
        Route::get('/logout', 'AuthController@logout')->name('logout');
        Route::get('/home', 'HomeController@index')->name('index');
        Route::post('/uploads', 'HomeController@uploads')->name('uploads');
        Route::resource('roles','RoleController');
        Route::resource('permissions','PermissionController');
        Route::resource('cms-users', 'CmsUserController');
        Route::get('/logs', 'CmsUserController@logs')->name('cms-users.logs');
        Route::resource('translations', 'TranslationsController');
        Route::get('/admin-words', 'TranslationsController@admin_word_index')->name('admin-words.index');
        Route::get('/admin-words/{code}', 'TranslationsController@admin_word_edit')->name('admin-words.edit');
        Route::put('/admin-words/update/{code}', 'TranslationsController@admin_word_update')->name('admin-words.update');
        Route::get('/site-words', 'TranslationsController@site_word_index')->name('site-words.index');
        Route::get('/site-words/{code}', 'TranslationsController@site_word_edit')->name('site-words.edit');
        Route::put('/site-words/update/{code}', 'TranslationsController@site_word_update')->name('site-words.update');
        Route::resource('settings', 'SettingsController');
        Route::resource('sliders', 'SlidersController');
        Route::get('category-categories/parent', 'CategoryController@getParentCategories')->name('category-category.getParentCategories');
        Route::get('category-categories/sub-parent', 'CategoryController@getSubCategories')->name('category-category.getSubParentCategories');
        Route::resource('category', 'CategoryController');
        Route::resource('news', 'NewsController');
        Route::post('/news/slider-image/delete', 'NewsController@deleteSliderImage')->name('news.slider_image.delete');
         Route::resource('projects', 'ProjectController');
        Route::post('/projects/slider-image/delete', 'ProjectController@deleteSliderImage')->name('projects.slider_image.delete');
        Route::resource('commits','CommitController');
        Route::resource('faqs','FaqsController');
        //Route::post('/news/slider-image/orderSliderImage', 'NewsController@orderSliderImage')->name('news.orderSliderImage');
        Route::get('service-categories/parent', 'ServiceController@getParentCategories')->name('service-category.getParentCategories');
        Route::get('service-categories/sub-parent', 'ServiceController@getSubCategories')->name('service-category.getSubParentCategories');
        Route::post('/service/delete-file', 'ServiceController@deleteFile')->name('service.deleteFile');
        Route::resource('service', 'ServiceController');
        Route::post('/services/order-by', 'ServiceController@orderBy')->name('services.orderBy');
        Route::resource('useful-link', 'UsefulLinkController');
        Route::get('career/contact', 'CareerController@contact')->name('career.contact');
        Route::get('career/volunteer', 'CareerController@volunteer')->name('career.volunteer');
        Route::delete('career/contact-destroy/{id}', 'CareerController@contactDestroy')->name('career.contactDestroy');
        Route::resource('career', 'CareerController');
        Route::resource('positions', 'PositionController');
        Route::get('parent-positions/{id}', 'PositionController@parent')->name('positions.parent');
    });
    Route::fallback(function () {
        abort(404);
    });
}catch (\Exception $exception){
    return response($exception->getMessage(), 500);
}
