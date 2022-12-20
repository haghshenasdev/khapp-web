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
        Schema::create('faktoors',function (Blueprint $t) {
            $t->id();
            $t->unsignedBigInteger('userid');
            $t->integer('amount');
            $t->unsignedBigInteger('type')->unsigned();
            $t->timestamps();
            $t->string('sabtid',150)->unique();
            $t->string('ResNum',150)->unique()->nullable();
            $t->boolean('is_pardakht')->default(0);
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
        Schema::dropIfExists('faktoors');
    }
};
