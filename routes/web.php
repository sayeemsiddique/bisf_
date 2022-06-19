<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

Route::get('/header-mail', function() {
    return view('mail_header');
});

Route::get('/footer-mail', function() {
    return view('mail_footer');
});

Route::get('/clear', function() {
    $exitCode = Artisan::call('cache:clear');
    $exitCode = Artisan::call('route:clear');
    $exitCode = Artisan::call('config:clear');
    $exitCode = Artisan::call('view:clear');
    
    return "Clean";
    // return what you want
});
Route::get('/link-storage', function() {
    $exitCode = Artisan::call('storage:link');
    
    return "Linked";
    // return what you want
});


// Route::get('/test-mail', 'Backend\Admin\PublicQueryController@sendMail');
/*
|--------------------------------------------------------------------------
| Frontend Routes
|--------------------------------------------------------------------------
*/

Route::group(['middleware' => ['set.locale']], function() {

    Route::get('/', 'Frontend\FrontendController@index')->name('index');

    // About us page
    Route::get('/about-us', 'Frontend\FrontendController@aboutus')->name('aboutus');
    // Contact us page
    Route::get('/contact-us', 'Frontend\FrontendController@contactus')->name('contactus');

    Route::get('/user-login', 'Frontend\FrontendController@login')->name('bjkb.login');
    Route::post('/registration', 'Frontend\FrontendController@registration')->name('bisf.registration');

    /* application_setting */
    Route::get('/application_setting/{setting}', 'Frontend\FrontendController@all_setting')->name('all_setting');

    Route::get('/local-value', 'Frontend\FrontendController@set_local_value')->name('set_local_value');
    Route::get('/store', 'Frontend\FrontendController@store_grid')->name('store.grid');
    Route::get('/store/category/{id}', 'Frontend\FrontendController@store_category')->name('store.category');
    Route::get('/product-detail/{id}', 'Frontend\FrontendController@product_detail')->name('product-detail');

    // // Product search 
    // Route::get('/store/search', 'Frontend\FrontendController@searchProduct')->name('searchProduct');

    // customer section
    Route::get('/order-track', 'Frontend\FrontendController@order_track')->name('order_track');
    Route::get('/cart', 'Frontend\FrontendController@cart')->name('cart');
    
    

    Route::group(['middleware' => ['AuthGates']], function() {
        Route::get('/accountDashboard', 'Frontend\FrontendController@account')->name('account');
        Route::get('/order-list', 'Frontend\FrontendController@account_orders')->name('account_orders');
        Route::get('/order-details/{orderId}', 'Frontend\FrontendController@orderDetails')->name('orderDetails');
        Route::get('/address', 'Frontend\FrontendController@account_address')->name('account_address');
        Route::get('/accountDetails', 'Frontend\FrontendController@accountDetails')->name('accountDetails');
        Route::post('/edit-address/{user}', 'Frontend\FrontendController@edit_address')->name('edit_address');
        Route::post('/edit-info/{user}', 'Frontend\FrontendController@edit_info')->name('edit_info');
        Route::get('/accountPassword', 'Frontend\FrontendController@accountPassword')->name('accountPassword');
        Route::post('/edit-password/{user}', 'Frontend\FrontendController@edit_password')->name('edit_password');

        Route::post('/add-to-cart', 'Frontend\FrontendController@add_to_cart')->name('add_to_cart');

        Route::get('/checkout', 'Frontend\FrontendController@checkout')->name('checkout');
        Route::post('/checkout-complete', 'Frontend\FrontendController@checkout_complete')->name('checkout_complete');
        Route::get('/remove-cart-item', 'Frontend\FrontendController@remove_cart_item')->name('remove_cart_item');
        Route::post('/cart-update', 'Frontend\FrontendController@update_cart')->name('update_cart');
    });

    // Notification redirect
    Route::get('/notification-redirect/{id}/{type}', 'Frontend\FrontendController@notificationRedirect')->name('notificationRedirect');


});



/*
|--------------------------------------------------------------------------
| Backend Routes
|--------------------------------------------------------------------------
*/

Route::get('/child-category', ['uses' => 'Backend\Admin\CategoryController@get_child_category'])->name('get_child_category');

