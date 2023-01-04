<?php

namespace App\Constants;

final class Types
{
    const PENDING_STATUS        = "PENDING";
    const RESERVED_STATUS       = "RESERVED";
    const REJECTED_STATUS       = "REJECTED";
    
    const PARTIALLY_PAID_STATUS   = "PARTIALLY_PAID";
    const COMPLETED_STATUS      = "COMPLETED";
    const RESCHEDULED_STATUS    = "RESCHEDULED";
    const CANCELLED_STATUS      = "CANCELLED";

    const WEB_REQUESTED         = "WEB";
    const ADMIN_REQUESTED       = "ADMIN";

    const BOOKING_REF_PREFIX    = "BLC";
    const PAYMENT_REF_PREFIX    = "PLG";

    const BOOKING = "BOOKING";
    const INQUIRY = "INQUIRY";
    const PAYMENT = "PAYMENT";

    const PAY_CAT_DEPOSIT = "DEPPAY";
    const PAY_CAT_RESERVATION = "RESPAY";
    const PAY_CAT_VAS = "VASPAY";
    const PAY_CAT_OTHER = "OTHERPAY";

    const PAY_METHOD_CARD = "PAYCARD";
    const PAY_METHOD_CASH = "PAYCASH";

    const PARTIAL_PAY = "PP";
    const FULL_PAY = "FP";

}
