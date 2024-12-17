<main>
    <section style="background-image: url('/storage/fixed/welcome_background.png');"
             class="relative h-screen w-full">
        <x-link-button class="absolute bottom-8 left-1/2 transform translate-x-[-50%] text-4xl">УЗНАТЬ БОЛЬШЕ
        </x-link-button>
    </section>

    <section class="content grid grid-rows-2 grid-flow-col gap-4 my-16">
        <div style="background-image: url('/storage/fixed/dlja_vannoi_background.png');"
            class="bg-cover row-span-1 h-96 relative">
            <span class="text-5xl font-semibold text-white absolute bottom-8 left-8">ДЛЯ<br>ВАННОЙ</span>
        </div>
        <div style="background-image: url('/storage/fixed/dlja_kuhni_background.png');"
             class="bg-contain col-span-1 h-96 bg-gold relative">
            <span class="text-5xl font-semibold text-white absolute top-8 left-8">ДЛЯ<br>КУХНИ</span>
        </div>
        <div style="background-image: url('/storage/fixed/dlja_vannoi_background_2.png');"
             class="bg-cover row-span-2 col-span-2 relative">
            <span class="text-5xl font-semibold text-white absolute top-8 left-8">ДЛЯ<br>КУХНИ</span>
        </div>
    </section>

    <section class="my-16 content uppercase flex justify-between items-center">
        <h1>Поставки<br>из Италии<br>и Испании</h1>
        <div class="w-0.5 bg-black h-28"></div>
        <h1>Актуальные<br>коллекции</h1>
        <div class="w-0.5 bg-black h-28"></div>
        <h1>Премиум<br>сервис</h1>
        <div class="w-0.5 bg-black h-28"></div>
        <h1>Разработка<br>3d проекта</h1>
    </section>

    <section class="content grid grid-rows-2 grid-cols-3 grid-flow-col gap-4 my-16">
        <div style="background-image: url('/storage/fixed/dlja_vannoi_background.png');"
             class="bg-cover row-span-2 relative">
            <span class="text-5xl font-semibold text-white absolute bottom-8 left-8">ДЛЯ<br>ВАННОЙ</span>
        </div>
        <div style="background-image: url('/storage/fixed/dlja_kuhni_background.png');"
             class="bg-contain row-span-2 bg-gold relative">
            <span class="text-5xl font-semibold text-white absolute top-8 left-8">ДЛЯ<br>КУХНИ</span>
        </div>
        <div style="background-image: url('/storage/fixed/dlja_vannoi_background_2.png');"
             class="bg-cover row-span-1 col-span-1 h-96 relative">
            <span class="text-5xl font-semibold text-white absolute top-8 left-8">ДЛЯ<br>КУХНИ</span>
        </div>
        <div style="background-image: url('/storage/fixed/dlja_vannoi_background_2.png');"
             class="bg-cover row-span-1 col-span-1 h-96 relative">
            <span class="text-5xl font-semibold text-white absolute top-8 left-8">ДЛЯ<br>КУХНИ</span>
        </div>
    </section>

    <section class="content">
        <h1>СВЯЖИТЕСЬ С НАМИ</h1>
        <div class="bg-green-300 p-8 flex gap-8 rounded-3xl">
            <div class="flex flex-col gap-4 w-1/2">
                <div class="flex flex-col">
                    <label for="">Имя</label>
                    <input type="text">
                </div>

                <div class="flex flex-col">
                    <label for="">Email</label>
                    <input type="text">
                </div>
                <div class="flex-1 flex flex-col">
                    <label for="">Сообщение</label>
                    <textarea class="h-full"></textarea>
                </div>
                <x-link-button>Отправить сообщение</x-link-button>
            </div>

            <img src="/storage/fixed/feedback_img.png" alt="">

        </div>
    </section>
</main>
