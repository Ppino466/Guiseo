<?php

namespace App\Mail;

use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class SalesDayReportMail extends Mailable
{
    use Queueable, SerializesModels;

    public $filePath;    

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Sales Day Report Mail',
        );
    }

    public function __construct($filePath)
    {
        $this->filePath = $filePath;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $date = Carbon::now()->format('Y-m-d');
        $fileName = "venta_diaria_{$date}.xlsx";
        return $this->view('emails.report')
                    ->subject('Daily Sales Report')
                    ->attach($this->filePath, [
                        'as' => $fileName,
                        'mime' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
                    ]);
    }
}
