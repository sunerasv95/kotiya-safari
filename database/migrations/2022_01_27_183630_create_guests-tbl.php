<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGuestsTbl extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('guests', function (Blueprint $table) {
            $table->id();
            $table->string('guest_code', 20);
            $table->string('full_name', 50);
            $table->string('email', 60);
            $table->tinyInteger('is_email_verified')->default(0);
            $table->string('country_code')->nullable();
            $table->ipAddress('last_login_ip')->nullable();
            $table->tinyInteger('status')->default(0);
            $table->timestamps();
            $table->timestamp('email_verified_at')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('guests');
    }
}
