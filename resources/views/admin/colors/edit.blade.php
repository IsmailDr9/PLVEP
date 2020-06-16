@extends('admin.index')
@section('content')
    <div class="card">

        <div class="box">
            <div class="box-header">
                <h3 class="box-title">{{$title}}</h3>
            </div>

            <div class="box-body">
                {{ Form::open(['url' => route('colors.update',['id'=>$color->id]),'method' => 'PUT', 'files'=>true]) }}
                <input name="id" type="hidden" value="{{$color->id}}">

                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <input type="text" name="name_ar" value="{{$color->name_ar}}" class="form-control" placeholder="Enter color name ar">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <input type="text" name="name_en" value="{{$color->name_en}}" class="form-control" placeholder="Enter color name en">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <input type="color" name="color" value="{{$color->color}}" class="form-control" placeholder="Enter color">
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