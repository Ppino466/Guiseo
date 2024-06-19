<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\Report\SalesDay as ReportSalesDay;
use App\Mail\SalesDayReportMail;
use Illuminate\Support\Facades\Mail;

class saleday extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:sale.day';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Genera reporte de venta del día en curso';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $email = '2121100410@soy.utj.edu.mx';
        
        // Generate the Excel file
        $filePath = storage_path('app/venta_diaria.xlsx');
        Excel::store(new ReportSalesDay, 'venta_diaria.xlsx');

        // Send the email with the attachment
        Mail::to($email)->send(new SalesDayReportMail($filePath));

        $this->info('Email sent successfully!');

        unlink($filePath);
    }
}
