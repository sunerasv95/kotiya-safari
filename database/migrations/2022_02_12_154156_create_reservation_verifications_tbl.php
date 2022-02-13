<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReservationVerificationsTbl extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reservation_verifications', function (Blueprint $table) {
            $table->id();
            $table->string('guest_code', 20)->nullable();
            $table->string('order_reference_no', 20)->nullable();
            $table->string('bk_verification_code', 20)->nullable();
            $table->string('_token', 200)->nullable();
            $table->tinyInteger('attempts')->default(0);
            $table->tinyInteger('status')->default(1);
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
        Schema::dropIfExists('reservation_verifications');
    }
}
