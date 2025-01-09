<main class="content flex-1">
    <div class="w-full relative mt-10">

        <h1 class="uppercase mb-10 text-5xl md:text-3xl">Дизайнерам</h1>

        <div class="flex flex-wrap text-lg gap-20 mb-10 uppercase underline md:gap-8">
            <a href="/" wire:navigate>Проекты</a>
            <div class="w-0.5 h-6 bg-black md:hidden"></div>
            <a href="" wire:navigate>Новости</a>
            <div class="w-0.5 h-6 bg-black md:hidden"></div>
            <a href="{{route('catalog-page')}}" wire:navigate>Каталог</a>
        </div>

        <img src="/fixed/circle_text.png" class="absolute w-64 bottom-0 z-40 right-16 md:hidden" alt="">

    </div>

    <p class="mb-10 text-lg">
        Компания «Тепло Керамо» с 2001 года успешно развивает свою деятельность на российском рынке и специализируется
        на поставках отделочных материалов: керамического гранита, керамической плитки, стеклянной и мраморной мозаики и
        расходных материалов для их укладки. Нашими основными поставщиками являются ведущие российские, итальянские,
        испанские и другие мировые фабрики. Мы предлагаем огромный ассортимент керамических изделий, применяемых в
        отделке как жилых и коммерческих интерьеров так и больших архитектурных ансамблей.
    </p>

    <div class="flex gap-4 flex-wrap mb-16">
        <img src="/fixed/designers_pic_1.png" class="w-full h-116 md:h-80" alt="">
        <div class="grid grid-cols-3 gap-4 w-full max-w-full md:flex md:flex-col">
            <img src="/fixed/designers_pic_2.png" class="h-auto w-full object-cover" alt="">
            <img src="/fixed/designers_pic_3.png" class="h-auto w-full object-cover" alt="">
            <img src="/fixed/designers_pic_4.png" class="h-auto w-full object-cover" alt="">
        </div>
    </div>

    <div class="w-full flex">
        <x-link-button x-on:click="$dispatch('open-modal', 'contact-modal')" class="text-4xl mx-auto">СВЯЗАТЬСЯ С НАМИ
        </x-link-button>
    </div>

</main>
