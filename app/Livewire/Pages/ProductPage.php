<?php

namespace App\Livewire\Pages;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Livewire\Component;

class ProductPage extends Component
{
    public $product;
    public $amount;
    public $total_price;

    public $ssent = false;

    public function render()
    {
        return view('livewire.pages.product-page');
    }

    public function mount($slug)
    {
        $this->product = Product::where('slug', $slug)->first();
        $this->amount = $this->product['packaged'];
        $this->total_price = $this->product['price'] * $this->amount;
    }

    public function addIdToCookie(Request $request)
    {
        $cookie = collect(json_decode($request->cookie('basket-products')));

        if (!$cookie->contains('id', $this->product['id'])) {
            $to_add = [
                'id' => $this->product['id'],
                'amount' => $this->amount,
                'price' => $this->total_price
            ];
            $cookie[] = $to_add;
            Cookie::queue(
                Cookie::make(
                    'basket-products',          // Имя куки
                    json_encode($cookie),       // Значение
                    60,                         // Срок действия в минутах
                    '/',                        // Путь
                    null,                       // Домен
                    false,                      // Безопасный SSL (true для HTTPS)
                    false                       // HttpOnly (false делает куку доступной для JavaScript)
                )
            );
            $this->dispatch('afterBasketUpdate');
            $this->sent = true;
        } else {
            dd('Уже есть в куках!');
        }

    }

    public function updateAmount($id, $dir)
    {
        $this->amount = round(max($this->product['packaged'], $this->amount + ($dir * $this->product['packaged'])), 1);
//        dd($this->amount);
        $this->total_price = $this->product['price'] * $this->amount;

    }

}
