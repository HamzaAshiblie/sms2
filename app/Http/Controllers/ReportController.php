<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Order;

class ReportController extends Controller
{
    public function getReportSales()
    {
        return view('reportSales');
    }

    public function postReportSales(Request $request)
    {
        $report = Order::where('client_id', $request['client_id'])->get();
        return response()->json($report,200);
    }

    public function getReportPurchases()
    {
        return view('reportPurchases');
    }

    public function getReportInvoices()
    {
        return view('reportInvoices');
    }

    public function postReportInvoice(Request $request)
    {
        return true;
        //return  response()->json($report,500);
    }

    public function getReportVats()
    {
        return view('reportVats');
    }
}
