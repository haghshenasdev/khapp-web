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
        Schema::create('darkhast_statuses', function (Blueprint $table) {
            $table->id();
            $table->string('status_title');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('darkhasts', function (Blueprint $table) {
            $table->dropForeign('darkhasts_status_foreign');
        });
        Schema::dropIfExists('darkhast_statuses');
    }
};
