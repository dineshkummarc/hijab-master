$(document).ready(function(){
    $('#px-color-form').validate({
        rules: {                                            
            name: {
                required: true
            }
                        
        },
        submitHandler: function(form) {
            var target = $(form).attr('action');
            $('#px-color-form .alert-warning').removeClass('hidden');
            $('#px-color-form .alert-success').addClass('hidden');
            $('#px-color-form .alert-danger').addClass('hidden');
            $('.px-summernote').each(function() {
                $(this).val($(this).code());
            });
            $.ajax({
                url : target,
                type : 'POST',
                dataType : 'json',
                data : $(form).serialize(),
                success : function(response){
                    $('#px-color-form .alert-warning').addClass('hidden');
                    if(response.status == 'ok'){
                        $('#px-color-form .alert-success').removeClass('hidden').children('span').text(response.msg);
                        window.location.href = response.redirect;
                    }
                    else
                        $('#px-color-form .alert-danger').removeClass('hidden').children('span').text(response.msg);	
                },
                error : function(jqXHR, textStatus, errorThrown) {
                    alert(textStatus, errorThrown);
                }
            });
        }
    });
})