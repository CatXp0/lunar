<div class="flex-col space-y-4">
    <div class="flex items-center justify-between">
        <strong class="text-xl font-bold md:text-2xl">
            {{ __('adminhub::catalogue.product-reviews.index.title') }}
        </strong>

        <div class="text-right">
            <x-hub::button tag="a"
                           href="{{ route('hub.product-reviews.create') }}">
                {{ __('adminhub::catalogue.product-reviews.index.create_btn') }}
            </x-hub::button>
        </div>
    </div>

    <div>
        @livewire('hub.components.products.product-reviews.table')
    </div>

</div>
