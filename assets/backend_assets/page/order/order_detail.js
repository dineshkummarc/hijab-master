$(document).ready(function(){
    $('body').delegate('.btn-order-process','click',function(){
            var order_id = $(this).attr('data-id');
            var status_next = $(this).attr('data-status');
            var title = '';
            var message = '';
            var open = 0;
            if(status_next == 2)
            {
                title = 'ORDER PAID PROCESS';
                message = 'Apakah Kamu Yakin Akan Mengubah Status Order Menjadi PAID?';
                open = 1;
            }
            else if(status_next == 3)
            {
                var nomor_resi = $('#nomor_resi').val();
                if(nomor_resi == '')
                {
                    open = 0;
                    alert('Nomor Resi Harus Diisi');
                }
                else
                    open = 1;
                title = 'ORDER SHIPPED PROCESS';
                message = 'Apakah Kamu Yakin Akan Mengubah Status Order Menjadi SHIPPED?';
                $('#process_id').attr('data-nomor-resi', nomor_resi);
            }
            else
            {
                title = 'ORDER REJECT PROCESS';
                message = 'Apakah Kamu Yakin Akan Mengubah Status Order Menjadi REJECTED?';
                open = 1;
            }
            $('#popup-title').html(title);
            $('#msg-show').html(message);
            $('#process_id').attr('data-id', order_id);
            $('#process_id').attr('data-status', status_next);
            if(open == 1)
                $('#px-order-message-box').addClass('open');
    });
    
    $('#process_id').click(function(){
        var order_id = $(this).attr('data-id');
        var status_id = $(this).attr('data-status');
        var nomor_resi = $(this).attr('data-nomor-resi');
        $('#px-order-message-form .alert-warning').removeClass('hidden');
        $('#px-order-message-form .alert-success').addClass('hidden');
        $('#px-order-message-form .alert-danger').addClass('hidden');
        $.ajax({
            url:'admin_order/process_order',
            type:'post',
            dataType:'json',
            data:{'id':order_id, 'status':status_id, 'nomor_resi':nomor_resi},
            success:function(response)
            {
                $('#px-order-message-form .alert-warning').addClass('hidden');
                if(response.status == 'ok'){
                    $('#px-order-message-form .alert-success').removeClass('hidden').children('span').text(response.msg);
                    window.location.href = response.redirect;
                }
                else
                    $('#px-order-message-form .alert-danger').removeClass('hidden').children('span').text(response.msg);
            }
        });
    });
});