<?php

namespace Lunar\Hub\Http\Livewire\Pages\Products\ProductReviews;

use Livewire\Component;

class ProductReviewCreate extends Component
{
    /**
     * Render the livewire component.
     *
     * @return \Illuminate\View\View
     */
    public function render()
    {
        return view('adminhub::livewire.pages.products.product-reviews.create')
            ->layout('adminhub::layouts.app', [
                'title' => 'Create Product Review',
            ]);
    }
}
