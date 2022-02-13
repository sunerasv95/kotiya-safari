<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReservationStatusTbl extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $allowedArr = ["PENDING", "PAR_PAID", "COMPLETED", "RE_SCHE", "CANCELLED"];

        Schema::create('reservation_status', function (Blueprint $table) use($allowedArr) {
            $table->id();
            $table->enum('status_name', $allowedArr);
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
        Schema::dropIfExists('reservation_status');
    }
}
