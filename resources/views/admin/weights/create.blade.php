@extends('admin.index')
@section('content')


    <div class="card">

        <div class="box">
            <div class="box-header">
                <h3 class="box-title">{{$title}}</h3>
            </div>

            <div class="box-body">
                {!! Form::open(['route' => 'weights.store', 'method' => 'post', 'files'=>true]) !!}
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <input type="text" name="name_ar" value="{{old('name_ar')}}" class="form-control" placeholder="Enter weight name ar">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <input type="text" name="name_en" value="{{old('name_en')}}" class="form-control" placeholder="Enter weight name en">
                        </div>
                    </div>
                </div>
            </div>

                <button value="submit" class="btn btn-info">Add</button>
                {!! Form::close() !!}
        </div>
    </div>


@endsection