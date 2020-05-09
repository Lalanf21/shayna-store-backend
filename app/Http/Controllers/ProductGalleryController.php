<?php

namespace App\Http\Controllers;

use App\http\Requests\ProductGalleryRequest;
use App\model\Product;
use App\model\ProductGallery;

class ProductGalleryController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $items = ProductGallery::with('product')->get();
        // dd($items);
        return view('pages.product-gallery.index', compact('items'));
    }

    public function create()
    {
        $products = Product::all();

        return view('pages.product-gallery.create', compact('products'));
    }

    public function store(ProductGalleryRequest $request)
    {
        $data = $request->all();
        $data['photo'] = $request->file('photo')->store('assets/product', 'public');

        ProductGallery::create($data);

        return redirect()->route('product-galleries.index')->with('status', 'Foto barang berhasil di tambahkan !');
    }
    

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

   
    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        $item = ProductGallery::findOrFail($id);
        $item->delete();
        return redirect()->route('product-galleries.index')->with('status', 'Foto berhasil di hapus !');
    }

    public function gallery(Request $request, $id)
    {
        $product = Product::findOrFail($id);
        $items = ProductGallery::with('product')
            ->where('products_id', $id)
            ->get();

        return view('pages.product-gallery.gallery',[
            'product' => $product,
            'items' => $items
        ]);
    }
}
