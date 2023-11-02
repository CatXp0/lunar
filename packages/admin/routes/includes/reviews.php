<?php

use Illuminate\Support\Facades\Route;
use Lunar\Hub\Http\Livewire\Pages\Products\ProductTypes\ProductTypeCreate;
use Lunar\Hub\Http\Livewire\Pages\Products\ProductTypes\ProductTypeIndex;
use Lunar\Hub\Http\Livewire\Pages\Products\ProductTypes\ProductTypeShow;

Route::group([
    'middleware' => 'can:catalogue:manage-products',
], function () {
    Route::get('/', ProductTypeIndex::class)->name('hub.reviews.index');
    Route::get('create', ProductTypeCreate::class)->name('hub.reviews.create');
    Route::get('{productReview}', ProductTypeShow::class)->name('hub.reviews.show');
});
