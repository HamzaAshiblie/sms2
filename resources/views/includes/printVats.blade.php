<table border="0" width="100%;" cellpadding="5" style="border:1px solid black;border-top-style:1px solid black;border-bottom-style:1px solid red; direction: rtl">
    <thead>
    <tr>
        <th  style="text-align: right">رقم الفاتورة</th>
        <th  style="text-align: right">رقم الفاتورة</th>
        <th  style="text-align: right">الاجمالي</th>
        <th  style="text-align: right">التاريخ</th>
    </tr>
    </thead>
    <tbody>
    @foreach($orders as $order)
        <tr>
            <td>{{ $order->id }}</td>
            <td>{{ $order->client->client_name }}</td>
            <td>{{ $order->vat }}</td>
            <td>{{ $order->created_at }}</td>
        </tr>
    @endforeach
    </tbody>
</table>