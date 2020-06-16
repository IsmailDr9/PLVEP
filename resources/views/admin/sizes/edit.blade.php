@extends('admin.index')
@section('content')

    @push('js')
        <script type="text/javascript">
            $(document).ready(function () {
                $('#jstree').jstree({
                    "core" : {
                        'data' : {!! loadDepartment($size->department_id) !!},
                        "themes" : {
                            "variant" : "large"
                        }
                    },
                    "checkbox" : {
                        "keep_selected_style" : false
                    },
                    "plugins" : [ "wholerow" ]
                });
            });
            $('#jstree').on('changed.jstree',function(e,data){
                var i , j , r = [];
                for(i = 0,j = data.selected.length; i < j ; i++)
                {
                    r.push(data.instance.get_node(data.selected[i]).id);
                }
                $('.parent_id').val(r.join(', '));
            });
        </script>
    @endpush

    <div class="card">

        <div class="box">
            <div class="box-header">
                <h3 class="box-title">{{$title}}</h3>
            </div>

            <div class="box-body">
                {{ Form::open(['url' => route('sizes.update',['id'=>$size->id]),'method' => 'PUT', 'files'=>true]) }}
                <input name="id" type="hidden" value="{{$size->id}}">

                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <input type="text" name="name_ar" value="{{$size->name_ar}}" class="form-control" placeholder="Enter Mall name ar">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <input type="text" name="name_en" value="{{$size->name_en}}" class="form-control" placeholder="Enter Mall name en">
                        </div>
                    </div>
                </div>
                <div class="clearfix"></div>
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <div id="jstree"></div>
                            <input type="hidden" name="department_id" class="parent_id" value="">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            {!! Form::select('is_public',['yes'=>'yes', 'no'=>'no'],$size->is_public,['class'=>'form-control','placeholder'=>'Please Select']) !!}
                        </div>
                    </div>
                </div>
                <div class="clearfix"></div>
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            {!! Form::file('icon',['class'=>'form-control']) !!}
                            @if(!empty($size->icon))
                                <img src="{{Storage::url($size->icon)}}" style="width: 50px ; height: 50px"/>
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