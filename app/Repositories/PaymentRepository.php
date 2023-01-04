<?php

namespace App\Repositories;

use App\Models\Payment;
use App\Models\Permission;
use App\Repositories\Contracts\PaymentRepositoryInterface;

class PaymentRepository implements PaymentRepositoryInterface
{

    public function save($data)
    {
        dd($data);
        $payment = new Payment();

        $payment->guest_id = $data['guest_id'];
        $payment->reservation_order_id = $data['reservation_order_id'];
        $payment->payment_reference = $data['payment_reference'];
        $payment->payment_category = $data['payment_category'];
        $payment->sub_amount = $data['amount'];
        $payment->tax_percentage = $data['tax_p'];
        $payment->tax = $data['tax'];
        $payment->discount_percentage = $data['discount_p'];
        $payment->discount	= $data['discount'];
        $payment->total_amount = $data['total'];
        $payment->payment_method = $data['payment_method'];
        $payment->status = $data['status'];
        $payment->is_deleted = 0;
        $payment->processed_at = null;
        $payment->created_at = now();
        $payment->updated_at = now();

        $payment->save();
    }
}
