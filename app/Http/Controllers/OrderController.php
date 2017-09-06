<?php

namespace App\Http\Controllers;

use App\Client;
use App\Order;
use App\Order_item;
use App\Product;
use Illuminate\Http\Request;

use App\Http\Requests;

class OrderController extends Controller
{
    public function getAddOrder()
    {
        $clients = Client::all();
        $products = Product::all();
        return view('addOrder',['clients' => $clients, 'products'=>$products]);

    }

    public function createOrder(Request $request)
    {
        $order_date = $request['order_date'];
        $client_id = $request['client_id'];
        $product_id = $request['product_id'];
        $total_amount = $request['total_amount'];
        $discount = $request['discount'];
        $grand_total = $request['grand_total'];
        $paid = $request['paid'];
        $due = $request['due'];
        $payment_type = $request['payment_type'];
        $quantity = $request['quantity'];
        $rate = $request['rate'];
        $total = $request['total'];

        $order = new Order();
        $order->order_date = $order_date;
        $order->client_id = $client_id;
        $order->total_amount = $total_amount;
        $order->discount =  $discount;
        $order->grand_total = $grand_total;
        $order->paid = $paid;
        $order->due = $due;
        $order->payment_type = $payment_type;
       if ($order->save()){
           $order_id =  $order->id;
           $order_item = new Order_item();
           $order_item->product_id = $product_id;
           $order_item->order_id = $order_id;
           $order_item->quantity = $quantity;
           $order_item->rate = $rate;
           $order_item->total = $total;
           $order_item->save();
       }

        return redirect()->back()->with(['message' => $order->id]);




    }
}
