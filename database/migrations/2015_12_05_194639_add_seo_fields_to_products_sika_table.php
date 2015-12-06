<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSeoFieldsToProductsSikaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('products_sika', function (Blueprint $table) {
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
        Schema::table('products_sika', function (Blueprint $table) {
            $table->dropColumn('page_title');
            $table->dropColumn('page_keywords');
            $table->dropColumn('page_description');
            $table->dropColumn('page_h1');
        });
    }
}
