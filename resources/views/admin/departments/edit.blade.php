@extends('admin.index')
@section('content')
{{--    {{dd(loadDepartment(1))}}--}}
    @push('js')
        <script type="text/javascript">
            $(document).ready(function () {
                $('#jstree').jstree({
                    "core" : {
                        'data' : {!! loadDepartment($department->parent, $department->id) !!},
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
                {{ Form::open(['url' => route('departments.update',['id'=>$department->id]),'method' => 'PUT', 'files'=>true]) }}

                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <input type="text" name="dep_name_ar" value="{{$department->dep_name_ar}}" class="form-control" placeholder="Enter departments name ar">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <input type="text" name="dep_name_en" value="{{$department->dep_name_en}}" class="form-control" placeholder="Enter departments name en">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <input type="textarea" name="description" value="{{$department->description}}" class="form-control" placeholder="Enter description name ar">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <input type="textarea" name="keyword" value="{{$department->keyword}}" class="form-control" placeholder="Enter keyword name en">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            {!! Form::file('icon',['class'=>'form-control']) !!}
                            @if(!empty($department->icon))
                                <img src="{{Storage::url($department->icon)}}" style="width: 50px ; height: 50px"/>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="clearfix"></div>
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <div id="jstree"></div>
                            <input type="hidden" name="parent" class="parent_id" value="">
                        </div>
                    </div>
                </div>
                <div class="clearfix"></div>
                <button value="submit" class="btn btn-info">Save</button>
                {!! Form::close() !!}
            </div>
        </div>
    </div>

{{--    @push('js')--}}
{{--        {!! $dataTable->scripts() !!}--}}
{{--    @endpush--}}
@endsection