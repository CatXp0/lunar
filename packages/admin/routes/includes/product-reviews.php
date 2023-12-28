<?php

use Illuminate\Support\Facades\Route;
use Lunar\Hub\Http\Livewire\Pages\Products\ProductReviews\ProductReviewCreate;
use Lunar\Hub\Http\Livewire\Pages\Products\ProductReviews\ProductReviewIndex;
use Lunar\Hub\Http\Livewire\Pages\Products\ProductReviews\ProductReviewShow;

Route::group([
    'middleware' => 'can:catalogue:manage-products',
], function () {
    Route::get('/', ProductReviewIndex::class)->name('hub.product-reviews.index');
    Route::get('create', ProductReviewCreate::class)->name('hub.product-reviews.create');
    Route::get('{productReview}', ProductReviewShow::class)->name('hub.product-reviews.show');
});
