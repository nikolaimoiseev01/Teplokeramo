<a wire:key="{{$product['id']}}" href="{{route('product-page', $product['slug'])}}"
   class="flex flex-col gap-2 w-fit max-w-72 sm:mx-auto" wire:navigate>
    <div class="w-72 h-72 md:w-52 md:h-52 relative">
        <div class="absolute w-full h-full bg-gray-200 animate-pulse"></div>
        <img src="{{$product->getFIrstMediaUrl('cover')}}" class="absolute z-20 w-full h-full object-cover" alt="">
    </div>
    <h2 class="text-3xl font-bold md:text-xl">{{$product['name']}}</h2>
    @if($product->collection)
        <div class="flex gap-2 text-xl md:text-base">
            <p>{{$product->collection['name']}}</p>
            <x-icon name="flag-country-{{$product['country_code']}}" class="w-4"/>
            <p>{{$product['country_name']}}</p>
        </div>
    @endif
    <p class="text-xl">От <b>999 руб. за м2</b></p>
    <p class="text-green-700 text-xl font-bold flex gap-2">
        <x-heroicon-s-check-circle class="w-4"/>
        В наличии
    </p>

</a>
