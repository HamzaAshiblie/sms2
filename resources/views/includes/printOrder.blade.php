<table border="1" cellspacing="0" cellpadding="20" width="100%">
    <thead>
    <tr >
        <th colspan="5">

            <center>
                Order Date : {{$order_date}}
                <center>Client Name : {{$client_name}}</center>
                Contact : {{$client_phone}}
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
    </tr>';

    $x = 1;
    while($row = $orderItemResult->fetch_array()) {

   <tr>
        <th>{{$x}}</th>
        <th>{{$product_name}}</th>
        <th>{{$unit_price}}</th>
        <th>{{$product_quantity}}</th>
        <th>{{$total_amount}}</th>
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
        <th>{{$total_amount}}</th>
    </tr>

    <tr>
        <th>Discount</th>
        <th>{{$discount}}</th>
    </tr>

    <tr>
        <th>Grand Total</th>
        <th>{{$grand_total}}</th>
    </tr>

    <tr>
        <th>Paid Amount</th>
        <th>{{$paid}}</th>
    </tr>

    <tr>
        <th>Due Amount</th>
        <th>{{$due}}</th>
    </tr>
    </tbody>
</table>