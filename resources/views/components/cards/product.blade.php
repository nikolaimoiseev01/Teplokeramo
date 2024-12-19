<a wire:key="{{$product['id']}}" href="{{route('product-page', $product['slug'])}}" class="swiper-slide flex flex-col gap-4 max-w-72" wire:navigate>
    <div class="w-72 h-72 bg-gray-50">
        <img src="{{$product->getFIrstMediaUrl('cover')}}" class="w-full"  alt="">
    </div>
    <h2 class="text-3xl">{{$product['name']}}</h2>
    <div class="flex gap-2">
        <x-icon name="flag-country-{{$product['country_code']}}" class="w-4"/>
        <p>{{$product->country['name']}}</p>
    </div>
</a>
