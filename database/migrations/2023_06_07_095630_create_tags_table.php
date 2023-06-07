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
        Schema::create('tags', function (Blueprint $table) {
            $table->id();
            $table->string('bename');
            $table->smallInteger('status'); // null = entezar pardakht, 0 = sabt shodeh, 1 = chap , 2 = garar gerefteh
            $table->foreignId('payed')->nullable()->constrained('faktoors')->nullOnDelete();
            $table->timestamps();
            $table->foreignId('user')->constrained('users');
            $table->foreignId('marasem')->constrained('marasems');
            $table->foreignId('type')->constrained('tag_types');
            $table->foreignId('tarh')->constrained('tag_tarhs');
            $table->foreignId('charity')->constrained('charities')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tags');
    }
};
