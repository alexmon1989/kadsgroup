<?php

use Illuminate\Database\Seeder;

class ProductsPrimerTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('products_primer')->truncate();

        File::cleanDirectory(public_path('assets/img/products/primer'));

        factory(App\ProductPrimer::class, 10)->create();
    }
}
