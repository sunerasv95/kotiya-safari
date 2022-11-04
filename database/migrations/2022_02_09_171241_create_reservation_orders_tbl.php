<?php

use App\Constants\Types;
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
        $status = [
            Types::PENDING_STATUS,
            Types::DEPOSIT_PAID_STATUS,
            Types::COMPLETED_STATUS,
            Types::RESCHEDULED_STATUS,
            Types::CANCELLED_STATUS
        ];

        Schema::create('reservation_orders', function (Blueprint $table) use($status) {
            $table->id();
            $table->integer('inquiry_id')->unsigned();
            $table->integer('guest_id')->unsigned();
            $table->string('reservation_reference', 50)->unique();
            $table->enum('status', $status)->default("PENDING");
            $table->integer('generated_by')->unsigned();
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
