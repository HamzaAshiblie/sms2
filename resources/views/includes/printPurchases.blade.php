<table border="0" width="100%;" cellpadding="5" style="border:1px solid black;border-top-style:1px solid black;border-bottom-style:1px solid red; direction: rtl">
    <thead>
    <tr>
        <th  style="text-align: right">رقم المنتج</th>
        <th  style="text-align: right">العائلة</th>
        <th  style="text-align: right">المنتج</th>
        <th  style="text-align: right">الكمية</th>
        <th  style="text-align: right">الوحدة</th>
        <th  style="text-align: right">سعر الشراء</th>
        <th  style="text-align: right">سعر البيع</th>
    </tr>
    </thead>
    <tbody>
    @foreach($products as $product)
        <tr>
            <td>{{ $product->id }}</td>
            <td>{{ $product->category->category_name }}</td>
            <td>{{ $product->product_name }}</td>
            <td>{{ $product->product_quantity }}</td>
            <td>{{ $product->product_unit }}</td>
            <td>{{ $product->init_price }}</td>
            <td>{{ $product->unit_price }}</td>
        </tr>
    @endforeach
    </tbody>
</table>