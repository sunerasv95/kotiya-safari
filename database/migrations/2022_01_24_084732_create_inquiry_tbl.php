<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInquiryTbl extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inquiries', function (Blueprint $table) {
            $table->id();
            $table->string('inquiry_reference_no')->unique();
            $table->integer('guest_id')->unsigned();
            $table->date('req_date_start');
            $table->date('req_date_to');
            $table->tinyInteger('boarding_plan_id')->unsigned();
            $table->tinyInteger('no_adults');
            $table->tinyInteger('no_kids');
            $table->boolean('pickup_required')->default(false);
            $table->tinyInteger('status');
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
        Schema::dropIfExists('inquiries');
    }
}
