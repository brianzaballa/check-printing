<?php

namespace BrianZaballa\CheckPrinting;

use BrianZaballa\CheckPrinting\Support\NumberToWords;
use Dompdf\Dompdf;
use Dompdf\Options;
use Illuminate\Contracts\View\Factory as ViewFactory;

class CheckPrinter
{
    public function __construct(
        protected ViewFactory $views,
        protected array $config,
    ) {
    }

    public function html(Check $check): string
    {
        return $this->views->make($this->config['view'], [
            'check' => $check,
            'payer' => $this->config['payer'],
            'bank' => $this->config['bank'],
            'amountFormatted' => number_format((float) $check->amount, 2),
            'amountWords' => NumberToWords::check($check->amount, $this->config['currency_word']),
            'date' => $check->date->format($this->config['date_format']),
        ])->render();
    }

    /** Returns raw PDF bytes. */
    public function pdf(Check $check): string
    {
        $options = new Options();
        $options->set('isRemoteEnabled', false);

        $dompdf = new Dompdf($options);
        $dompdf->setPaper($this->config['paper']);
        $dompdf->loadHtml($this->html($check));
        $dompdf->render();

        return $dompdf->output();
    }

    public function save(Check $check, string $path): string
    {
        file_put_contents($path, $this->pdf($check));

        return $path;
    }
}
