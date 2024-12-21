<a wire:key="{{$brand['id']}}" class="p-4 bg-gold-300 hover:shadow max-w-72 flex flex-col gap-2"
   href="{{route('brand-page', $brand['slug'])}}?f_brand_id={{$brand['id']}}" wire:navigate>
    {{$brand->getFIrstMedia('cover')}}
    <h2 class="text-3xl font-bold">{{$brand['name']}}</h2>
    <div class="flex gap-2">
        <x-icon name="flag-country-{{$brand->product[0]['country_code']}}" class="w-4"/>
        <p>{{$brand->product[0]->country['name']}}</p>
    </div>
</a>
