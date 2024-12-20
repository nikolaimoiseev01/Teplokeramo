<main class="content flex-1">
    <h1 class="uppercase mb-8 text-4xl">Производители</h1>

    <div class="flex flex-wrap gap-20 mb-8 uppercase underline md:gap-8 md:flex-col">
        <a href="/" wire:navigate>Проекты</a>
        <div class="w-0.5 h-6 bg-black md:hidden"></div>
        <a href="" wire:navigate>Новости</a>
        <div class="w-0.5 h-6 bg-black md:hidden"></div>
        <a href="{{route('catalog-page')}}" wire:navigate>Каталог</a>
    </div>

    <p class="mb-8"">
        Компания «Тепло Керамо» с 2001 года успешно развивает свою деятельность на российском рынке и специализируется
        на поставках отделочных материалов: керамического гранита, керамической плитки, стеклянной и мраморной мозаики и
        расходных материалов для их укладки. Нашими основными поставщиками являются ведущие российские, итальянские,
        испанские и другие мировые фабрики. Мы предлагаем огромный ассортимент керамических изделий, применяемых в
        отделке как жилых и коммерческих интерьеров так и больших архитектурных ансамблей.
    </p>

    <div class="flex flex-wrap mb-16">
        <div class="w-1/2 flex flex-col gap-1 items-center justify-center text-center p-12 border-b border-r border-black md:w-full md:border-r-0">
            <h1 class="text-8xl">23</h1>
            <span class="text-2xl font-bold">года<br>успешной работы</span>
        </div>
        <div class="w-1/2 flex flex-col gap-1 items-center justify-center text-center p-12 border-b border-black md:w-full">
            <h1 class="text-8xl">61</h1>
            <span class="text-2xl font-bold">фабрика<br>среди наших поставщиков</span>
        </div>
        <div class="w-1/2 flex flex-col gap-1 items-center justify-center text-center p-12 border-r border-black md:w-full md:border-r-0 md:border-b">
            <h1 class="text-8xl">75&nbsp; 232</h1>
            <span class="text-2xl font-bold">позиции<br>доступно для заказа</span>
        </div>
        <div class="w-1/2 flex flex-col gap-1 items-center justify-center text-center p-12 md:w-full">
            <h1 class="text-8xl">1&nbsp; 343</h1>
            <span class="text-2xl font-bold">дилера<br>по всей России</span>
        </div>
    </div>

    <div class="w-full flex">
        <x-link-button class="text-4xl mx-auto">СОЗДАТЬ ДИЗАЙН ПРОЕКТ
        </x-link-button>
    </div>
</main>
