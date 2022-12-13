<?php

namespace App\Http\Controllers;

use App\Models\TransactionDetail;
use App\Models\TransactionHeader;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $customers = User::where('role', 'USER')->count();
        $revenues = TransactionHeader::sum('total');
        $transactions = TransactionHeader::count();
        $recentTransactions = TransactionDetail::with(['product'])->orderBy('created_at', 'desc')->take(5)->get();

        return view('pages.dashboard.index', [
            'customers' => $customers,
            'revenues' => $revenues,
            'transactions' => $transactions,
            'recentTransactions' => $recentTransactions,
        ]);
    }
}
