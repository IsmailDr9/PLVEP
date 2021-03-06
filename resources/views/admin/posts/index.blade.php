@extends('admin.index')
@section('content')
@push('js')
    <script type="text/javascript">
        // Ajax show form
        $(document).on('click','.create-modal',function () {
            $('#create').modal('show');
            $('.form-horizontal').show();
            $('.modal-title').text('Add Post');
        });

        // Ajax Function Add
        $("#add").click(function() {
            $.ajax({
                type: 'POST',
                url: '{{route('add.post')}}',
                data: {
                    '_token': $('input[name=_token]').val(),
                    'title': $('input[name=title]').val(),
                    'body': $('input[name=body]').val()
                },
                success: function(data){
                    if ((data.errors)) {
                        $('.error').removeClass('hidden');
                        $('.error').text(data.errors.title);
                        $('.error').text(data.errors.body);
                    } else {
                        $('.error').remove();
                        $('#table').append("<tr class='post" + data.id + "'>"+
                            "<td>" + data.id + "</td>"+
                            "<td>" + data.title + "</td>"+
                            "<td>" + data.body + "</td>"+
                            "<td>" + data.created_at + "</td>"+
                            "<td><button class='show-modal btn btn-info btn-sm' data-id='" + data.id + "' data-title='" + data.title + "' data-body='" + data.body + "'><span class='fa fa-eye'></span></button> <button class='edit-modal btn btn-warning btn-sm' data-id='" + data.id + "' data-title='" + data.title + "' data-body='" + data.body + "'><span class='fa fa-edit'></span></button> <button class='delete-modal btn btn-danger btn-sm' data-id='" + data.id + "' data-title='" + data.title + "' data-body='" + data.body + "'><span class='fa fa-trash'></span></button></td>"+
                            "</tr>");
                        $('#create').modal('hide');
                    }
                },
            });
            $('#title').val('');
            $('#body').val('');
        });

        // function Edit POST
        $(document).on('click', '.edit-modal', function() {
            $('#footer_action_button').text(" Update Post");
            $('#footer_action_button').addClass('glyphicon-check');
            $('#footer_action_button').removeClass('glyphicon-trash');
            $('.actionBtn').addClass('btn-success');
            $('.actionBtn').removeClass('btn-danger');
            $('.actionBtn').addClass('edit');
            $('.modal-title').text('Post Edit');
            $('.deleteContent').hide();
            $('.form-horizontal').show();
            $('#fid').val($(this).data('id'));
            $('#t').val($(this).data('title'));
            $('#b').val($(this).data('body'));
            $('#myModal').modal('show');
        });

        $('.modal-footer').on('click', '.edit', function() {
            $.ajax({
                type: 'POST',
                url: 'editPost',
                data: {
                    '_token': $('input[name=_token]').val(),
                    'id': $("#fid").val(),
                    'title': $('#t').val(),
                    'body': $('#b').val()
                },
                success: function(data) {
                    $('.post' + data.id).replaceWith(" "+
                        "<tr class='post" + data.id + "'>"+
                        "<td>" + data.id + "</td>"+
                        "<td>" + data.title + "</td>"+
                        "<td>" + data.body + "</td>"+
                        "<td>" + data.created_at + "</td>"+
                        "<td><button class='show-modal btn btn-info btn-sm' data-id='" + data.id + "' data-title='" + data.title + "' data-body='" + data.body + "'><span class='fa fa-eye'></span></button> <button class='edit-modal btn btn-warning btn-sm' data-id='" + data.id + "' data-title='" + data.title + "' data-body='" + data.body + "'><span class='fa fa-edit'></span></button> <button class='delete-modal btn btn-danger btn-sm' data-id='" + data.id + "' data-title='" + data.title + "' data-body='" + data.body + "'><span class='fa fa-trash'></span></button></td>"+
                        "</tr>");
                }
            });
        });

        // form Delete function
        $(document).on('click', '.delete-modal', function() {
            $('#footer_action_button').text(" Delete");
            $('#footer_action_button').removeClass('glyphicon-check');
            $('#footer_action_button').addClass('glyphicon-trash');
            $('.actionBtn').removeClass('btn-success');
            $('.actionBtn').addClass('btn-danger');
            $('.actionBtn').addClass('delete');
            $('.modal-title').text('Delete Post');
            $('.id').text($(this).data('id'));
            $('.deleteContent').show();
            $('.form-horizontal').hide();
            $('.title').html($(this).data('title'));
            $('#myModal').modal('show');
        });

        $('.modal-footer').on('click', '.delete', function(){
            $.ajax({
                type: 'POST',
                url: 'deletePost',
                data: {
                    '_token': $('input[name=_token]').val(),
                    'id': $('.id').text()
                },
                success: function(data){
                    $('.post' + $('.id').text()).remove();
                }
            });
        });

        // Show function
        $(document).on('click', '.show-modal', function() {
            $('#show').modal('show');
            $('#i').text($(this).data('id'));
            $('#ti').text($(this).data('title'));
            $('#by').text($(this).data('body'));
            $('.modal-title').text('Show Post');
        });

    </script>
