@extends('admin.index')
@section('content')
    <div class="box">
        <div class="box-header">
            <h3 class="box-title">{{$title}}</h3>
        </div>
        <div class="box-body">
            {!! Form::open(['route' => 'states.delete.all', 'method' => 'delete', 'id'=>'form_data']) !!}
            {!! $dataTable->table(['class'=>'dataTable table table-striped table-hove table-bordered'],true) !!}
            {!! Form::close()  !!}
        </div>
    </div>

    <!-- Modal -->
    <div id="multibleDelete" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header left">
                    <h4 class="modal-title">Delete</h4>
                </div>
                <div class="modal-body">
                    <div class="empty_record" id="empty_record" hidden>
                        <p>Please Check Some Record</p>
                    </div>
                    <div class="not_empty" id="not_empty" hidden>
                        <p>Are You Sure Delete <span class="record_count"></span> Record ?</p>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="empty_record" id="empty_record" hidden>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                    <div class="not_empty empty_button" id="not_empty" hidden>
                        <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
                        <button type="submit" class="btn btn-danger delete_all" name="delete_all" data-dismiss="modal">Yes</button>
                    </div>
                </div>
            </div>

        </div>
    </div>
    @push('js')
        <script>
            delete_all();
        </script>
        {!! $dataTable->scripts() !!}
    @endpush
@endsection