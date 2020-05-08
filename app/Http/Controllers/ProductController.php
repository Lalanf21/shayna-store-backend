<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\http\Requests\ProductRequest;
use Illuminate\Support\Str;
use App\model\Product;

class ProductController extends Controller
{
    
    public function index()
    {
        $items = Product::all();
        return view('pages.products.index', compact('items'));
    }

    public function create()
    {
        return view('pages.products.create'); 
    }

   
    public function store(ProductRequest $request)
    {
        $data = $request->all();
        $data['slug'] = Str::slug($request->name);
        // dd($data);
        Product::create($data);
        return redirect()->route('products.index')->with('status','Barang berhasil di tambahkan !');
    }

    
    public function show($id)
    {
        //
    }

    
    public function edit($id)
    {
        $item = Product::findOrFail($id);
        return view('pages.products.edit', compact('item'));
    }

    
    public function update(ProductRequest $request, $id)
    {
        $data = $request->all();
        $data['slug'] = Str::slug($request->name);
        // dd($data);
        $item = Product::findOrFail($id);
        $item->update($data);
        return redirect()->route('products.index')->with('status', 'Barang berhasil di Edit !');
    }
    
    
    public function destroy($id)
    {
        $item = Product::findOrFail($id);
        $item->delete();
        return redirect()->route('products.index')->with('status', 'Barang berhasil di hapus !');
    }
}
