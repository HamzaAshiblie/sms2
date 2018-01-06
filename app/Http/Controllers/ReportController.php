<?php

namespace App\Http\Controllers;

use App\Client;
use App\Order_item;
use App\Product;
use App\Product_update;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Order;

class ReportController extends Controller
{
    public function getReportSales()
    {
        $betweenOrders =[];
        $order_item = Order_item::all()->groupBy('order_id');

        $orders = Order::all();
        return view('reportSales',['orders'=>$orders, 'order_items'=>$order_item , 'betweenOrders' => $betweenOrders]);
    }

    public function postReportSales(Request $request)
    {
        $report = Order::where('client_id', $request['client_id'])->get();
        return response()->json($report,200);
    }

    public function printSales()
    {
        $betweenOrders =[];
        $order_item = Order_item::all()->groupBy('order_id');

        $orders = Order::all();
        return view('includes.printSales',['orders'=>$orders, 'order_items'=>$order_item , 'betweenOrders' => $betweenOrders]);
    }
    public function getReportPurchases(Request $request)
    {
        $betweenProducts = [];
        $products = Product::all();

        $product_updates = Product_update::all();
        foreach ($product_updates as $product_update)
        {
            if($product_update->operation == 'توريد')
            {
                $product_quantity = $product_update->product_quantity;
            }
        }

        if($request['message']!=null){
            return view('reportPurchases',['products'=> $products, 'betweenProducts' => $betweenProducts])->with('message');
        }else{
            return view('reportPurchases',['products'=> $products, 'betweenProducts' => $betweenProducts]);
        }
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
        $betweenVatOrders =[];
        $orders = Order::all();
        $clients = Client::all();
        return view('reportVats',['orders'=> $orders, 'betweenVatOrders' => $betweenVatOrders, 'clients' => $clients]);
    }

    public function getReportBetweenDate(Request $request)
    {
        $start = $request['start'].' 00:00:00';
        $end = $request['end'].' 23:59:14';
        $order_item = Order_item::all()->groupBy('order_id');
        $orders = Order::all();
        $betweenOrders = Order::whereBetween('created_at', array($start, $end))->get();;
        return view('reportSales',['orders'=>$orders, 'order_items'=>$order_item , 'betweenOrders' => $betweenOrders]);
    }

    public function getReportPurchasesBetweenDate(Request $request)
    {
        $start = $request['start'].' 00:00:00';
        $end = $request['end'].' 23:59:14';
        $product = Product::all();
        $betweenProducts = Product::whereBetween('created_at', array($start, $end))->get();;
        return view('reportPurchases',['products' => $product, 'betweenProducts' => $betweenProducts]);
    }

    public function getReportVatBetweenDate(Request $request)
    {
        $start = $request['start'].' 00:00:00';
        $end = $request['end'].' 23:59:14';
        $order_item = Order_item::all()->groupBy('order_id');
        $orders = Order::all();
        $betweenVatOrders = Order::whereBetween('created_at', array($start, $end))->get();;
        return view('reportVats',['orders'=>$orders, 'order_items'=>$order_item , 'betweenVatOrders' => $betweenVatOrders]);
    }

    public function getReportLimited()
    {
        $products = Product::where([['product_quantity','<=','limit']])->get();
        return view('reportLimited',['products'=>$products]);
    }
}
