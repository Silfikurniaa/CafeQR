<?php

namespace App\Support;

class Format
{
    public static function omzetSingkat(int $amount): string
    {
        if ($amount >= 1_000_000) {
            $jt = $amount / 1_000_000;

            return 'Rp '.number_format($jt, 1, ',', '.').'jt';
        }

        if ($amount >= 1_000) {
            return 'Rp '.number_format($amount / 1_000, 0, ',', '.').' rb';
        }

        return 'Rp '.number_format($amount, 0, ',', '.');
    }
}
