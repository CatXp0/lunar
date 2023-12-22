<?php

namespace Lunar\Hub\Http\Livewire\Components\Products\Tables;

use Illuminate\Support\Collection;
use Lunar\Hub\Http\Livewire\Traits\Notifies;
use Lunar\Hub\Models\SavedSearch;
use Lunar\Hub\Tables\Builders\ProductReviewsTableBuilder;
use Lunar\LivewireTables\Components\Columns\TextColumn;
use Lunar\LivewireTables\Components\Table;

class ProductReviewsTable extends Table
{
    use Notifies;

    /**
     * {@inheritDoc}
     */
    protected $tableBuilderBinding = ProductReviewsTableBuilder::class;

    /**
     * {@inheritDoc}
     */
    public bool $searchable = true;

    /**
     * {@inheritDoc}
     */
    public bool $canSaveSearches = true;

    /**
     * {@inheritDoc}
     */
    protected $listeners = [
        'saveSearch' => 'handleSaveSearch',
    ];

    /**
     * {@inheritDoc}
     */
    public function build()
    {
        $this->tableBuilder->baseColumns([
            TextColumn::make('title')->heading(
                __('adminhub::tables.headings.title')
            )->url(function ($record) {
                return route('hub.product-reviews.show', $record->id);
            }),
            TextColumn::make('product.name', function ($record) {
                return $record->translateAttribute('product');
            })->url(function ($record) {
                return route('hub.products.show', $record->product_id);
            })->heading(
                __('adminhub::tables.headings.product_name')
            ),
            TextColumn::make('content', function ($record) {
                return $record->content;
            })->heading(
                __('adminhub::tables.headings.content')
            ),
            TextColumn::make('rating', function ($record) {
                return $record->rating;
            })->heading(
                __('adminhub::tables.headings.rating')
            ),
            TextColumn::make('real_rating', function ($record) {
                return $record->rating;
            })->heading(
                __('adminhub::tables.headings.real_rating')
            ),
            TextColumn::make('is_active', function ($record) {
                return $record->is_active ? 'Yes' : 'No';
            })->heading(
                __('adminhub::tables.headings.is_active')
            ),
        ]);
    }

    /**
     * Remove a saved search record.
     *
     * @param  int  $id
     * @return void
     */
    public function deleteSavedSearch($id)
    {
        SavedSearch::destroy($id);

        $this->resetSavedSearch();

        $this->notify(
            __('adminhub::notifications.saved_searches.deleted')
        );
    }

    /**
     * Save a search.
     *
     * @return void
     */
    public function saveSearch()
    {
        $this->validateOnly('savedSearchName', [
            'savedSearchName' => 'required',
        ]);

        auth()->getUser()->savedSearches()->create([
            'name' => $this->savedSearchName,
            'term' => $this->query,
            'component' => $this->getName(),
            'filters' => $this->filters,
        ]);

        $this->notify(
            __('adminhub::notifications.saved_searches.saved')
        );

        $this->savedSearchName = null;

        $this->emit('savedSearch');
    }

    /**
     * Return the saved searches available to the table.
     */
    public function getSavedSearchesProperty(): Collection
    {
        return auth()->getUser()->savedSearches()->whereComponent(
            $this->getName()
        )->get()->map(function ($savedSearch) {
            return [
                'key' => $savedSearch->id,
                'label' => $savedSearch->name,
                'filters' => $savedSearch->filters,
                'query' => $savedSearch->term,
            ];
        });
    }

    /**
     * {@inheritDoc}
     */
    public function getData()
    {
        $filters = $this->filters;
        $query = $this->query;

        if ($this->savedSearch) {
            $search = $this->savedSearches->first(function ($search) {
                return $search['key'] == $this->savedSearch;
            });

            if ($search) {
                $filters = $search['filters'];
                $query = $search['query'];
            }
        }

        return $this->tableBuilder
            ->searchTerm($query)
            ->queryStringFilters($filters)
            ->perPage($this->perPage)
            ->getData();
    }
}
