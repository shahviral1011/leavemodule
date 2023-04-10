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
        Schema::create('leave_requests', function (Blueprint $table) {
            $table->id();
            $table->biginteger('user_id')->unsigned();
            $table->string('leave_type');
            $table->string('leave_type_shift_wise');
            $table->date('start_date');
            $table->date('end_date');
            $table->string('status')->default('pending');
            $table->string('emp_leave_reason')->nullable();
            $table->string('rejection_reason')->nullable();
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
        Schema::dropIfExists('leave_requests');
    }
};
