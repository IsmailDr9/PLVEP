@extends('admin.index')
@section('content')
    <div class="card">

        <div class="box">
            <div class="box-header">
                <h3 class="box-title">{{$title}}</h3>
            </div>

            <div class="box-body">
                {{ Form::open(['url' => route('brands.update',['id'=>$brand->id]),'method' => 'PUT', 'files'=>true]) }}
                <input name="id" type="hidden" value="{{$brand->id}}">

                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <input type="text" name="brand_name_ar" value="{{$brand->brand_name_ar}}" class="form-control" placeholder="Enter country name ar">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <input type="text" name="brand_name_en" value="{{$brand->brand_name_en}}" class="form-control" placeholder="Enter country name en">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            {!! Form::file('logo',['class'=>'form-control']) !!}
                            @if(!empty($brand->logo))
                                <img src="{{Storage::url($brand->logo)}}" style="width: 50px ; height: 50px"/>
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