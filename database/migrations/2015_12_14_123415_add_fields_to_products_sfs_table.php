<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFieldsToProductsSfsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('products_sfs', function (Blueprint $table) {

            $table->string('photo')->after('title')->default('default.jpg');
            $table->text('description_small')->after('photo');
            $table->text('description_full')->after('description_small')->nullable();

            // SEO fields
            $table->string('page_title')->nullable()->after('enabled');
            $table->text('page_keywords')->nullable()->after('page_title');
            $table->text('page_description')->nullable()->after('page_keywords');
            $table->string('page_h1')->nullable()->after('page_description');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('products_sfs', function (Blueprint $table) {
            $table->dropColumn('photo');
            $table->dropColumn('description_small');
            $table->dropColumn('description_full');
            $table->dropColumn('page_title');
            $table->dropColumn('page_keywords');
            $table->dropColumn('page_description');
            $table->dropColumn('page_h1');
        });
    }
}
