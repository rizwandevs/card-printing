<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\CategoryVariation;
use App\Product;
use App\ProductVariation;
use App\ProductVariationValue;
use App\Variation;
use App\VariationValue;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;
use Illuminate\Validation\ValidationException;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        return view('admin.product.index',[
            'table'=>Product::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('admin.product.create',[
            'categories'=>Category::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     * @throws ValidationException
     */
    public function store(Request $request)
    {




        $this->validate($request,[
            'name'=>'required',
        ]);

//        if(!count($request->variations)){
//            $request->session()->flash('message.head', 'danger');
//            $request->session()->flash('message.body','At lest one variation required!');
//            return back();
//        }

        $ii=0;

//        return $request;
        $variation = []; //color , size etc//
        $value = []; //value_id//
        $arr = []; //value_id//

        $table =  new Product();
        $table->name = $request->name;
        $table->category_id = $request->category;
        $table->save();

        $product = $table->orderBy('id','desc')->first();

        foreach ($request->variation['value'] as $k=>$i){
            foreach ($request->variation['value'] as $kk=>$ii) {
                foreach ($ii as $kkk=>$iii){
                    $table =  new ProductVariation();
                    $table->variation_id = $k;
                    $table->product_id   = $product['id'];
                    $table->value_id     = $kkk;
                    $table->save();
//                    return $iii;
                }


//                $table =  new ProductVariationValue();
//                $table->variation_id = $k;
//                $table->product_id   = $product['id'];
//                $table->value_id     = $kk;
//                $table->save();
            }

        }
        return $value;

        $table =  new Product();
        $table->name = $request->name;
        $table->price = $request->price;
        $table->category_id = $request->category;
        $table->save();

        $product = $table->orderby('id','desc')->first();

        for($i=0; $i<count($request->variations);  $i++){
            $table =  new ProductVariation();
            $table->product_id = $product['id'];
            $table->variation_id = $request->variations[$i];
            $table->value_id = $request->values[$i];
            $table->save();
        }

        $request->session()->flash('message.head', 'success');
        $request->session()->flash('message.body','saved!');
        return back();
    }
/**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        return view('admin.product.edit',[
            'data'=>Product::find($id),
            'categories'=>Category::all()
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return void
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param int $id
     * @return Response
     * @throws ValidationException
     */
    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'name'=>'required',
        ]);
        $product = Product::find($id);
        $product->productVariation()->delete();
        $product->name = $request->name;
        $product->price = $request->price;
        $product->category_id = $request->category;
        $product->save();

        for($i=0; $i<count($request->variations);  $i++){
            $table =  new ProductVariation();
            $table->product_id = $product['id'];
            $table->variation_id = $request->variations[$i];
            $table->value_id = $request->values[$i];
            $table->save();
        }

        $request->session()->flash('message.head', 'success');
        $request->session()->flash('message.body','saved!');
        return back();




        $variation = Category::find($id);
        $variation->categoryVariation()->delete();
        $variation->name = $request->name;
        $variation->save();

        foreach ($request->variations as $i){
            $table =  new CategoryVariation();
            $table->variation_id = $i;
            $table->category_id = $id;
            $table->save();
        }

        $request->session()->flash('message.head', 'success');
        $request->session()->flash('message.body','Updated!');
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        $table = Product::find($id);
        if($table) {
            $table->productVariation()->delete();
            $table->delete();
        }

        session()->flash('message.head', 'success');
        session()->flash('message.body','Deleted!');
        return back();
    }
}
