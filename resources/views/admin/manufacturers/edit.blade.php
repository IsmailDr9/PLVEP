@extends('admin.index')
@section('content')
    <div class="card">

        <div class="box">
            <div class="box-header">
                <h3 class="box-title">{{$title}}</h3>
            </div>

            <div class="box-body">
                {{ Form::open(['url' => route('manufacturers.update',['id'=>$manufacturer->id]),'method' => 'PUT', 'files'=>true]) }}
                <input name="id" type="hidden" value="{{$manufacturer->id}}">

                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <input type="text" name="name_ar" value="{{$manufacturer->name_ar}}" class="form-control" placeholder="Enter Manufacturer name ar">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <input type="text" name="name_en" value="{{$manufacturer->name_en}}" class="form-control" placeholder="Enter Manufacturer name en">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <input type="text" name="facebook" value="{{$manufacturer->facebook}}" class="form-control" placeholder="Enter Manufacturer facebook">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <input type="text" name="twitter" value="{{$manufacturer->twitter}}" class="form-control" placeholder="Enter Manufacturer twitter">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <input type="text" name="website" value="{{$manufacturer->website}}" class="form-control" placeholder="Enter Manufacturer website">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <input type="text" name="contact_name" value="{{$manufacturer->contact_name}}" class="form-control" placeholder="Enter Manufacturer contact name">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <input type="text" name="email" value="{{$manufacturer->email}}" class="form-control" placeholder="Enter email">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <input type="text" name="mobile" value="{{$manufacturer->mobile}}" class="form-control" placeholder="Enter mobile">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <input type="text" name="address" value="{{$manufacturer->address}}" class="form-control" placeholder="Enter address">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <input type="text" name="lat" value="{{$manufacturer->lat}}" class="form-control" placeholder="Enter Manufacturer lat">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <input type="text" name="lan" value="{{$manufacturer->lan}}" class="form-control" placeholder="Enter Manufacturer lan">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            {!! Form::file('icon',['class'=>'form-control']) !!}
                            @if(!empty($manufacturer->icon))
                                <img src="{{Storage::url($manufacturer->icon)}}" style="width: 50px ; height: 50px"/>
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