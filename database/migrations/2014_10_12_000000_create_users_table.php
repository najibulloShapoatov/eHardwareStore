<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('surname')->nullable();
            $table->string('phone')->unique();
            $table->string('email');
            $table->string('password');
            $table->string('sms_code')->nullable();
            $table->decimal('balance', 12, 2)->default('0.00');
            $table->tinyInteger('user_type')->unsigned()->default(1);           // 1-klient, 2-optovik, ... 7- admin
            $table->string('image')->nullable();
            $table->tinyInteger('is_active')->unsigned()->default(1);           // 1-yes, 0-no
            $table->dateTime('date_reg')->nullable();
            $table->dateTime('date_auth')->nullable();
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
