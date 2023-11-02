<?php

namespace Lunar\Hub\Http\Livewire\Pages\Products\ProductReviews;

use Livewire\Component;

class ProductReviewIndex extends Component
{
    /**
     * Render the livewire component.
     *
     * @return \Illuminate\View\View
     */
    public function render()
    {
        return view('adminhub::livewire.pages.products.reviews.index')
            ->layout('adminhub::layouts.app', [
                'title' => 'Product Reviews',
            ]);
    }
}
