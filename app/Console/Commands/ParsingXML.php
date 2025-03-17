<?php

namespace App\Console\Commands;

use App\Models\Brand;
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
    public function handle()
    {

        $link = 'https://viaceramica.online/index.php?route=extension/module/viaceramica_api&secret_key=hmlx4WPh';

        // Загружаем XML
        $response = Http::get($link);
        $xmlContent = $response->body();

        // Преобразуем XML в объект
        $xml = simplexml_load_string($xmlContent);
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
                $product = Product::firstOrCreate([
                    'name' => (string) $offer->name,
                    'slug' => Str::slug((string) $offer->name, "-")
                ], [
                    'brand_id' => $our_brand_id[0]['our_id'],
                    'price' => $offer->price * 100,
                    'source' => 'viaceramica.online'
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
}
