<main class="content flex-1">
    <h1 class="uppercase mt-10 mb-10 text-5xl md:text-3xl">
        @if($products)
            Корзина
        @else
            Корзина пуста
        @endif
    </h1>
    @if($products)
        <div class="flex gap-9 flex-col">
            @foreach($products as $product)
                <div
                    class="flex p-5 flex-wrap gap-14 border border-gray-200 rounded-2xl md:flex-col md:items-center md:gap-4">
                    <img src="{{$product['media_url']}}" class="w-36 max-h-36 object-cover" alt="">
                    <div class="flex flex-col gap-1">
                        <a href="{{route('product-page', $product['slug'])}}" wire:navigate
                           class="text-3xl mb-2 font-bold md:text-xl">{{$product['name']}}</a>
                        <div class="flex gap-2 text-xl md:text-base">
                            <p>{{$product['collection']['name']}}</p>
                            <x-icon name="flag-country-{{$product['country_code']}}" class="w-4"/>
                            <p>{{$product['country_name']}}</p>
                        </div>
                        <p class="text-green-700 text-xl font-bold flex gap-2">
                            <x-heroicon-s-check-circle class="w-4"/>
                            В наличииn
                        </p>
                        <button onclick="removeIdFromCookie('basket-products', {{$product['id']}})"
                                wire:click="deleteProduct({{$product['id']}})"
                                class="delete-from-basket text-red-200 font-bold text-xl w-fit mt-auto">удалить
                        </button>
                    </div>
                    <div class="flex gap-12 ml-auto items-center md:m-auto md:flex-col md:gap-4">
                        <x-range-input :product="$product"/>
                        <div class="flex flex-col gap-2">
                            <h1 class="text-4xl">{{$product['price_cookie'] / 100}} ₽</h1>
                            <span class="text-2xl text-gray-400">{{$product['price'] / 100}} ₽ за m2</span>
                        </div>
                    </div>

                </div>
            @endforeach
        </div>

        <h1 class="uppercase mt-10 mb-10 text-4xl md:text-2xl">Оформление заказа</h1>

        <form wire:submit="send" x-data id="myForm" action="/submit" method="POST" class="flex flex-col gap-4 w-full">
            <div class="flex gap-4 w-full md:flex-col">
                <div class="flex flex-col gap-4 w-1/2 md:w-full">
                    <x-input-text wire:model="name" class="w-full" required placeholder="Имя"></x-input-text>
                    <x-input-text wire:model="tel" class="mobile_input" required placeholder="8 (911) 123-45-67"></x-input-text>
                    <x-input-text wire:model="email" required placeholder="Email"></x-input-text>
                </div>

                <div class="flex flex-col gap-4 w-1/2 md:w-full">
                    <x-input-textarea placeholder="Адрес доставки" wire:model="address"></x-input-textarea>
                    <div class="flex gap-4 items-center">
                        <input type="radio" wire:model="payment_type" name="payment_type" value="Наличные"
                               id="Наличные">
                        <label for="Наличные">Наличные</label>
                        <input type="radio" wire:model="payment_type" name="payment_type" value="Безналичные"
                               id="Безналичные">
                        <label for="Безналичные">Безналичные</label>
                    </div>
                </div>
            </div>
            <x-input-textarea placeholder="Комментарий" class="h-full" wire:model="comment"></x-input-textarea>

            <div class="flex gap-4">
                <h1 class="items-center -leading-3">Итого: {{collect($this->products)->sum('price_cookie') / 100}}₽</h1>
                <button
                    @if($sent)disabled @endif
                class="px-12 py-3 bg-red-200 text-white rounded-full text-center w-fit  hover:bg-green-500 transition-all ">
                <span wire:loading.remove>@if($sent)
                        УСПЕШНО ОТПРАВЛЕНО!
                    @else
                        ОТПРАВИТЬ
                    @endif</span>

                    <svg wire:loading aria-hidden="true"
                         class="w-6 h-6 mx-auto text-gray-200 animate-spin dark:text-gray-600 fill-blue-600"
                         viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z"
                            fill="currentColor"/>
                        <path
                            d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z"
                            fill="currentFill"/>
                    </svg>
                </button>
            </div>

        </form>
    @endif
</main>
