<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * store products in database
     */
    public function run(): void
    {
        //disable the foreign key check to avoid foreign key constraint error
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        DB::table('products')->truncate();

        $products = [
            [
                'name' => 'Nordic Chair',
                'slug' => Str::slug('Nordic Chair'),
                'customer_type' => 'b2b',
                'price' => '50.30',
                'image' => "images/product-1.png"
            ],
            [
                'name' => 'Kruzo Aero Chair',
                'slug' => Str::slug('Kruzo Aero Chair'),
                'customer_type' => 'b2c',
                'price' => '78.00',
                'image' => "images/product-2.png"
            ],
            [
                'name' => 'Special Nordic',
                'slug' => Str::slug('Special Nordic'),
                'customer_type' => 'b2b',
                'price' => '74.00',
                'image' => "images/product-3.png"
            ]
        ];



        foreach ($products as $product)
        {
            Product::create($product);
        }

        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
