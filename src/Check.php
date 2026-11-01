<?php

namespace BrianZaballa\CheckPrinting;

use DateTimeInterface;
use InvalidArgumentException;

class Check
{
    public function __construct(
        public readonly string $payee,
        public readonly string $amount,
        public readonly string $checkNumber,
        public readonly DateTimeInterface $date,
        public readonly ?string $memo = null,
    ) {
        if (! preg_match('/^\d+(\.\d{1,2})?$/', $amount)) {
            throw new InvalidArgumentException('Amount must be a positive decimal string with up to 2 decimals.');
        }
        if (! preg_match('/^\d+$/', $checkNumber)) {
            throw new InvalidArgumentException('Check number must be numeric.');
        }
    }
}
