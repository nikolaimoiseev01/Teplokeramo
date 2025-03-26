<main class="content flex-1">
    @if(Auth::check())
        <a href="/admin/products/{{$product['id']}}/edit" target="_blank" class="link mb-8 block">Товар в Админке</a>
    @endif
    <div class="flex gap-6 flex-wrap mb-10 text-xl md:text-base">
        <a href="/" wire:navigate>Главная</a>
        <x-heroicon-s-chevron-right class="w-6"/>
        <a href="{{route('catalog-page')}}" wire:navigate>Каталог</a>
        <x-heroicon-s-chevron-right class="w-6"/>
        <a href="{{route('brands-page')}}" wire:navigate>Производители</a>
        <x-heroicon-s-chevron-right class="w-6"/>
        <a href="{{route('brand-page', $product->brand['slug'])}}" wire:navigate>{{$product->brand['name']}}</a>
        <x-heroicon-s-chevron-right class="w-6"/>
        <p>{{$product['name']}}</p>
    </div>
    <section class="flex mb-10 gap-8 xl:flex-col">
        <img src="{{$product->getFirstMediaUrl('cover')}}" class="w-128 min-w-128 max-h-128 object-cover md:min-w-px"
             alt="">
        <div class="flex gap-8 flex-col">
            <div class="flex flex-col gap-4">
                <h1 class="text-4xl font-bold ">{{$product->brand['name']}} | {{$product['name']}}</h1>
                @if($product['country_code'])
                    <div class="flex gap-2 text-xl md:text-base">
                        <x-icon name="flag-country-{{$product['country_code']}}" class="w-4"/>
                        <p>{{$product['country_name']}}</p>
                        <p>{{$product['size'] ?? null}}</p>
                    </div>
                @endif
            </div>
            <div class="flex gap-8 md:flex-col">
                <div class="flex flex-col gap-4">
                    <h1 class="text-green-500 text-5xl font-bold">{{$product['price'] / 100}}р за м2</h1>
                    @if($product['old_price'])
                        <h1 class="text-4xl line-through text-gray-200">{{$product['old_price'] / 100}}р</h1>
                    @endif
                </div>
                <div class="flex gap-4 flex-col flex-1">
                    <p class="text-green-700 text-xl font-bold flex gap-2">
                        <x-heroicon-s-check-circle class="w-4"/>
                        В наличии
                    </p>
                    <div class="flex">
                        <p>ID</p>
                        <div class="border-b border-gray-200 mb-1 mx-2 flex-1"></div>
                        <p>{{$product['id']}}</p>
                    </div>
                    @if($product['article'])
                        <div class="flex">
                            <p>Артикул</p>
                            <div class="border-b border-gray-200 mb-1 mx-2 flex-1"></div>
                            <p>{{$product['article']}}</p>
                        </div>
                    @endif
                    @if($product['type'])
                        <div class="flex">
                            <p>Тип</p>
                            <div class="border-b border-gray-200 mb-1 mx-2 flex-1"></div>
                            <p>{{$product['type']}}</p>
                        </div>
                    @endif
                </div>
            </div>
            @if($product['packaged'] > 0)
                <div class="flex flex-col gap-8 border rounded-2xl border-gray-200 p-4">
                    <div class="flex gap-4 items-start justify-between md:flex-col">
                        <div class="flex flex-col gap-4 text-xl">
                            <p>Товар продается упаковками:</p>
                            <div class="flex gap-4">
                                <p class="text-gray-200">1 упак = {{$product['packaged']}}м2</p>
                                @if($product['packaged_cnt'])
                                    <p class="text-gray-200">Шт в кор: {{$product['packaged_cnt']}}</p>
                                @endif
                            </div>
                        </div>
                        <div
                            class="flex px-4 justify-center items-center gap-2 text-red-200 rounded-2xl border-red-200 border">
                            <x-heroicon-c-heart class="w-4 h-4"/>
                            <span>В избранное</span>
                        </div>
                    </div>
                    <div class="flex gap-8 justify-between items-center md:flex-col">
                        <x-range-input :product="$product"></x-range-input>
                        <x-link-button wire:ignore id="big-basket-button-{{$product['id']}}"
                                       {{--                                   onclick="addIdToCookie('basket-products', {{$product['id']}})"--}}
                                       wire:click="addIdToCookie()"
                                       class=" w-full">В корзину
                        </x-link-button>
                        <div class="flex flex-col ">
                            <p>Итог</p>
                            <h1 class="text-nowrap">{{$total_price / 100}} руб</h1>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </section>

    <section class="flex flex-col mb-10 gap-8" x-data="{ open: true }">
        <div @click="open = !open" class="flex gap-2 items-center text-green-700 cursor-pointer">
            <p class="border-b text-lg border-green-700">Характеристики</p>
            <x-heroicon-o-chevron-down x-show="!open" class="w-6"/>
            <x-heroicon-o-chevron-up x-show="open" class="w-6"/>
            <div class="border-b border-gray-200 mx-2 mb-px flex-1 mt-auto"></div>
        </div>
        <div class="grid grid-cols-2 grid-flow-row auto-rows-max gap-x-8 gap-y-4 text-xl md:flex md:flex-col">
            <div class="flex">
                <p>Производитель</p>
                <div class="border-b border-gray-200 mb-1 mx-2 flex-1"></div>
                <p class="md:text-end">{{$product->brand['name']}}</p>
            </div>
            @if($product->collection)
                <div class="flex">
                    <p>Коллекция</p>
                    <div class="border-b border-gray-200 mb-1 mx-2 flex-1"></div>
                    <p class="md:text-end">{{$product->collection['name']}}</p>
                </div>
            @endif
            @if($product->country_name)
                <div class="flex">
                    <p>Страна</p>
                    <div class="border-b border-gray-200 mb-1 mx-2 flex-1"></div>
                    <p class="md:text-end">{{$product['country_name']}}</p>
                </div>
            @endif
            @if($product['thickness'] ?? null)
                <div class="flex">
                    <p>Толщина плитки</p>
                    <div class="border-b border-gray-200 mb-1 mx-2 flex-1"></div>
                    <p class="md:text-end">{{$product['thickness']}}</p>
                </div>
            @endif
            @if($product['weight'])
                <div class="flex">
                    <p>Вес в коробке</p>
                    <div class="border-b border-gray-200 mb-1 mx-2 flex-1"></div>
                    <p class="md:text-end">{{$product['weight']}}</p>
                </div>
            @endif
            @if($product['color'])
                <div class="flex">
                    <p>Цвет</p>
                    <div class="border-b border-gray-200 mb-1 mx-2 flex-1"></div>
                    <p class="md:text-end">{{$product['color']}}</p>
                </div>
            @endif
            @if($product['size'])
                <div class="flex">
                    <p>Размер</p>
                    <div class="border-b border-gray-200 mb-1 mx-2 flex-1"></div>
                    <p class="md:text-end">{{$product['size']}}</p>
                </div>
            @endif
            @if($product['area_of_use'])
                <div class="flex">
                    <p>Применимость</p>
                    <div class="border-b border-gray-200 mb-1 mx-2 flex-1"></div>
                    <p class="text-end">{{implode(',', $product['area_of_use'])}}</p>
                </div>
            @endif
            @if($product['other_attributes'])
                @foreach($product['other_attributes'] as $name => $value)
                    <div class="flex">
                        <p>{{$name}}</p>
                        <div class="border-b border-gray-200 mb-1 mx-2 flex-1"></div>
                        <p class="md:text-end">{{$value}}</p>
                    </div>
                @endforeach
            @endif
        </div>

        <div x-show="open" class="mt-4 flex flex-col gap-2">

        </div>
    </section>

    <livewire:components.product-feedback-form :product="$product"/>


    <div class="content h-20 w-full z-10 relative">
        <img src="/fixed/circle_text.png" class="absolute top-4 z-40 left-1/2 transform translate-x-[-50%]  md:hidden"
             alt="">
    </div>

</main>
