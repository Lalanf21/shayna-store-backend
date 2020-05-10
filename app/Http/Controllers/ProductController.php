<?php

namespace App\Http\Controllers;

use App\http\Requests\ProductRequest;

use Illuminate\Support\Str;
use Illuminate\http\Request;

use App\model\Product;
use App\model\ProductGallery;

class ProductController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    
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
        dd($request);
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
        
        ProductGallery::where('products_id', $id)->delete();
        
        return redirect()->route('products.index')->with('status', 'Barang berhasil di hapus !');
    }

    public function gallery(Request $request, $id)
    {
        $product = Product::findOrFail($id);
        $items = ProductGallery::with('product')
            ->where('products_id', $id)
            ->get();

        return view('pages.product-gallery.gallery', [
            'product' => $product,
            'items' => $items
        ]);
    }
}
