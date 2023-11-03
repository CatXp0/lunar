<div class="flex-col space-y-4">
    <div class="flex items-center justify-between">
        <strong class="text-xl font-bold md:text-2xl">
            {{ __('adminhub::catalogue.reviews.index.title') }}
        </strong>

        <div class="text-right">
            <x-hub::button tag="a"
                           href="{{ route('hub.reviews.create') }}">
                {{ __('adminhub::catalogue.reviews.index.create_btn') }}
            </x-hub::button>
        </div>
    </div>

    <div>
        @livewire('hub.components.products.reviews.table')
    </div>

</div>
