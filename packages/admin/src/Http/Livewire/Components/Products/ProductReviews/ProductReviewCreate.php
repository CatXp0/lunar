<?php

namespace Lunar\Hub\Http\Livewire\Components\Products\ProductReviews;

use Lunar\Models\Attribute;
use Lunar\Models\Product;
use Lunar\Models\ProductReview;
use Lunar\Models\ProductVariant;

class ProductReviewCreate extends AbstractProductReview
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
            __('adminhub::catalogue.product-reviews.show.updated_message'),
            'hub.product-reviews.index'
        );
    }

    /**
     * Render the livewire component.
     *
     * @return \Illuminate\View\View
     */
    public function render()
    {
        return view('adminhub::livewire.components.products.product-reviews.create')
            ->layout('adminhub::layouts.base');
    }
}
