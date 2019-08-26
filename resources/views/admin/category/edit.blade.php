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
                            <form method="post" action="{{route('category.update',$data['id'])}}" enctype="multipart/form-data">@csrf @method('PATCH')
                                <input type="hidden" name="id" value="{{$data['id']}}">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="prn">Category Name <small class="text-danger">*</small></label>
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-caret-right"></i></span>
                                                <input type="text" class="form-control" name="name" id="name" placeholder="Enter Category Name" value="{{$data['name']}}">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row add-variation">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="prn">Image <small class="text-danger">*</small></label>
                                            <input type="file" name="image" class="dropify" data-default-file="/uploads/{{$data['img']}}" data-height="300" data-max-file-size="0.5M" data-allowed-file-extensions="png jpg jpeg"/>
                                        </div>
                                    </div>
                                </div>
                                <div class="row add-variation">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="prn">Select Variations <small class="text-danger">*</small></label>
                                            <select name="variations[]" id="variations" class="form-control" multiple>
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
            $("#variations").val([@foreach($data->categoryVariation as $cv){{$cv->variation_id}},@endforeach]);
        });

    </script>
@endsection
