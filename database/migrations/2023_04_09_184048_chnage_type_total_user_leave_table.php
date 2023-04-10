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
        Schema::table('user_total_leaves', function (Blueprint $table) {
            $table->float('cl', 8, 2)->default(6)->change();
            $table->float('pl', 8, 2)->default(6)->change();
            $table->float('sl', 8, 2)->default(6)->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('user_total_leaves', function (Blueprint $table) {
            //
        });
    }
};
