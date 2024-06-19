<?php

namespace App\Mail;

use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class SalesWeekReportMail extends Mailable
{
    use Queueable, SerializesModels;

    use Queueable, SerializesModels;

    public $filePath;    

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Sales Week Report Mail',
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
        $date = Carbon::now();
        $weekNumber = $date->weekOfMonth;
        $fileName = "venta_semana_{$weekNumber}_{$date->format('Y-m-d')}.xlsx";
        return $this->view('emails.report')
                    ->subject('Weekly Sales Report')
                    ->attach($this->filePath, [
                        'as' => $fileName,
                        'mime' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
                    ]);
    }
}
