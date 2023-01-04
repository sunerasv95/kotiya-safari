<?php

use App\Constants\Types;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Carbon\Carbon;

class CreateInquiryTbl extends Migration
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
            Types::RESERVED_STATUS,
            Types::REJECTED_STATUS
        ];
        $requestTypes = [
            Types::WEB_REQUESTED,
            Types::ADMIN_REQUESTED
        ];

        Schema::create('inquiries', function (Blueprint $table) use($status, $requestTypes) {
            $table->id();
            $table->string('inquiry_reference_no')->unique();
            $table->enum('request_type', $requestTypes);
            $table->integer('guest_id')->unsigned();
            $table->date('checkin_date');
            $table->date('checkout_date');
            $table->tinyInteger('dates_flexible')->default(0);
            $table->tinyInteger('no_adults')->default(1);
            $table->tinyInteger('no_kids')->default(0);
            $table->tinyInteger('tc_agreed');
            $table->enum('status', $status)->default("PENDING");
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
        Schema::dropIfExists('inquiries');
    }
}
