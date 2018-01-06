@extends('layouts.master')

@section('content')

    <div style="height: 50px"></div>
    <table class="table" id="reportLimited-table">
        <thead>
        <tr>
            <th  style="text-align: right">رقم المنتج</th>
            <th  style="text-align: right">العائلة</th>
            <th  style="text-align: right">المنتج</th>
            <th  style="text-align: right">الكمية</th>
            <th  style="text-align: right">السعر</th>
        </tr>
        </thead>
        <tbody>
        @foreach($products as $product)
            <tr>
                <td>{{ $product->id }}</td>
                <td>{{ $product->category->category_name }}</td>
                <td>{{ $product->product_name }}</td>
                <td>{{ $product->product_quantity }}</td>
                <td>{{ $product->unit_price }}</td>
            </tr>

        @endforeach
        </tbody>
    </table>
@endsection