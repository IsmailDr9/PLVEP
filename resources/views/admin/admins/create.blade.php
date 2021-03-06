@extends('admin.index')
@section('content')
    <div class="card">

        <div class="box">
            <div class="box-header">
                <h3 class="box-title">{{$title}}</h3>
            </div>

            <div class="box-body">
                {!! Form::open(['route' => 'admin.store', 'method' => 'post']) !!}
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <input type="text" name="email" value="{{old('email')}}" class="form-control" placeholder="Enter Email">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <input type="text" name="name" value="{{old('name')}}" class="form-control" placeholder="Enter Name">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <input type="text" name="password" class="form-control" placeholder="Enter Password">
                        </div>
                    </div>
                </div>
                {!! Form::submit('Submit') !!}
                {!! Form::close() !!}
            </div>
        </div>
    </div>

{{--    @push('js')--}}
{{--        {!! $dataTable->scripts() !!}--}}
{{--    @endpush--}}
@endsection