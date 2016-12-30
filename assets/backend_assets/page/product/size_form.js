$(document).ready(function(){
    $('#px-size-form').validate({
        rules: {                                            
            name: {
                required: true
            }
                        
        },
        submitHandler: function(form) {
            var target = $(form).attr('action');
            $('#px-size-form .alert-warning').removeClass('hidden');
            $('#px-size-form .alert-success').addClass('hidden');
            $('#px-size-form .alert-danger').addClass('hidden');
            $('.px-summernote').each(function() {
                $(this).val($(this).code());
            });
            $.ajax({
                url : target,
                type : 'POST',
                dataType : 'json',
                data : $(form).serialize(),
                success : function(response){
                    $('#px-size-form .alert-warning').addClass('hidden');
                    if(response.status == 'ok'){
                        $('#px-size-form .alert-success').removeClass('hidden').children('span').text(response.msg);
                        window.location.href = response.redirect;
                    }
                    else
                        $('#px-size-form .alert-danger').removeClass('hidden').children('span').text(response.msg);	
                },
                error : function(jqXHR, textStatus, errorThrown) {
                    alert(textStatus, errorThrown);
                }
            });
        }
    });
})