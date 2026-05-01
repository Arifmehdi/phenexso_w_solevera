@extends('admin.master')

@section('title')
    Admin Dashboard | {{ env('APP_NAME') }}
@endsection

@section('body')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Admin Dashboard</h1>
            </div>
        </div>
    </div>
</div>

<section class="content">
    <div class="container-fluid">
        <!-- Top Summary Cards -->
        <div class="row">
            <div class="col-lg-3 col-6">
                <div class="small-box bg-info shadow-sm">
                    <div class="inner">
                        <h3>{{ $users }}</h3>
                        <p>Total Users</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-users"></i>
                    </div>
                    <a href="{{ route('admin.all_user') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <div class="col-lg-3 col-6">
                <div class="small-box bg-success shadow-sm">
                    <div class="inner">
                        <h3>{{ $productcount }}</h3>
                        <p>Total Products</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-shopping-bag"></i>
                    </div>
                    <a href="{{ route('admin.productsAll') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <div class="col-lg-3 col-6">
                <div class="small-box bg-warning shadow-sm">
                    <div class="inner">
                        <h3>{{ $orders }}</h3>
                        <p>Total Orders</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-shopping-cart"></i>
                    </div>
                    <a href="{{ route('admin.orderList') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <div class="col-lg-3 col-6">
                <div class="small-box bg-danger shadow-sm">
                    <div class="inner">
                        <h3>{{ number_format($this_month_revenue, 2) }} ৳</h3>
                        <p>Monthly Revenue</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-money-bill-wave"></i>
                    </div>
                    <a href="#" class="small-box-footer">This Month <i class="fas fa-info-circle"></i></a>
                </div>
            </div>
        </div>

        <!-- Order Status Summary Row -->
        <div class="row">
            <div class="col-md-3">
                <div class="card bg-light shadow-sm">
                    <div class="card-body py-3 px-4 d-flex align-items-center">
                        <div class="bg-primary p-3 rounded-circle mr-3">
                            <i class="fas fa-clock text-white"></i>
                        </div>
                        <div>
                            <h5 class="mb-0 font-weight-bold">{{ $pending_orders_count }}</h5>
                            <span class="text-muted small">Pending Orders</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card bg-light shadow-sm">
                    <div class="card-body py-3 px-4 d-flex align-items-center">
                        <div class="bg-info p-3 rounded-circle mr-3">
                            <i class="fas fa-check-circle text-white"></i>
                        </div>
                        <div>
                            <h5 class="mb-0 font-weight-bold">{{ $confirmed_orders_count }}</h5>
                            <span class="text-muted small">Confirmed Orders</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card bg-light shadow-sm">
                    <div class="card-body py-3 px-4 d-flex align-items-center">
                        <div class="bg-success p-3 rounded-circle mr-3">
                            <i class="fas fa-truck text-white"></i>
                        </div>
                        <div>
                            <h5 class="mb-0 font-weight-bold">{{ $delivered_orders_count }}</h5>
                            <span class="text-muted small">Delivered Orders</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card bg-light shadow-sm">
                    <div class="card-body py-3 px-4 d-flex align-items-center">
                        <div class="bg-danger p-3 rounded-circle mr-3">
                            <i class="fas fa-times-circle text-white"></i>
                        </div>
                        <div>
                            <h5 class="mb-0 font-weight-bold">{{ $cancelled_orders_count }}</h5>
                            <span class="text-muted small">Cancelled Orders</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Sales Chart Row -->
        <div class="row mt-4">
            <div class="col-md-12">
                <div class="card shadow-sm border-0">
                    <div class="card-header bg-white">
                        <h3 class="card-title">
                            <i class="fas fa-chart-line mr-1 text-primary"></i>
                            Sales Analytics (Last 7 Days)
                        </h3>
                    </div>
                    <div class="card-body">
                        <div class="chart">
                            <canvas id="salesChart" style="min-height: 250px; height: 350px; max-height: 350px; max-width: 100%;"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-4">
            <!-- Recent Orders -->
            <div class="col-md-7">
                <div class="card shadow-sm border-0">
                    <div class="card-header bg-white d-flex align-items-center">
                        <h3 class="card-title flex-grow-1">
                            <i class="fas fa-shopping-cart mr-1 text-warning"></i> Recent Orders
                        </h3>
                        <a href="{{ route('admin.orderList') }}" class="btn btn-sm btn-outline-primary">View All</a>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-hover mb-0">
                                <thead class="bg-light small">
                                    <tr>
                                        <th>Order ID</th>
                                        <th>Customer</th>
                                        <th>Status</th>
                                        <th>Total</th>
                                        <th>Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($recent_orders as $order)
                                        <tr>
                                            <td><a href="#">#{{ $order->id }}</a></td>
                                            <td>{{ $order->user->name ?? $order->name }}</td>
                                            <td>
                                                @php
                                                    $statusClass = [
                                                        'pending' => 'badge-primary',
                                                        'confirmed' => 'badge-info',
                                                        'delivered' => 'badge-success',
                                                        'cancelled' => 'badge-danger',
                                                    ][$order->order_status] ?? 'badge-secondary';
                                                @endphp
                                                <span class="badge {{ $statusClass }} text-capitalize">
                                                    {{ $order->order_status }}
                                                </span>
                                            </td>
                                            <td>{{ number_format($order->grand_total, 2) }} ৳</td>
                                            <td>{{ $order->created_at->format('M d, Y') }}</td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="5" class="text-center py-4">No recent orders found.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Top Products -->
            <div class="col-md-5">
                <div class="card shadow-sm border-0">
                    <div class="card-header bg-white d-flex align-items-center">
                        <h3 class="card-title flex-grow-1">
                            <i class="fas fa-th-large mr-1 text-info"></i> Latest Products
                        </h3>
                        <a href="{{ route('admin.productsAll') }}" class="btn btn-sm btn-outline-primary">View All</a>
                    </div>
                    <div class="card-body p-0">
                        <ul class="products-list product-list-in-card pl-2 pr-2">
                            @forelse ($products as $product)
                                <li class="item">
                                    <div class="product-img">
                                        <img src="{{ route('imagecache', ['template' => 'sbixs', 'filename' => $product->fi()]) }}" alt="Product Image" class="img-size-50">
                                    </div>
                                    <div class="product-info">
                                        <a href="{{ route('admin.productEdit', $product) }}" class="product-title">
                                            {{ Str::limit($product->name_en, 30) }}
                                            <span class="badge badge-success float-right">{{ $product->price }} ৳</span>
                                        </a>
                                        <span class="product-description">
                                            Stock: {{ $product->stock ?? 'N/A' }} | Status: {{ $product->active ? 'Active' : 'Inactive' }}
                                        </span>
                                    </div>
                                </li>
                            @empty
                                <li class="item text-center py-4 text-muted">No products found.</li>
                            @endforelse
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@push('js')
<script>
    $(function () {
        var salesChartCanvas = $('#salesChart').get(0).getContext('2d')

        var salesChartData = {
            labels: {!! json_encode($labels_last_7_days) !!},
            datasets: [
                {
                    label: 'Delivered Sales',
                    backgroundColor: 'rgba(60,141,188,0.1)',
                    borderColor: 'rgba(60,141,188,1)',
                    pointRadius: 4,
                    pointBackgroundColor: 'rgba(60,141,188,1)',
                    pointBorderColor: '#fff',
                    pointHoverBackgroundColor: '#fff',
                    pointHoverBorderColor: 'rgba(60,141,188,1)',
                    data: {!! json_encode($sales_last_7_days) !!},
                    fill: true
                }
            ]
        }

        var salesChartOptions = {
            maintainAspectRatio: false,
            responsive: true,
            legend: {
                display: true,
                position: 'top'
            },
            scales: {
                xAxes: [{
                    gridLines: {
                        display: false
                    }
                }],
                yAxes: [{
                    gridLines: {
                        display: true,
                        color: '#f3f3f3',
                        zeroLineColor: '#f3f3f3'
                    },
                    ticks: {
                        beginAtZero: true,
                        callback: function(value) {
                            return value + ' ৳';
                        }
                    }
                }]
            },
            tooltips: {
                callbacks: {
                    label: function(tooltipItem, data) {
                        return data.datasets[tooltipItem.datasetIndex].label + ': ' + tooltipItem.yLabel + ' ৳';
                    }
                }
            }
        }

        var salesChart = new Chart(salesChartCanvas, {
            type: 'line',
            data: salesChartData,
            options: salesChartOptions
        })
    })
</script>
@endpush
