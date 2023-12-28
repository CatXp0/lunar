<?php

namespace Lunar\Hub\Http\Livewire\Components\Products\ProductReviews;

use Livewire\Component;

class ProductReviewsIndex extends Component
{
    /**
     * Render the livewire component.
     *
     * @return \Illuminate\View\View
     */
    public function render()
    {
        return view('adminhub::livewire.components.products.product-reviews.index')
            ->layout('adminhub::layouts.base');
    }
}
