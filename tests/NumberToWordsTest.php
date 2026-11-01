<?php

namespace BrianZaballa\CheckPrinting\Tests;

use BrianZaballa\CheckPrinting\Support\NumberToWords;
use PHPUnit\Framework\TestCase;

class NumberToWordsTest extends TestCase
{
    public function test_converts_amounts(): void
    {
        $this->assertSame('Zero and 00/100 Dollars', NumberToWords::check('0'));
        $this->assertSame('One Thousand Two Hundred Thirty Four and 50/100 Dollars', NumberToWords::check('1234.5'));
        $this->assertSame('One Million and 99/100 Dollars', NumberToWords::check('1000000.99'));
    }
}
