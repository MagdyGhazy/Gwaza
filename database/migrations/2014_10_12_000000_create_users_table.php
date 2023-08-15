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
            $table->string('first_name');
            $table->string('mid_name')->nullable();
            $table->string('last_name');
            $table->string('email')->unique()->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->integer('governorate')->nullable();
            $table->integer('city')->nullable();
            $table->string('photo')->nullable();
            $table->bigInteger('phone')->nullable();
            $table->string('country_code')->nullable();
            $table->enum('gender',['male','female'])->default('male')->nullable();
            $table->integer('user_type')->nullable();
            $table->enum('provider_type',['worker','shop'])->default('worker')->nullable();
            $table->bigInteger('id_number')->nullable();
            $table->string('id_photo_front')->nullable();
            $table->string('id_photo_back')->nullable();
            $table->string('criminal_fish')->nullable();
            $table->longText('message')->nullable();
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
