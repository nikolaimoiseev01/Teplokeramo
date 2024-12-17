<a wire:key="{{$product['id']}}" href="{{route('product-page', $product['slug'])}}" class="swiper-slide flex flex-col gap-4 max-w-80" wire:navigate>
    {{$product->getFIrstMedia('cover')}}
    <h2>{{$product['name']}}</h2>
    <div class="flex gap-2">
        <x-icon name="flag-country-{{$product['country_code']}}" class="w-4"/>
        <p>{{$product->country['name']}}</p>
    </div>
</a>
