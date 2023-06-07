<?php

namespace Database\Seeders;

use App\Models\SubCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SubCategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        SubCategory::create([
            'category_id' => 1,
            'name' => 'Carton',
            'slug'=>$this->slugify('Carton'),
        ]);
        SubCategory::create([
            'category_id' => 1,
            'name' => 'Flyer',
            'slug'=>$this->slugify('Flyer'),
        ]);
        SubCategory::create([
            'category_id' => 1,
            'name' => 'Tape',
            'slug'=>$this->slugify('Tape'),
        ]);
        SubCategory::create([
            'category_id' => 1,
            'name' => 'Poly',
            'slug'=>$this->slugify('Poly'),
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
