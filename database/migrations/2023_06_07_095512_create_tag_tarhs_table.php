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
        Schema::create('tag_tarhs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('charity')->constrained('charities')->cascadeOnDelete();
            $table->string('name');
            $table->string('img');
            $table->integer('system_id')->nullable();
            $table->boolean("is_active")->default(1);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tag_tarhs');
    }
};
