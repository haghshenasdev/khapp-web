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
        Schema::create('pooyeshes',function (Blueprint $t){
            $t->smallIncrements('id');
            $t->string('title');
            $t->text('description');
            $t->string('image');
            $t->integer('amount')->nullable();
            $t->timestamp('start')->nullable();
            $t->timestamp('end')->nullable();
            $t->unsignedBigInteger('type_pay')->unsigned();
            $t->boolean("is_active")->default(1);
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
        Schema::dropIfExists('pooyeshes');
    }
};
