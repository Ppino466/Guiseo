<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class SalesHistoricReportMail extends Mailable
{
    use Queueable, SerializesModels;

    public $filePath;    

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Sales Historic Report Mail',
        );
    }

    public function __construct($filePath)
    {
        $this->filePath = $filePath;
    }

    public function build()
    {
        return $this->view('emails.report')
                    ->subject('Daily Sales Report')
                    ->attach($this->filePath, [
                        'as' => 'venta_historico.xlsx',
                        'mime' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
                    ]);
    }
}
