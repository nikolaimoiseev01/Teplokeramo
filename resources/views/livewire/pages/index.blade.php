<main>
    <style>

        /* Основной фон для больших экранов */
        .welcome-section {
            background-image: url('/fixed/welcome_background.png');
            background-size: cover;
            background-position: center;
        }

        /* Изменение фона для маленьких экранов */
        @media (max-width: 768px) {
            .welcome-section {
                background-image: url('/fixed/welcome_background_small.png');
            }
        }
    </style>
    <section class="welcome-section relative h-screen w-full">
        <x-link-button href="{{route('about-page')}}"
                       wire:navigate
                       class="absolute w-max py-7 bottom-10 left-1/2 transform translate-x-[-50%] text-4xl md:text-xl md:py-4">
            УЗНАТЬ БОЛЬШЕ
        </x-link-button>
        <div class="w-full absolute left-1/2 hidden top-1/2 transform w-2/3 translate-y-[-50%]  translate-x-[-50%] md:block">
        <img src="/fixed/circle_white.png"
             class=" animate-spin-slow" alt="">
        </div>

        <div class="content h-20 w-full absolute bottom-0 left-1/2 translate-x-[-50%] z-10">
            <img src="/fixed/circle_text.png" class="absolute -bottom-52 z-40 right-0 md:hidden animate-spin-slow" alt="">
        </div>

    </section>

    <section class="content grid grid-rows-2 grid-flow-col gap-4 my-16 text-4xl font-semibold text-white md:flex md:flex-col md:text-3xl">
        <a href="{{ route('catalog-page', ['f_area_of_use' => 'Для ванной']) }}"
           style="background-image: url('/fixed/dlja_vannoi_background.png');"
           class="bg-cover row-span-1 h-96 relative">
            <span class=" absolute bottom-8 left-8">ДЛЯ<br>ВАННОЙ</span>
        </a>
        <a href="{{ route('catalog-page', ['f_area_of_use' => 'Для кухни']) }}"
           style="background-image: url('/fixed/dlja_kuhni_background.png');"
           class="bg-contain col-span-1 h-96 bg-gold relative">
            <span class="absolute top-8 left-8">ДЛЯ<br>КУХНИ</span>
        </a>
        <a href="{{ route('catalog-page', ['f_area_of_use' => 'Для кухни']) }}"
           style="background-image: url('/fixed/dlja_vannoi_background_2.png');"
           class="bg-cover row-span-2 col-span-2 relative md:h-96">
        </a>
    </section>

    <section
        class="my-16 content uppercase flex justify-between items-center flex-wrap gap-8 text-3xl leading-7 md:justify-center md:text-center">
        <h1 class="">Поставки<br>из Италии<br>и Испании</h1>
        <div class="w-0.5 bg-black h-20 md:hidden"></div>
        <h1 class="">Актуальные<br>коллекции</h1>
        <div class="w-0.5 bg-black h-20  md:hidden"></div>
        <h1 class="">Премиум<br>сервис</h1>
        <div class="w-0.5 bg-black h-20  md:hidden"></div>
        <h1 class="">Разработка<br>3d проекта</h1>
    </section>

    <style>

        /* Изменение фона для маленьких экранов */
        @media (max-width: 768px) {
            .sant-block {
                background-position: 0 780px;
            }
        }
    </style>
    <section
        class="content flex gap-4 my-16 flex-wrap md:flex md:flex-col uppercase text-4xl md:text-3xl leading-8 font-semibold text-white">
        <a href="{{ route('catalog-page', ['f_area_of_use' => 'Для ванной']) }}"
           style="background-image: url('/fixed/santechnika.png');"
           class="sant-block bg-cover flex-1 relative md:h-116 md:flex-initial">
            <span class=" absolute top-8 left-8">Сантехника</span>
        </a>
        <a href="{{ route('catalog-page', ['f_area_of_use' => 'Для кухни']) }}"
           style="background-image: url('/fixed/santechnika_2.png');"
           class="bg-cover flex-1 bg-gold relative md:h-116 md:flex-initial">
            <span class=" absolute bottom-8 left-8">Готовые<br>решения</span>
        </a>
        <div class="flex flex-col gap-4">
            <a href="{{ route('catalog-page', ['f_area_of_use' => 'Для кухни']) }}"
               style="background-image: url('/fixed/sop_tovari.png');"
               class="bg-cover h-116 w-116 block relative md:flex-initial md:w-full">
                <span class="text-white absolute bottom-8 left-8">Сопутствующие<br>товары</span>
            </a>
            <a href="{{ route('catalog-page', ['f_area_of_use' => 'Для кухни']) }}"
               style="background-image: url('/fixed/zelenaja_plitka.png');"
               class="bg-cover block h-116 w-116 relative md:flex-initial md:w-full">
            </a>
        </div>

    </section>

    <section class="content">
        <livewire:components.contact-form/>
    </section>

</main>
