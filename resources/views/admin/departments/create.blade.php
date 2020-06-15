@extends('admin.index')
@section('content')
{{--    {{dd(loadDepartment(1))}}--}}
    @push('js')
        <script type="text/javascript">
            $(document).ready(function () {
                $('#jstree').jstree({
                    "core" : {
                        'data' : {!! loadDepartment(old('parent')) !!},
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
                {!! Form::open(['route' => 'departments.store', 'method' => 'post', 'files'=>true]) !!}
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <input type="text" name="dep_name_ar" value="{{old('dep_name_ar')}}" class="form-control" placeholder="Enter departments name ar">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <input type="text" name="dep_name_en" value="{{old('dep_name_en')}}" class="form-control" placeholder="Enter departments name en">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <input type="textarea" name="description" value="{{old('description')}}" class="form-control" placeholder="Enter description name ar">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <input type="textarea" name="keyword" value="{{old('keyword')}}" class="form-control" placeholder="Enter keyword name en">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            {!! Form::file('icon',['class'=>'form-control']) !!}
                        </div>
                    </div>
                </div>
                <div class="clearfix"></div>
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <div id="jstree"></div>
                            <input type="hidden" name="parent" class="parent_id" value="{{old('parent')}}">
                        </div>
                    </div>
                </div>
                <div class="clearfix"></div>
                <button value="submit" class="btn btn-info">Add</button>
                {!! Form::close() !!}
            </div>
        </div>
    </div>

{{--    @push('js')--}}
{{--        {!! $dataTable->scripts() !!}--}}
{{--    @endpush--}}
@endsection