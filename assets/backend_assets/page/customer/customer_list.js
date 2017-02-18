var table;
$(document).ready(function(){
	table = $('#table').DataTable({ 

        "processing":  true, //Feature control the processing indicator.
        "serverSide": true, //Feature control DataTables' server-side processing mode.
        "order": [], //Initial no order.

        // Load data for the table's content from an Ajax source
        "ajax": {
            "url": "http://localhost/hijab-master/admin_customer/customer_list_ajax",
            "type": "POST"
        },

        //Set column definition initialisation properties.
        "columnDefs": [
        { 
            "targets": [-1], //last column
            "orderable": false, //set not orderable
        },
        { "sClass": "text-center", "aTargets": [-1, -2, -3] },
        { "sClass": "text-right", "aTargets": [-4] }
        ],

    });
    
	// $('#px-customer-message-form').validate({
	// 	ignore: [],
	// 	rules: {                                            
	// 		id: {
	// 			required: true
	// 		}
	// 	},
	// 	submitHandler: function(form) {
	// 		var target = $(form).attr('action');
	// 		$('#px-customer-message-form .msg-status').text('Deleting data');
	// 		$.ajax({
	// 			url : target,
	// 			type : 'POST',
	// 			dataType : 'json',
	// 			data : $(form).serialize(),
	// 			success : function(response){
	// 				if(response.status == 'ok'){
	// 					$('#px-customer-message-form .msg-status').text('Delete Success...');
	// 					window.location.href = response.redirect;
	// 				}
	// 				else
	// 					$('#px-customer-message-form .msg-status').text('Delete Failed');
	// 			},
	// 			error : function(jqXHR, textStatus, errorThrown) {
	// 				alert(textStatus, errorThrown);
	// 			}
	// 		});
	// 	}
	// });
	// $('body').delegate('.btn-delete','click',function(){
	// 	$('#px-customer-message-box').addClass('open');
	// 	var id = $(this).attr('data-target-id');
	// 	$('#px-customer-message-form input[name="id"]').val('');
	// 	$('#px-customer-message-form input[name="id"]').val(id);
	// });

	// $('.btn-change-status').click(function(){
	// 	var id = $(this).attr('row_id');
	// 	$.ajax({
	// 		url:'customer/status_customer',
	// 		type:'POST',
	// 		dataType:'json',
	// 		data: {id:id},
	// 		success : function(response)
	// 		{
	// 			if(response.status == 'ok')
	// 			{
	// 				if(response.status_customer == 1)
	// 				{
	// 					$('#status_customer'+response.id).removeClass('btn-danger');
	// 					$('#status_customer'+response.id).addClass('btn-success');
	// 					$('#status_customer'+response.id).html('Yes');
	// 				}
	// 				else
	// 				{
	// 					$('#status_customer'+response.id).removeClass('btn-success');
	// 					$('#status_customer'+response.id).addClass('btn-danger');
	// 					$('#status_customer'+response.id).html('No');
	// 				}
	// 			}
	// 		}
	// 	})
	// });
})