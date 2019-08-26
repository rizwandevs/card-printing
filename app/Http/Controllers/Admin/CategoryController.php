<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\CategoryVariation;
use App\Variation;
use App\VariationValue;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;
use Illuminate\Validation\ValidationException;
use File;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        return view('admin.category.index',[
            'table'=>Category::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('admin.category.create',[
            'variations'=>Variation::all()
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
            'variations'=>'required',
        ]);
        if(!count($request->variations)){
            $request->session()->flash('message.head', 'danger');
            $request->session()->flash('message.body','At lest one variation required!');
            return back();
        }

        $image = $request->file('image');
        $ext = $image->getClientOriginalExtension();

        $img_name = uniqid().'.'.$ext;
        $image->move('uploads',$img_name);


        $table =  new Category();
        $table->name = $request->name;
        $table->img = $img_name;
        $table->save();

        $category = $table->orderby('id','desc')->first();

        foreach ($request->variations as $i){
            $table =  new CategoryVariation();
            $table->category_id = $category['id'];
            $table->variation_id = $i;
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
        return view('admin.category.edit',[
            'data'=>Category::find($id),
            'variations'=>Variation::all()
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
            'variations'=>'required',
        ]);
        if(!count($request->variations)){
            $request->session()->flash('message.head', 'danger');
            $request->session()->flash('message.body','At lest one variation required!');
            return back();
        }
        $category = Category::find($id);
        $category->categoryVariation()->delete();
        $category->name = $request->name;
        if($request->image){
            File::delete('uploads/'.$category->img);
            $image = $request->file('image');
            $ext = $image->getClientOriginalExtension();
            $img_name = uniqid().'.'.$ext;
            $image->move('uploads',$img_name);
            $category->img = $img_name;
        }
        $category->save();

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
        $table = Category::find($id);
        if($table) {
            File::delete('uploads/'.$table->img);
            $table->categoryVariation()->delete();
            $table->delete();
        }

        session()->flash('message.head', 'success');
        session()->flash('message.body','Deleted!');
        return back();
    }
}
