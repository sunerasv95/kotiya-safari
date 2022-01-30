<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReservationTbl extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reservations', function (Blueprint $table) {
            $table->id();
            $table->integer('inquiry_id')->unsigned();
            $table->string('bk_reference_no', 15)->unique();
            $table->string('bk_activation_code', 10)->unique();
            $table->string('location_code', 10)->nullable();
            $table->string('tent_code', 10)->nullable();
            $table->tinyInteger('is_activated')->default(0);
            $table->tinyInteger('is_admin_activated')->nullable();
            $table->tinyInteger('bk_status');
            $table->timestamp('activated_at')->nullable();
            $table->timestamp('activation_expired_at');
            $table->string('remark', 200)->nullable();
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
        Schema::dropIfExists('reservations');
    }
}
