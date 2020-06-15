{{--<a href="{{url('admin/admin/'.$id.'/delete')}}" @method('Delete') class=""></a>--}}


<!-- Trigger the modal with a button -->
<button type="button" class="btn btn-danger" data-toggle="modal" data-target="#del_admin{{$id}}"><i class="fa fa-trash"></i></button>

<!-- Modal -->
<div id="del_admin{{$id}}" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Admin Delete</h4>
            </div>
            {!! Form::open(['route' => ['admin.destroy','id'=>$id], 'method' => 'delete']) !!}
            	
            <div class="modal-body">
                <p>Delete This Admin {!! App\helper\Useful::getAdminName($id) !!}</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-info" data-dismiss="modal">Close</button>
                {!! Form::submit('Yes', ['class' => 'btn btn-danger']) !!}
            </div>
            {!! Form::close() !!}

        </div>

    </div>
</div>
