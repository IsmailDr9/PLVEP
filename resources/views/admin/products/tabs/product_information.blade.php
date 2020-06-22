<hr/>
<div class="form-group">
    {!! Form::label('title', 'Name Arabic', ['class' => 'control-label']) !!}
    {!! Form::text('title', $product->title, ['class' => 'form-control']) !!}
</div>
<div class="form-group">
    {!! Form::label('content', 'Content', ['class' => 'control-label']) !!}
    {!! Form::textarea('content', $product->content, ['class' => 'form-control']) !!}
</div>