Route::group(['middleware' => ['AuthGates'], 'prefix' => '/admin', 'as' => 'admin.'], function() {

    /* Admin Dashboard Route */
    Route::get('/', ['uses' => 'Backend\IndexController@adminDashboard'])->name('index');

    /* Admin search Route */
    Route::get('search/ajax/{type}', ['uses' => 'Backend\Admin\AdminSearchContoller@ajaxSearch'])->name('searchAjax');


    /* Manage User Routes */
    Route::group(['prefix' => '/user', 'as' => 'user.'], function() {
        Route::get('/index', ['uses' => 'Backend\Admin\UserController@index'])->name('index');
        Route::get('/pending', ['uses' => 'Backend\Admin\UserController@pending'])->name('pending');
        Route::get('/approved', ['uses' => 'Backend\Admin\UserController@approved'])->name('approved');
        Route::get('/create', ['uses' => 'Backend\Admin\UserController@create'])->name('create');
        Route::post('/store', ['uses' => 'Backend\Admin\UserController@store'])->name('store');
        Route::get('/show/{id}', ['uses' => 'Backend\Admin\UserController@show'])->name('show');
        Route::get('/edit/{id}', ['uses' => 'Backend\Admin\UserController@edit'])->name('edit');
        Route::patch('/update/{user}', ['uses' => 'Backend\Admin\UserController@update'])->name('update');
        Route::get('/block/{user}', ['uses' => 'Backend\Admin\UserController@block'])->name('block');
        Route::get('/delete/{user}', ['uses' => 'Backend\Admin\UserController@destroy'])->name('delete');
        Route::get('/approve/{user}', ['uses' => 'Backend\Admin\UserController@approve'])->name('approve');

        Route::get('/editProfile/{username}/', ['uses' => 'Backend\Admin\UserController@editProfile'])->name('editProfile');
        Route::patch('/updateProfile/{user}', ['uses' => 'Backend\Admin\UserController@updateProfile'])->name('updateProfile');
        Route::patch('/updatePassword/{user}', ['uses' => 'Backend\Admin\UserController@updatePassword'])->name('updatePassword');
    });

    /* Manage User Routes */
    Route::group(['prefix' => '/customer', 'as' => 'customer.'], function() {
        Route::get('/all_customer', ['uses' => 'Backend\Admin\CustomerController@all_customer'])->name('all_customer');
        Route::get('/all_corporate', ['uses' => 'Backend\Admin\CustomerController@all_corporate'])->name('all_corporate');
        Route::get('/all_dealer', ['uses' => 'Backend\Admin\CustomerController@all_dealer'])->name('all_dealer');

        Route::get('/pending_corporate', ['uses' => 'Backend\Admin\CustomerController@pending_corporate'])->name('pending_corporate');
        Route::get('/pending_dealer', ['uses' => 'Backend\Admin\CustomerController@pending_dealer'])->name('pending_dealer');

        Route::get('/approved_corporate', ['uses' => 'Backend\Admin\CustomerController@approved_corporate'])->name('approved_corporate');
        Route::get('/approved_dealer', ['uses' => 'Backend\Admin\CustomerController@approved_dealer'])->name('approved_dealer');

        Route::get('/blocked_customer', ['uses' => 'Backend\Admin\CustomerController@blocked_customer'])->name('blocked_customer');
        Route::get('/blocked_corporate', ['uses' => 'Backend\Admin\CustomerController@blocked_corporate'])->name('blocked_corporate');
        Route::get('/blocked_dealer', ['uses' => 'Backend\Admin\CustomerController@blocked_dealer'])->name('blocked_dealer');

        Route::get('/declined_corporate', ['uses' => 'Backend\Admin\CustomerController@declined_corporate'])->name('declined_corporate');
        Route::get('/declined_dealer', ['uses' => 'Backend\Admin\CustomerController@declined_dealer'])->name('declined_dealer');

        Route::get('/create_customer', ['uses' => 'Backend\Admin\CustomerController@create_customer'])->name('create_customer');
        Route::get('/create_corporate', ['uses' => 'Backend\Admin\CustomerController@create_corporate'])->name('create_corporate');
        Route::get('/create_dealer', ['uses' => 'Backend\Admin\CustomerController@create_dealer'])->name('create_dealer');
        Route::post('/store', ['uses' => 'Backend\Admin\CustomerController@store'])->name('store');
        Route::get('/show/{id}', ['uses' => 'Backend\Admin\CustomerController@show'])->name('show');
        Route::get('/edit/{id}', ['uses' => 'Backend\Admin\CustomerController@edit'])->name('edit');
        Route::patch('/update/{user}', ['uses' => 'Backend\Admin\CustomerController@update'])->name('update');
        Route::get('/block/{user}', ['uses' => 'Backend\Admin\CustomerController@block'])->name('block');
        Route::get('/delete/{user}', ['uses' => 'Backend\Admin\CustomerController@destroy'])->name('delete');
        Route::get('/approve/{user}', ['uses' => 'Backend\Admin\CustomerController@approve'])->name('approve');
    });
    
    /* Manage Roles Routes */    
    Route::group(['prefix' => '/role', 'as' => 'role.'], function() {
        Route::get('/index', ['uses' => 'Backend\Admin\RoleController@index'])->name('index');
        Route::post('/create', ['uses' => 'Backend\Admin\RoleController@create'])->name('create');
        Route::post('/update/{id}', ['uses' => 'Backend\Admin\RoleController@update'])->name('update');
        Route::get('/status/change/{id}', ['uses' => 'Backend\Admin\RoleController@statusChange'])->name('statusChange');
    });

    /* Manage Permission Routes */    
    Route::group(['prefix' => '/permission', 'as' => 'permission.'], function() {
        Route::get('/index', ['uses' => 'Backend\Admin\PermissionController@index'])->name('index');
        Route::post('/create', ['uses' => 'Backend\Admin\PermissionController@create'])->name('create');
        Route::post('/update/{id}', ['uses' => 'Backend\Admin\PermissionController@update'])->name('update');
    });

    /* Manage RolePermission */
    Route::group(['prefix' => '/role-permission', 'as' => 'rolePermission.'], function() {
        Route::get('/index', ['uses' => 'Backend\Admin\RolePermissionController@index'])->name('index');
        Route::get('/create', ['uses' => 'Backend\Admin\RolePermissionController@create'])->name('create');
        Route::get('/edit/{rolePermission}', ['uses' => 'Backend\Admin\RolePermissionController@edit'])->name('edit');
        Route::get('/select/new/role', [ 'uses' => 'Backend\Admin\RolePermissionController@selectNewRole' ])->name('selectNewRole');
        Route::post('/store', ['uses' => 'Backend\Admin\RolePermissionController@store'])->name('store');
        Route::post('/update/{rolePermission}', ['uses' => 'Backend\Admin\RolePermissionController@update'])->name('update');
        
    });

    /* Manage Department */
    Route::group(['prefix' => '/department', 'as' => 'department.'], function() {
        Route::get('/index', ['uses' => 'Backend\Admin\DepartmentController@index'])->name('index');
        Route::get('/create', ['uses' => 'Backend\Admin\DepartmentController@create'])->name('create');
        Route::post('/store', ['uses' => 'Backend\Admin\DepartmentController@store'])->name('store');
        Route::get('/show/{id}', ['uses' => 'Backend\Admin\DepartmentController@show'])->name('show');
        Route::get('/edit/{id}', ['uses' => 'Backend\Admin\DepartmentController@edit'])->name('edit');
        Route::patch('/update/{department}', ['uses' => 'Backend\Admin\DepartmentController@update'])->name('update');
        Route::get('/delete/{department}', ['uses' => 'Backend\Admin\DepartmentController@statusChange'])->name('delete');
        Route::get('/destroy/{id}', ['uses' => 'Backend\Admin\DepartmentController@destroy'])->name('destroy');
    });

    /* Manage Category */
    Route::group(['prefix' => '/category'], function() {
        Route::get('/index', ['uses' => 'Backend\Admin\CategoryController@index'])->name('category.index');
        Route::get('/create', ['uses' => 'Backend\Admin\CategoryController@create'])->name('category.create');
        Route::post('/store', ['uses' => 'Backend\Admin\CategoryController@store'])->name('category.store');
        Route::get('/show/{id}', ['uses' => 'Backend\Admin\CategoryController@show'])->name('category.show');
        Route::get('/edit/{id}', ['uses' => 'Backend\Admin\CategoryController@edit'])->name('category.edit');
        Route::patch('/update/{id}', ['uses' => 'Backend\Admin\CategoryController@update'])->name('category.update');
        Route::get('/delete/{id}', ['uses' => 'Backend\Admin\CategoryController@destroy'])->name('category.delete');
    });

    /* Manage Brand */
    Route::group(['prefix' => '/brand'], function() {
        Route::get('/index', ['uses' => 'Backend\Admin\BrandController@index'])->name('brand.index');
        Route::get('/create', ['uses' => 'Backend\Admin\BrandController@create'])->name('brand.create');
        Route::post('/store', ['uses' => 'Backend\Admin\BrandController@store'])->name('brand.store');
        Route::get('/show/{id}', ['uses' => 'Backend\Admin\BrandController@show'])->name('brand.show');
        Route::get('/edit/{id}', ['uses' => 'Backend\Admin\BrandController@edit'])->name('brand.edit');
        Route::patch('/update/{id}', ['uses' => 'Backend\Admin\BrandController@update'])->name('brand.update');
        Route::get('/delete/{id}', ['uses' => 'Backend\Admin\BrandController@destroy'])->name('brand.delete');
    });
    
    /* Manage Varient Type */
    Route::group(['prefix' => '/varient-type'], function() {
        Route::get('/index', ['uses' => 'Backend\Admin\VarientTypeController@index'])->name('varienttype.index');
        Route::get('/create', ['uses' => 'Backend\Admin\VarientTypeController@create'])->name('varienttype.create');
        Route::post('/store', ['uses' => 'Backend\Admin\VarientTypeController@store'])->name('varienttype.store');
        Route::get('/show/{id}', ['uses' => 'Backend\Admin\VarientTypeController@show'])->name('varienttype.show');
        Route::get('/edit/{id}', ['uses' => 'Backend\Admin\VarientTypeController@edit'])->name('varienttype.edit');
        Route::patch('/update/{id}', ['uses' => 'Backend\Admin\VarientTypeController@update'])->name('varienttype.update');
        Route::get('/delete/{id}', ['uses' => 'Backend\Admin\VarientTypeController@destroy'])->name('varienttype.delete');
    });
    
    /* Manage Product */
    Route::group(['prefix' => '/product'], function() {

        Route::get('/index', ['uses' => 'Backend\Admin\ProductController@index'])->name('product.index');
        Route::get('/create', ['uses' => 'Backend\Admin\ProductController@create'])->name('product.create');
        Route::post('/store', ['uses' => 'Backend\Admin\ProductController@store'])->name('product.store');
        Route::get('/show/{id}', ['uses' => 'Backend\Admin\ProductController@show'])->name('product.show');
        Route::get('/edit/{id}', ['uses' => 'Backend\Admin\ProductController@edit'])->name('product.edit');
        Route::post('/update/{id}', ['uses' => 'Backend\Admin\ProductController@update'])->name('product.update');
        Route::get('/delete/{id}', ['uses' => 'Backend\Admin\ProductController@destroy'])->name('product.delete');

        Route::get('/stock', ['uses' => 'Backend\Admin\ProductController@stock'])->name('product.stock');
        Route::get('/add-stock', ['uses' => 'Backend\Admin\ProductController@add_stock'])->name('product.add_stock');
        Route::post('/store-stock', ['uses' => 'Backend\Admin\ProductController@store_inventory'])->name('product.store_inventory');

        // material
        
        Route::get('/materials', ['uses' => 'Backend\Admin\ProductController@material_index'])->name('product.material_index');
        Route::post('/material-store', ['uses' => 'Backend\Admin\ProductController@material_store'])->name('product.material_store');
        Route::post('/material-update/{id}', ['uses' => 'Backend\Admin\ProductController@material_update'])->name('product.material_update');
        Route::get('/material-stock', ['uses' => 'Backend\Admin\ProductController@material_stock'])->name('product.material_stock');
        Route::get('/material-add-stock', ['uses' => 'Backend\Admin\ProductController@material_add_stock'])->name('product.material_add_stock');
        Route::post('/material-store-stock', ['uses' => 'Backend\Admin\ProductController@store_material_inventory'])->name('product.store_material_inventory');
    });

    Route::group(['prefix' => '/product/varient'], function() {
        // Route::get('/index', ['uses' => 'Backend\Admin\ProductVarientController@index'])->name('product.varient.index');
        // Route::get('/create', ['uses' => 'Backend\Admin\ProductVarientController@create'])->name('product.varient.create');
        // Route::post('/store', ['uses' => 'Backend\Admin\ProductVarientController@store'])->name('product.varient.store');
        // Route::get('/show/{id}', ['uses' => 'Backend\Admin\ProductVarientController@show'])->name('product.varient.show');
        // Route::get('/edit/{id}', ['uses' => 'Backend\Admin\ProductVarientController@edit'])->name('product.varient.edit');
        // Route::post('/update/{id}', ['uses' => 'Backend\Admin\ProductVarientController@update'])->name('product.varient.update');
        Route::get('/delete/{id}', ['uses' => 'Backend\Admin\ProductVarientController@destroy'])->name('product.varient.delete');
    });
    
    /* Manage Vat */
    Route::group(['prefix' => '/vat'], function() {
        Route::get('/index', ['uses' => 'Backend\Admin\VatController@index'])->name('vat.index');
        Route::get('/create', ['uses' => 'Backend\Admin\VatController@create'])->name('vat.create');
        Route::post('/store', ['uses' => 'Backend\Admin\VatController@store'])->name('vat.store');
        Route::get('/show/{id}', ['uses' => 'Backend\Admin\VatController@show'])->name('vat.show');
        Route::get('/edit/{id}', ['uses' => 'Backend\Admin\VatController@edit'])->name('vat.edit');
        Route::post('/update/{id}', ['uses' => 'Backend\Admin\VatController@update'])->name('vat.update');
        Route::get('/delete/{id}', ['uses' => 'Backend\Admin\VatController@destroy'])->name('vat.delete');
    });
    
    /* Manage Slider */
    Route::group(['prefix' => '/slider'], function() {
        Route::get('/index', ['uses' => 'Backend\Admin\SliderController@index'])->name('slider.index');
        Route::get('/create', ['uses' => 'Backend\Admin\SliderController@create'])->name('slider.create');
        Route::post('/store', ['uses' => 'Backend\Admin\SliderController@store'])->name('slider.store');
        Route::get('/show/{id}', ['uses' => 'Backend\Admin\SliderController@show'])->name('slider.show');
        Route::get('/edit/{id}', ['uses' => 'Backend\Admin\SliderController@edit'])->name('slider.edit');
        Route::post('/update/{id}', ['uses' => 'Backend\Admin\SliderController@update'])->name('slider.update');
        Route::get('/delete/{id}', ['uses' => 'Backend\Admin\SliderController@delete'])->name('slider.delete');
    });

    /* Manage Designation */
    Route::group(['prefix' => '/designation', 'as' => 'designation.'], function() {
        Route::get('/index', ['uses' => 'Backend\Admin\DesignationController@index'])->name('index');
        Route::get('/create', ['uses' => 'Backend\Admin\DesignationController@create'])->name('create');
        Route::post('/store', ['uses' => 'Backend\Admin\DesignationController@store'])->name('store');
        Route::get('/edit/{designation}',['uses' => 'Backend\Admin\DesignationController@edit'])->name('edit');
        Route::post('/update/{designation}',['uses' => 'Backend\Admin\DesignationController@update'])->name('update');
        Route::post('/destroy/{designation}',['uses'=> 'Backend\Admin\DesignationController@destroy'])->name('destroy');
        Route::get('/delete/{id}',['uses'=> 'Backend\Admin\DesignationController@delete'])->name('delete');

    });

    /* Manage Vehicle */
    Route::group(['prefix' => '/vehicle', 'as' => 'vehicle.'], function() {
        Route::get('/index', ['uses' => 'Backend\Admin\VehicleController@index'])->name('index');
        Route::get('/create', ['uses' => 'Backend\Admin\VehicleController@create'])->name('create');
        Route::post('/store', ['uses' => 'Backend\Admin\VehicleController@store'])->name('store');
        Route::get('/show/{id}', ['uses' => 'Backend\Admin\VehicleController@show'])->name('show');
        Route::get('/edit/{id}', ['uses' => 'Backend\Admin\VehicleController@edit'])->name('edit');
        Route::patch('/update/{vehicle}', ['uses' => 'Backend\Admin\VehicleController@update'])->name('update');
        Route::get('/delete/{vehicle}', ['uses' => 'Backend\Admin\VehicleController@statusChange'])->name('delete');
        Route::get('/destroy/{id}', ['uses' => 'Backend\Admin\VehicleController@destroy'])->name('destroy');
    });

    /* Manage Bank */
    Route::group(['prefix' => '/bank', 'as' => 'bank.'], function() {
        Route::get('/index', ['uses' => 'Backend\Admin\BankController@index'])->name('index');
        Route::get('/create', ['uses' => 'Backend\Admin\BankController@create'])->name('create');
        Route::post('/store', ['uses' => 'Backend\Admin\BankController@store'])->name('store');
        Route::get('/show/{id}', ['uses' => 'Backend\Admin\BankController@show'])->name('show');
        Route::get('/edit/{id}', ['uses' => 'Backend\Admin\BankController@edit'])->name('edit');
        Route::patch('/update/{bank}', ['uses' => 'Backend\Admin\BankController@update'])->name('update');
        Route::get('/delete/{bank}', ['uses' => 'Backend\Admin\BankController@statusChange'])->name('delete');
        Route::get('/destroy/{id}', ['uses' => 'Backend\Admin\BankController@destroy'])->name('destroy');
    });

    /* Manage setting */
    Route::group(['prefix' => '/setting', 'as' => 'setting.'], function() {
        
        Route::get('/edit/{id}',['uses' => 'Backend\Admin\SettingController@edit'])->name('edit');
        Route::post('/update/{setting}',['uses' => 'Backend\Admin\SettingController@update'])->name('update');

        Route::get('/order_setting/{id}',['uses' => 'Backend\Admin\SettingController@setting_edit'])->name('setting_edit');
        Route::post('/order_setting_update/{setting}',['uses' => 'Backend\Admin\SettingController@setting_update'])->name('setting_update');

        // template setting
        Route::get('/index', ['uses' => 'Backend\Admin\SettingController@templateSetting'])->name('templateSetting');
        Route::get('/showtemp/{template}', ['uses' => 'Backend\Admin\SettingController@showTemp'])->name('showTemp');
        Route::get('/edit-template/{template}',['uses' => 'Backend\Admin\SettingController@editTemplate'])->name('editTemplate');
        Route::get('/create-template',['uses' => 'Backend\Admin\SettingController@createTemplate'])->name('createTemplate');
        Route::post('/store-template',['uses' => 'Backend\Admin\SettingController@storeTemplate'])->name('storeTemplate');
        Route::post('/update-template/{template}',['uses' => 'Backend\Admin\SettingController@updateTemplate'])->name('updateTemplate');        
        Route::post('/destroy/{template}',['uses'=> 'Backend\Admin\SettingController@destroy'])->name('destroy');

    });

    /* Manage Division Section */
    Route::get('/division-wing', 'Backend\Admin\DivisionController@admin_devision_list_by_wing')->name('division_wing');
    Route::resource('/divisions', 'Backend\Admin\DivisionController');

    Route::group(['prefix' => '/divisions', 'as' => 'divisions.'], function() {
        Route::get('delete/{division}',['uses' => 'Backend\Admin\DivisionController@deleteDivision'])->name('deleteDivision');
        Route::get('delete-permanently/{division}',['uses' => 'Backend\Admin\DivisionController@delete'])->name('delete_division_permanently');
    });

    // Pages controller to manage about us, contact us
    Route::group(['prefix' => '/page', 'as' => 'page.'], function() {
        Route::get('/about-us', ['uses' => 'Backend\Admin\PageController@aboutus'])->name('aboutus');
        Route::post('/update/about-us', ['uses' => 'Backend\Admin\PageController@updateAboutus'])->name('updateAboutus');
        Route::get('/contact-us', ['uses' => 'Backend\Admin\PageController@contactus'])->name('contactus');
        Route::post('/update/contact-us', ['uses' => 'Backend\Admin\PageController@updateContactus'])->name('updateContactus');
    });

    /* Manage Order */
    Route::group(['prefix' => '/order'], function() {
        Route::get('/index', ['uses' => 'Frontend\OrderController@index'])->name('order.index');
        Route::get('/show/{id}', ['uses' => 'Frontend\OrderController@show'])->name('order.show');
        Route::get('/destroy/{id}', ['uses' => 'Frontend\OrderController@delete'])->name('order.delete');
        // payment status update
        Route::post('/payment-update', ['uses' => 'Frontend\OrderController@paymentUpdate'])->name('order.paymentUpdate');
        // Order status update
        Route::post('/order-update', ['uses' => 'Frontend\OrderController@orderUpdate'])->name('order.orderUpdate');
        // Delivery status update
        Route::post('/delivery-update', ['uses' => 'Frontend\OrderController@deliveryUpdate'])->name('order.deliveryUpdate');
    });
    
    
});


Route::post('/districts', ['uses' => 'Backend\DynamicDependentController@getDistrictsByDivision'])->name('districts');

Route::post('/upazilas', ['uses' => 'Backend\DynamicDependentController@getUpazilasByDistrict'])->name('upazilas');

Route::post('/offices', ['uses' => 'Backend\DynamicDependentController@getOfficesByUpazila'])->name('offices');

Route::post('/designations', ['uses' => 'Backend\DynamicDependentController@getDesignationsByLevel'])->name('designations');

Route::post('/divisions', ['uses' => 'Backend\DynamicDependentController@getDivisionsByWing'])->name('divisions');

Auth::routes(['register' => false]);

Route::get('/user-logout', 'Frontend\FrontendController@user_logout')->name('user_logout');