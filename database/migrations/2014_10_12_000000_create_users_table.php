<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('address');
            $table->double('latitude');
            $table->double('longitude');
            $table->string('photo')->nullable();
            $table->bigInteger('phone');
            $table->integer('gender');
            $table->integer('user_type');
            $table->bigInteger('id_number')->nullable();
            $table->string('id_photo_front')->nullable();
            $table->string('id_photo_back')->nullable();
            $table->string('criminal_fish')->nullable();
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
};
