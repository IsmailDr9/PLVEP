<?php

//Route::get('event/test', function () {
//    return event(new \App\Events\EventTest('some text by event test'));
//});
$this->group(['prefix' => 'admin','namespace' => 'Admin'], function () {

    Config::set('auth.defines', 'admin');

    $this->get('login','AdminAuth@showLoginForm')->name('login');

    $this->post('save/login','AdminAuth@checkGuard')->name('login.check');

    /**
     * Start Forgot Password
     */
    $this->get('forgot/password','AdminAuth@forgetPassword')->name('forgot.password');
    $this->post('rest/password','AdminAuth@resetPassword')->name('reset.password');
    $this->get('receive/rest/password/{token}','AdminAuth@receiveResetPassword');
    $this->post('receive/rest/password/{token}','AdminAuth@checkResetPassword')->name('check.newPassword');
    /**
     * End Route Forgot Password
     */

    $this->group(['middleware' => 'admin:admin'], function () {

        /**
         * Admin Controller
         */
        $this->resource('admin','AdminController');

        $this->delete('admin/destroy/all','AdminController@multiDelete')->name('admin.delete.all');
        /**
         * End Admin Controller
         */

        /**
         * User Controller
         */
        $this->resource('user','UserController');

        $this->delete('user/destroy/all','UserController@multiDelete')->name('user.delete.all');
        /**
         * End User Controller
         */

        /**
         * Countries Controller
         */
        $this->resource('countries','CountriesController');
        $this->delete('countries/destroy/all','CountriesController@multiDelete')->name('countries.delete.all');

        /**
         * End Countries Controller
         */

        /**
         * Cities Controller
         */
        $this->resource('cities','CitiesController');
        $this->delete('cities/destroy/all','CitiesController@multiDelete')->name('cities.delete.all');
        /**
         * End Cities Controller
         */

        /**
         * States Controller
         */
        $this->resource('states','StatesController');
        $this->delete('states/destroy/all','StatesController@multiDelete')->name('states.delete.all');
        /**
         * End States Controller
         */

        /**
         * Post Controller
         */
        $this->resource('posts','PostController');
        $this->post('addPosts','PostController@store')->name('add.post');
        $this->post('editPost','PostController@editPost');
        $this->post('deletePost','PostController@deletePost');
        /**
         * End Post Controller
         */

        /**
         * Department Controller
         */
        $this->resource('departments','DepartmentsController');
        /**
         * End Department Controller
         */

        /**
         * Brands Controller
         */
        $this->resource('brands','BrandsController');
        $this->delete('brands/destroy/all','BrandsController@multiDelete')->name('brands.delete.all');

        /**
         * End Brands Controller
         */

        /**
         * Manufacturers Controller
         */
        $this->resource('manufacturers','ManufacturersController');
        $this->delete('manufacturers/destroy/all','ManufacturersController@multiDelete')->name('manufacturers.delete.all');

        /**
         * End Manufacturers Controller
         */

        /**
         * Shippings Controller
         */
        $this->resource('shippings','ShippingsController');
        $this->delete('shippings/destroy/all','ShippingsController@multiDelete')->name('shippings.delete.all');

        /**
         * End Shippings Controller
         */

        /**
         * Malls Controller
         */
        $this->resource('malls','MallsController');
        $this->delete('malls/destroy/all','MallsController@multiDelete')->name('malls.delete.all');

        /**
         * End Malls Controller
         */

        /**
         * Colors Controller
         */
        $this->resource('colors','ColorsController');
        $this->delete('colors/destroy/all','ColorsController@multiDelete')->name('colors.delete.all');

        /**
         * End Colors Controller
         */

        /**
         * Sizes Controller
         */
        $this->resource('sizes','SizesController');
        $this->delete('sizes/destroy/all','SizesController@multiDelete')->name('sizes.delete.all');

        /**
         * End Sizes Controller
         */

        /**
         * Weight Controller
         */
        $this->resource('weights','WeightsController');
        $this->delete('weights/destroy/all','WeightsController@multiDelete')->name('weights.delete.all');

        /**
         * End Weight Controller
         */

        /**
         * Products Controller
         */
        $this->resource('products','ProductsController');
        $this->delete('products/destroy/all','ProductsController@multiDelete')->name('products.delete.all');
        $this->post('products/save/image/{productId}','ProductsController@uploadImage')->name('product.image');
        $this->post('products/delete/image','ProductsController@deleteImage')->name('image.delete');
        //Size And weight
        $this->post('size/weight/{productId}','ProductsController@prepareWeightAndSize')->name('product.size.weight');


        /**
         * End Products Controller
         */


        $this->get('/home', function () {

            return view('admin.home');
        });

        $this->any('logout','AdminAuth@logout')->name('admin.logout');

        //Settings Route
//        Route::get('settings', 'Settings@setting')->name('show.setting');
//        Route::post('settings', 'Settings@setting_save');
        //End Settings

    });

});
$this->get('lang/{lang}/{id}','LangControllerSet@getLang');

?>