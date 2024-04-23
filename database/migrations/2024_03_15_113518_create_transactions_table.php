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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->string('transaction_number')->nullable();
            $table->string('invoice_number')->nullable();
            $table->integer('customer_id')->nullable();
            $table->bigInteger('total_price')->nullable();
            $table->bigInteger('total_payment')->nullable();
            $table->bigInteger('total_change')->nullable();
            $table->integer('total_point_earn')->nullable();
            $table->integer('created_by')->nullable();
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
        Schema::dropIfExists('transactions');
    }
};
