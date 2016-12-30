$(document).ready(function(){
	$('#px-system-masterdata-form').validate({
		ignore: [],
		rules: {                                            
			content: {
				required: true
			}
		},
		submitHandler: function(form) {
			var target = $(form).attr('action');
			$('#px-system-masterdata-form .alert-warning').removeClass('hidden');
			$('#px-system-masterdata-form .alert-success').addClass('hidden');
			$('#px-system-masterdata-form .alert-danger').addClass('hidden');
			$.ajax({
				url : target,
				type : 'POST',
				dataType : 'json',
				data : $(form).serialize(),
				success : function(response){
					$('#px-system-masterdata-form .alert-warning').addClass('hidden');
					if(response.status == 'ok'){
						$('#px-system-masterdata-form .alert-success').removeClass('hidden').children('span').text(response.msg);
						window.location.href = response.redirect;
					}
					else
						$('#px-system-masterdata-form .alert-danger').removeClass('hidden').children('span').text(response.msg);	
				},
				error : function(jqXHR, textStatus, errorThrown) {
					alert(textStatus, errorThrown);
				}
			});
		}
	});
	$('#px-system-masterdata-message-form').validate({
		ignore: [],
		rules: {                                            
			id: {
				required: true
			}
		},
		submitHandler: function(form) {
			var target = $(form).attr('action');
			$('#px-system-masterdata-message-form .msg-status').text('Deleting data');
			$.ajax({
				url : target,
				type : 'POST',
				dataType : 'json',
				data : $(form).serialize(),
				success : function(response){
					if(response.status == 'ok'){
						$('#px-system-masterdata-message-form .msg-status').text('Delete Success...');
						window.location.href = response.redirect;
					}
					else
						$('#px-system-masterdata-message-form .msg-status').text('Delete Failed');	
				},
				error : function(jqXHR, textStatus, errorThrown) {
					alert(textStatus, errorThrown);
				}
			});
		}
	});
	$('.btn-add').click(function(){
		var target_form = $(this).attr('data-target-form');
		$('#px-system-masterdata-form').attr('action',target_form);
		$('#px-system-masterdata-form-id').val('');
		$('#px-system-masterdata-form-content').val('');
		$('#px-system-masterdata-modal').modal('show');
	});
	$('body').delegate('.btn-edit','click',function(){
		var target_form = $(this).attr('data-target-form');
		var target = $(this).attr('data-target-get');
		var id = $(this).attr('data-target-id');
		$('#px-system-masterdata-form').attr('action',target_form);
		$.ajax({
			url : target,
			type : 'POST',
			dataType : 'json',
			data : {'id':id},
			success : function(response){
				$('#px-system-masterdata-form-id').val(response.data.row.id);
				$('#px-system-masterdata-form-content').val(response.data.row.content);
				$('#px-system-masterdata-modal').modal('show');
			},
			error : function(jqXHR, textStatus, errorThrown) {
				alert(textStatus, errorThrown);
			}
		});
	});
	$('body').delegate('.btn-delete','click',function(){
		var id = $(this).attr('data-target-id');
		$('#px-system-masterdata-message-form input[name="id"]').val('');
		$('#px-system-masterdata-message-form input[name="id"]').val(id);
		$('#px-system-masterdata-message-box').addClass('open');
	});
	$('#px-system-masterdata-modal').on('hidden.bs.modal', function (e) {
		$('#px-system-masterdata-form').validate().resetForm();
	});
	$('#px-system-masterdata-modal').on('shown.bs.modal', function (e) {
		$('#px-system-masterdata-form').validate().resetForm();
	});
})