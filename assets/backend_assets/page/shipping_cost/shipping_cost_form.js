$(document).ready(function(){
    $('#px-shipping_cost-form').validate({
        rules: {
            price: {
                required: true
            }
        },
        submitHandler: function(form) {
            var target = $(form).attr('action');
            $('#px-shipping_cost-form .alert-warning').removeClass('hidden');
            $('#px-shipping_cost-form .alert-success').addClass('hidden');
            $('#px-shipping_cost-form .alert-danger').addClass('hidden');
            $.ajax({
                url : target,
                type : 'POST',
                dataType : 'json',
                data : $(form).serialize(),
                success : function(response){
                    $('#px-shipping_cost-form .alert-warning').addClass('hidden');
                    if(response.status == 'ok'){
                        $('#px-shipping_cost-form .alert-success').removeClass('hidden').children('span').text(response.msg);
                        window.location.href = response.redirect;
                    }
                    else
                        $('#px-shipping_cost-form .alert-danger').removeClass('hidden').children('span').text(response.msg);	
                },
                error : function(jqXHR, textStatus, errorThrown) {
                    alert(textStatus, errorThrown);
                }
            });
        }
    });
});