<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\Report\SalesHistoric as ReportSalesHistoric;
use App\Mail\SalesHistoricReportMail;
use Illuminate\Support\Facades\Mail;

class salehistoric extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:sale.historic';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Genera reporte historico de ventas';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $email = '2121100410@soy.utj.edu.mx';
        
        // Generate the Excel file
        $filePath = storage_path('app/venta_historico.xlsx');
        Excel::store(new ReportSalesHistoric, 'venta_historico.xlsx');

        // Send the email with the attachment
        Mail::to($email)->send(new SalesHistoricReportMail($filePath));

        $this->info('Email sent successfully!');

        unlink($filePath);

    }
}
