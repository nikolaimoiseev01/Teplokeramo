<?php

use App\Livewire\Pages\BrandPage;
use App\Livewire\Pages\BrandsPage as BrandsAlias;
use App\Livewire\Pages\CatalogPage as CatalogPageAlias;
use App\Livewire\Pages\CollectionPage as CollectionPageAlias;
use App\Livewire\Pages\Index as IndexAlias;
use App\Livewire\Pages\ProductPage as ProductPageAlias;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', IndexAlias::class);
Route::get('/catalog', CatalogPageAlias::class)->name('catalog-page');
Route::get('/brands', BrandsAlias::class)->name('brands-page');
Route::get('/brand/{slug}', BrandPage::class)->name('brand-page');
Route::get('/collection/{slug}', CollectionPageAlias::class)->name('collection-page');
Route::get('/product/{slug}', ProductPageAlias::class)->name('product-page');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

//require __DIR__.'/auth.php';
