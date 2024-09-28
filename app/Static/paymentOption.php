<?php

namespace App\Static;

class PaymentOption
{

    public static function all()
    {
        return ['wave', 'kpay', 'aya', 'cb', 'cash', 'other'];
    }
}
