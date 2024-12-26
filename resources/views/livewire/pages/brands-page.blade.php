<main class="content flex-1">
    <div class="flex gap-6 mb-10 text-xl md:text-base flex-wrap">
        <a href="/" wire:navigate>Главная</a>
        <x-heroicon-s-chevron-right class="w-6"/>
        <a href="{{route('catalog-page')}}" wire:navigate>Каталог</a>
        <x-heroicon-s-chevron-right class="w-6"/>
        <span>Производители</span>
    </div>
    <h1 class="uppercase mb-10 text-5xl md:text-3xl">Производители</h1>

    <div class="flex gap-10 relative mb-16">
        <x-dropdown-select
            class="mb-6"
            alltext="Все страны"
            model="country_filter"
            :options="$countries"
        />

        <img src="/fixed/circle_text.png" class="absolute z-40 right-16 -top-40 md:hidden w-72" alt="">

        <x-dropdown-select
            model="sort_option"
            type="no_border"
            :options="$sort_options"
        />
    </div>


    <div class="flex gap-6 flex-wrap md:justify-center ">
        @foreach($brands as $brand)
            <x-cards.brand :brand="$brand"/>
        @endforeach
    </div>


</main>
