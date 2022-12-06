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
        Schema::create('home_items', function (Blueprint $table) {
            $table->id();
            $table->string('title',20);
            $table->string('icon');
            $table->string('action');
            $table->boolean("is_active")->default(1);
            $table->unsignedBigInteger('charity')->unsigned();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('home_items');
    }
};
