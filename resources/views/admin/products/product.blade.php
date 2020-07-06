@extends('admin.index')
@section('content')
@push('js')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>

    <script type="text/javascript">
        $(document).ready(function() {
            $('.js-example-basic-single').select2();

            $(document).on('click','.save_and_continue',function () {
                var form_data = $('#product_form').serialize();
                $.ajax({
                    url:'{{route('products.update',$product->id)}}',
                    dataType:'json',
                    type:'put',
                    data:form_data,
                    beforeSend:function () {

                        $('.loading_save_c').show();
                        $('.validate_message').html('');
                        $('.error_message').hide();

                    },success: function (data) {
                        if(data.status == true ){
                            $('.validate_message_success').html(data.message);

                            $('.success_message').show();
                            setTimeout(
                                function() {
                                     $(".success_message").fadeOut();
                                }, 5000);

                            $('.error_message').hide();
                            $('.loading_save_c').hide();
                        }
                    },error(response){

                        // $('.loading_save_c').hide();
                        var error_li = '';
                        $.each(response.responseJSON.errors,function (index,value) {
                            error_li +='<li>'+value+'</li>';
                        });
                        $('.validate_message').html(error_li);
                        $('.error_message').show();
                        $('.success_message').hide();

                    }
                });
                return false;
            });
        });
    </script>
@endpush
<!-- Modal Delete -->
<div id="del_user{{$product->id}}" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Admin Delete</h4>
            </div>
            {!! Form::open(['route' => ['products.destroy','id'=>$product->id], 'method' => 'delete']) !!}

            <div class="modal-body">
                <p>Delete This Product {!! App\helper\Useful::getProductName($product->id) !!}</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-info" data-dismiss="modal">Close</button>
                {!! Form::submit('Yes', ['class' => 'btn btn-danger']) !!}
            </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>

    <div class="card" style="padding: 23px">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">{{$title}}</h3>
            </div>
            <hr class="box-body">
            {!! Form::open(['route' => 'products.store', 'method' => 'put', 'files'=>true, 'id'=>'product_form']) !!}
            <div>
                <a href="#" class="btn btn-primary save">Save <i class="fa fa-floppy-o"></i></a>
                <a href="#" class="btn btn-success save_and_continue">Save And Continue <i class="fa fa-floppy-o"></i>
                    <i class="fa fa-spin fa-spinner loading_save_c" style="display: none"></i>
                </a>
                <a href="{{route('product.copy',$product->id)}}" class="btn btn-info copy_product">Copy Product <i class="fa fa-copy"></i></a>
                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#del_user{{$product->id}}">Delete <i class="fa fa-trash"></i></button>
            </div>
            <hr/>
            <div class="alert alert-danger error_message" style="display: none">
                <ul class="validate_message">

                </ul>
            </div>
            <div class="alert alert-success success_message" style="display: none">
                <ul class="validate_message_success">

                </ul>
            </div>
            <div>
                <nav class="nav nav-pills nav-fill">
                    <ul class="nav nav-pills" id="tabs-icons-text" role="tablist">
                        <li>
                            <a data-toggle="tab" class="nav-item nav-link active btn btn-outline-info" href="#menu1" style="margin: 3px">
                                Product Information
                                <i class="fa fa-info"></i>
                            </a>
                        </li>
                        <li>
                            <a data-toggle="tab" class="nav-item nav-link btn btn-outline-info" href="#menu2" style="margin: 3px">
                                Department <i class="fa fa-list"></i>
                            </a>
                        </li>
                        <li>
                            <a data-toggle="tab" class="nav-item nav-link btn btn-outline-info" href="#menu3" style="margin: 3px">
                                Product Setting <i class="fa fa-cog"></i>
                            </a>
                        </li>
                        <li>
                            <a data-toggle="tab" class="nav-item nav-link btn btn-outline-info" href="#menu4" style="margin: 3px">
                                Product Media <i class="fa fa-photo"></i>
                            </a>
                        </li>
                        <li>
                            <a data-toggle="tab" class="nav-item nav-link btn btn-outline-info" href="#menu5" style="margin: 3px">
                                Product Size And Weight <i class="fa fa-pound-sign"></i>
                            </a>
                        </li>
                        <li>
                            <a data-toggle="tab" class="nav-item nav-link btn btn-outline-info" href="#menu6" style="margin: 3px">
                                Other Data <i class="fa fa-database"></i>
                            </a>
                        </li>
                        <li>
                            <a data-toggle="tab" class="nav-item nav-link btn btn-outline-info" href="#menu7" style="margin: 3px">
                                Related Product <i class="fa fa-list"></i>
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
            <br>
            <div class="tab-content">
                <div id="menu1" class="tab-pane fade active show">
                    <h3>Product Information</h3>
                    @include('admin.products.tabs.product_information')
                </div>
                <div id="menu2" class="tab-pane fade">
                    <h3>Department</h3>
                    @include('admin.products.tabs.department')
                </div>
                <div id="menu3" class="tab-pane fade">
                    <h3>Product Setting</h3>
                    @include('admin.products.tabs.product_setting')
                </div>
                <div id="menu4" class="tab-pane fade">
                    <h3>Product Media</h3>
                    @include('admin.products.tabs.product_media')
                </div>
                <div id="menu5" class="tab-pane fade">
                    <h3>Product Size And Weight</h3>
                    @include('admin.products.tabs.product_size_and_weight')
                </div>
                <div id="menu6" class="tab-pane fade">
                    @include('admin.products.tabs.other_data')
                </div>
                <div id="menu7" class="tab-pane fade">
                    @include('admin.products.tabs.related_product')
                </div>
            </div>
            <hr/>
            <a href="#" class="btn btn-primary save">Save <i class="fa fa-floppy-o"></i></a>
            <a href="#" class="btn btn-success save_and_continue">Save And Continue <i class="fa fa-floppy-o"></i>
                <i class="fa fa-spin fa-spinner loading_save_c" style="display: none"></i>
            </a>
            <a href="{{route('product.copy',$product->id)}}" class="btn btn-info copy_product">Copy Product <i class="fa fa-copy"></i></a>
            <a href="#" class="btn btn-danger delete">Delete <i class="fa fa-trash"></i></a>
            {!! Form::close() !!}
        </div>
    </div>


    {{--    @push('js')--}}
    {{--        {!! $dataTable->scripts() !!}--}}
    {{--    @endpush--}}

@endsection