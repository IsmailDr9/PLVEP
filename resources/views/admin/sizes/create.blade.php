@extends('admin.index')
@section('content')

@push('js')
    <script type="text/javascript">
        $(document).ready(function () {
            $('#jstree').jstree({
                "core" : {
                    'data' : {!! loadDepartment(old('department_id')) !!},
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
            $('.department_id').val(r.join(', '));
        });
    </script>
@endpush

    <div class="card">

        <div class="box">
            <div class="box-header">
                <h3 class="box-title">{{$title}}</h3>
            </div>

            <div class="box-body">
                {!! Form::open(['route' => 'sizes.store', 'method' => 'post', 'files'=>true]) !!}
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <input type="text" name="name_ar" value="{{old('name_ar')}}" class="form-control" placeholder="Enter Size name ar">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <input type="text" name="name_en" value="{{old('name_en')}}" class="form-control" placeholder="Enter Size name en">
                        </div>
                    </div>
                </div>
                <div class="clearfix"></div>
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <div id="jstree"></div>
                            <input type="hidden" name="department_id" class="department_id" value="{{old('department_id')}}">
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            {!! Form::select('is_public',['yes'=>'yes', 'no'=>'no'],old('is_public'),['class'=>'form-control','placeholder'=>'Please Select']) !!}
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
            </div>

                <button value="submit" class="btn btn-info">Add</button>
                {!! Form::close() !!}
        </div>
    </div>


@endsection