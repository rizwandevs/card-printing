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
                            <h3 class="box-title">Home Slider</h3>
                            <div class="box-tools">
                            </div>
                        </div>
                        <div class="box-body">
                            @include('components.admin.alerts')
                            <form method="post" action="{{route('homeSlider.store')}}" enctype="multipart/form-data">@csrf
                                <div class="row add-variation">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="prn">Slide <small class="text-danger">*</small></label>
                                            <input type="file" name="image" class="dropify" data-height="300" data-max-file-size="0.5M" data-min-width="800" data-min-height="600" data-allowed-file-extensions="png jpg jpeg"/>
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
        $('.dropify').dropify();

    </script>
@endsection
