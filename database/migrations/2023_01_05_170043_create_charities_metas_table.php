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
        Schema::create('charities_metas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('charity')->unsigned();
            $table->string('logo')->nullable();
            $table->string('website')->nullable();
            $table->string('phone',11)->nullable();
            $table->integer('terminal_id')->nullable();
            $table->text('about')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('charities_metas');
    }
};
