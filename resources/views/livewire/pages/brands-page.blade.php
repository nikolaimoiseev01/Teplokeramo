<main class="content flex-1">
    <div class="flex gap-6 mb-6">
        <a href="/" wire:navigate>Главная</a>
        <x-heroicon-s-chevron-right class="w-6"/>
        <a href="{{route('catalog-page')}}" wire:navigate>Каталог</a>
        <x-heroicon-s-chevron-right class="w-6"/>
        <span>Производители</span>
    </div>
    <h1 class="uppercase mb-6 text-4xl">Производители</h1>

    <x-dropdown-select
        class="mb-6"
        alltext="Все страны"
        model="country_filter"
        :options="$countries"
    />


    <div class="flex gap-6 flex-wrap md:justify-center ">
        @foreach($brands as $brand)
            <x-cards.brand :brand="$brand"/>
        @endforeach
    </div>


</main>
