@extends('layouts.admin-app')
@section('style')
@endsection
@section('content')

    <section class="content">
        <div id="pageErrors">
        </div>
        <div id="contentContainer"><div class="row">
                <div class="col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box">
                        <span class="info-box-icon bg-aqua"><i class="fa fa-users"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Staff Workers</span>
                            <span class="info-box-number">10</span>
                        </div>
                    </div>
                </div>

                <div class="clearfix visible-sm-block"></div>
                <div class="col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box">
                        <span class="info-box-icon bg-green"><i class="fa fa-briefcase"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Departments</span>
                            <span class="info-box-number">2</span>
                        </div>
                    </div>
                </div>


               </div></div>
    </section>
@endsection
@section('script')

@endsection
