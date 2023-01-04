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
            $table->integer('reservation_order_id')->unsigned();
            $table->string('verification_code', 50);
            $table->string('_token', 200)->nullable();
            $table->tinyInteger('attempts')->default(0);
            $table->tinyInteger('status')->default(1);
            $table->timestamp('last_attempt_at')->nullable();
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
