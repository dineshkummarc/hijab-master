$(document).ready(function(){
	$('#px-order-form').validate({
		ignore: [],
		rules: {                                            
			name: {
				required: true
			},
			target: {
				required: true
			},
			id_parent: {
				required : true
			},
			icon: {
				required : true
			}
		},
		submitHandler: function(form) {
			var target = $(form).attr('action');
			$('#px-order-form .alert-warning').removeClass('hidden');
			$('#px-order-form .alert-success').addClass('hidden');
			$('#px-order-form .alert-danger').addClass('hidden');
			$.ajax({
				url : target,
				type : 'POST',
				dataType : 'json',
				data : $(form).serialize(),
				success : function(response){
					$('#px-order-form .alert-warning').addClass('hidden');
					if(response.status == 'ok'){
						$('#px-order-form .alert-success').removeClass('hidden').children('span').text(response.msg);
						window.location.href = response.redirect;
					}
					else
						$('#px-order-form .alert-danger').removeClass('hidden').children('span').text(response.msg);	
				},
				error : function(jqXHR, textStatus, errorThrown) {
					alert(textStatus, errorThrown);
				}
			});
		}
	});
	$('#px-order-message-form').validate({
		ignore: [],
		rules: {                                            
			id: {
				required: true
			}
		},
		submitHandler: function(form) {
			var target = $(form).attr('action');
			$('#px-order-message-form .msg-status').text('Deleting data');
			$.ajax({
				url : target,
				type : 'POST',
				dataType : 'json',
				data : $(form).serialize(),
				success : function(response){
					if(response.status == 'ok'){
						$('#px-order-message-form .msg-status').text('Delete Success...');
						window.location.href = response.redirect;
					}
					else
						$('#px-order-message-form .msg-status').text('Delete Failed');	
				},
				error : function(jqXHR, textStatus, errorThrown) {
					alert(textStatus, errorThrown);
				}
			});
		}
	});
	$('.btn-add').click(function(){
		var target_form = $(this).attr('data-target-form');
		$('#px-order-form').attr('action',target_form);
		$('#px-order-form-id').val('');
		$('#px-order-form-name').val('');
		$('#px-order-form-icon option').removeAttr('selected');
		$('#px-order-modal').modal('show');
	});
	$('body').delegate('.btn-edit','click',function(){
		var target_form = $(this).attr('data-target-form');
		var target = $(this).attr('data-target-get');
		var id = $(this).attr('data-target-id');
		$('#px-order-form').attr('action',target_form);
		$.ajax({
			url : target,
			type : 'POST',
			dataType : 'json',
			data : {'id':id},
			success : function(response){
				$('#px-order-form-id').val(response.data.tracking.id);
				$('#px-order-form-customer_id').val(response.data.row.customer_id);
				$('#px-order-form-title').val(response.data.tracking.title);
				$('#px-order-form-content').val(response.data.tracking.content);
				// $('#px-order-form-jasa_pengiriman_id option[value="'+response.data.tracking.jasa_pengiriman_id+'"]').prop('selected',true);
				// $('#px-order-form-shipping_flag_id option[value="'+response.data.tracking.shipping_flag_id+'"]').prop('selected',true);
				// $('#px-order-form-flag_id option[value="'+response.data.tracking.flag_id+'"]').prop('selected',true);
				$('#px-order-modal').modal('show');
			},
			error : function(jqXHR, textStatus, errorThrown) {
				alert(textStatus, errorThrown);
			}
		});
	});
	$('body').delegate('.btn-delete','click',function(){
		var id = $(this).attr('data-target-id');
		$('#px-order-message-form input[name="id"]').val('');
		$('#px-order-message-form input[name="id"]').val(id);
		$('#px-order-message-box').addClass('open');
	});
	$('#px-order-modal').on('hidden.bs.modal', function (e) {
		$('#px-order-form').validate().resetForm();
	});
	$('#px-order-modal').on('shown.bs.modal', function (e) {
		$('#px-order-form').validate().resetForm();
	});
	$('#px-order-form-icon option').hover(function(){
		var icon = $(this).val();
		$('#px-order-form-icon-preview span').attr('class','fa '+icon);
	})
})