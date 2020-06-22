@extends('admin.index')
@section('content')
    <div class="card">

        <div class="box">
            <div class="box-header">
                <h3 class="box-title">{{$title}}</h3>
            </div>

            <div class="box-body">
                {{ Form::open(['url' => route('countries.update',['id'=>$country->id]),'method' => 'PUT', 'files'=>true]) }}
                <input name="id" type="hidden" value="{{$country->id}}">

                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <input type="text" name="country_name_ar" value="{{$country->country_name_ar}}" class="form-control" placeholder="Enter country name ar">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <input type="text" name="country_name_en" value="{{$country->country_name_en}}" class="form-control" placeholder="Enter country name en">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <input type="text" name="mob" value="{{$country->mob}}" class="form-control" placeholder="Enter country mob">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <input type="text" name="code" value="{{$country->code}}" class="form-control" placeholder="Enter country code">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <input type="text" name="currency" value="{{$country->currency}}" class="form-control" placeholder="Enter currency code">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            {!! Form::file('logo',['class'=>'form-control']) !!}
                            @if(!empty($country->logo))
                                <img src="{{Storage::url($country->logo)}}" style="width: 50px ; height: 50px"/>
                            @endif
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