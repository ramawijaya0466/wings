@extends('layouts.dashboard')

@push('addon-style')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.10.21/datatables.min.css"/>
@endpush

@section('content')
<div class="section-content section-dashboard-home" data-aos="fade-up">
    <div class="container-fluid">
        <div class="dashboard-heading">
            <h2 class="dashboard-title">Report</h2>
            <p class="dashboard-subtitle">
                Report Penjualan
            </p>
        </div>
        <div class="dashboard-content">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-hover scroll-horizontal-vertical w-100" id="report-table">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Transaction</th>
                                            <th>User</th>
                                            <th>Total</th>
                                            <th>Date</th>
                                            <th>Item</th>
                                        </tr>
                                    </thead>
                                    <tbody></tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('addon-script')
<script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.10.21/datatables.min.js"></script>
<script>
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });

    $("#report-table").DataTable({
        destroy: true,
        processing: true,
        serverSide: true,
        ordering: false,
        ajax: {
            url: "/report/pagination",
        },
        columns: [
            { data: "DT_RowIndex", orderable: false, searchable: false, },
            { data: 'transaction', name: 'transaction_headers.document_number' },
            { data: 'user', name: 'transaction_headers.user' },
            { data: 'total', name: 'transaction_headers.total' },
            { data: 'date', name: 'transaction_headers.date' },
            { data: 'product_name', name: 'products.product_name' },
        ]
    });
</script>
@endpush
