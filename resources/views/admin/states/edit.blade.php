@extends('admin.index')
@section('content')

    @push('js')
        <script type="text/javascript">
            $(document).ready(function () {
                @if($state->country_id)
                $.ajax({
                    url:'{{aurl('states/create')}}',
                    type:'get',
                    dataType:'html',
                    data:{country_id: {{$state->country_id}},select:'{{$state->city_id}}'},
                    success: function (data)
                    {
                        $('.city').html(data);
                    }
                });
                @endif
                $(document).on('change','.country-id',function () {
                    var country = $('.country-id option:selected').val();
                    if (country > 0)
                    {
                        $.ajax({
                            url:'{{aurl('states/create')}}',
                            type:'get',
                            dataType:'html',
                            data:{country_id:country,select:''},
                            success: function (data)
                            {
                                $('.city').html(data);
                            }
                        });

                    }else{

                        $('.city').html('');

                    }
                });
            });
        </script>
    @endpush
    <div class="card">

        <div class="box">
            <div class="box-header">
                <h3 class="box-title">{{$title}}</h3>
            </div>

            <div class="box-body">
                {{ Form::open(['url' => route('states.update',['id'=>$state->id]),'method' => 'PUT']) }}
                <input name="id" type="hidden" value="{{$state->id}}">

                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <input type="text" name="state_name_ar" value="{{$state->state_name_ar}}" class="form-control" placeholder="Enter city name ar">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <input type="text" name="state_name_en" value="{{$state->state_name_en}}" class="form-control" placeholder="Enter city name en">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            {!! Form::select('country_id',App\Model\Country::pluck('country_name_'.session('lang'),'id'),$state->country_id,['class'=>'form-control country-id', 'placeholder'=>'Please Select Country']) !!}
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <span class="city">

                            </span>
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