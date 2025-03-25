<?php

namespace App\Console\Commands;

use App\Models\Brand;
use App\Models\Collection;
use App\Models\Country;
use App\Models\Product;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;
use Orchestra\Parser\Xml\Facade as XmlParser;

class ParsingXML extends Command
{

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'ParsingXML';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */

    public function viaceramica() {
        $link = 'https://viaceramica.online/index.php?route=extension/module/viaceramica_api&secret_key=hmlx4WPh';

        // Загружаем XML
        $response = Http::get($link);
        $xmlContent = $response->body();
        $xml = simplexml_load_string($xmlContent);

        // Преобразуем XML в объект
        $categoriesArray = [];
        foreach ($xml->shop->categories->category as $category) {
            $brand = Brand::updateOrCreate([
                'name' => (string)ltrim($category),
                'slug' => Str::slug((string)ltrim($category), "-")
            ]);
            $categoriesArray[] = [
                'id' => (int)$category['id'],
                'name' => (string)ltrim($category),
                'our_id' => $brand['id']
            ];
        };
        $total_offers = count($xml->shop->offers->offer);
        $i = 1;
        foreach ($xml->shop->offers->offer as $index => $offer) {
            $category_id = (int)$offer->categoryId;
            echo "{$i} из  $total_offers \n";
            $our_brand_id = array_values(array_filter($categoriesArray, fn($item) => $item['id'] === $category_id));
            if ($our_brand_id) {
                $product = Product::updateOrCreate([
                    'name' => (string) $offer->name,
                    'slug' => Str::slug((string) $offer->name, "-")
                ], [
                    'brand_id' => $our_brand_id[0]['our_id'],
                    'price' => $offer->price * 100,
                    'source' => 'viaceramica.online',
                    'packaged' => 0,
                    'article' => $offer->model
                ]);
                if ($product->wasRecentlyCreated) {
                    $pictures = explode(";", $offer->picture);
                    $product->clearMediaCollection('cover');
                    $product->addMediaFromUrl($pictures[0])->preservingOriginal()->toMediaCollection('cover');
                }
            }
            $i += 1;
        }
    }

    public function keramogranit() {
        $link = 'https://www.keramogranit.ru/bitrix/catalog_export/for_partners.php';

        // Загружаем XML
        $response = Http::get($link);
        $xmlContent = $response->body();
        $xml = simplexml_load_string($xmlContent);

        // Массив для хранения коллекций и производителей
        $collectionsWithBrands = [];

        // Проход по каждому товару, чтобы заполнить коллекции и бренды
        foreach ($xml->shop->offers->offer as $offer) {
            $collection = null;
            $manufacturer = null;

            foreach ($offer->param as $param) {
                $name = (string)$param['name'];

                if ($name === 'Коллекция') {
                    $collection = (string)$param;
                }

                if ($name === 'Производитель') {
                    $manufacturer = (string)$param;
                }
            }

            if ($collection && $manufacturer) {
                $collectionsWithBrands[$collection] = $manufacturer;
            }
        }

        $uniqueBrands = array_unique(array_values($collectionsWithBrands));

        // Заполняем производителей
        foreach ($uniqueBrands as $brand) {
            Brand::updateOrCreate([
                'name' => $brand,
                'slug' => Str::slug($brand, "-")
            ]);
        };

        // Заполняем коллекции
        foreach ($collectionsWithBrands as $collection => $brand) {
            $brand = Brand::where('name', $brand)->first();
            Collection::updateOrCreate([
                'name' => $collection,
                'brand_id' => $brand['id'],
                'slug' => Str::slug($collection, "-")
            ]);
        };

        $total_offers = count($xml->shop->offers->offer);
        $i = 1;

        foreach ($xml->shop->offers->offer as $index => $offer) {
            $id = (string)$offer['id'];
            echo "{$i} из  $total_offers ($id) \n";

            $params = [];
            foreach ($offer->param as $param) {
                 $params[(string)$param['name']] = (string)$param;
            }
            $brand = Brand::where('name', $params['Производитель'])->first();
            $collection = Collection::where('name', $params['Коллекция'])->first();

            $country = Country::where('name', $params['Страна'])->first();

            if($params['Применение'] ?? null) {
                $areas_of_use = explode(",", $params['Применение'] ?? '');
            } else {
                $areas_of_use = null;
            }
            if($params['Вес коробки (кг)'] ?? null) {
                $weight = (float)str_replace(',', '.', $params['Вес коробки (кг)']);
            } else {
                $weight = null;
            }

            if ($brand && $collection) {
                $product = Product::updateOrCreate([
                    'name' => (string) $offer->name,
                    'slug' => Str::slug((string) $offer->name, "-")
                ], [
                    'source' => 'keramogranit',
                    'brand_id' => $brand['id'],
                    'collection_id' => $collection['id'],
                    'price' => $offer->price * 100,
                    'article' => $params['Артикул'],
                    'packaged' => $params['Количество квадратных метров в коробке'] ?? null,
                    'color' => $params['Цвет'],
                    'country_code' => $country['code'],
                    'country_name' => $country['name'],
                    'area_of_use' => $areas_of_use,
                    'type' => $params['Поверхность'] ?? null,
                    'weight' => $weight
                ]);
                if ($product->wasRecentlyCreated) {
                    $product->clearMediaCollection('cover');
                    $product->addMediaFromUrl((string)$offer->picture)->preservingOriginal()->toMediaCollection('cover');
                }
            }
            $i += 1;
        }

    }
    public function handle()
    {
        $this->keramogranit();
    }
}
