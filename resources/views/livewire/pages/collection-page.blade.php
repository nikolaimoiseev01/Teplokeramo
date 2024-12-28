<main class="content flex-1">
    @if(Auth::check())
        <a href="/admin/collections/{{$collection['id']}}/edit"  target="_blank" class="link mb-8 block">Коллекция в Админке</a>
    @endif
    <div class="flex gap-6 flex-wrap mb-10 text-xl md:text-base">
        <a href="/" wire:navigate>Главная</a>
        <x-heroicon-s-chevron-right class="w-6"/>
        <a href="{{route('catalog-page')}}" wire:navigate>Каталог</a>
        <x-heroicon-s-chevron-right class="w-6"/>
        <a href="{{route('brands-page')}}" wire:navigate>Производители</a>
        <x-heroicon-s-chevron-right class="w-6"/>
        <a href="{{route('brand-page', $collection->brand['slug'])}}" wire:navigate>{{$collection->brand['name']}}</a>
        <x-heroicon-s-chevron-right class="w-6"/>
        <p>{{$collection['name']}}</p>
    </div>

    <h1 class="mb-10 text-5xl md:text-3xl">{{$collection->brand['name']}} | {{$collection['name']}}</h1>
    <div class="flex gap-8 mb-10 flex-wrap text-xl md:text-base ">
        <div class="flex px-4 justify-center items-center gap-2 text-red-200 rounded-2xl border-red-200 border">
            <x-heroicon-c-heart class="w-4 h-4"/>
            <span>В избранное</span>
        </div>
        <div class="flex px-4 justify-center items-center gap-2 text-green-700 rounded-2xl border-green-700 border">
            <x-heroicon-c-heart class="w-4 h-4"/>
            <span>В наличии</span>
        </div>
        <div class="flex px-4 justify-center items-center gap-2 rounded-2xl border border-black ">
            <span>Хит продаж!</span>
        </div>
    </div>

    <x-collection-slider class="mb-10" :collection="$collection"/>

    <h1 class="mb-10 text-5xl md:text-3xl">{{$collection['name']}}</h1>

    <p class="text-lg mb-8 md:text-base">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam vehicula urna vitae
        fringilla rutrum. Vestibulum
        id massa tortor. Donec ut mattis augue. Nulla nec scelerisque purus. Fusce volutpat risus libero, eget pulvinar
        dolor egestas at. Quisque sit amet venenatis erat, sit amet egestas sapien. Nunc sit amet mauris non eros
        rhoncus porttitor ac in ex. Aliquam erat volutpat. Suspendisse ac finibus dui.</p>

    <div class="flex mb-10 justify-between flex-wrap gap-8">
        <div class="flex gap-8">
            <div class="rounded-full w-16 h-16 md:w-10 md:h-10 bg-green-500"></div>
            <div class="rounded-full w-16 h-16 md:w-10 md:h-10 bg-gold-300"></div>
            <div class="rounded-full w-16 h-16 md:w-10 md:h-10 bg-gray-500"></div>
            <div class="rounded-full w-16 h-16 md:w-10 md:h-10 bg-black"></div>
        </div>
    </div>

    <section class="flex flex-col mb-8" x-data="{ open: true }">
        <div @click="open = !open" class="flex gap-2 items-center text-green-700 cursor-pointer">
            <p class="border-b text-lg border-green-700">Технические характеристики</p>
            <x-heroicon-o-chevron-down x-show="!open" class="w-6"/>
            <x-heroicon-o-chevron-up x-show="open" class="w-6"/>
        </div>
        <div x-show="open" class="mt-4 flex flex-col gap-2">
            <p><b class="text-xl">Производетель: </b>{{$collection->brand['name']}}</p>
            <p><b class="text-xl">Страна: </b>{{$collection->product[0]['country_name']}}</p>
            <p><b class="text-xl">Размеры, см: </b>тест</p>
            <p><b class="text-xl">Толщина, см: </b>{{$product_thickness}}</p>
            <p><b class="text-xl">Тип плитки: </b>{{$product_types}}</p>
            <p><b class="text-xl">Цвет плитки: </b>{{$product_colors}}</p>

        </div>
    </section>


    <section class="mb-8">
        <h1 class="mb-8 border-b-2 border-red w-fit md:text-2xl">Товары в коллекции</h1>
        <x-products-slider :products="$collection->product"/>
    </section>

    <div class="content h-20 w-full z-10 relative">
        <img src="/fixed/circle_text.png" class="absolute top-4 z-40 left-1/2 transform translate-x-[-50%]  md:hidden" alt="">
    </div>


</main>

