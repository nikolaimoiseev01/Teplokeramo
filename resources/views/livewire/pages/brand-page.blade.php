<main class="content flex-1">
    <div class="flex gap-6 mb-10 text-xl md:text-base">
        <a href="/" wire:navigate>Главная</a>
        <x-heroicon-s-chevron-right class="w-6"/>
        <a href="{{route('catalog-page')}}" wire:navigate>Каталог</a>
        <x-heroicon-s-chevron-right class="w-6"/>
        <a href="{{route('brands-page')}}" wire:navigate>Производители</a>
        <x-heroicon-s-chevron-right class="w-6"/>
        <p>{{$brand['name']}}</p>
    </div>

    <h1 class="uppercase mb-10 text-5xl md:text-3xl">{{$brand['name']}}</h1>

    <livewire:components.portal.catalog-list :collections="$brand->collection"/>

</main>
