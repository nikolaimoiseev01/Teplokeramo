<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Brand;
use App\Models\Collection;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */

    public $brands = [
            [
                'name' => 'Arcana Ceramica',
                'country_code' => 'es',
                'country_name' => 'Испания'
            ],
            [
                'name' => 'Atlas Concorde',
                'country_code' => 'au',
                'country_name' => 'Австралия'
            ],
            [
                'name' => 'Atlas Concorde Rus',
                'country_code' => 'us',
                'country_name' => 'США'
            ],
            [
                'name' => 'Bisazza',
                'country_code' => 'ru',
                'country_name' => 'Россия'
            ]
        ];

    public $areas = ['Для кухни', 'Для ванной', 'Для гостинной'];
    public function makeBrands()
    {

        $cover_directory =  url('/') . "/fixed/test/300x300.png";
        foreach ($this->brands as $var) {
            $brand = Brand::create([
                'name' => $var['name'],
                'slug' => Str::slug($var['name'], "-")
            ]);

            $brand->addMediaFromUrl($cover_directory)->preservingOriginal()->toMediaCollection('cover');
        }
    }

    public function makeCollections()
    {
        $col_id = 1;
        $brands = Brand::all();
        foreach ($brands as $brand) {
            // Определяем случайное количество коллекций (от 5 до 7)
            $collectionsCount = random_int(5, 7);

            for ($ci = 1; $ci <= $collectionsCount; $ci++) { // Создаем коллекцию у бренда
                $collection = Collection::create([
                    'name' => "Коллекция $col_id", // Название коллекции
                    'slug' => Str::slug("Коллекция $col_id", "-"),
                    'brand_id' => $brand['id']
                ]);
                $col_id += 1;
                $rand = rand(1, 2);
                $cover_directory = url('/') . "/fixed/test/420x420px_{$rand}.png";
                $collection->addMediaFromUrl($cover_directory)->preservingOriginal()->toMediaCollection('cover');

                for ($ex = 1; $ex <= 4; $ex++) { // Создаем коллекцию у бренда
                    $rand = rand(1, 2);
                    $cover_directory =  url('/') . "/fixed/test/1300x700px_{$rand}.png";
                    $collection->addMediaFromUrl($cover_directory)->preservingOriginal()->toMediaCollection('examples');
                }


                for ($i = 1; $i <= 30; $i++) { // Создаем товары у коллекции
                    $searchName = $brand['name'];

                    $result = array_filter($this->brands, function ($brand) use ($searchName) {
                        return $brand['name'] === $searchName;
                    });

                    $area = Arr::random($this->areas, rand(1, 3));

                    $product = Product::create([
                        'name' => "Товар $i (б {$brand['id']}, к {$collection['id']})",
                        'brand_id' => $brand['id'],
                        'country_code' => current($result)['country_code'],
                        'country_name' => current($result)['country_name'],
                        'area_of_use' => $area,
                        'price' => 420000,
                        'packaged' => 1.44,
                        'article' => 123456,
                        'type' => 'Матовый',
                        'weight' => 50,
                        'thickness' => 8.5,
                        'color' => '#B7C3AA',
                        'slug' => Str::slug("Товар $i (б {$brand['id']}, к {$collection['id']})"),
                        'collection_id' => $collection['id'], // Присваиваем ID коллекции
                    ]);
                    $rand = rand(1, 2);
                    $cover_directory =   url('/') . "/fixed/test/420x420px_{$rand}.png";
                    $product->addMediaFromUrl($cover_directory)->preservingOriginal()->toMediaCollection('cover');
                }

            }
        }
    }

    public function run(): void
    {
        $file = new Filesystem;
        $file->cleanDirectory('storage/app/public/media');

//        $this->call(CountriesSeeder::class);

        $user = User::create([
            'name' => 'admin',
            'email' => 'admin@mail.ru',
            'email_verified_at' => now(),
            'password' => Hash::make('zXW2QSXj5eyN'),
            'remember_token' => Str::random(10),
        ]);


        $this->makeBrands();
        $this->makeCollections();
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
