<a wire:key="{{$collection['id']}}" class=" flex flex-col gap-2 max-w-80" href="{{route('collection-page', $collection['slug'])}}" wire:navigate>
    <div class="w-72 h-72 md:w-52 md:h-52 relative">
        <div class="bg-gradient-to-r from-gray-200 via-gray-300 to-gray-200 animate-pulse absolute w-full h-full z-0"></div>
        <img src="{{$collection->getFIrstMediaUrl('cover')}}" class="w-full absolute w-full h-full z-10"  alt="">
    </div>
    <h2 class="text-3xl font-bold">{{$collection['name']}}</h2>
    <div class="flex gap-2 text-xl">
        <p>{{$collection->brand['name']}}</p>
        <x-icon name="flag-country-{{$collection->product[0]['country_code']}}" class="w-4"/>
        <p>{{$collection->product[0]->country['name']}}</p>
    </div>
    <p class="text-xl">От <b>999 руб. за м2</b></p>
    <p class="text-green-700 text-xl font-bold flex gap-2"><x-heroicon-s-check-circle class="w-4" />В наличии</p>

</a>
