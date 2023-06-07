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
        Schema::create('marasems', function (Blueprint $table) {
            $table->id();
            $table->foreignId('charity')->constrained('charities')->cascadeOnDelete();
            $table->string('location');
            $table->string('marhoom_name');
            $table->smallInteger('marasem_type')->nullable(); // null = tarhim, 0 = hafeth, 1 = chehelom , 2 = sal
            $table->timestamp('date');
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
        Schema::dropIfExists('marasems');
    }
};
