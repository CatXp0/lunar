<?php

namespace Lunar\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Lunar\Models\Product;
use Lunar\Models\ProductReview;
use Lunar\Models\ProductVariant;

class ProductReviewFactory extends Factory
{
    protected $model = ProductReview::class;

    public function definition(): array
    {
        return [
            'product_id' => Product::factory(),
            'variant_id' => ProductVariant::factory(),
            'title' => Str::random(12),
            'content' => Str::random(12),
            'unit_quantity' => 1,
            'rating' => $this->faker->randomElements(range(1, 5)),
            'real_rating' => $this->faker->randomElements(range(1, 5)),
            'is_active' => true,
        ];
    }
}
