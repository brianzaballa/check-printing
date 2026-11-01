# CheckPrinting

Laravel package that renders printable bank checks (payee, amount, amount in words, MICR line) as PDFs.

## Install

```bash
composer require brianzaballa/check-printing
php artisan vendor:publish --tag=check-printing-config
php artisan vendor:publish --tag=check-printing-views   # optional, to customize layout
```

Set `CHECK_PAYER_NAME`, `CHECK_PAYER_ADDRESS`, `CHECK_BANK_NAME`, `CHECK_ROUTING_NUMBER`, `CHECK_ACCOUNT_NUMBER` in `.env`.

## Usage

```php
use BrianZaballa\CheckPrinting\Check;
use BrianZaballa\CheckPrinting\Facades\CheckPrinting;

$check = new Check('Jane Doe', '1234.50', '1001', now(), 'Invoice 42');

return response(CheckPrinting::pdf($check), 200, ['Content-Type' => 'application/pdf']);
CheckPrinting::save($check, storage_path('check-1001.pdf'));
```

Amounts are decimal strings to avoid float errors. Align the layout to your check stock by editing the published view.
The MICR line uses plain letters (C = on-us, A = transit symbol); use a MICR E-13B font in the published view for real stock.
