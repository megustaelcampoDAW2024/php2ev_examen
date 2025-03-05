<?php
namespace App\Mail;

use App\Models\Cuota;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Http;

class CuotaFacturaMailable extends Mailable
{
    use Queueable, SerializesModels;

    public $cuota;

    /**
     * Create a new message instance.
     *
     * @param Cuota $cuota
     */
    public function __construct(Cuota $cuota)
    {
        $this->cuota = $cuota;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $response = Http::get('https://api.exchangerate-api.com/v4/latest/' . $this->cuota->moneda);
        $exchangeRate = $response->json()['rates']['EUR'];
        $importe_euro = round($this->cuota->importe * $exchangeRate, 2);
        $pdf = Pdf::loadView('cuota.factura', [
            'cuota' => $this->cuota,
            'importe_euro' => $importe_euro,
        ]);

        return $this->view('emails.cuota.factura')
                    ->subject('Factura de Cuota')
                    ->attachData($pdf->output(), 'factura_cuota_' . $this->cuota->id . '.pdf', [
                        'mime' => 'application/pdf',
                    ]);
    }
}