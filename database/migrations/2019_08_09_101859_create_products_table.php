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
        Schema::create('products', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('category_id');
            $table->date('date_add')->nullable();
            $table->date('date_end')->nullable();
            $table->integer('brand_id')->nullable();
            $table->integer('manufacture_id')->nullable();
            $table->integer('country_id')->nullable();
            $table->string('title');
            $table->string('slug')->unique();
            $table->string('articul')->nullable();
            $table->decimal('price', 12, 2)->default('0.00');
            $table->decimal('quantity', 12, 2)->default('0.00');
            $table->string('image')->nullable();
            $table->text('description')->nullable();
            $table->integer('viewed')->default(0);
            $table->integer('sold')->default(0);
            $table->tinyInteger('is_active')->unsigned()->default(1);           // 1-yes, 0-no
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
        Schema::dropIfExists('products');
    }
}
