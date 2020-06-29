@push('js')
<script type="text/javascript">
    $(document).ready(function() {
        var dataSelect = [
            @foreach(App\Model\Country::all() as $country)
            {
                "text": "{{ $country->{'country_name_'.session('lang')} }}",
                "children": [
                    @foreach($country->malls()->get() as $mall)
                    {
                        "id":{{$mall->id}},
                        "text": "{{ $mall->{'name_'.session('lang')} }}",
                        @if(mallId($mall->id, $product->id))
                        "selected": true,
                        @endif
                    },
                    @endforeach
                ],
            },
            @endforeach
        ];

        $('.js-example-basic-single').select2({data:dataSelect});
    });
</script>

@endpush
<hr/>

<div class="size_weight">
<h1 class="text-center">Please Select Department</h1>
</div>

<div class="product-color-and-brand" style="display: none">
    <div class="row">
        <div class="col-4">
            <div class="form-group">
                <label for="sizes">Color</label>
                <div class="col-md-9">
                    {!! Form::select('color_id', App\Model\Color::pluck('name_'.session('lang'),'id') , $product->color_id , ['class' => 'form-control','placeholder'=>'Color Id']) !!}
                </div>
            </div>
        </div>
        <div class="col-4">
            <div class="form-group">
                <label for="sizes">Brand</label>
                <div class="col-md-9">
                    {!! Form::select('brand_id', App\Model\Brand::pluck('brand_name_'.session('lang'),'id') , $product->brand_id , ['class' => 'form-control','placeholder'=>'Brand Id']) !!}
                </div>
            </div>
        </div>
        <div class="col-4">
            <div class="form-group">
                <label for="sizes">Manufacturer</label>
                <div class="col-md-9">
                    {!! Form::select('manu_id', App\Model\Manufacturer::pluck('name_'.session('lang'),'id') , $product->manu_id , ['class' => 'form-control','placeholder'=>'Manufacturer Id']) !!}
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-4">
            <div class="form-group">
                <label for="sizes">Malls</label>
              <div class="col-md-9">
                  <select name="malls[]" class="js-example-basic-single" multiple="multiple" style="width: 100%">

                  </select>
              </div>
            </div>
        </div>
    </div>
</div>