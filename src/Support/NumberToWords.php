<?php

namespace BrianZaballa\CheckPrinting\Support;

class NumberToWords
{
    private const ONES = ['', 'One', 'Two', 'Three', 'Four', 'Five', 'Six', 'Seven', 'Eight', 'Nine', 'Ten',
        'Eleven', 'Twelve', 'Thirteen', 'Fourteen', 'Fifteen', 'Sixteen', 'Seventeen', 'Eighteen', 'Nineteen'];

    private const TENS = ['', '', 'Twenty', 'Thirty', 'Forty', 'Fifty', 'Sixty', 'Seventy', 'Eighty', 'Ninety'];

    private const SCALES = ['', 'Thousand', 'Million', 'Billion', 'Trillion'];

    /** Converts a decimal string, e.g. "1234.5", to "One Thousand ... and 50/100 Dollars". */
    public static function check(string $amount, string $currencyWord = 'Dollars'): string
    {
        [$whole, $cents] = array_pad(explode('.', $amount, 2), 2, '0');
        $cents = str_pad(substr($cents, 0, 2), 2, '0');

        return self::integer((int) $whole).' and '.$cents.'/100 '.$currencyWord;
    }

    public static function integer(int $n): string
    {
        if ($n === 0) {
            return 'Zero';
        }

        $parts = [];
        for ($i = 0; $n > 0; $i++, $n = intdiv($n, 1000)) {
            $chunk = $n % 1000;
            if ($chunk > 0) {
                array_unshift($parts, trim(self::hundreds($chunk).' '.self::SCALES[$i]));
            }
        }

        return implode(' ', $parts);
    }

    private static function hundreds(int $n): string
    {
        $out = '';
        if ($n >= 100) {
            $out = self::ONES[intdiv($n, 100)].' Hundred';
            $n %= 100;
        }
        if ($n >= 20) {
            $out .= ' '.self::TENS[intdiv($n, 10)];
            $n %= 10;
        }
        if ($n > 0) {
            $out .= ' '.self::ONES[$n];
        }

        return trim($out);
    }
}
