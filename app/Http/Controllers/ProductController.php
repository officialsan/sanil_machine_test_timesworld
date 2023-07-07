<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Variant;
use App\Models\ProductVariantMapping;
class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::all();
        return view('products.product_list',['products'=>$products]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $variants = Variant::all();
        return view('products.product_add_form',['variants' => $variants]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     */
    public function storeOrUpdate(Request $request)
    {
        $filename = null;
        if($request->image){
            $filename = time() . '.' . $request->image->extension();
            $request->image->move(public_path('images'), $filename);
        }
        $product = $request->id ? Product::find($request->id) : new Product();
        $product->title = $request->title;
        $product->description = $request->description;
        $product->image = $filename ?? $product->image;
        $product->save();
        $this->variantStore($product->id,$request->variants);
        return response()->json([
                                'status' => 'sucess',
                                'message' => 'Product updated successfully.',
                            ], 200);
    }

    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     */
    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $variants = Variant::all();
        return view('products.product_edit_form',['variants' => $variants,'product'=>$product]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     */
    public function destroy($id)
    {
        ProductVariantMapping::where('product_id',$id)->delete();
        $product = Product::findOrFail($id);
        $product->delete();
        return redirect("/")->with(['success'=>'Product delete successfully']);
        
    }    
    /**
     * variantStore
     *
     * @param  int $product_id
     * @param  array $variants
     */
    private function variantStore(int $product_id,array $variants)
    {
        ProductVariantMapping::where('product_id',$product_id)->delete();
        $data = [];
        foreach($variants as $variant){
            $data[] = [
                'variant_id' => $variant,
                'product_id' => $product_id,
            ];
        }
        return ProductVariantMapping::insert($data);
    }
}