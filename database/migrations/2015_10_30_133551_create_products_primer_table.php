<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsPrimerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products_primer', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->integer('category_id')->unsigned();
            $table->string('photo');
            $table->string('package');
            $table->text('description_small');
            $table->text('description_full')->nullable();
            $table->text('using')->nullable();
            $table->text('tech_characteristics')->nullable();
            $table->text('exec_works')->nullable();
            $table->text('application')->nullable();
            $table->text('properties_using')->nullable();
            $table->text('phys_chem_properties')->nullable();
            $table->text('restrictions')->nullable();
            $table->text('safety')->nullable();
            $table->text('general_characteristics')->nullable();
            $table->string('price_1_name')->nullable();
            $table->string('price_1_val')->nullable();
            $table->string('price_2_name')->nullable();
            $table->string('price_2_val')->nullable();
            $table->string('price_3_name')->nullable();
            $table->string('price_3_val')->nullable();
            $table->string('price_4_name')->nullable();
            $table->string('price_4_val')->nullable();
            $table->boolean('enabled')->default(FALSE);
            $table->timestamps();

            $table->foreign('category_id')
                ->references('id')
                ->on('categories')
                ->onUpdate('CASCADE')
                ->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('products_primer');
    }
}
