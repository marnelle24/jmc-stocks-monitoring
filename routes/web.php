<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('frontpage');
});

Route::get('/product/{slug}', function ($slug) {
    dump($slug);
})->name('product.single');

Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified',])->group(function () {
    
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('/products', function () {
        return view('product.index');
    })->name('products');
    
    Route::get('/products/add', function () {
        if(auth()->user()->can('create'))
            return view('product.add');
        else
            return redirect('dashboard');
    })->name('products.add');

    Route::get('/product/{id}/edit', function ($id) {
        if(auth()->user()->can('update'))
            return view('product.update', [
                'id' => $id
            ]);
        else
            return redirect('dashboard');
    })->name('product.update');

    Route::get('/suppliers', function () {
        return view('supplier.index');
    })->name('suppliers');

    Route::get('/supplier/{slug}', function ($slug) {
        return view('supplier.single', [
            'slug' => $slug
        ]);
    })->name('supplier.single');

    Route::get('/categories', function () {
        return view('category.index');
    })->name('categories');

    Route::get('/category/{slug}', function ($slug) {
        dump($slug);
    })->name('category.single');

    Route::get('/users', function () {
        return view('user.index');
    })->name('users');

    Route::get('/user/add', function () {
        if(auth()->user()->can('create'))
            return view('user.add');
        else
            return redirect('dashboard');
    })->name('user.add');

    Route::get('/sales', function () {
        return view('sales.index');
    })->name('sales');

    Route::get('/sales/new', function () {
        return view('sales.add');
    })->name('sales.add');

    Route::get('/sale/{sales_order_no}', function ($sales_order_no) {
        return view('sales.single', [
            'sales_order_no' => $sales_order_no
        ]);
    })->name('sales.single');

});
