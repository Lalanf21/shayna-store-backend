<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\model\Transaction;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function get(Request $request, $id)
    {
        $product = Transaction::with('details.product')
            ->find($id);
        if ($product)
            return ResponseFormatter::success($product, 'data transaksi berhasil di ambil');
        else
            return ResponseFormatter::error(null, 'data transaksi tidak ada', 404);

    }
}
