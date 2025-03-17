<section x-data="{ tab: 'collections' }">

    @if($f_area_of_use)
        <h1 class="text-3xl mb-8">{{$f_area_of_use}}</h1>
    @endif

    <div class="flex gap-4 flex-wrap justify-between mb-8 items-center">
        <div class="text-xl flex gap-4">
            <span class="cursor-pointer px-6 py-1" :class="{ 'text-white bg-green-400 rounded-xl': tab === 'collections' }"
                  @click="tab = 'collections'">{{morphos\Russian\pluralize($orig_collections->count(), 'коллекция')}}</span>
            <span class="cursor-pointer  px-6 py-1" :class="{ 'text-white bg-green-400 rounded-xl': tab === 'products' }"
                  @click="tab = 'products'">{{morphos\Russian\pluralize($orig_products->count(), 'товар')}}</span>
        </div>
        <x-dropdown-select
            model="sort_option"
            type="no_border"
            :options="$sort_options"
        />
    </div>




        <div x-show="tab == 'collections'"> {{-- Коллекции --}}
        <div class="grid grid-cols-[repeat(3,_270px)] justify-between gap-8 mb-6 xl:flex xl:flex-wrap">
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
        <div class="grid grid-cols-[repeat(3,_270px)] justify-between gap-8 mb-6 xl:flex xl:flex-wrap">
            @foreach($products as $key => $product)
                <x-cards.product :product="$product"/>
            @endforeach

        </div>
        @if($orig_products->count() <= $product_limit)
            <p class="text-lg text-center">Все товары ({{$orig_products->count()}}) загружены</p>
        @else
            <p wire:click="loadMoreProducts" class="cursor-pointer text-lg text-center">Загрузить еще
                <svg wire:loading aria-hidden="true" class="w-8 h-8 text-gray-200 animate-spin dark:text-gray-600 fill-green-700" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="currentColor"/>
                    <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentFill"/>
                </svg>
            </p>
        @endif

    </div>
</section>
