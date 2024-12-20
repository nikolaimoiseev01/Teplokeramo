<main>
    <section style="background-image: url('/fixed/welcome_background.png');"
             class="relative h-screen w-full">
        <x-link-button class="absolute bottom-8 left-1/2 transform translate-x-[-50%] text-4xl">УЗНАТЬ БОЛЬШЕ
        </x-link-button>
    </section>

    <section class="content grid grid-rows-2 grid-flow-col gap-4 my-16 md:flex md:flex-col">
        <a href="{{ route('catalog-page', ['f_area_of_use' => 'Для ванной']) }}" style="background-image: url('/fixed/dlja_vannoi_background.png');"
            class="bg-cover row-span-1 h-96 relative">
            <span class="text-5xl font-semibold text-white absolute bottom-8 left-8">ДЛЯ<br>ВАННОЙ</span>
        </a>
        <a href="{{ route('catalog-page', ['f_area_of_use' => 'Для кухни']) }}" style="background-image: url('/fixed/dlja_kuhni_background.png');"
             class="bg-contain col-span-1 h-96 bg-gold relative">
            <span class="text-5xl font-semibold text-white absolute top-8 left-8">ДЛЯ<br>КУХНИ</span>
        </a>
        <a href="{{ route('catalog-page', ['f_area_of_use' => 'Для кухни']) }}" style="background-image: url('/fixed/dlja_vannoi_background_2.png');"
             class="bg-cover row-span-2 col-span-2 relative md:h-96">
            <span class="text-5xl font-semibold text-white absolute top-8 left-8">ДЛЯ<br>КУХНИ</span>
        </a>
    </section>

    <section class="my-16 content uppercase flex justify-between items-center flex-wrap gap-8 md:justify-center md:text-center">
        <h1>Поставки<br>из Италии<br>и Испании</h1>
        <div class="w-0.5 bg-black h-28 md:hidden"></div>
        <h1>Актуальные<br>коллекции</h1>
        <div class="w-0.5 bg-black h-28  md:hidden"></div>
        <h1>Премиум<br>сервис</h1>
        <div class="w-0.5 bg-black h-28  md:hidden"></div>
        <h1>Разработка<br>3d проекта</h1>
    </section>

    <section class="content grid grid-rows-2 grid-cols-3 grid-flow-col gap-4 my-16 flex-wrap md:flex md:flex-col">
        <a href="{{ route('catalog-page', ['f_area_of_use' => 'Для ванной']) }}" style="background-image: url('/fixed/dlja_vannoi_background.png');"
             class="bg-cover row-span-2 col-span-1 relative md:h-96">
            <span class="text-5xl font-semibold text-white absolute bottom-8 left-8">ДЛЯ<br>ВАННОЙ</span>
        </a>
        <a href="{{ route('catalog-page', ['f_area_of_use' => 'Для кухни']) }}" style="background-image: url('/fixed/dlja_kuhni_background.png');"
             class="bg-contain row-span-2 col-span-1 bg-gold relative md:h-96">
            <span class="text-5xl font-semibold text-white absolute top-8 left-8">ДЛЯ<br>КУХНИ</span>
        </a>
        <a href="{{ route('catalog-page', ['f_area_of_use' => 'Для кухни']) }}" style="background-image: url('/fixed/dlja_vannoi_background_2.png');"
             class="bg-cover row-span-1 col-span-1 h-96 relative">
            <span class="text-5xl font-semibold text-white absolute top-8 left-8">ДЛЯ<br>КУХНИ</span>
        </a>
        <a href="{{ route('catalog-page', ['f_area_of_use' => 'Для кухни']) }}" style="background-image: url('/fixed/dlja_vannoi_background_2.png');"
             class="bg-cover row-span-1 col-span-1 h-96 relative">
            <span class="text-5xl font-semibold text-white absolute top-8 left-8">ДЛЯ<br>КУХНИ</span>
        </a>
    </section>

    <section class="content">
        <livewire:components.contact-form/>
    </section>

</main>
