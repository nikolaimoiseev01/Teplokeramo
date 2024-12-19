<section x-data="{ tab: 'collections' }">
    <div class="flex gap-4 flex-wrap justify-between mb-8 items-center">
        <div class="text-lg flex gap-4">
            <span class="cursor-pointer" :class="{ 'border-b-2 border-red': tab === 'collections' }"
                  @click="tab = 'collections'">{{morphos\Russian\pluralize($orig_collections->count(), 'коллекция')}}</span>
            <span class="cursor-pointer" :class="{ 'border-b-2 border-red': tab === 'products' }"
                  @click="tab = 'products'">{{morphos\Russian\pluralize($totalProducts, 'товар')}}</span>
        </div>
        <div class="flex items-center gap-4">
            <span>По популятрности</span>
            <svg width="25" height="13" viewBox="0 0 25 13" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M2 2L12.5 10.5L23.5 2" stroke="black" stroke-width="3" stroke-linecap="round"/>
            </svg>
        </div>
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
            @if($totalProducts <= $product_limit)
                <p class="text-lg text-center">Все товары ({{$totalProducts}}) загружены</p>
            @else
                <p wire:click="loadMoreProducts" class="cursor-pointer text-lg text-center">Загрузить еще</p>
            @endif

    </div>
</section>
