@extends('layouts.admin-app')
@section('style')
@endsection
@section('content')
    <section class="content">
        <div id="pageErrors">
        </div>
        <div id="contentContainer">
            <div class="row">
                <div class="col-md-12">
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title">Products</h3>
                            <div class="box-tools">
                            </div>
                        </div>
                        <div class="box-body">
                            @include('components.admin.alerts')
                            <form method="post" action="{{route('product.update',$data['id'])}}">@csrf @method('PATCH')
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="prn">Product Name <small class="text-danger">*</small></label>
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-caret-right"></i></span>
                                                <input type="text" class="form-control" name="name" id="name" placeholder="Enter Product Name" value="{{$data['name']}}">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="prn">Price<small class="text-danger">*</small></label>
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-caret-right"></i></span>
                                                <input type="text" class="form-control" name="price" id="price" placeholder="Enter Product Name" value="{{$data['price']}}">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row ">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="prn">Select Category<small class="text-danger">*</small></label>
                                            <select title="" name="category" id="category" class="form-control" >
                                                <option value="">select</option>
                                                @foreach($categories as $v)
                                                    <option value="{{$v->id}}">{{$v->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div id="variation_box"></div>
                                <div class="box-footer">
                                    <button type="submit" class="btn btn-primary pull-right">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('js')
    <script>
        $(document).ready(function () {
            let category = $("#category");
            category.val({{$data['category_id']}});
            setTimeout(function () {
            category.trigger('change');
            },1000);

            $(document).on('change','#category',function () {
                $.ajax({
                    url:"{{route('variation_by_category')}}",
                    type:"GET",
                    data:{id:$(this).val()},
                    beforeSend:function () {
                        $("#variation_box").html(null);
                    },
                    complete:function (data) {
                        let json = JSON.parse(data.responseText);
                        $.each(json,function (i,v) {
                            getVariationValue(v['variation_id'],v['name']);
                        });
                    }
                });

            });
        });

        function getVariationValue(id,name) {
            $.ajax({
                url:"{{route('value_by_variation')}}",
                type:"GET",
                data:{id:id},
                beforeSend:function () {

                },
                complete:function (data) {
                    let json = JSON.parse(data.responseText);
                    let variation_value_lenght = parseInt(json.length);
                    if (variation_value_lenght) {
                        if (variation_value_lenght) {
                            let a = ' <div class="row">' +
                                '<div class="col-md-6">' +
                                '<div class="form-group">' +
                                '<label for="prn">' + name + '<small class="text-danger">*</small></label>' +
                                '<select name="values[]" id="v'+id+'" class="form-control">';
                            let b = "";
                            let c = '</select><input hidden name="variations[]" value="'+id+'">' +
                                '</div></div><text/div>';

                            $.each(json, function (i, v) {
                                b +='<option value="'+v['id']+'">'+v['value']+'</option>';
                            });
                            $('#variation_box').append(a+b+c);
                        }
                    }
                    f();
                }
            });
        }
        
        function f() {
            @foreach($data->productVariationValue as $pVv)
                $("#v{{$pVv['variation_id']}}").val({{$pVv['value_id']}});
            @endforeach
        }
    </script>

@endsection
