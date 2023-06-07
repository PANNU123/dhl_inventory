<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Product::create([
            'category_id' => 1,
            'sub_category_id' => 1,
            'uom_id' => 3,
            'vendor_id' => 1,
            'name' => 'Carton',
            'slug'=>$this->slugify('Carton'),
            'price' => '5000',
            'qty' => '150',
            'description' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.',
        ]);
        Product::create([
            'category_id' => 1,
            'sub_category_id' => 2,
            'uom_id' => 1,
            'vendor_id' => 2,
            'name' => 'Large Flyer',
            'slug'=>$this->slugify('Large Flyer'),
            'price' => '4000',
            'qty' => '300',
            'description' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.',
        ]);
        Product::create([
            'category_id' => 1,
            'sub_category_id' => 3,
            'uom_id' => 1,
            'vendor_id' => 2,
            'name' => 'DHL Yellow Tape',
            'slug'=>$this->slugify('DHL Yellow Tape'),
            'price' => '8000',
            'qty' => '200',
            'description' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.',
        ]);
    }

    public function slugify($text){
        // replace non letter or digits by divider
        $text = preg_replace('~[^\pL\d]+~u', '-', $text);
        // transliterate
        $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);
        // remove unwanted characters
        $text = preg_replace('~[^-\w]+~', '', $text);
        // trim
        $text = trim($text, '-');
        // remove duplicate divider
        $text = preg_replace('~-+~', '-', $text);
        // lowercase
        $text = strtolower($text);
        if (empty($text)) {
            return 'n-a';
        }
        return $text;
    }
}
