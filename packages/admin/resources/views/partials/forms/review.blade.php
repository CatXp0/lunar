<div class="flex-col space-y-4">
    <div class="flex-col px-4 py-5 space-y-4 bg-white shadow sm:rounded-md sm:p-6">
        <x-hub::input.group label="Content"
                            for="content"
                            :error="$errors->first('productReview.content')"
                            required>
            <x-hub::input.text wire:model="productReview.rating"
                               name="rating"
                               id="rating"
                               :error="$errors->first('productReview.rating')" />
        </x-hub::input.group>
    </div>

    <div x-data="{ view: 'products' }">
        <div class="p-6 bg-white rounded-b shadow">
            @if ($view == 'products')
                @include('adminhub::partials.reviews.attributes', [
                    'type' => 'products',
                ])
            @endif
        </div>
    </div>
</div>
