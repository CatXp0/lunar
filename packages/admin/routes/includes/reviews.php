<?php

use Illuminate\Support\Facades\Route;
use Lunar\Hub\Http\Livewire\Pages\Products\Reviews\ProductReviewCreate;
use Lunar\Hub\Http\Livewire\Pages\Products\Reviews\ProductReviewIndex;
use Lunar\Hub\Http\Livewire\Pages\Products\Reviews\ProductReviewShow;

Route::group([
    'middleware' => 'can:catalogue:manage-products',
], function () {
    Route::get('/', ProductReviewIndex::class)->name('hub.reviews.index');
    Route::get('create', ProductReviewCreate::class)->name('hub.reviews.create');
    Route::get('{productReview}', ProductReviewShow::class)->name('hub.reviews.show');
});
