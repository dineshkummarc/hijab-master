$(document).ready(function(){
    $('#px-customer-address-form').validate({
        rules: {
            receiver_name: {
                required: true
            },
            title: {
                required: true
            },
            address: {
                required: true
            },
            province: {
                required: true
            },
            city: {
                required: true
            },
            region: {
                required: true
            },
            postal_code: {
                required: true
            },
            phone: {
                required: true
            }
        },
        submitHandler: function(form) {
            var target = $(form).attr('action');
            $('#px-customer-address-form .alert-warning').removeClass('hidden');
            $('#px-customer-address-form .alert-success').addClass('hidden');
            $('#px-customer-address-form .alert-danger').addClass('hidden');
            $('.px-summernote').each(function() {
                $(this).val($(this).code());
            });
            $.ajax({
                url : target,
                type : 'POST',
                dataType : 'json',
                data : $(form).serialize(),
                success : function(response){
                    $('#px-customer-address-form .alert-warning').addClass('hidden');
                    if(response.status == 'ok'){
                        $('#px-customer-address-form .alert-success').removeClass('hidden').children('span').text(response.msg);
                        window.location.href = response.redirect;
                    }
                    else
                        $('#px-customer-address-form .alert-danger').removeClass('hidden').children('span').text(response.msg);	
                },
                error : function(jqXHR, textStatus, errorThrown) {
                    alert(textStatus, errorThrown);
                }
            });
        }
    });

    $('#px-customer-address-form-province').change(function(){
            var province_id = $(this).val();
            $.ajax({
                url : 'admin_customer/get_city',
                type : 'POST',
                dataType : 'json',
                data : {'province_id' : province_id},
                success: function(response){
                    if(response.status = 'ok')
                    {
                        $('#px-customer-address-form-city').html("");
                        $.each(response.data, function(i, data){
                        {
                            $('#px-customer-address-form-city').append('<option value="'+data.id+'">'+data.type+' '+data.name+'</option>');
                        }
                        });
                    }
                }
            });
        });
        $('#px-customer-address-form-city').change(function(){
            var city_id = $(this).val();
            $.ajax({
                url : 'admin_customer/get_region',
                type : 'POST',
                dataType : 'json',
                data : {'city_id' : city_id},
                success: function(response){
                    if(response.status = 'ok')
                    {
                        $('#px-customer-address-form-region').html("");
                        $.each(response.data, function(i, data){
                        {
                            $('#px-customer-address-form-region').append('<option value="'+data.id+'">'+data.name+'</option>');
                        }
                        });
                    }
                }
            });
        });
})