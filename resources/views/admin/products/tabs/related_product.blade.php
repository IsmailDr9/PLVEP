@push('js')
    <script type="text/javascript">
        $(document).ready(function () {
            $(document).on('click','.do-related-product-search',function () {
                var search = $('.search').val();
                if (search != '' || search !== null){
                    $.ajax({
                       url:'{{route('product.search',$product->id)}}',
                       dataType:'json',
                       type:'post',
                       data:{_token:'{{ csrf_token() }}',search:search},

                        beforeSend: function () {
                           $('.loading-data').show();
                        },
                        success:function (data) {

                           if(data.status === true){
                               if(data.count > 0){
                                   var items = '';
                                   $.each(data.result,function (index,value) {
                                       items += '<li><label><input type="checkbox" class="form-check-input" name="related[]" value="'+value.id+'"/> ' + value.title + ' </label></li>';
                                   });
                                   $('.items').html(items);
                               }
                               $('.loading-data').hide();

                           }
                        },
                        error:function (data) {

                        }

                    });
                }
            });
        });
    </script>
@endpush

<div id="other_data" class="tab-pane">
    <h3>Related Product</h3>
    <hr/>
    <div class="div_inputs col-md-12 col-lg-12 col-sm-12">
        <!-- Search form -->
        <form class="form-inline">
            <i class="fas fa-spin fa-spinner fa-2x loading-data" aria-hidden="true" style="display: none"></i>
            <i class="fas fa-search do-related-product-search" aria-hidden="true"></i>
            <input class="form-control form-control-sm ml-3 w-75 search" type="text" placeholder="Search" aria-label="Search">
        </form>
        <hr/>
        <ol class="items">

        </ol>
        <ol>
            @foreach($product->related()->get() as $related)
                <li>
                    <label>
                        <input type="checkbox" name="related[]" checked value="{{$related->related_product_id}}"/>{{$related->product->title}}
                    </label>
                </li>
            @endforeach
        </ol>
    </div>
</div>