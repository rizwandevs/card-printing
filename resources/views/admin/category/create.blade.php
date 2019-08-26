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
                            <h3 class="box-title">Categories</h3>
                            <div class="box-tools">
                            </div>
                        </div>
                        <div class="box-body">
                            @include('components.admin.alerts')
                            <form method="post" action="{{route('category.store')}}" enctype="multipart/form-data">@csrf
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="prn">Category Name <small class="text-danger">*</small></label>
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-caret-right"></i></span>
                                                <input type="text" class="form-control" name="name" id="name" placeholder="Enter Category Name">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row add-variation">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="prn">Image <small class="text-danger">*</small></label>
                                            <input type="file" name="image" class="dropify" data-height="300" data-max-file-size="0.5M" data-allowed-file-extensions="png jpg jpeg"/>
                                        </div>
                                    </div>
                                </div>
                                <div class="row add-variation">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="prn">Select Variations <small class="text-danger">*</small></label>
                                                <select name="variations[]" id="" class="form-control" multiple>
                                                    @foreach($variations as $v)
                                                        <option value="{{$v->id}}">{{$v->name}}</option>
                                                    @endforeach
                                                </select>
                                        </div>
                                    </div>
                                </div>

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
            $('.dropify').dropify();
           $(document).on('click','#add_variation',function () {
               let count = parseInt($('#variation_box > .row').length)+1;

               $('#variation_box').append(' <div class="row">' +
                   '<div class="col-md-6">' +
                   '<div class="form-group">' +
                   '<label for="prn">Value '+count+'<small class="text-danger">*</small></label>' +
                   '<div class="input-group">' +
                   '<span class="input-group-addon"><i class="fa fa-caret-right"></i></span>' +
                   '<input type="text" class="form-control" name="values[]" id="variation_value" placeholder="Enter Category Name">' +
                   '</div>' +
                   '<i class="fa float-right fa-remove " onclick="removeRow($(this))" style="position: absolute;right: -10px;top: 35px;"></i>' +
                   '</div></div></div>');
           });

        });

        function removeRow(e) {
            e.closest('.row').remove()
        }
    </script>
@endsection
