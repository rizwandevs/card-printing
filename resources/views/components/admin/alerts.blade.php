
    @if(count($errors) > 0)
    @foreach ($errors->all() as $error)
        <div class="alert alert-danger alert-dismissible ">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
            {{$error}}.
        </div>
        @endforeach
     @endif

    @if(session()->has('message.head'))
        <div class="alert alert-{{ session('message.head') }} alert-dismissible ">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
            {!! session('message.body') !!}
        </div>
    @endif
