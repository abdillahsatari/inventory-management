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
        Schema::create('transaction_details', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('transaction_id')->nullable();
            $table->bigInteger('inventory_id')->nullable();
            $table->string('inventory_name')->nullable();
            $table->bigInteger('inventory_price')->nullable();
            $table->bigInteger('quantity')->nullable();
            $table->integer("inventory_discount")->default(0);
            $table->bigInteger('inventory_total_price')->nullable();
            $table->integer("inventory_point")->nullable();
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
        Schema::dropIfExists('transaction_details');
    }
};
