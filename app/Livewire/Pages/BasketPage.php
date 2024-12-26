<?php

namespace App\Livewire\Pages;

use App\Models\Product;
use App\Notifications\TelegramNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Notification;
use Livewire\Component;
use morphos\Russian;

class BasketPage extends Component
{
    public $products;
    public $cookie;
    public $name;
    public $tel;
    public $email;
    public $address;
    public $comment;
    public $sent;
    public $payment_type = 'Наличные';

    public function render()
    {
        return view('livewire.pages.basket-page');
    }

    public function updateCookie($val) {
        Cookie::queue(
            Cookie::make(
                'basket-products',          // Имя куки
                json_encode($val),       // Значение
                60,                         // Срок действия в минутах
                '/',                        // Путь
                null,                       // Домен
                false,                      // Безопасный SSL (true для HTTPS)
                false                       // HttpOnly (false делает куку доступной для JavaScript)
            )
        );
        $this->dispatch('afterBasketUpdate');
    }

    public function mount(Request $request)
    {
        $this->cookie = collect(json_decode($request->cookie('basket-products')));
        $this->products = Product::whereIn('id', $this->cookie->pluck('id'))->with('collection')->with('brand')->get();
        $this->products = $this->products->map(function ($product) {
            // Находим данные из куков для текущего товара
            $cookieItem = collect($this->cookie)->firstWhere('id', $product->id);

            // Добавляем колонки как атрибуты
            $product->setAttribute('media_url', $product->getFirstMediaUrl('cover'));
            $product->setAttribute('amount_cookie', $cookieItem ? $cookieItem->amount : null);
            $product->setAttribute('price_cookie', $cookieItem ? $cookieItem->price : null);

            return $product;
        });
        $this->products = $this->products->toArray();
    }


    public function deleteProduct($id)
    {
        $this->products = collect($this->products)->reject(function ($product) use ($id) {
            return $product['id'] === $id;
        });

        $this->cookie = collect($this->cookie)->reject(function ($product) use ($id) {
            return $product->id === $id;
        });

        $this->updateCookie($this->cookie);

    }

    public function send()
    {
        $product_names = '';
        foreach ($this->products as $product) {
            $boxes =  $product['amount_cookie'] / $product['packaged'];
            $product_names .= "{$product['name']} (коробок: $boxes по {$product['packaged']}м2), ";
        }
        $product_names = rtrim($product_names, ", ");
        $title = 'Новый заказ!';
        $text = "*Имя:* {$this->name}
*Телефон:* {$this->tel}
*Email:* {$this->email}
*Оплата:* {$this->payment_type}
*Комментарий:* {$this->comment}
*Товары:* {$product_names}";

        // Посылаем Telegram уведомление нам
        Notification::route('telegram', config('cons.telegram_chat_id'))
            ->notify(new TelegramNotification($title, $text, null, null));
        $this->sent = true;

        Cookie::queue(Cookie::forget('basket-products'));
        $this->dispatch('afterBasketUpdate');
        $this->redirect(route('basket-success-page'));
    }


    public function updateAmount($id, $dir)
    {

        foreach ($this->products as &$product) {
            if (($product['packaged'] <> $product['amount_cookie'] && $dir == -1) || $dir == 1) {
                if ($product['id'] == $id) {
//                dd($product);
                    if ($dir == 1) {
                        $product['amount_cookie'] = $product['amount_cookie'] + $product['packaged'];
                    } else {
                        $product['amount_cookie'] = $product['amount_cookie'] - $product['packaged'];
                    }
                    $product['price_cookie'] = $product['amount_cookie'] * $product['price'];
                    break; // Прерываем цикл, если нашли нужный элемент
                }
            }
        }

//        dd($this->products);
    }
}
