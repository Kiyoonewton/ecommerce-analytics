@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Consolidated Orders</h1>
        <div>
            <a href="{{ route('consolidated-orders.export') }}" class="btn btn-success">Export to Excel</a>
            <a href="{{ route('consolidated-orders.import.form') }}" class="btn btn-primary">Import from Excel</a>
        </div>
    </div>

    <div class="card mb-4">
        <div class="card-body">
            <p>Total Records: <strong>{{ $totalRecords }}</strong></p>
        </div>
    </div>

    <div class="table-responsive">
        <table class="table table-striped table-bordered">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Order ID</th>
                    <th>Customer</th>
                    <th>Product</th>
                    <th>Quantity</th>
                    <th>Line Total</th>
                    <th>Order Date</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach($orders as $order)
                    <tr>
                        <td>{{ $order->id }}</td>
                        <td>{{ $order->order_id }}</td>
                        <td>
                            {{ $order->customer_name }}<br>
                            <small>{{ $order->customer_email }}</small>
                        </td>
                        <td>
                            {{ $order->product_name }}<br>
                            <small>SKU: {{ $order->sku }}</small>
                        </td>
                        <td>{{ $order->quantity }} × ${{ number_format($order->item_price, 2) }}</td>
                        <td>${{ number_format($order->line_total, 2) }}</td>
                        <td>{{ $order->order_date->format('Y-m-d H:i') }}</td>
                        <td>{{ $order->order_status }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="d-flex justify-content-center">
        {{ $orders->links() }}
    </div>
@endsection