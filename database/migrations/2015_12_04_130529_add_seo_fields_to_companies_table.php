<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSeoFieldsToCompaniesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('companies', function (Blueprint $table) {
            $table->string('page_title')->after('description')->nullable();
            $table->text('page_keywords')->after('page_title')->nullable();
            $table->text('page_description')->after('page_keywords')->nullable();
            $table->string('page_h1')->after('page_description')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('companies', function (Blueprint $table) {
            $table->dropColumn('page_title');
            $table->dropColumn('page_keywords');
            $table->dropColumn('page_description');
            $table->dropColumn('page_h1');
        });
    }
}
