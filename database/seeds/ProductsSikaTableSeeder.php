<?php

use Illuminate\Database\Seeder;

class ProductsSikaTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('products_sika')->truncate();

        File::cleanDirectory(public_path('assets/img/products/sika'));
        File::makeDirectory(public_path('assets/img/products/sika/tech-carts'), true, true);

        factory(App\ProductSika::class, 10)->create();
    }
}
