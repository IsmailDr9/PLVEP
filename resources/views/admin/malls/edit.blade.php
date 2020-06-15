@extends('admin.index')
@section('content')
    <div class="card">

        <div class="box">
            <div class="box-header">
                <h3 class="box-title">{{$title}}</h3>
            </div>

            <div class="box-body">
                {{ Form::open(['url' => route('malls.update',['id'=>$mall->id]),'method' => 'PUT', 'files'=>true]) }}
                <input name="id" type="hidden" value="{{$mall->id}}">

                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <input type="text" name="name_ar" value="{{$mall->name_ar}}" class="form-control" placeholder="Enter Mall name ar">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <input type="text" name="name_en" value="{{$mall->name_en}}" class="form-control" placeholder="Enter Mall name en">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <input type="text" name="facebook" value="{{$mall->facebook}}" class="form-control" placeholder="Enter Mall facebook">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <input type="text" name="twitter" value="{{$mall->twitter}}" class="form-control" placeholder="Enter Mall twitter">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <input type="text" name="website" value="{{$mall->website}}" class="form-control" placeholder="Enter Mall website">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <input type="text" name="contact_name" value="{{$mall->contact_name}}" class="form-control" placeholder="Enter Mall contact name">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <input type="text" name="email" value="{{$mall->email}}" class="form-control" placeholder="Enter email">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <input type="text" name="mobile" value="{{$mall->mobile}}" class="form-control" placeholder="Enter mobile">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <input type="text" name="address" value="{{$mall->address}}" class="form-control" placeholder="Enter address">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <input type="text" name="lat" value="{{$mall->lat}}" class="form-control" placeholder="Enter Mall lat">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <input type="text" name="lan" value="{{$mall->lan}}" class="form-control" placeholder="Enter Mall lan">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            {!! Form::select('country_id',App\Model\Country::pluck('country_name_'.session('lang'),'id'),$mall->country_id,['class'=>'form-control country-id', 'placeholder'=>'Please Select Country']) !!}
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            {!! Form::file('icon',['class'=>'form-control']) !!}
                            @if(!empty($mall->icon))
                                <img src="{{Storage::url($mall->icon)}}" style="width: 50px ; height: 50px"/>
                            @endif
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