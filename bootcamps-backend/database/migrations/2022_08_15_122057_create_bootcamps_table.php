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
        Schema::create('bootcamps', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100);
            $table->string('website', 200)->nullable();
            $table->unsignedBigInteger('phone');
            $table->string('email', 60);
            $table->string('address')->nullable();
            $table->unsignedDecimal('average_rating');
            $table->unsignedDecimal('average_cost');
            $table->foreignId('user_id')->constrained();
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
        Schema::dropIfExists('bootcamps');
    }
};
