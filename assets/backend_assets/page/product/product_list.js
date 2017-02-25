var table;
$(document).ready(function(){
	table = $('#table').DataTable({ 

        "processing":  true, //Feature control the processing indicator.
        "serverSide": true, //Feature control DataTables' server-side processing mode.
        "order": [], //Initial no order.

        // Load data for the table's content from an Ajax source
        "ajax": {
            "url": "admin_product/product_list_ajax",
            "type": "POST"
        },

        //Set column definition initialisation properties.
        "columnDefs": [
        { 
            "targets": [-1], //last column
            "orderable": false, //set not orderable
        },
        { "sClass": "text-center", "aTargets": [-1, -2, -3] }
        ],

    });

	$('#px-product-product_list-message-form').validate({
		ignore: [],
		rules: {                                            
			id: {
				required: true
			}
		},
		submitHandler: function(form) {
			var target = $(form).attr('action');
			$('#px-product-product_list-message-form .msg-status').text('Deleting data');
			$.ajax({
				url : target,
				type : 'POST',
				dataType : 'json',
				data : $(form).serialize(),
				success : function(response){
					if(response.status == 'ok'){
						$('#px-product-product_list-message-form .msg-status').text('Delete Success...');
						window.location.href = response.redirect;
					}
					else
						$('#px-product-product_list-message-form .msg-status').text('Delete Failed');
				},
				error : function(jqXHR, textStatus, errorThrown) {
					alert(textStatus, errorThrown);
				}
			});
		}
	});
	$('body').delegate('.btn-delete','click',function(){
		$('#px-product-product_list-message-box').addClass('open');
		var id = $(this).attr('data-target-id');
		$('#px-product-product_list-message-form input[name="id"]').val('');
		$('#px-product-product_list-message-form input[name="id"]').val(id);
	});
        $('.btn-change-status').click(function(){
		var id = $(this).attr('row_id');
		alert(id);
		$.ajax({
			url:'admin_product/productshow',
			type:'POST',
			dataType:'json',
			data: {id:id},
			success : function(response)
			{
				if(response.status == 'ok')
				{
					if(response.show_flag == 1)
					{
						$('#show_flag'+response.id).removeClass('btn-danger');
						$('#show_flag'+response.id).addClass('btn-success');
						$('#show_flag'+response.id).html('Show');
					}
					else
					{
						$('#show_flag'+response.id).removeClass('btn-success');
						$('#show_flag'+response.id).addClass('btn-danger');
						$('#show_flag'+response.id).html('Hide');
					}
				}
			}
		})
	});
})