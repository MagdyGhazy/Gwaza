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
        Schema::create('provider_requests', function (Blueprint $table) {
            $table->id();


            $table->string('user_id');
            $table->string('photo');
            $table->bigInteger('id_number');
            $table->string('id_photo_front');
            $table->string('id_photo_back');
            $table->string('criminal_fish');
            $table->string('provider_type');
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
        Schema::dropIfExists('provider_requests');
    }
};
