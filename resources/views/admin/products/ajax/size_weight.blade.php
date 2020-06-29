<div class="row">
    <div class="col-6">
        <div class="form-group">
            <label for="sizes" class="col-md-3">Size Id</label>
            <div class="col-md-9">
                {!! Form::select('size_id', $sizes , $product->size_id, ['class' => 'form-control','placeholder'=>'Size Id']) !!}
            </div>
        </div>
    </div>
    <div class="col-6">
        <div class="form-group">
            <label for="sizes" class="col-md-3">Size</label>
            <div class="col-md-9">
                {!! Form::text('size',$product->size, ['class' => 'form-control','placeholder'=>'Size']) !!}
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-6">
        <div class="form-group">
            <label for="weights" class="col-md-3">Weight Id</label>
            <div class="col-md-9">
                {!! Form::select('weight_id', $weights , $product->weight_id , ['class' => 'form-control','placeholder'=>'Weight Id']) !!}
            </div>
        </div>
    </div>
    <div class="col-6">
        <div class="form-group">
            <label for="weights" class="col-md-3">Weights</label>
            <div class="col-md-9">
                {!! Form::text('weight',$product->weight, ['class' => 'form-control','placeholder'=>'Weights']) !!}
            </div>
        </div>
    </div>
</div>


