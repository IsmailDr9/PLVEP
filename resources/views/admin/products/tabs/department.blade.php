@push('js')
    <script type="text/javascript">
        $(document).ready(function () {
            $('#jstree').jstree({
                "core": {
                    'data': {!! loadDepartment($product->department_id) !!},
                    "themes": {
                        "variant": "large"
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
            $('.parent_id').val(r.join(', '));
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