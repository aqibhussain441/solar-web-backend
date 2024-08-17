<?php

use App\Livewire\Admin\Categories\CategoryManager;
use App\Livewire\Admin\Groups\GroupManager;
use App\Livewire\Admin\Posts\PostManager;
use App\Livewire\Admin\Products\ProductManager;
use App\Livewire\Admin\SectionAttributes\SectionAttributeManager;
use App\Livewire\Admin\SubCategories\SubCategoryManager;
use App\Livewire\Admin\Types\TypeManager;
use App\Livewire\Admin\TypeSections\TypeSectionManager;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
    Route::get('/posts', PostManager::class)->name('posts')->lazy();
    Route::get('/product-categories', CategoryManager::class)->name('product.categories')->lazy();
    Route::get('/product-sub-categories', SubCategoryManager::class)->name('product.subCategories')->lazy();
    Route::get('/product-groups', GroupManager::class)->name('product.groups')->lazy();
    Route::get('/product-types', TypeManager::class)->name('product.types')->lazy();
    Route::get('/product-type-sections', TypeSectionManager::class)->name('product.typeSections')->lazy();
    Route::get('/type-section-attributes', SectionAttributeManager::class)->name('product.typeSectionAttributes')->lazy();
    Route::get('/products', ProductManager::class)->name('products')->lazy();
});
