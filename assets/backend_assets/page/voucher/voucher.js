$(document).ready(function(){
    $('#px-voucher-message-form').validate({
        ignore: [],
        rules: {
            id: {
                required: true
            }
        },
        submitHandler: function(form) {
            var target = $(form).attr('action');
            $('#px-voucher-message-form .msg-status').text('Deleting data');
            $.ajax({
                url : target,
                type : 'POST',
                dataType : 'json',
                data : $(form).serialize(),
                success : function(response){
                    if(response.status == 'ok'){
                        $('#px-voucher-message-form .msg-status').text('Delete Success...');
                        window.location.href = response.redirect;
                    }
                    else
                        $('#px-voucher-message-form .msg-status').text('Delete Failed');
                },
                error : function(jqXHR, textStatus, errorThrown) {
                    alert(textStatus, errorThrown);
                }
            });
        }
    });
    $('body').delegate('.btn-delete','click',function(){
        $('#px-voucher-message-box').addClass('open');
        var id = $(this).attr('data-target-id');
        $('#px-voucher-message-form input[name="id"]').val('');
        $('#px-voucher-message-form input[name="id"]').val(id);
    });

    $('.btn-change-status').click(function(){
        var id = $(this).attr('row_id');
        $.ajax({
            url:'admin_voucher/global_voucher_status_edit',
            type:'POST',
            dataType:'json',
            data: {id:id},
            success : function(response)
            {
                if(response.status == 'ok')
                {
                    if(response.promo_status == 1)
                    {
                        $('#promo_status'+response.id).removeClass('btn-danger');
                        $('#promo_status'+response.id).addClass('btn-success');
                        $('#promo_status'+response.id).html('Yes');
                    }
                    else
                    {
                        $('#promo_status'+response.id).removeClass('btn-success');
                        $('#promo_status'+response.id).addClass('btn-danger');
                        $('#promo_status'+response.id).html('No');
                    }
                }
            }
        })
    });
})