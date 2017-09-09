<?php

namespace App\Http\Controllers;

use App\Client;
use App\Order;
use App\Order_item;
use App\Product;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Input;

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
        $product_id = $request['productName'];
        $total_amount = $request['total_amount'];
        $discount = $request['discount'];
        $grand_total = $request['grand_total'];
        $paid = $request['paid'];
        $due = $request['due'];
        $payment_type = $request['payment_type'];
        $quantity = $request['quantity'];
        $rate = $request['rateValue'];
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
           $input = Input::all();
           $condition = $input['productName'];
           foreach ($condition as $key => $condition) {
               $order_id =  $order->id;
               $order_item = new Order_item();
               $order_item->product_id = $input['productName'][$key];
               $order_item->order_id = $order_id;
               $order_item->quantity = $input['quantity'][$key];
               $order_item->rate = $input['rateValue'][$key];
               $order_item->total = $input['totalValue'][$key];
               $order_item->save();
           }
       }

        return redirect()->back()->with(['message' => $order->id]);
    }
    public function fetchProductData()
    {
            $product = Product::all(['id','product_name'])->toArray();
            return $product;
    }

    public function fetchSelectedProduct(Request $request)
    {
        $product = Product::find($request['productId']);
        return $product;
    }
}
