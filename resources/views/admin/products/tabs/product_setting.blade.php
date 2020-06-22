@push('js')
    <script type="text/javascript">
        $('.date-picker').datepicker({
            autoclose:true,
            clearBtn:true,
        });

        $(document).on('change','.status',function () {

            var status = $('.status option:selected').val();

            if (status ==  'refused')
            {

                $('.reason').show();

            }else{

                $(".reason_value").val("");
                $('.reason').hide();

            }
        });

    </script>
@endpush
<div class="row">
    <div class="col-3">
        <div class="form-group">
            {!! Form::label('price', 'Price', ['class' => 'control-label']) !!}
            {!! Form::text('price', $product->price, ['class' => 'form-control']) !!}
        </div>
    </div>
    <div class="col-3">
        <div class="form-group">
            {!! Form::label('stock', 'Stock', ['class' => 'control-label']) !!}
            {!! Form::text('stock', $product->stock, ['class' => 'form-control']) !!}
        </div>
    </div>
    <div class="col-3">
        <div class="form-group">
            {!! Form::label('start_at', 'Start At', ['class' => 'control-label']) !!}
            {!! Form::text('start_at', $product->start_at, ['class' => 'form-control date-picker']) !!}
        </div>
    </div>
    <div class="col-3">
        <div class="form-group">
            {!! Form::label('end_at', 'End At', ['class' => 'control-label']) !!}
            {!! Form::text('end_at', $product->end_at, ['class' => 'form-control date-picker']) !!}
        </div>
    </div>

</div>

<div class="clearfix"></div>

<div class="row">
    <div class="col-4">
        <div class="form-group">
            {!! Form::label('price_offer', 'Price Offer', ['class' => 'control-label']) !!}
            {!! Form::text('price_offer', $product->price_offer, ['class' => 'form-control']) !!}
        </div>
    </div>

    <div class="col-4">
        <div class="form-group">
            {!! Form::label('start_offer_at', 'Start Offer At', ['class' => 'control-label']) !!}
            {!! Form::text('start_offer_at', $product->start_offer_at, ['class' => 'form-control date-picker']) !!}
        </div>
    </div>

    <div class="col-4">
        <div class="form-group">
            {!! Form::label('end_offer_at', 'End Offer At', ['class' => 'control-label']) !!}
            {!! Form::text('end_offer_at', $product->end_offer_at, ['class' => 'form-control date-picker']) !!}
        </div>
    </div>

</div>

<div class="clearfix"></div>

<div class="row">
    <div class="col">
        <div class="form-group">
            {{ Form::label('name', 'Status') }}
            {!! Form::select('status',['pending'=>'pending', 'refused'=>'refused', 'active'=>'active'],$product->status, ['class' => 'form-control status','placeholder'=>'Please Select Product Status']) !!}
        </div>
    </div>
</div>

<div class="form-group reason" style="display: none">
    {!! Form::label('reason', 'Reason', ['class' => 'control-label']) !!}
    {!! Form::textarea('reason', $product->reason, ['class' => 'form-control reason_value']) !!}
</div>
