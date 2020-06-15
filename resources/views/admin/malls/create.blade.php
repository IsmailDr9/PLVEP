@extends('admin.index')
@section('content')

    <div class="card">

        <div class="box">
            <div class="box-header">
                <h3 class="box-title">{{$title}}</h3>
            </div>

            <div class="box-body">
                {!! Form::open(['route' => 'malls.store', 'method' => 'post', 'files'=>true]) !!}
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <input type="text" name="name_ar" value="{{old('name_ar')}}" class="form-control" placeholder="Enter Mall name ar">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <input type="text" name="name_en" value="{{old('name_en')}}" class="form-control" placeholder="Enter Mall name en">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <input type="text" name="facebook" value="{{old('facebook')}}" class="form-control" placeholder="Enter Mall facebook">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <input type="text" name="twitter" value="{{old('twitter')}}" class="form-control" placeholder="Enter twitter name en">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <input type="text" name="website" value="{{old('website')}}" class="form-control" placeholder="Enter website name en">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <input type="text" name="contact_name" value="{{old('contact_name')}}" class="form-control" placeholder="Enter Contact name en">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <input type="text" name="email" value="{{old('email')}}" class="form-control" placeholder="Enter email">
                        </div>
                    </div>
                </div>
                </div> <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <input type="text" name="mobile" value="{{old('mobile')}}" class="form-control" placeholder="Enter mobile">
                        </div>
                    </div>
                </div>
                </div> <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <input type="text" name="address" value="{{old('address')}}" class="form-control" placeholder="Enter address">
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
                            <input type="text" name="lan" value="{{old('lan')}}" class="form-control" placeholder="Enter lan">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            {!! Form::select('country_id',App\Model\Country::pluck('country_name_'.session('lang'),'id'),old('country_id'),['class'=>'form-control country-id', 'placeholder'=>'Please Select Country']) !!}
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