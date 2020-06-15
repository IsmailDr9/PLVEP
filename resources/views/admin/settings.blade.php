@extends('admin.index')
@section('content')
    <div class="box">
        <div class="box-header">
            <h3 class="box-title">{{ $title }}</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            {!! Form::open(['url'=>aurl('settings'),'files'=>true]) !!}
            <div class="form-group">
                Site Name Arabic
                {!! Form::text('sitename_ar',setting()->sitename_ar,['class'=>'form-control']) !!}
            </div>
            <div class="form-group">
                Site Name English
                {!! Form::text('sitename_en',setting()->sitename_en,['class'=>'form-control']) !!}
            </div>
            <div class="form-group">
                Admin Email
                {!! Form::email('email',setting()->email,['class'=>'form-control']) !!}
            </div>
            <div class="form-group">
                Admin Logo
                {!! Form::file('logo',['class'=>'form-control']) !!}
                @if(!empty(setting()->logo))
                    <img src="{{Storage::url(setting()->logo)}}" style="width: 50px ; height: 50px"/>
                @endif
            </div>


            <div class="form-group">
                Admin Icon
                {!! Form::file('icon',['class'=>'form-control']) !!}
                @if(!empty(setting()->icon))
                    <img src="{{Storage::url(setting()->icon)}}" style="width: 50px ; height: 50px"/>
                    @endif
            </div>
            <div class="form-group">
                Admin Description
                {!! Form::textarea('description',setting()->description,['class'=>'form-control']) !!}
            </div>
            <div class="form-group">
                Admin Keywords
                {!! Form::textarea('keywords',setting()->keywords,['class'=>'form-control']) !!}
            </div>
            <div class="form-group">
                Admin Main Lang
                {!! Form::select('main_lang',['ar'=>trans('admin.ar'),'en'=>trans('admin.en')],setting()->main_lang,['class'=>'form-control']) !!}
            </div>
            <div class="form-group">
                Admin Status
                {!! Form::select('status',['open'=>trans('admin.open'),'close'=>trans('admin.close')],setting()->status,['class'=>'form-control']) !!}
            </div>
            <div class="form-group">
                Admin Message Maintenance
                {!! Form::textarea('message_maintenance',setting()->message_maintenance,['class'=>'form-control']) !!}
            </div>
            {!! Form::submit(trans('admin.save'),['class'=>'btn btn-primary']) !!}
            {!! Form::close() !!}
        </div>
        <!-- /.box-body -->
    </div>
    <!-- /.box -->
@endsection