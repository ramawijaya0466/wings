@extends('layouts.dashboard')

@section('content')
<div class="section-content section-dashboard-home" data-aos="fade-up">
    <div class="container-fluid">
        <div class="dashboard-heading">
            <h2 class="dashboard-title">Dashboard</h2>
            <p class="dashboard-subtitle">
                Look what you have made today!
            </p>
        </div>
        <div class="dashboard-content">
            @if (Auth::user()->role == 'ADMIN')
                <div class="row">
                    <div class="col-md-4">
                        <div class="card mb-2">
                            <div class="card-body">
                                <div class="dashboard-card-title">
                                    Customer
                                </div>
                                <div class="dashboard-card-subtitle">
                                    {{ $customers }}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card mb-2">
                            <div class="card-body">
                                <div class="dashboard-card-title">
                                    Revenue
                                </div>
                                <div class="dashboard-card-subtitle">
                                    Rp. {{ number_format($revenues, 0, ',', '.') }}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card mb-2">
                            <div class="card-body">
                                <div class="dashboard-card-title">
                                    Transaction
                                </div>
                                <div class="dashboard-card-subtitle">
                                    {{ $transactions }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif

            <div class="row mt-3">
                <div class="col-12 mt-2">
                    <h5 class="mb-3">Recent Transactions</h5>
                    @forelse ($recentTransactions as $transaction)
                        <a class="card card-list d-block" href="#">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-1">
                                        <img src="/template/images/dashboard-icon-product-1.png" alt="" />
                                    </div>
                                    <div class="col-md-4">
                                        {{ $transaction->product->product_name }}
                                    </div>
                                    <div class="col-md-3">
                                        Rp. {{ number_format($transaction->subtotal, 0, ',', '.') }}
                                    </div>
                                    <div class="col-md-3">
                                        {{ $transaction->created_at }}
                                    </div>
                                    <div class="col-md-1 d-none d-md-block">
                                        <img src="/template/images/dashboard-arrow-right.svg" alt="" />
                                    </div>
                                </div>
                            </div>
                        </a>
                    @empty
                        <div class="card card-list d-block">
                            <div class="card-body">
                                <h5>No transaction occured ...</h5>
                            </div>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
