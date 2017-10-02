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
    public function getOrder()
    {
        /*
        $arr = array();
        $orders = Order::all()->toArray();
        if($orders){
            //$orders['client_name'] = '';
            foreach ($orders as $order) {
                $client=Client::find($order['client_id']);
                $new_order = array();
                if($client && $order['client_id']>0){
                    $client_name = array('client_name'=>$client->client_name);
                    //$new_order = array_merge($order,$client_name);
                }else{
                    $client_name = array('client_name'=>'NO BODY');
                }
                $new_order = array_merge($order,$client_name);
                array_push($arr,$new_order);

            }
        }
        $orders = $arr;
        return view('manageOrders',['orders'=>$orders]);
        */

        $order_item = Order_item::all()->groupBy('order_id');

        $orders = Order::all();
        return view('manageOrders',['orders'=>$orders, 'order_items'=>$order_item]);
    }
    public function getAddOrder()
    {
        $clients = Client::all();
        $products = Product::all();
        return view('addOrder',['clients' => $clients, 'products'=>$products]);

    }

    public function createOrder(Request $request)
    {

        $this->validate($request, [
            'product_name'=> 'required:products',
            'product_quantity'=>'required',
            //'unit_price'=>'required:products',
            'order_date'=>'required:orders',
            'client_id'=>'required',
            'total_amount'=>'required:orders',
            'grand_total'=>'required',
            'paid'=>'required',
            'payment_type'=>'required',
            'due'=>'required',
            'discount'=>'required'

        ]);


        $order_date = $request['order_date'];
        $client_id = $request['client_id'];
        $product_id = $request['product_name'];
        $total_amount = $request['total_amount'];
        $discount = $request['discount'];
        $grand_total = $request['grand_total'];
        $paid = $request['paid'];
        $due = $request['due'];
        $payment_type = $request['payment_type'];
        //$quantity = $request['quantity'];
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
        $updated_quantity = 0;

        if ($order->save()){
           //$input = Input::all();
            $product_ids = $request['product_name'];
            $quantities = $request['product_quantity'];
            foreach ($product_ids as $key => $product_id) {

               $product = Product::find($product_id);
               $product->product_quantity = $product->product_quantity - $quantities[$key];
               $product->save();

               $order_id =  $order->id;
               $order_item = new Order_item();
               $order_item->product_id = $product_id;
               $order_item->order_id = $order_id;
               $order_item->quantity = $quantities[$key];
               //$order_item->rate = $input['rateValue'][$key];
               //$order_item->total = $input['totalValue'][$key];
               $order_item->save();

           }
       }

        return response()->json($order_id,200);
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
    public function printOrder(Request $request)
    {
        $order = Order::find($request['order_id']);
        return view('printOrder',['order' => $order]);
    }
}
