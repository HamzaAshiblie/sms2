<table border="0" width="100%;" cellpadding="5" style="border:1px solid black;border-top-style:1px solid black;border-bottom-style:1px solid red; direction: rtl">
<thead>
    <tr>
        <th  style="text-align: right">رقم المنتج</th>
        <th  style="text-align: right">العائلة</th>
        <th  style="text-align: right">المنتج</th>
        <th  style="text-align: right">الكمية</th>
        <th  style="text-align: right">سعر البيع</th>
        <th  style="text-align: right">العميل</th>
        <th  style="text-align: right">التاريخ</th>
        <th  style="text-align: right">الكمية</th>
        <th  style="text-align: right">سعر البيع</th>
        <th  style="text-align: right">العميل</th>
        <th  style="text-align: right">التاريخ</th>
    </tr>
    </thead>
    <tbody>
    @foreach($orders as $order)
        <tr>
            <td>{{ $order->id }}</td>
            <td>{{ $order->order_date }}</td>
            <td>{{ $order->client->client_name }}</td>
            <td>{{ $order_items->has($order->id) ? count($order_items[$order->id]) : 0 }}</td>
            <td>{{ $order->total_amount }}</td>
            <td>{{ $order->discount }}</td>
            <td>{{ $order->vat }}</td>
            <td>{{ $order->grand_total }}</td>
            <td>{{ $order->paid }}</td>
            <td>{{ $order->due }}</td>
            <td>{{ $order->payment_type }}</td>
        </tr>
    @endforeach
    </tbody>
</table>