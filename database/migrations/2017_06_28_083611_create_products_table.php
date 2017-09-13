<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tdq68_products', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('code')->unique();
            $table->string('slug')->unique();
            $table->longText('content');
            $table->integer('regular_price')->unsigned();
            $table->integer('sale_price')->unsigned();
            $table->integer('original_price')->unsigned();
            $table->integer('quantity')->default(0)->unsigned();
            $table->longText('attributes')->nullable();;
            $table->text('image')->nullable();
            $table->integer('category_id')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->tinyInteger('status')->unsigned()->default(1);
            $table->integer('views')->default(0)->unsigned();
            $table->string('meta_title');
            $table->text('meta_keywords');
            $table->text('meta_description');
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
        Schema::dropIfExists('tdq68_products');
    }
}
