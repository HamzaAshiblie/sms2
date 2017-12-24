<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function getReportSales()
    {
        return view('reportSales');
    }

    public function getReportPurchases()
    {
        return view('reportPurchases');
    }

    public function getReportInvoices()
    {
        return view('reportInvoices');
    }

    public function getReportVats()
    {
        return view('reportVats');
    }
}
