<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Variant;
use App\Models\ProductVariantMapping;
class VariantController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $variants = Variant::all();
        return view('variants.variant_list',['variants'=>$variants]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('variants.variant_add_form');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     */
    public function storeOrUpdate(Request $request)
    {
       
        $variant = $request->id ? Variant::find($request->id) : new Variant();
        $variant->title = $request->title;
        $variant->save();
        return response()->json([
                                'status' => 'sucess',
                                'message' => 'Variant updated successfully.',
                            ], 200);
    }

    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     */
    public function edit($id)
    {
        $variant = Variant::findOrFail($id);
        return view('variants.variant_edit_form',['variant'=>$variant]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     */
    public function destroy($id)
    {
        ProductVariantMapping::where('variant_id',$id)->delete();
        $variant = Variant::findOrFail($id);
        $variant->delete();
        return redirect("/variants")->with(['success'=>'Variant delete successfully']);
        
    }    
   
}