<table border="1" cellspacing="0" cellpadding="20" width="100%">
    <thead>
    <tr >
        <th colspan="5">
            رقم الطلب : {{$order->id}}
            <center>
                تاريخ الطلب : {{$order->order_date}}
                <center>العميل : {{$order->client->client_name}}</center>
                الهاتف : {{$order->client->client_phone}}
            </center>
        </th>

    </tr>
    </thead>
</table>
<table border="0" width="100%;" cellpadding="5" style="border:1px solid black;border-top-style:1px solid black;border-bottom-style:1px solid red; direction: rtl">

    <tbody>
    <tr>
        <th>رقم</th>
        <th>المنتج</th>
        <th>السعر</th>
        <th>الخصم</th>
        <th>الكمية</th>
        <th>الإجمالي</th>
    </tr>


    @foreach($order_items as $order_item)
    <tr>
        <th>#</th>
        <th>{{$order_item->product->product_name}}</th>
        <th>{{$order_item->rate}}</th>
        <th>{{$order_item->item_discount}}</th>
        <th>{{$order_item->quantity}}</th>
        <th>{{$order_item->total}}</th>
    </tr>
    @endforeach

    <tr>
        <th></th>
    </tr>

    <tr>
        <th></th>
    </tr>

    <tr>
        <th>الإجمالي</th>
        <th>{{$order->total_amount}}</th>
    </tr>

    <tr>
        <th>الخصم</th>
        <th>{{$order->discount}}</th>
    </tr>

    <tr>
        <th>المجموع الكلي</th>
        <th>{{$order->grand_total}}</th>
    </tr>

    <tr>
        <th>المدفوع</th>
        <th>{{$order->paid}}</th>
    </tr>

    <tr>
        <th>المستحق</th>
        <th>{{$order->due}}</th>
    </tr>
    </tbody>
</table>