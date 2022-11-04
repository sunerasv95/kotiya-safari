<?php

use App\Constants\Types;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentsTable extends Migration
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
            Types::COMPLETED_STATUS,
            Types::REJECTED_STATUS
        ];

        $payTypes = [
            Types::PAY_CAT_DEPOSIT,
            Types::PAY_CAT_RESERVATION,
            Types::PAY_CAT_VAS,
            Types::PAY_CAT_OTHER
        ];

        $methods = [
            Types::PAY_METHOD_CARD,
            Types::PAY_METHOD_CASH
        ];

        Schema::create('payments', function (Blueprint $table) use($status, $payTypes, $methods){
            $table->id();
            $table->integer('guest_id')->unsigned();
            $table->integer('reservation_order_id')->unsigned();
            $table->string('payment_reference', 30)->unique();
            $table->enum('payment_category', $payTypes);
            $table->double('total_amount')->default(0);
            $table->double('sub_amount')->default(0);
            $table->double('tax_percentage')->default(0);
            $table->double('tax')->default(0);
            $table->double('discount_percentage')->default(0);
            $table->double('discount')->default(0);
            $table->enum('payment_method', $methods);
            $table->enum('status', $status);
            $table->tinyInteger('is_deleted')->default(0);
            $table->timestamp('processed_at');
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
        Schema::dropIfExists('payments');
    }
}
