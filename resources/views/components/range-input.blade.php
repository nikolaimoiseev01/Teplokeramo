<div
    x-data="{
        amount: {{ $product['amount_cookie'] ?? $product['packaged'] }},
        updateAmount(change) {
            this.amount = Math.max({{$product['packaged']}}, this.amount + change); // Не позволяет уйти в отрицательное значение
        }
    }"
    class="number-wrap flex space-x-4 h-fit items-start"
>
    <!-- Минус кнопка -->
    <button
        @click="updateAmount({{-$product['packaged']}})"
        wire:click="updateAmount({{$product['id']}}, -1)"
        class="w-10 h-9 rounded-l-full bg-gray-300 flex justify-center items-center text-xl font-bold text-white"
    >
        -
    </button>

    <!-- Значение -->
    <div class="text-center">
        <input
            type="number"
            x-model="amount"
            class="input w-10 h-9 p-0 text-center text-xl font-medium !border-none focus:outline-none focus:ring focus:ring-gray-200"
        />
        <div class="text-sm text-gray-500">m²</div>
    </div>

    <!-- Плюс кнопка -->
    <button
        @click="updateAmount({{$product['packaged']}})"
        wire:click="updateAmount({{$product['id']}}, 1)"
        class="w-10 h-9 rounded-r-full bg-gray-300 flex justify-center items-center text-xl font-bold text-white"
    >
        +
    </button>
</div>
