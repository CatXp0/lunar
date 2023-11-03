<?php

namespace Lunar\Hub\Http\Livewire\Components\Products\Reviews;

use Lunar\Models\Attribute;
use Lunar\Models\Product;
use Lunar\Models\ProductReview;
use Lunar\Models\ProductVariant;

class ReviewCreate extends AbstractReview
{
    /**
     * Mount the component.
     *
     * @return void
     */
    public function mount()
    {
        $this->productReview = new ProductReview();
    }

    /**
     * Register the validation rules.
     *
     * @return array
     */
    protected function rules()
    {
        return [
            'productReview.title' => 'required|string',
            'productReview.content' => 'required|string|unique',
        ];
    }

    /**
     * Method to handle product type saving.
     *
     * @return void
     */
    public function create()
    {
        $this->validate();

        $this->productReview->save();

        $this->notify(
            __('adminhub::catalogue.reviews.show.updated_message'),
            'hub.reviews.index'
        );
    }

    /**
     * Render the livewire component.
     *
     * @return \Illuminate\View\View
     */
    public function render()
    {
        return view('adminhub::livewire.components.products.reviews.create')
            ->layout('adminhub::layouts.base');
    }
}
