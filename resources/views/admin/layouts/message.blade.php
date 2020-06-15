@if(Session::has('info') || Session::has('success') || Session::has('danger') | Session::has('warning'))
    <div class="container-fluid mt-5">
        @if(Session::has('info'))
            <div class="alert {{ Session::get('alert-class', 'alert-info') }}"><i class="fa fa-warning"></i> {!! Session::get('info') !!}
                <a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a>
            </div>
        @endif
        @if(Session::has('status'))
            <div class="alert {{ Session::get('alert-class', 'alert-info') }}"><i class="fa fa-warning"></i> {!! Session::get('status') !!}
                <a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a>
            </div>
        @endif
        @if(Session::has('success'))
            <div class="alert {{ Session::get('alert-class', 'alert-success') }}"><i class="fa fa-check"></i>{!! Session::get('success')  !!}<a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a></div>
        @endif
        @if(Session::has('warning'))
            <div class="alert {{ Session::get('alert-class', 'alert-warning') }}"><i class="fas fa-exclamation"></i>{!!Session::get('warning') !!} <a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a></div>
        @endif
        @if(Session::has('danger'))
            <div class="alert {{ Session::get('alert-class', 'alert-danger') }}"> <i class="fas fa-exclamation-triangle"></i>{!! Session::get('danger') !!} <a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a></div>
        @endif
    </div>
@endif
@if($errors->all())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                <li>{{$error}}</li>
                @endforeach
            </ul>
        </div>
@endif
