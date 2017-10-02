<table border="1" cellspacing="0" cellpadding="20" width="100%">
    <thead>
    <tr >
        <th colspan="5">

            <center>
                Order Date : {{$order->order_date}}
                <center>Client Name : {{$order->client->client_name}}</center>
                Contact : {{$order->client->client_phone}}
            </center>
        </th>

    </tr>
    </thead>
</table>
<table border="0" width="100%;" cellpadding="5" style="border:1px solid black;border-top-style:1px solid black;border-bottom-style:1px solid black;">

    <tbody>
    <tr>
        <th>S.no</th>
        <th>Product</th>
        <th>Rate</th>
        <th>Quantity</th>
        <th>Total</th>
    </tr>


   <tr>
       @foreach($order_items as $order_item)
        <th>#</th>
        <th>{{$order_item->product->product_name}}</th>
        <th>{{$order_item->rate}}</th>
        <th>{{$order_item->quantity}}</th>
        <th>{{$order_item->total}}</th>
       @endforeach
    </tr>
   <tr>
        <th></th>
    </tr>

    <tr>
        <th></th>
    </tr>

    <tr>
        <th>Sub Amount</th>
        <th>Any number</th>
    </tr>

    <tr>
        <th>VAT (13%)</th>
        <th>Any number</th>
    </tr>

    <tr>
        <th>Total Amount</th>
        <th>{{$order->total_amount}}</th>
    </tr>

    <tr>
        <th>Discount</th>
        <th>{{$order->discount}}</th>
    </tr>

    <tr>
        <th>Grand Total</th>
        <th>{{$order->grand_total}}</th>
    </tr>

    <tr>
        <th>Paid Amount</th>
        <th>{{$order->paid}}</th>
    </tr>

    <tr>
        <th>Due Amount</th>
        <th>{{$order->due}}</th>
    </tr>
    </tbody>
</table>