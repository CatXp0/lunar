<?php

namespace Lunar\Hub\Http\Livewire\Pages\Products\ProductReviews;

use Livewire\Component;
use Lunar\Models\ProductReview;

class ProductReviewShow extends Component
{
    /**
     * The Product we are currently editing.
     */
    public ProductReview $productReview;

    /**
     * Render the livewire component.
     *
     * @return \Illuminate\View\View
     */
    public function render()
    {
        return view('adminhub::livewire.pages.products.reviews.show')
            ->layout('adminhub::layouts.app', [
                'title' => 'Edit Product',
            ]);
    }
}