@endpush

<div class="row">
    <div class="col-md-12">
        <h1>Simple Laravel CRUD Ajax</h1>
    </div>
</div>

<div class="row">
    <div class="table table-responsive">
        <table class="table table-bordered" id="table">
            <tr>
                <th width="150px">NO</th>
                <th>Title</th>
                <th>Body</th>
                <th>Created At</th>
                <th class="text-center" width="150px">
                    <a href="#" class="create-modal btn btn-success btn-sm">
                        <i class="fa fa-plus"></i>
                    </a>
                </th>
            </tr>
            {{ csrf_field() }}
            <?php
            $no = 1 ;
            ?>
            @foreach($posts as $key => $post)
                <tr class="post{{$post->id}}">
                    <td>{{$no++}}</td>
                    <td>{{$post->title}}</td>
                    <td>{{$post->body}}</td>
                    <td>{{$post->created_at}}</td>
                    <td>
                        <a href="#" class="show-modal  btn btn-info btn-sm" data-id ="{{$post->id}}" data-title="{{$post->title}}" data-body="{{$post->body}}">
                            <i class="fa fa-eye"></i>
                        </a>

                        <a href="#" class="edit-modal btn btn-warning btn-sm" data-id ="{{$post->id}}" data-title="{{$post->title}}" data-body="{{$post->body}}">
                            <i class="fa fa-edit"></i>
                        </a>

                        <a href="#" class="delete-modal btn btn-danger btn-sm" data-id ="{{$post->id}}" data-title="{{$post->title}}" data-body="{{$post->body}}">
                            <i class="fa fa-trash"></i>
                        </a>

                    </td>

                </tr>
            @endforeach
        </table>
    </div>
</div>
@endsection

<style>
    .hidden {
        display: none;
    }
</style>
{{--Form Create post--}}
<div id="create" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"></h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" role="form">
                    <div class="form-group row add">
                        <div class="col-sm-10">
                            <label class="control-label" for="title">Title :</label>
                            <input type="text" class="form-control" id="title" name="title"
                                   placeholder="Your Title Here" required>
                            <p class="error text-center alert alert-danger hidden"></p>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-10">
                            <label class="control-label" for="body">Body :</label>
                            <input type="text" class="form-control" id="body" name="body"
                                   placeholder="Your Body Here" required>
                            <p class="error text-center alert alert-danger hidden"></p>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button class="btn btn-warning" type="submit" id="add">
                    <span class="glyphicon glyphicon-plus"></span>Save Post
                </button>

                <button class="btn btn-warning" type="button" id="add">
                    <span class="glyphicon glyphicon-remove"></span>Close
                </button>
            </div>
        </div>
    </div>
</div>



<div id="myModal"class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"></h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" role="modal">
                    <div class="form-group">
                        <label class="control-label col-sm-2"for="id">ID</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="fid" disabled>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-2"for="title">Title</label>
                        <div class="col-sm-10">
                            <input type="name" class="form-control" id="t">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-2"for="body">Body</label>
                        <div class="col-sm-10">
                            <textarea type="name" class="form-control" id="b"></textarea>
                        </div>
                    </div>
                </form>
                {{-- Form Delete Post --}}
                <div class="deleteContent">
                    Are You sure want to delete <span class="title"></span>?
                    <span class="hidden id"></span>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn actionBtn" data-dismiss="modal">
                    <span id="footer_action_button" class="glyphicon"></span>
                </button>
                <button type="button" class="btn btn-warning" data-dismiss="modal">
                    <span class="glyphicon glyphicon"></span>close
                </button>
            </div>
        </div>
    </div>
</div>

{{-- Modal Form Show POST --}}
<div id="show" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"></h4>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="">ID :</label>
                    <b id="i"/>
                </div>
                <div class="form-group">
                    <label for="">Title :</label>
                    <b id="ti"/>
                </div>
                <div class="form-group">
                    <label for="">Body :</label>
                    <b id="by"/>
                </div>
            </div>
        </div>
    </div>
</div>
