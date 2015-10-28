<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->text('description')->nullable();
            $table->integer('group_category_id')->unsigned()->nullable();
            $table->foreign('group_category_id')
                ->references('id')
                ->on('groups_categories')
                ->onDelete('CASCADE')
                ->onUpdate('CASCADE');
            $table->integer('parent_id')->unsigned()->nullable();
            $table->foreign('parent_id')
                ->references('id')->on('categories')
                ->onDelete('no action')
                ->onUpdate('cascade');
            $table->integer('order');
            $table->boolean('enabled');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('categories');
    }
}
