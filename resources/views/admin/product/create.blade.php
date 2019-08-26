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
                            <form method="post" action="{{route('product.store')}}">@csrf
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="prn">Product Name <small class="text-danger">*</small></label>
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-caret-right"></i></span>
                                                <input type="text" class="form-control" name="name" id="name" placeholder="Enter Category Name">
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
                                                <input type="text" class="form-control" name="price" id="price" placeholder="Enter Category Name">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row add-variation">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="prn">Default Image <small class="text-danger">*</small></label>
                                            <input type="file" name="default_image" class="dropify" data-height="100" data-max-file-size="0.1M" data-allowed-file-extensions="png jpg jpeg"/>
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
                                <div id="append"></div>

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
        $('.dropify').dropify();
        $(document).ready(function () {
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
                                '<select name="variation[]" id="" data-id="'+json[0]['variation_id']+'" class="form-control" onchange="valueAttr($(this))" multiple>';
                            let b = "";
                            let c = '</select></div></div></div>';

                            $.each(json, function (i, v) {
                                b +='<option value="'+v['id']+'">'+v['value']+'</option>';
                            });

                            $('#variation_box').append(a+b+c);
                        }
                    }
                }
            });
        }

        function valueAttr(elm) {
            $("."+elm.data('id')).remove();
            let id = elm.attr('data-id');
            let row = elm.closest('.row');
                elm.find(':selected').each(function (k, v) {
                    let vv = $(this).val();
                    let tt = $(this).text();
                    let a = ' <div class="row '+elm.data('id')+'">' +
                        '<div class="col-md-6 ">' +
                        '<table class="table bg-gray-light table-sm table-bordered" style="border:2px solid #0d6aad">' +
                        '<tbory>' +
                        '<tr>'+
                        '<th style="width: 100px;padding-top: 43px;">'+$(this).text()+'</th>'+
                        '<td><input type="text" class="form-control" style="margin-top: 28px;" name="variation[value]['+id+']['+vv+'][price]"></td>'+
                        '<td><input type="file" class="dropify_Generated" data-height="80" name="variation[value]['+id+']['+vv+'][image]" data-max-file-size="0.1M" data-allowed-file-extensions="png jpg jpeg"></td>'+
                        '</tr>'+
                        '</tbory>'+
                        '</table>' +
                        '<div>';
                    row.after(a);
                });
                $('.dropify_Generated').dropify();
        }
    </script>
@endsection
