<main class="content flex-1">
    <div class="w-full relative">

        <h1 class="uppercase mb-10 text-5xl md:text-3xl">О НАС</h1>

        <div class="flex flex-wrap text-lg gap-20 mb-10 uppercase underline md:gap-8">
            <a href="/" wire:navigate>Проекты</a>
            <div class="w-0.5 h-6 bg-black md:hidden"></div>
            <a href="" wire:navigate>Новости</a>
            <div class="w-0.5 h-6 bg-black md:hidden"></div>
            <a href="{{route('catalog-page')}}" wire:navigate>Каталог</a>
        </div>

        <img src="/fixed/circle_text.png" class="absolute w-72 bottom-0 z-40 right-16 md:hidden" alt="">

    </div>
    <p class="mb-10 text-lg">
        Компания «Тепло Керамо» с 2001 года успешно развивает свою деятельность на российском рынке и специализируется
        на поставках отделочных материалов: керамического гранита, керамической плитки, стеклянной и мраморной мозаики и
        расходных материалов для их укладки. Нашими основными поставщиками являются ведущие российские, итальянские,
        испанские и другие мировые фабрики. Мы предлагаем огромный ассортимент керамических изделий, применяемых в
        отделке как жилых и коммерческих интерьеров так и больших архитектурных ансамблей.
    </p>

    <div class="flex flex-wrap mb-16">
        <div class="w-1/2 flex flex-col gap-1 items-center justify-center text-center p-12 border-b border-r border-black md:w-full md:border-r-0">
            <h1 class="text-8xl md:text-6xl">23</h1>
            <span class="text-2xl md:text-xl font-bold">года<br>успешной работы</span>
        </div>
        <div class="w-1/2 flex flex-col gap-1 items-center justify-center text-center p-12 border-b border-black md:w-full">
            <h1 class="text-8xl md:text-6xl">61</h1>
            <span class="text-2xl md:text-xl font-bold">фабрика<br>среди наших поставщиков</span>
        </div>
        <div class="w-1/2 flex flex-col gap-1 items-center justify-center text-center p-12 border-r border-black md:w-full md:border-r-0 md:border-b">
            <h1 class="text-8xl md:text-6xl">75&nbsp; 232</h1>
            <span class="text-2xl md:text-xl font-bold">позиции<br>доступно для заказа</span>
        </div>
        <div class="w-1/2 flex flex-col gap-1 items-center justify-center text-center p-12 md:w-full">
            <h1 class="text-8xl md:text-6xl">1&nbsp; 343</h1>
            <span class="text-2xl md:text-xl font-bold">дилера<br>по всей России</span>
        </div>
    </div>

    <div class="w-full flex">
        <x-link-button class="text-4xl mx-auto">СОЗДАТЬ ДИЗАЙН ПРОЕКТ
        </x-link-button>
    </div>
</main>
