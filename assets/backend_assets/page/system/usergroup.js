$(document).ready(function(){
	$('#px-system-usergroup-form').validate({
		ignore: [],
		rules: {                                            
			usergroup_name: {
				required: true
			}
		},
		submitHandler: function(form) {
			var target = $(form).attr('action');
			$('#px-system-usergroup-form .alert-warning').removeClass('hidden');
			$('#px-system-usergroup-form .alert-success').addClass('hidden');
			$('#px-system-usergroup-form .alert-danger').addClass('hidden');
			$.ajax({
				url : target,
				type : 'POST',
				dataType : 'json',
				data : $(form).serialize(),
				success : function(response){
					$('#px-system-usergroup-form .alert-warning').addClass('hidden');
					if(response.status == 'ok'){
						$('#px-system-usergroup-form .alert-success').removeClass('hidden').children('span').text(response.msg);
						window.location.href = response.redirect;
					}
					else
						$('#px-system-usergroup-form .alert-danger').removeClass('hidden').children('span').text(response.msg);	
				},
				error : function(jqXHR, textStatus, errorThrown) {
					alert(textStatus, errorThrown);
				}
			});
		}
	});
	$('#px-system-usergroup-message-form').validate({
		ignore: [],
		rules: {                                            
			id: {
				required: true
			}
		},
		submitHandler: function(form) {
			var target = $(form).attr('action');
			$('#px-system-usergroup-message-form .msg-status').text('Deleting data');
			$.ajax({
				url : target,
				type : 'POST',
				dataType : 'json',
				data : $(form).serialize(),
				success : function(response){
					if(response.status == 'ok'){
						$('#px-system-usergroup-message-form .msg-status').text('Delete Success...');
						window.location.href = response.redirect;
					}
					else
						$('#px-system-usergroup-message-form .msg-status').text('Delete Failed');
				},
				error : function(jqXHR, textStatus, errorThrown) {
					alert(textStatus, errorThrown);
				}
			});
		}
	});
	$('.btn-add').click(function(){
		var target_form = $(this).attr('data-target-form');
		$('#px-system-usergroup-form').attr('action',target_form);
		$('#px-system-usergroup-form-id').val('');
		$('#px-system-usergroup-form-usergroup-name').val('');
		$('#px-system-usergroup-modal').modal('show');
	});
	$('body').delegate('.btn-edit','click',function(){
		var target_form = $(this).attr('data-target-form');
		var target = $(this).attr('data-target-get');
		var id = $(this).attr('data-target-id');
		$('#px-system-usergroup-form').attr('action',target_form);
		$.ajax({
			url : target,
			type : 'POST',
			dataType : 'json',
			data : {'id':id},
			success : function(response){
				$('#px-system-usergroup-form-id').val(response.data.row.id);
				$('#px-system-usergroup-form-usergroup-name').val(response.data.row.usergroup_name);
				$('#px-system-usergroup-modal').modal('show');
			},
			error : function(jqXHR, textStatus, errorThrown) {
				alert(textStatus, errorThrown);
			}
		});
	});
	$('body').delegate('.btn-delete','click',function(){
		var id = $(this).attr('data-target-id');
		$('#px-system-usergroup-message-form input[name="id"]').val('');
		$('#px-system-usergroup-message-form input[name="id"]').val(id);
		$('#px-system-usergroup-message-box').addClass('open');
	});
	$('#px-system-usergroup-modal').on('hidden.bs.modal', function (e) {
		$('#px-system-usergroup-form').validate().resetForm();
	});
	$('#px-system-usergroup-modal').on('shown.bs.modal', function (e) {
		$('#px-system-usergroup-form').validate().resetForm();
	});
})