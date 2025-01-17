<?php

namespace Lunar\Hub\Tables\Builders;

use Lunar\Hub\Tables\TableBuilder;
use Lunar\Models\ProductReview;

class ProductReviewsTableBuilder extends TableBuilder
{
    /**
     * Return the query data.
     *
     * @return LengthAwarePaginator
     */
    public function getData(): iterable
    {
        $query = ProductReview::query()->withCount(['product']);

        if ($this->searchTerm) {
            $query->where('title', 'LIKE', '%'.$this->searchTerm.'%');
        }

        $filters = collect($this->queryStringFilters)->filter(function ($value) {
            return (bool) $value;
        });

        foreach ($this->queryExtenders as $qe) {
            call_user_func($qe, $query, $this->searchTerm, $filters);
        }

        // Get the table filters we want to apply.
        $tableFilters = $this->getFilters()->filter(function ($filter) use ($filters) {
            return $filters->has($filter->field);
        });

        foreach ($tableFilters as $filter) {
            call_user_func($filter->getQuery(), $filters, $query);
        }

        return $query->paginate($this->perPage);
    }
}
