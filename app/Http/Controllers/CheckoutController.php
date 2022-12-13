<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\TransactionDetail;
use App\Models\TransactionHeader;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $checkouts = Cart::with(['product'])->where('user_id', Auth::user()->id)->get();

        return view('pages.checkout.index', [
            'checkouts' => $checkouts,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        DB::beginTransaction();
        try {
            $transactionHeader = TransactionHeader::create([
                'document_code' => '',
                'document_number' => '',
                'user' => $request->user,
                'total' => 0,
                'date' => now(),
            ]);

            $transactionTotal = [];
            $transactionDetail = [];
            foreach (json_decode($request->data, true) as $key => $value) {
                $transactionDetail[$key]['document_code'] = $transactionHeader->document_code;
                $transactionDetail[$key]['document_number'] = $transactionHeader->document_number;
                $transactionDetail[$key]['product_code'] = $value['product_code'];
                $transactionDetail[$key]['price'] = str_replace('.', '', $value['price']);
                $transactionDetail[$key]['quantity'] = str_replace('.', '', $value['quantity']);
                $transactionDetail[$key]['unit'] = $value['unit'];
                $transactionDetail[$key]['subtotal'] = str_replace('.', '', $value['subtotal']);
                $transactionDetail[$key]['currency'] = $value['currency'];
                $transactionDetail[$key]['created_at'] = now();
                $transactionDetail[$key]['updated_at'] = now();

                $transactionTotal[$key] = intval(str_replace('.', '', $value['subtotal']));
            }
            TransactionDetail::insert($transactionDetail);

            TransactionHeader::where('document_number', $transactionHeader->document_number)->first()->update([
                'total' => array_sum($transactionTotal)
            ]);

            Cart::where('user_id', $request->user_id)->delete();

            DB::commit();

            return response()->json([
                'status' => 'success',
                'message' => 'Checkout success',
                'data' => $request->all(),
            ], 201);
        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage(),
            ], 500);
        }
    }
}
