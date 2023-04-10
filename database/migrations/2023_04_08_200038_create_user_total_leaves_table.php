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
        Schema::create('user_total_leaves', function (Blueprint $table) {
            $table->id();
            $table->biginteger('user_id')->unsigned();
            $table->smallInteger('cl')->default(6);
            $table->smallInteger('pl')->default(6);
            $table->smallInteger('sl')->default(6);
            $table->foreign('user_id')->references('id')->on('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_total_leaves');
    }
};
