@extends('admin.index')
@section('content')
    <div class="card">

        <div class="box">
            <div class="box-header">
                <h3 class="box-title">{{$title}}</h3>
            </div>

            <div class="box-body">
                {!! Form::open(['route' => 'cities.store', 'method' => 'post']) !!}
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <input type="text" name="city_name_ar" value="{{old('city_name_ar')}}" class="form-control" placeholder="Enter city name ar">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <input type="text" name="city_name_en" value="{{old('city_name_en')}}" class="form-control" placeholder="Enter city name en">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            {!! Form::select('country_id',App\Model\Country::pluck('country_name_'.session('lang'),'id'),old('country_id'),['class'=>'form-control']) !!}
                        </div>
                    </div>
                </div>
                <button value="submit" class="btn btn-info">Add</button>
                {!! Form::close() !!}
            </div>
        </div>
    </div>

{{--    @push('js')--}}
{{--        {!! $dataTable->scripts() !!}--}}
{{--    @endpush--}}
@endsection