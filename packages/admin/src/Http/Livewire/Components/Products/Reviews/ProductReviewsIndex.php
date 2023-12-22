<?php

namespace Lunar\Hub\Http\Livewire\Components\Products\Reviews;

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
        return view('adminhub::livewire.components.products.product-types.index')
            ->layout('adminhub::layouts.base');
    }
}
