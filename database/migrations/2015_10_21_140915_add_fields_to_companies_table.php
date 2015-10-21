<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFieldsToCompaniesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('companies', function (Blueprint $table) {
            $table->string('file_main')->after('short_title');
            $table->string('file_logo')->after('file_main');
            $table->text('description')->after('file_logo');

            $table->unique('short_title');
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
            $table->dropColumn('file_main');
            $table->dropColumn('file_logo');
            $table->dropColumn('description');

            $table->dropUnique('companies_short_title_unique');
        });
    }
}
