<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReservationOrderDetailsTbl extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reservation_order_details', function (Blueprint $table) {
            $table->id();
            $table->string('order_reference_no', 15);
            $table->tinyInteger('total_nights')->default(0);
            $table->string('location_code', 10)->nullable();
            $table->string('tent_code', 10)->nullable();
            $table->tinyInteger('status')->default(0);
            $table->tinyInteger('is_deleted')->default(0);
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
        Schema::dropIfExists('reservation_order_details');
    }
}
