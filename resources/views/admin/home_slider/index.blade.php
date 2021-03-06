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
                          <table class="table table-bordered">
                              <thead>
                              <tr>
                                  <th>Slide</th>
                                  <th>Date</th>
                                  <th colspan="2">Actions</th>
                              </tr>
                              </thead>
                              <tbody>
                              @foreach($table as $i)
                                  <tr>
                                      <td><img src="/uploads/{{$i->img}}" alt="" style="width: 100px;"></td>
                                      <td>{{$i->created_at}}</td>
                                      <td>
                                          <form action="{{route('homeSlider.show',$i->id)}}" method="GET">
                                          <button type="submit" class="btn btn-xs btn-info"><i class="fa fa-edit text-light"></i></button>
                                          </form>
                                      </td>
                                      <td>
                                          <form action="{{route('homeSlider.destroy',$i->id)}}" method="POST">
                                              @method('Delete')
                                              @csrf
                                              <button type="submit" class="btn btn-xs btn-danger"><i class="fa fa-remove text-light"></i></button>
                                          </form>
                                      </td>
                                  </tr>
                              @endforeach
                              </tbody>
                          </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('js')

@endsection
