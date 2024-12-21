<section x-data="{ tab: 'collections' }">

    @if($f_area_of_use)
        <h1 class="text-3xl mb-8">{{$f_area_of_use}}</h1>
    @endif

    <div class="flex gap-4 flex-wrap justify-between mb-8 items-center">
        <div class="text-xl flex gap-4">
            <span class="cursor-pointer" :class="{ 'border-b-2 border-red': tab === 'collections' }"
                  @click="tab = 'collections'">{{morphos\Russian\pluralize($orig_collections->count(), 'коллекция')}}</span>
            <span class="cursor-pointer" :class="{ 'border-b-2 border-red': tab === 'products' }"
                  @click="tab = 'products'">{{morphos\Russian\pluralize($orig_products->count(), 'товар')}}</span>
        </div>
        <x-dropdown-select
            model="sort_option"
            type="no_border"
            :options="$sort_options"
        />
    </div>




        <div x-show="tab == 'collections'"> {{-- Коллекции --}}
        <div class="flex gap-8 flex-wrap justify-between mb-6 md:justify-center">
            @foreach($collections as $collection)
                <x-cards.collection :collection="$collection"/>
            @endforeach
        </div>
        @if($orig_collections->count() <= $collection_limit)
            <p class="text-lg text-center">Все коллекции ({{$orig_collections->count()}}) загружены</p>
        @else
            <p wire:click="loadMoreCollections" class="cursor-pointer text-lg text-center">Загрузить еще</p>
        @endif

    </div>

    <div x-show="tab == 'products'"> {{-- Товары --}}
        <div class="flex gap-8 flex-wrap justify-between mb-6 md:justify-center">
            @foreach($products as $key => $product)
                <x-cards.product :product="$product"/>
            @endforeach

        </div>
        @if($orig_products->count() <= $product_limit)
            <p class="text-lg text-center">Все товары ({{$orig_products->count()}}) загружены</p>
        @else
            <p wire:click="loadMoreProducts" class="cursor-pointer text-lg text-center">Загрузить еще</p>
        @endif

    </div>
</section>
