<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateManufacturesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('manufactures', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->date('date_add')->nullable();
            $table->date('date_end')->nullable();
            $table->integer('sort_order')->unsigned()->default(0);
            $table->string('title');
            $table->string('slug')->unique();
            $table->string('image')->nullable();
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
        Schema::dropIfExists('manufactures');
    }
}
