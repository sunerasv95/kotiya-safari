<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdminsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admins', function (Blueprint $table) {
            $table->id();
            $table->uuid('admin_code');
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password')->nullable();
            $table->integer('role_id')->unsigned()->nullable();
            $table->tinyInteger('activated')->default(1);
            $table->tinyInteger('deleted')->default(0);
            $table->ipAddress('last_login_from')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->timestamp('last_login_at')->nullable();
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
        Schema::dropIfExists('admins');
    }
}
