$(document).ready(function(){
    $('#px-voucher-form').validate({
        rules: {
            name: {
                required: true
            }

        },
        submitHandler: function(form) {
            var target = $(form).attr('action');
            $('#px-voucher-form .alert-warning').removeClass('hidden');
            $('#px-voucher-form .alert-success').addClass('hidden');
            $('#px-voucher-form .alert-danger').addClass('hidden');
            $('.px-summernote').each(function() {
                $(this).val($(this).code());
            });
            $.ajax({
                url : target,
                type : 'POST',
                dataType : 'json',
                data : $(form).serialize(),
                success : function(response){
                    $('#px-voucher-form .alert-warning').addClass('hidden');
                    if(response.status == 'ok'){
                        $('#px-voucher-form .alert-success').removeClass('hidden').children('span').text(response.msg);
                        window.location.href = response.redirect;
                    }
                    else
                        $('#px-voucher-form .alert-danger').removeClass('hidden').children('span').text(response.msg);
                },
                error : function(jqXHR, textStatus, errorThrown) {
                    alert(textStatus, errorThrown);
                }
            });
        }
    });



    $('body').delegate('.btn-delete-file','click',function(){
        $(this).parent().remove();
    });
})