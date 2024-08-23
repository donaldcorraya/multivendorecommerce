<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// })->name('home');

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/shop', [HomeController::class, 'shop'])->name('shop');
Route::get('/products/{slug}', [HomeController::class, 'productSingle'])->name('productSingle');

// Route::middleware([
//     'auth:sanctum',
//     config('jetstream.auth_session'),
//     'verified',
// ])->group(function () {
//     Route::get('/dashboard', function () {
//         return view('dashboard');
//     })->name('dashboard');
// });





Route::middleware(['admin'])->group(function(){

    Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');
    Route::post('/admin-logout', [AdminController::class, 'logout'])->name('admin-logout');
    Route::get('/categories', [ProductController::class, 'categories'])->name('categories');
    Route::get('/add_new_category', [ProductController::class, 'addNewCategory'])->name('add_new_category');
    Route::post('/add_new_category', [ProductController::class, 'addNewCategoryPost'])->name('add_new_category');
    
    Route::get('/attributes', [ProductController::class, 'attributes'])->name('attributes');
    Route::post('/add_attribute', [ProductController::class, 'add_attribute'])->name('add_attribute');
    Route::post('/add_attribute_item', [ProductController::class, 'addAttributeItem'])->name('add_attribute_item');
    Route::post('/attribute_edit', [ProductController::class, 'attributeEdit'])->name('attribute_edit');
    Route::get('/attributes/{id}', [ProductController::class, 'attributesDetails'])->name('attributesDetails');
    Route::get('/attributes_edit/{id}', [ProductController::class, 'attributes_edit'])->name('attributes_edit');
    Route::get('/attributes_details_edit/{id}', [ProductController::class, 'attributesDetailsEdit'])->name('attributesDetailsEdit');
    Route::post('/attribute_item_edit', [ProductController::class, 'attributeItemEdit'])->name('attribute_item_edit');
    Route::get('/attributes_delete/{id}', [ProductController::class, 'attributesDelete'])->name('attributes_delete');
    Route::get('/attributes_details_delete/{id}', [ProductController::class, 'attributesDetailsDelete'])->name('attributesDetailsDelete');
    
    Route::get('/brand', [ProductController::class, 'brand'])->name('brand');
    Route::post('/add_new_brand', [ProductController::class, 'addNewBrand'])->name('add_new_brand');
    Route::get('/brand_delete/{id}', [ProductController::class, 'brandDelete'])->name('brand_delete');
    Route::get('/brand_edit/{id}', [ProductController::class, 'brandEdit'])->name('brand_edit');
    Route::post('/brand_edit_submit', [ProductController::class, 'brandEditSubmit'])->name('brand_edit_submit');

    Route::get('/category_edit/{id}', [ProductController::class, 'categoryEdit'])->name('category_edit');
    Route::get('/category_delete/{id}', [ProductController::class, 'categoryDelete'])->name('category_delete');
    Route::post('/category_edit_post', [ProductController::class, 'categoryEditPost'])->name('category_edit_post');
    Route::post('/featured_status_change_ajax', [ProductController::class, 'featuredStatusChangeAjax'])->name('featured_status_change_ajax');

    Route::get('/colors', [ProductController::class, 'colors'])->name('colors');
    Route::post('/add_colors', [ProductController::class, 'addColor'])->name('add_color');
    Route::get('/colors_edit/{id}', [ProductController::class, 'colorsEdit'])->name('colors_edit');
    Route::post('/color_edit_submit', [ProductController::class, 'colorEditSubmit'])->name('color_edit_submit');
    Route::get('/colors_delete/{id}', [ProductController::class, 'colorsDelete'])->name('colors_delete');

    Route::get('/add_product', [ProductController::class, 'addProduct'])->name('add_product');
    Route::get('/product_edit/{id}', [ProductController::class, 'productEdit'])->name('product_edit');
    Route::post('/get_variant_details', [ProductController::class, 'get_variant_details'])->name('get_variant_details');
    Route::post('/get_variant_details_edit', [ProductController::class, 'get_variant_details_edit'])->name('get_variant_details_edit');
    Route::post('/get_attributes_details', [ProductController::class, 'get_attributes_details'])->name('get_attributes_details');
    Route::post('/get_attributes_details_edit', [ProductController::class, 'get_attributes_details_edit'])->name('get_attributes_details_edit');
    Route::post('/product_add_post', [ProductController::class, 'product_add_post'])->name('product.add.post');
    Route::get('/all_products', [ProductController::class, 'allProducts'])->name('all.products');
    Route::get('/product_edit_get_details', [ProductController::class, 'productEditGetDetails'])->name('product.edit.get.details');

    Route::post('/todays_deal_status_change_ajax', [ProductController::class, 'todaysDealStatusChangeAjax'])->name('todays_deal_status_change_ajax');
    Route::post('/product_status_change_ajax', [ProductController::class, 'productStatusChangeAjax'])->name('product_status_change_ajax');
    Route::post('/product_featured_status_change_ajax', [ProductController::class, 'productFeaturedStatusChangeAjax'])->name('product_featured_status_change_ajax');
    
});