$(document).ready(function(){
    $('#px-stock-form').validate({
        rules: {
            size_id: {
                required: true
            },
            color_id: {
                required: true
            },                                            
            stock: {
                required: true
            }      
        },
        submitHandler: function(form) {
            var target = $(form).attr('action');
            $('#px-stock-form .alert-warning').removeClass('hidden');
            $('#px-stock-form .alert-success').addClass('hidden');
            $('#px-stock-form .alert-danger').addClass('hidden');
            $('.px-summernote').each(function() {
                $(this).val($(this).code());
            });
            $.ajax({
                url : target,
                type : 'POST',
                dataType : 'json',
                data : $(form).serialize(),
                success : function(response){
                    $('#px-stock-form .alert-warning').addClass('hidden');
                    if(response.status == 'ok'){
                        $('#px-stock-form .alert-success').removeClass('hidden').children('span').text(response.msg);
                        window.location.href = response.redirect;
                    }
                    else
                        $('#px-stock-form .alert-danger').removeClass('hidden').children('span').text(response.msg);	
                },
                error : function(jqXHR, textStatus, errorThrown) {
                    alert(textStatus, errorThrown);
                }
            });
        }
    });
})