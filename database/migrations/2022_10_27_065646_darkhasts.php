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
        Schema::create('darkhasts',function (Blueprint $t){
            $t->id();
            $t->unsignedBigInteger('type')->unsigned();
            $t->unsignedBigInteger('user');
            $t->text('description')->nullable();
            $t->timestamps();
            $t->unsignedBigInteger('status')->unsigned()->default(1);
            $t->unsignedBigInteger('charity')->unsigned();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('darkhasts');
    }
};
