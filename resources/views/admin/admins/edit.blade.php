@extends('admin.index')
@section('content')
    <div class="card">

        <div class="box">
            <div class="box-header">
                <h3 class="box-title">{{$title}}</h3>
            </div>

            <div class="box-body">
                {{ Form::open(['url' => route('admin.update',['id'=>$admin->id]),'method' => 'PUT']) }}
                <input name="id" type="hidden" value="{{$admin->id}}">
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <input type="text" name="email" value="{{$admin->email}}" class="form-control" placeholder="Enter Email">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <input type="text" name="name" value="{{$admin->name}}" class="form-control" placeholder="Enter Name">
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
               <button value="submit" class="btn btn-info">Save</button>
                {!! Form::close() !!}
            </div>
        </div>
    </div>

    {{--    @push('js')--}}
    {{--        {!! $dataTable->scripts() !!}--}}
    {{--    @endpush--}}
@endsection