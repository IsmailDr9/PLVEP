@extends('admin.index')
@section('content')

    <div class="card">

        <div class="box">
            <div class="box-header">
                <h3 class="box-title">{{$title}}</h3>
            </div>

            <div class="box-body">
                {!! Form::open(['route' => 'shippings.store', 'method' => 'post', 'files'=>true]) !!}
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <input type="text" name="name_ar" value="{{old('name_ar')}}" class="form-control" placeholder="Enter Shipping name ar">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <input type="text" name="name_en" value="{{old('name_en')}}" class="form-control" placeholder="Enter Shipping name en">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <input type="text" name="lat" value="{{old('lat')}}" class="form-control" placeholder="Enter lat">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <input type="text" name="lng" value="{{old('lng')}}" class="form-control" placeholder="Enter lng">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <select name="user_id" class="form-control">
                                <option value="0" disabled selected>Enter User</option>
                                @foreach($companies as $index=>$level)
                                    <option  value="{{$level->id}}" >{{$level->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            {!! Form::file('icon',['class'=>'form-control']) !!}
                        </div>
                    </div>
            </div>

                <button value="submit" class="btn btn-info">Add</button>
                {!! Form::close() !!}
        </div>
    </div>


@endsection