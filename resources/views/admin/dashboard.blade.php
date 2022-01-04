@extends('layouts.app')
@section('header')
    @include('layouts.partials.header')
@endsection
@section('content')
    <div class="container p-5 mb-5">

        <div class="row g-0 justify-content-center">
            <div class="col-md-10">
                <div class="d-flex flex-row justify-content-start mb-3">
                    <a href="{{ route('admin.dashboard') }}" class="btn btn-jh-primary me-3">
                        Dashboard
                    </a>
                    <a href="{{ route('admin.categories.index') }}" class="btn btn-jh-primary me-3">
                        Manage Categories
                    </a>
                    <a href="{{ route('product.index') }}" class="btn btn-jh-primary">
                        Manage Products
                    </a>
                </div>

                <div class="card shadow-sm">
                    <div class="card-header">
                        <p class="mb-0 fw-700 text-bistre">
                            Orders
                        </p>
                    </div>

                    <div class="card-body">
                        <table class="table fs-7 table-hover table-bordered" id="orders_table" aria-describedby="orders_table">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Order ID</th>
                                <th scope="col">Price</th>
                                <th scope="col">Date</th>
                                <th scope="col" class="text-center">Payment Status</th>
                                <th scope="col" class="text-center">Order Progress</th>
                                <th scope="col" class="text-center">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($orders as $order)
                                <tr>
                                    <th scope="row">{{ $loop->index + 1 }}</th>
                                    <td>
                                        {{ $order->id }}
                                    </td>
                                    <td>
                                        {{ '$' . number_format($order->total_price) }}
                                    </td>
                                    <td>
                                        {{ date('Y-m-d H:i:s ', strtotime($order->created_at))  }}
                                    </td>
                                    <td class="text-center">
                                        @if($order->payment_status === 'CREATED')
                                            <div class="badge bg-warning text-dark">
                                                {{ $order->payment_status }}
                                            </div>
                                        @elseif($order->payment_status === 'PENDING')
                                            <div class="badge bg-info text-dark">
                                                {{ $order->payment_status }}
                                            </div>
                                        @elseif($order->payment_status === 'PAID')
                                            <div class="badge bg-success">
                                                {{ $order->payment_status }}
                                            </div>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        @if($order->order_progress === 'IN_PACKAGING')
                                            <div class="badge bg-warning text-dark">
                                                {{ $order->order_progress }}
                                            </div>
                                        @elseif($order->order_progress === 'ON_DELIVERY')
                                            <div class="badge bg-info text-dark">
                                                {{ $order->order_progress }}
                                            </div>
                                        @elseif($order->order_progress === 'RECEIVED')
                                            <div class="badge bg-success">
                                                {{ $order->order_progress }}
                                            </div>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        <a href="{{ route('admin.order.details', $order->id) }}" class="btn btn-sm btn-outline-secondary">
                                            Details
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        $(document).ready(function () {
            $('#orders_table').DataTable();
        });
    </script>
@endsection
