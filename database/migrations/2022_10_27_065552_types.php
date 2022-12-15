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
        Schema::create('types',function (Blueprint $t){
            $t->id();
            $t->string('type_name',150);
            $t->string('title',150);
            $t->string('description')->nullable();
            $t->boolean('is_active')->default(1);
            $t->unsignedBigInteger('sub')->unsigned()->nullable();
            $t->boolean('default')->nullable();
            $t->boolean('optional_sub_select')->nullable();
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
        Schema::dropIfExists('types');
    }
};
