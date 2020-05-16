<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Model\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function all(Request $request)
    {
        $id = $request->input('id');
        $name = $request->input('name');
        $slug = $request->input('slug');
        $type = $request->input('type');
        $price_from = $request->input('price_from');
        $price_to = $request->input('price_to');
        $limit = $request->input('limit',6);

        if($id)
        {
            $product = Product::with('gallery')->find($id);

            if($product)
            {
                return ResponseFormatter::success($product,'data product berhasil di ambil');
            }else {
                return ResponseFormatter::error(null,'data product tidak ada',404);
            }
        }

        if($slug)
        {
            $product = Product::with('gallery')
                ->where('slug',$slug)
                ->first();

            if($product)
            {
                return ResponseFormatter::success($product,'data product berhasil di ambil');
            }else {
                return ResponseFormatter::error(null,'data product tidak ada',404);
            }
        }

        $product = Product::with('gallery');
        if( $name )
            $product->where('name','like', '%'. $name .'%'); 
        if( $type )
            $product->where('type','like', '%'. $type .'%'); 
        if( $price_from )
            $product->where('price','>=', $price_from); 
        if( $price_to )
            $product->where('price','<=', $price_to); 

        return ResponseFormatter::success($product->paginate($limit),'Data list product berhasil di ambil');
    }
}
