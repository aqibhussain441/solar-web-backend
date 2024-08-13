<?php

use App\Livewire\Admin\Categories\CategoryManager;
use App\Livewire\Admin\Groups\GroupManager;
use App\Livewire\Admin\Posts\PostManager;
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
    Route::get('/posts', PostManager::class)->name('posts');
    Route::get('/product-categories', CategoryManager::class)->name('product.categories');
    Route::get('/product-sub-categories', SubCategoryManager::class)->name('product.subCategories');
    Route::get('/product-groups', GroupManager::class)->name('product.groups');
    Route::get('/product-types', TypeManager::class)->name('product.types');
    Route::get('/product-type-sections', TypeSectionManager::class)->name('product.typeSections');
    Route::get('/type-section-attributes', SectionAttributeManager::class)->name('product.typeSectionAttributes');
});
