<?php

namespace Lunar\Hub\Http\Livewire\Components\Products\ProductReviews;

use Lunar\Facades\DB;
use Lunar\Models\Attribute;
use Lunar\Models\Product;
use Lunar\Models\ProductType;
use Lunar\Models\ProductVariant;

class ProductReviewShow extends AbstractProductReview
{
    public bool $deleteDialogVisible = false;

    public function mount()
    {
//        $systemProductAttributes = Attribute::system(Product::class)->get();
//        $systemVariantAttribues = Attribute::system(ProductVariant::class)->get();
//        $this->selectedProductAttributes = $this->review->mappedAttributes
//            ->filter(fn ($att) => $att->attribute_type == Product::class)
//            ->merge($systemProductAttributes);
//
//        $this->selectedVariantAttributes = $this->productType->mappedAttributes
//            ->filter(fn ($att) => $att->attribute_type == ProductVariant::class)
//            ->merge($systemVariantAttribues);
    }

    /**
     * Register the validation rules.
     *
     * @return array
     */
    protected function rules()
    {
        return [
            'product-review.content' => [
                'required',
                'string',
                'max:255'
//                'unique:'.get_class($this->productReview).',name,'.$this->productType->id,
            ],
        ];
    }

    /**
     * Method to handle product type saving.
     *
     * @return void
     */
    public function update()
    {
        $this->validate();

        $this->productReview->save();

//        $this->productReview->mappedAttributes()->sync(
//            array_merge(
//                $this->selectedProductAttributes->pluck('id')->toArray(),
//                $this->selectedVariantAttributes->pluck('id')->toArray()
//            )
//        );

        $this->notify(
            __('adminhub::catalogue.product-reviews.show.updated_message'),
            'hub.product-reviews.index'
        );
    }

    public function getCanDeleteProperty()
    {
        return true;
    }

    /**
     * Delete the variant.
     *
     * @return void
     */
    public function delete()
    {
        DB::transaction(fn () => $this->productReview->delete());

        $this->notify(
            __('adminhub::catalogue.product-reviews.show.delete.delete_notification'),
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
        return view('adminhub::livewire.components.products.product-reviews.show')
            ->layout('adminhub::layouts.base');
    }
}
