<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>{{!empty($title)?$title:trans('admin.adminPanel')}}</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{url('/')}}/design/adminpanel/plugins/fontawesome-free/css/all.min.css">
    <!-- Ionicons -->
{{--    <link rel="stylesheet" href="{{url('/')}}/design/adminpanel/https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">--}}
    <!-- Tempusdominus Bbootstrap 4 -->
    <link rel="stylesheet" href="{{url('/')}}/design/adminpanel/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="{{url('/')}}/design/adminpanel/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- JQVMap -->
    <link rel="stylesheet" href="{{url('/')}}/design/adminpanel/plugins/jqvmap/jqvmap.min.css">
    <!-- Theme style -->
{{--    @if (\App\helper\Useful::getDir() == 'ltr')--}}
        <link rel="stylesheet" href="{{url('/')}}/design/adminpanel/dist/css/adminlte.min.css">
{{--    @else--}}
{{--        <link rel="stylesheet" href="{{url('/')}}/design/adminpanel/dist/css/rtl/adminLTE.min.css">--}}
{{--        <link rel="stylesheet" href="{{url('/')}}/design/adminpanel/dist/css/rtl/bootstrap-rtl.min.css">--}}
{{--        <link rel="stylesheet" href="{{url('/')}}/design/adminpanel/dist/css/rtl/rtl.css">--}}
{{--    @endif--}}
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="{{url('/')}}/design/adminpanel/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="{{url('/')}}/design/adminpanel/plugins/daterangepicker/daterangepicker.css">
    <!-- summernote -->
    <link rel="stylesheet" href="{{url('/')}}/design/adminpanel/plugins/summernote/summernote-bs4.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">


{{-- js tree--}}
    @if(Route::currentRouteName()  == 'products.edit')
    <link rel="stylesheet" href="{{url('/')}}/design/adminpanel/jstree/themes/default-dark/style.css">
    @else
    <link rel="stylesheet" href="{{url('/')}}/design/adminpanel/jstree/themes/default/style.css">
    @endif

{{-- js datepicker--}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css">

{{--Select 2--}}
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />

    <!-- Google Font: Source Sans Pro -->
{{--    <link href="{{url('/')}}/design/adminpanel/https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">--}}
</head>
    <?php

    $array = ['manufacturers.index', 'malls.index'];

    if (in_array(Route::currentRouteName(),$array)){
    ?>
        <body style="position: absolute">

    <?php

    }else{

    ?>

        <body>

    <?php

    }

?>
