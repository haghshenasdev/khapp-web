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
        Schema::create('tag_types', function (Blueprint $table) {
            $table->id();
            $table->foreignId('meta')->nullable()->constrained('tag_type_meta')->nullOnDelete();
            $table->foreignId('charity')->constrained('charities')->cascadeOnDelete();
            $table->string('title');
            $table->string('img');
            $table->integer('amount');
            $table->integer('count');
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
        Schema::dropIfExists('tag_types');
    }
};
