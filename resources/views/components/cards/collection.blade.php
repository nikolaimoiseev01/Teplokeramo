<a wire:key="{{$collection['id']}}" class=" flex flex-col gap-4 max-w-80" href="{{route('collection-page', $collection['slug'])}}" wire:navigate>
    <div class="w-72 h-72 bg-gray-50">
        <img src="{{$collection->getFIrstMediaUrl('cover')}}" class="w-full"  alt="">
    </div>
    <h2 class="text-3xl">{{$collection['name']}}</h2>
    <div class="flex gap-2">
        <p>{{$collection->brand['name']}}</p>
        <x-icon name="flag-country-{{$collection->product[0]['country_code']}}" class="w-4"/>
        <p>{{$collection->product[0]->country['name']}}</p>
    </div>

</a>
