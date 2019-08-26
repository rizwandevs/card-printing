<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\CategoryVariation;
use App\Variation;
use App\VariationValue;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class VariationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        return view('admin.variation.index',[
            'table'=>Variation::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('admin.variation.create');
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
            'values'=>'required',
        ]);
        if(!count($request->values)){
            $request->session()->flash('message.head', 'danger');
            $request->session()->flash('message.body','At lest one value required!');
            return back();
        }
        $table =  new Variation();
        $table->name = $request->name;
        $table->save();

        $variation = $table->orderby('id','desc')->first();

        foreach ($request->values as $i){
            $table =  new VariationValue();
            $table->value = $i;
            $table->variation_id = $variation['id'];
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
        return view('admin.variation.edit',[
            'data'=>Variation::find($id)
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
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
            'values'=>'required',
        ]);
        if(!count($request->values)){
            $request->session()->flash('message.head', 'danger');
            $request->session()->flash('message.body','At lest one value required!');
            return back();
        }
        $variation = Variation::find($id);
        $variation->variationValues()->delete();
        $variation->name = $request->name;
        $variation->save();

        foreach ($request->values as $i){
            $table =  new VariationValue();
            $table->value = $i;
            $table->variation_id = $variation['id'];
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
        $table = Variation::find($id);
        if($table) {
            $table->variationValues()->delete();
            $table->delete();
        }

        session()->flash('message.head', 'success');
        session()->flash('message.body','Deleted!');
        return back();

    }

    public  function variationByCategory(){

        return DB::table('category_variations')->Rightjoin('variations','category_variations.variation_id','=','variations.id')
            ->where('category_variations.category_id',\request('id'))->get(['category_variations.*','variations.name']);

    }

    public  function valueByVariation(){
        $value=VariationValue::where('variation_id',request('id'))->get();
        return $value;
    }
}
