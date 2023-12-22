<?php

namespace Lunar\Hub\Http\Livewire\Components\Products\Reviews;

use Illuminate\Support\Collection;
use Livewire\Component;
use Livewire\WithPagination;
use Lunar\Hub\Http\Livewire\Traits\Notifies;
use Lunar\Hub\Http\Livewire\Traits\WithLanguages;
use Lunar\Models\Attribute;
use Lunar\Models\AttributeGroup;
use Lunar\Models\Product;
use Lunar\Models\ProductReview;
use Lunar\Models\ProductType;
use Lunar\Models\ProductVariant;

abstract class AbstractProductReview extends Component
{
    use Notifies;
    use WithLanguages;
    use WithPagination;

    /**
     * The current view of attributes we're assigning.
     *
     * @var string
     */
    public $view = 'products';

    /**
     * Instance of the parent product.
     */
    public ProductReview $productReview;

    /**
     * Attributes which are ready to be synced.
     */
    public Collection $selectedReviews;

    /**
     * The attribute search term.
     *
     * @var string
     */
    public $reviewSearch = '';

    public function addAttribute($id)
    {
        $this->selectedReviews = $this->selectedReviews->push(
            $this->getAvailableReviews()->first(fn ($att) => $att->id == $id)
        );
    }

    public function removeAttribute($id)
    {
        $index = $this->selectedReviews->search(fn ($att) => $att->id == $id);

        $this->selectedReviews->forget($index);
    }

    public function updatedReviewSearch()
    {
        $this->resetPage();
    }

    /**
     * Select all attributes in a group.
     *
     * @param  string|int  $groupId
     * @return void
     */
    public function selectAll($groupId)
    {
        $attributes = $this->getAvailableReviews()
            ->filter(fn ($att) => $att->attribute_group_id == $groupId);

        foreach ($attributes as $attribute) {
            $this->selectedReviews->push($attribute);
        }
    }

    /**
     * Deselect all attributes in a group.
     *
     * @return void
     */
    public function deselectAll()
    {
        $this->selectedReviews = $this->selectedReviews->reject(function ($review) use ($groupId) {
            return ! $review->system && $att->attribute_group_id == $groupId;
        });
    }

    /**
     * Return available attributes given a type.
     *`
     * @return \Illuminate\Contracts\Pagination\Paginator
     */
    public function getAvailableReviews()
    {
        return ProductReview::when(
                $this->reviewSearch,
                fn ($query, $search) => $query->where("title", 'LIKE', '%'.$search.'%')
            )->whereNotIn('id', $this->selectedReviews->pluck('id')->toArray())
            ->get();
    }
}
