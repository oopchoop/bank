<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('users_credits', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->unsigned();
            $table->bigInteger('credit_id')->unsigned();
            $table->double('years');
            $table->double('sum');
            $table->double('month_pay');
            $table->double('result_sum');
            $table->date('date');
            $table->foreign('user_id')
                ->references('id')
                ->on('users');
            $table->foreign('credit_id')
                ->references('id')
                ->on('credits');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users_credits');
    }
};
