<?php

namespace App\Http\Controllers;

use App\Models\TransactionHeader;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class ReportController extends Controller
{
    public function index()
    {
        return view('pages.report.index');
    }

    public function pagination(Request $request)
    {
        $query = TransactionHeader::query()
            ->join('transaction_details', 'transaction_headers.document_number', '=', 'transaction_details.document_number')
            ->join('products', 'transaction_details.product_code', '=', 'products.product_code')
            ->select(
                'transaction_headers.document_code',
                'transaction_headers.document_number',
                'transaction_headers.document_number as transaction',
                'transaction_headers.total',
                'transaction_headers.user',
                'transaction_headers.date',
                'products.product_name',
            )
            ->when($request->search['value'], function ($query) use ($request) {
                $query
                    ->where('transaction_headers.document_code', 'LIKE', '%' . $request->search['value'] . '%')
                    ->orWhere('transaction_headers.document_number', 'LIKE', '%' . $request->search['value'] . '%')
                    ->orWhere('transaction_headers.total', 'LIKE', '%' . $request->search['value'] . '%')
                    ->orWhere('transaction_headers.date', 'LIKE', '%' . $request->search['value'] . '%')
                    ->orWhere('products.product_name', 'LIKE', '%' . $request->search['value'] . '%');
            });

        return DataTables::eloquent($query)
            ->addIndexColumn()
            ->editColumn('transaction', function($row) {
                return $row->document_code . '-' . $row->document_number;
            })
            ->editColumn('total', function($row) {
                return 'Rp. ' . number_format($row->total, 0, ',', '.');
            })
            ->toJson();
    }
}
