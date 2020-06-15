function check_all() {
    $('input[class="item_checkbox"]:checkbox').each(function () {
        if($('input[class="check_all"]:checkbox:checked').length == 0)
        {
            $(this).prop('checked',false);
        }else{
            $(this).prop('checked',true);

        }
    });
}
function delete_all() {

    $(document).on('click','.delete_all', function () {
        $('#form_data').submit();
    });

    $(document).on('click','.delBt',function () {
        var item_checked = $('input[class="item_checkbox"]:checkbox:checked').length;
        if (item_checked > 0){
            $('.record_count').text(item_checked);
            $('.not_empty').removeAttr('hidden');
            $('.empty_button').show();

            document.getElementById("empty_record").setAttribute("hidden","hidden");


        }else {
            $('.record_count').text('');
            $('.empty_record').removeAttr('hidden');
            $('.empty_button').hide();
            document.getElementById("not_empty").setAttribute("hidden","hidden");

        }
        $('#multibleDelete').modal('show');
    });
}