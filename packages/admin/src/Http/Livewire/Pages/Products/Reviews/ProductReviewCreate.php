<?php

namespace Lunar\Hub\Http\Livewire\Pages\Products\Reviews;

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
        return view('adminhub::livewire.pages.products.reviews.create')
            ->layout('adminhub::layouts.app', [
                'title' => 'Create Product Review',
            ]);
    }
}
