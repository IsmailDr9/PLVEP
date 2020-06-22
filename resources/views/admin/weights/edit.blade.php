@extends('admin.index')
@section('content')


    <div class="card">

        <div class="box">
            <div class="box-header">
                <h3 class="box-title">{{$title}}</h3>
            </div>

            <div class="box-body">
                {{ Form::open(['url' => route('weights.update',['id'=>$weight->id]),'method' => 'PUT', 'files'=>true]) }}
                <input name="id" type="hidden" value="{{$weight->id}}">

                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <input type="text" name="name_ar" value="{{$weight->name_ar}}" class="form-control" placeholder="Enter Weight name ar">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <input type="text" name="name_en" value="{{$weight->name_en}}" class="form-control" placeholder="Enter Weight name en">
                        </div>
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