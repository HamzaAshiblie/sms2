<?php

namespace App\Http\Controllers;

use App\Category;
use App\Client;
use App\Order;
use App\Order_item;
use App\Product;
use App\Product_update;
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
        $products = Product::where('product_quantity','>',0)->get();
        return view('addOrder',['clients' => $clients, 'products'=>$products]);

    }

    public function createOrder(Request $request)
    {

        $this->validate($request, [
            'product_name'=> 'required',
            'product_quantity'=>'required',
            'unit_price'=>'required',
            'total'=>'required:products',
            'order_date'=>'required:orders',
            'client_id'=>'required',
            'total_amount'=>'required:orders',
            'grand_total'=>'required',
            'paid'=>'required',
            'payment_type'=>'required',
            'due'=>'required',
            'item_discount'=>'required',
            'discount'=>'required'

        ]);


        $order_date = $request['order_date'];
        $client_id = $request['client_id'];
        $product_id = $request['product_name'];
        $total_amount = $request['total_amount'];
        $discount = $request['discount'];
        $vat = $request['vat'];
        $grand_total = $request['grand_total'];
        $paid = $request['paid'];
        $due = $request['due'];
        $payment_type = $request['payment_type'];
        //$quantity = $request['quantity'];
        //$unit_price = $request['unit_price'];
        //$total = $request['total'];

        $order = new Order();
        $order->order_date = $order_date;
        $order->client_id = $client_id;
        $order->total_amount = $total_amount;
        $order->discount =  $discount;
        $order->vat =  $vat;
        $order->grand_total = $grand_total;
        $order->paid = $paid;
        $order->due = $due;
        $order->payment_type = $payment_type;

        if ($request->user()->orders()->save($order)){
           //$input = Input::all();
            $product_ids = $request['product_name'];
            $quantities = $request['product_quantity'];
            $unit_prices = $request['unit_price'];
            $item_discounts = $request['item_discount'];
            $item_vats = $request['item_vat'];
            $totals = $request['total'];
            foreach ($product_ids as $key => $product_id) {
               //$product = Product::find($product_id);
               //$old = $product->product_quantity;
               //$product->product_quantity = $old - $quantities[$key];
               //$product->save();
               $order_id =  $order->id;
               $order_item = new Order_item();
               $order_item->product_id = $product_id;
               $order_item->order_id = $order_id;
               $order_item->quantity = $quantities[$key];
               $order_item->rate = $unit_prices[$key];
               $order_item->item_discount = $item_discounts[$key];
               $order_item->item_vat = $item_vats[$key];
               $order_item->total = $totals[$key];
               if ($order_item->save()){
                   $old_quantity = Product::where('id',$product_id)->first()->product_quantity;
                   $new_quantity = $quantities[$key];
                   $updated_quantity =   $old_quantity - $new_quantity;
                   Product::where('id',$product_id)->update(['product_quantity'=>$updated_quantity]);
                   $product_update = new Product_update();
                   $product_update->product_id = $product_id;
                   $product_update->product_quantity = $new_quantity;
                   $product_update->supplier = '';
                   $product_update->country ='';
                   $product_update->amount =$request['grand_total'];
                   $product_update->operation = 'مبيعات';
                   $product_update->save();
               }
           }
       }
        return response()->json($order_id,200);
    }
    public function removeOrderItem(Request $request)
    {
        $product_ids = $request['product_id'];
        $order_item_ids = $request['order_item_id'];
        $removed_quantities = $request['removed_quantity'];
        $totals = $request['total'];
        $removed_total = $request['removed_total'];
        $removed_discount = $request['removed_discount'];
        $removed_vat = $request['removed_vat'];
        $order_id = $request['order_id'];
        foreach ($order_item_ids as $key => $order_item_id){
            $product = Product::where('id',$product_ids[$key])->first();
            $old_quantity = $product->product_quantity;
            $updated_quantity = $old_quantity + $removed_quantities[$key];
            $product->product_quantity = $updated_quantity;
            $product->save();
            $order_item = Order_item::where('id',$order_item_id)->first();
            $old_item_quantity = $order_item->quantity;
            $old_item_total = $order_item->total;
            $updated_item_quantity = $old_item_quantity - $removed_quantities[$key];
            $updated_item_total = $old_item_total - $totals[$key];
            $order_item->quantity = $updated_item_quantity;
            $order_item->total = $updated_item_total;
            $order_item->save();
            $product_update = new Product_update();
            $product_update->product_id = $product_ids[$key];
            $product_update->product_quantity = $removed_quantities[$key];
            $product_update->supplier = '';
            $product_update->country ='';
            $product_update->amount =$removed_total;
            $product_update->operation = 'مرتجع';
            $product_update->save();
        }
        $order = Order::where('id',$order_id)->first();
        $old_grand_total = $order->grand_total;
        $old_discount = $order->discount;
        $old_vat = $order->vat;
        $order->grand_total = $old_grand_total - $removed_total;
        $order->discount = $old_discount - $removed_discount;
        $order->vat = $old_vat - $removed_vat;
        $order->save();
        return response()->json($order,200);
    }
    public function fetchProductData()
    {
            $product = Product::where('product_quantity','>',0)->get();
            return $product;
    }
    public function fetchSelectedProduct(Request $request)
    {
        //$product = Product::find($request['productId']);
        //$product = Product::where([['id',$request['productId']],['product_quantity','>',0]])->get();
        $product = Product::where([
            ['id', '=', $request['productId']],
            ['product_quantity', '>', 0]])->first();
        return $product;
    }
    public function printOrder($order_id)
    {
        $order = Order::where('id', $order_id)->first();
        if($order){
        $order_items = Order_item::where('order_id', $order_id)->get();
        return view('includes.printOrder',['order' => $order, 'order_items'=> $order_items]);
        }
        else{
            $message = 'رقم الطلب غير صحيح';
            return redirect()->back()->with(['message' => $message]);
        }
    }
    public function getOrderItem($order_id)
    {
        $order = Order::where('id', $order_id)->first();
        $order_items = Order_item::where('order_id', $order_id)->get();
        return view('removeOrderItem',['order' => $order, 'order_items'=> $order_items]);
    }
    public function fetchOrderItems(Request $request)
    {
        $order_items = Order_item::where('order_id', $request['order_id'])->get();
        return response()->json($order_items,200);
    }
    public function updateOrderPayment(Request $request)
    {
        $order = Order::where('id',$request['id'])->first();
        if($order){
            $order->paid += $request['paid'];
            $order->due = $request['due'] - $request['paid'];
            $order->payment_type = $request['payment_type'];
            $order->update();
        }
        return response()->json($order,200);
    }
}
