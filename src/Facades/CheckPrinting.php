<?php

namespace BrianZaballa\CheckPrinting\Facades;

use BrianZaballa\CheckPrinting\CheckPrinter;
use Illuminate\Support\Facades\Facade;

/**
 * @method static string html(\BrianZaballa\CheckPrinting\Check $check)
 * @method static string pdf(\BrianZaballa\CheckPrinting\Check $check)
 * @method static string save(\BrianZaballa\CheckPrinting\Check $check, string $path)
 */
class CheckPrinting extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return CheckPrinter::class;
    }
}
