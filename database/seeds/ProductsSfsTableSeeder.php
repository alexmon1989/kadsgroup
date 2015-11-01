<?php

use Illuminate\Database\Seeder;

class ProductsSfsTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('products_sfs')->truncate();

        File::cleanDirectory(public_path('assets/img/products/sfs'));

        factory(App\ProductSfs::class, 10)->create();
    }
}
