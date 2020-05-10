<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\model\Transaction;
use App\model\TransactionDetail;

class TransactionController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $items = Transaction::all();
        return view('pages.transaction.index', compact('items'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        $item = Transaction::with('details.product')->findOrFail($id);

        return view('pages.transaction.show',compact('item'));
    }

    public function edit($id)
    {
        $item = Transaction::findOrFail($id);

        return view('pages.transaction.edit', compact('item'));
    }

    public function update(Request $request, $id)
    {
        $data = $request->all();
        $item = Transaction::findOrFail($id);
        $item->update($data);
        return redirect()->route('transaction.index')->with('status', 'Transaksi berhasil di Edit !');
    }
    
    public function destroy($id)
    {
        $item = Transaction::findOrFail($id);
        $item->delete();

        return redirect()->route('transaction.index')->with('status', 'Daftar transaksi berhasil di hapus !');
    }
    
    public function setStatus(Request $request, $id)
    {   
        $request->validate([
            'status'=>'required|in:PENDING,SUCCESS,FAILED'
            ]);
            
            $item = Transaction::findOrFail($id);
            $item->transaction_status = $request->status;
            $item->save();
            
            return redirect()->route('transaction.index')->with('status', 'Status transaksi berhasil di ubah !');

    }
}
