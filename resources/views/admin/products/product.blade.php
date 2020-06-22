@extends('admin.index')
@section('content')
@push('js')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>

    <script type="text/javascript">
        $(document).ready(function() {
            $('.js-example-basic-single').select2();
        });
    </script>
@endpush
    <div class="card" style="padding: 23px">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">{{$title}}</h3>
            </div>
            <hr class="box-body">
            {!! Form::open(['route' => 'products.store', 'method' => 'post', 'files'=>true]) !!}
            <div>
                <a href="#" class="btn btn-primary save">Save <i class="fa fa-floppy-o"></i></a>
                <a href="#" class="btn btn-success save_and_delete">Save And Continue <i class="fa fa-floppy-o"></i></a>
                <a href="#" class="btn btn-info copy_product">Copy Product <i class="fa fa-copy"></i></a>
                <a href="#" class="btn btn-danger delete">Delete <i class="fa fa-trash"></i></a>
            </div>
            <hr/>
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
                    @include('admin.products.tabs.product_size_and_weight')
                </div>
                <div id="menu6" class="tab-pane fade">
                    @include('admin.products.tabs.other_data')
                </div>
            </div>
            <hr/>
            <a href="#" class="btn btn-primary save">Save <i class="fa fa-floppy-o"></i></a>
            <a href="#" class="btn btn-success save_and_delete">Save And Continue <i class="fa fa-floppy-o"></i></a>
            <a href="#" class="btn btn-info copy_product">Copy Product <i class="fa fa-copy"></i></a>
            <a href="#" class="btn btn-danger delete">Delete <i class="fa fa-trash"></i></a>
            {!! Form::close() !!}
        </div>
    </div>


    {{--    @push('js')--}}
    {{--        {!! $dataTable->scripts() !!}--}}
    {{--    @endpush--}}

@endsection