<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\CategoryVariation;
use App\HomeSlider;
use App\Variation;
use App\VariationValue;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;
use Illuminate\Validation\ValidationException;
use File;

class HomeSliderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        return view('admin.home_slider.index',[
            'table'=>HomeSlider::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('admin.home_slider.create');
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
            'image'=>'required',
        ]);


        $image = $request->file('image');
        $ext = $image->getClientOriginalExtension();

        $img_name = uniqid().'.'.$ext;
        $image->move('uploads',$img_name);

        $table =  new HomeSlider();
        $table->img = $img_name;
        $table->save();

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
        return view('admin.home_slider.edit',[
            'data'=>HomeSlider::find($id),
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
            'image'=>'required',
        ]);
        $homeSlider = HomeSlider::find($id);
        $image = $request->file('image');
        $image->move('uploads',$homeSlider['img']);

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
        $homeSlider = HomeSlider::find($id);
        File::delete('uploads/'.$homeSlider->img);
        $homeSlider->delete();

        session()->flash('message.head', 'success');
        session()->flash('message.body','Deleted!');
        return back();
    }
}
