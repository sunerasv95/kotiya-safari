<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReservationOrdersTbl extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $allowedArr = ["PENDING", "PAR_PAID", "COMPLETED", "RE_SCHE", "CANCELLED"];

        Schema::create('reservation_orders', function (Blueprint $table) use($allowedArr) {
            $table->id();
            $table->integer('inquiry_id')->unsigned();
            $table->string('guest_code', 20)->nullable();
            $table->string('order_reference_no', 15)->unique();
            $table->string('bk_verification_code', 10)->unique();
            $table->tinyInteger('is_verified')->default(0);
            $table->tinyInteger('is_rescheduled')->default(0);
            $table->timestamp('verified_at')->nullable();
            $table->timestamp('verification_expired_at');
            $table->string('remark', 200)->nullable();
            $table->enum('status', $allowedArr)->default("PENDING");
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
        Schema::dropIfExists('reservation_orders');
    }
}
