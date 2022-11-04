<?php

namespace App\Constants;

final class Types
{
    const PENDING_STATUS        = "PENDING";
    const RESERVED_STATUS       = "RESERVED";
    const REJECTED_STATUS       = "REJECTED";
    const DEPOSIT_PAID_STATUS   = "DEPOSIT_PAID";
    const COMPLETED_STATUS      = "COMPLETED";
    const RESCHEDULED_STATUS    = "RESCHEDULED";
    const CANCELLED_STATUS      = "CANCELLED";

    const WEB_REQUESTED         = "WEB";
    const ADMIN_REQUESTED       = "ADMIN";

    const BOOKING_REF_PREFIX    = "BLC";

    const BOOKING = "BOOKING";
    const INQUIRY = "INQUIRY";

    const PAY_CAT_DEPOSIT = "DEPPAY";
    const PAY_CAT_RESERVATION = "RESPAY";
    const PAY_CAT_VAS = "VASPAY";
    const PAY_CAT_OTHER = "OTHERPAY";

    const PAY_METHOD_CARD = "PAYCARD";
    const PAY_METHOD_CASH = "PAYCASH";

}
