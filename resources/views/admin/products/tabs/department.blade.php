@push('js')
    <script type="text/javascript">
        $(document).ready(function () {
            $('#jstree').jstree({
                "core": {
                    'data': {!! loadDepartment($product->department_id) !!},
                    "themes": {
                        "name": "default-dark",
                        "variant": "large",
                        "icons": false,
                        "dots": true,
                    }
                },
                "checkbox": {
                    "keep_selected_style": false
                },
                "plugins": ["wholerow"]
            });
        });
        $('#jstree').on('changed.jstree', function (e, data) {
            var i, j, r = [];
            for (i = 0, j = data.selected.length; i < j; i++) {
                r.push(data.instance.get_node(data.selected[i]).id);
            }
            var department = r.join(', ');
            $('.parent_id').val(department);

            //Load weight and size
            $.ajax({
                url: "{{route('product.size.weight',$product->id)}}",
                dataType:'html',
                type:'post',
                data:{_token:'{{csrf_token()}}',dep_id:department},
                success:function (data)
                {
                    $('.size_weight').html(data);
                    $('.product-color-and-brand').show();
                }
            });
        });
    </script>
@endpush
<hr/>
<div class="clearfix"></div>
<div class="row">
    <div class="col-6">
        <div class="form-group">
            <div id="jstree"></div>
            <input type="hidden" name="department_id" class="parent_id" value="">
        </div>
    </div>
</div>