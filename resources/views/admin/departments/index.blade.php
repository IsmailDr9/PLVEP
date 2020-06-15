@extends('admin.index')
@section('content')

@push('js')

    <!-- Modal -->
    <div id="delete_bootstrap_modal" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Department Delete</h4>
                </div>
                {!! Form::open([ 'method' => 'delete', 'id'=>'form_delete_department']) !!}

                <div class="modal-body">
                    <p>Are You Sure Delete This Item</p><span id="dep_name"></span>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-info" data-dismiss="modal">Close</button>
                    {!! Form::submit('Yes', ['class' => 'btn btn-danger']) !!}
                </div>
                {!! Form::close() !!}

            </div>

        </div>
    </div>



    <script type="text/javascript">
    $(document).ready(function () {
        $('#jstree').jstree({
            "core" : {
                'data' : {!! loadDepartment() !!},
                "themes" : {
                    "variant" : "large"
                }
            },
            "checkbox" : {
                "keep_selected_style" : true
            },
            "plugins" : [ "wholerow" ]
        });
    });

    $('#jstree').on('changed.jstree',function(e,data){
        var i, j, r  = [];
        var name  = [];
        for(i = 0,j = data.selected.length; i < j ; i++)
        {
            r.push(data.instance.get_node(data.selected[i]).id);
            name.push(data.instance.get_node(data.selected[i]).text);
        }
        $('#form_delete_department').attr('action','{{aurl('departments')}}/'+r.join(', '));
        $('#dep_name').text(name.join(', '));
        // $('.parent_id').val(r.join(', '));

        if(r.join(', ') != '')
        {
            $('.show_btn_control').show();
            $('.edit_dep').attr('href', '{{aurl('departments')}}/'+r.join(', ')+'/edit');
        }else{
            $('.show_btn_control').hide();
        }
    });
    </script>
@endpush


    <div class="box">
        <div class="box-header">
            <h3 class="box-title">{{$title}}</h3>
        </div>

        <div class="box-body">
            <a href="" class="btn btn-info edit_dep show_btn_control" style="display: none"><i class="fa fa-edit"></i>Edit</a>
            <a href="" class="btn btn-danger delete_dep show_btn_control" style="display: none" data-toggle="modal" data-target="#delete_bootstrap_modal"><i class="fa fa-trash"></i>Delete</a>

            <div id="jstree"></div>

            <input type="hidden" name="parent" class="parent_id" value="">

        </div>
    </div>

@endsection