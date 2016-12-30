$(document).ready(function(){
	$('#px-system-useraccess-form').validate({
		ignore: [],
		rules: {                                            
			// usergroup_name: {
			// 	required: true
			// }
		},
		submitHandler: function(form) {
			var target = $(form).attr('action');
			$('#px-system-useraccess-form .alert-warning').removeClass('hidden');
			$('#px-system-useraccess-form .alert-success').addClass('hidden');
			$('#px-system-useraccess-form .alert-danger').addClass('hidden');
			$.ajax({
				url : target,
				type : 'POST',
				dataType : 'json',
				data : $(form).serialize(),
				success : function(response){
					$('#px-system-useraccess-form .alert-warning').addClass('hidden');
					if(response.status == 'ok'){
						$('#px-system-useraccess-form .alert-success').removeClass('hidden').children('span').text(response.msg);
						window.location.href = response.redirect;
					}
					else
						$('#px-system-useraccess-form .alert-danger').removeClass('hidden').children('span').text(response.msg);	
				},
				error : function(jqXHR, textStatus, errorThrown) {
					alert(textStatus, errorThrown);
				}
			});
		}
	});
	$('#px-system-useraccess-message-form').validate({
		ignore: [],
		rules: {                                            
			id: {
				required: true
			}
		},
		submitHandler: function(form) {
			var target = $(form).attr('action');
			$('#px-system-useraccess-message-form .msg-status').text('Deleting data');
			$.ajax({
				url : target,
				type : 'POST',
				dataType : 'json',
				data : $(form).serialize(),
				success : function(response){
					if(response.status == 'ok'){
						$('#px-system-useraccess-message-form .msg-status').text('Delete Success...');
						window.location.href = response.redirect;
					}
					else
						$('#px-system-useraccess-message-form .msg-status').text('Delete Failed');
				},
				error : function(jqXHR, textStatus, errorThrown) {
					alert(textStatus, errorThrown);
				}
			});
		}
	});
	$('.btn-add').click(function(){
		var target_form = $(this).attr('data-target-form');
		$('#px-system-useraccess-form').attr('action',target_form);
		$('#px-system-useraccess-id').val('');
		$('#px-system-useraccess-group-id option').removeAttr('selected').parent().removeClass('hidden');
		$('#px-system-useraccess-form [type="checkbox"]').removeAttr('checked');
		$('#px-system-useraccess-group-label').remove();
		$('#px-system-useraccess-modal').modal('show');
	});
	$('body').delegate('.btn-edit','click',function(){
		var target_form = $(this).attr('data-target-form');
		var target = $(this).attr('data-target-get');
		var id = $(this).attr('data-target-id');
		var group_name = $(this).parent().parent().children('#px-system-useraccess-group-name-text').text();
		$('#px-system-useraccess-form').attr('action',target_form);
		$.ajax({
			url : target,
			type : 'POST',
			dataType : 'json',
			data : {'id':id},
			success : function(response){
				$('#px-system-useraccess-form-id-usergroup').addClass('hidden');
				$('#px-system-useraccess-form-id-usergroup').after('<label class="control-label" id="px-system-useraccess-group-label"><strong>'+group_name+'</strong></label>');
				$('#px-system-useraccess-form-id').val(id);
				$('#px-system-useraccess-form [type="checkbox"]').removeAttr('checked');
				$.each(response.data.row, function(i, data){
					$('[name="id_menu[]"][value="'+data.id_menu+'"]').before('<input type="hidden" name="id_useraccess['+data.id_menu+']" value="'+data.id+'">');
					if(data.act_read == 1)
						$('[type="checkbox"][name="act_read['+data.id_menu+']"]').prop('checked',true);
					if(data.act_create == 1)
						$('[type="checkbox"][name="act_create['+data.id_menu+']"]').prop('checked',true);
					if(data.act_update == 1)
						$('[type="checkbox"][name="act_update['+data.id_menu+']"]').prop('checked',true);
					if(data.act_delete == 1)
						$('[type="checkbox"][name="act_delete['+data.id_menu+']"]').prop('checked',true);
				});
				$('#px-system-useraccess-modal').modal('show');
			},
			error : function(jqXHR, textStatus, errorThrown) {
				alert(textStatus, errorThrown);
			}
		});
	});
	$('body').delegate('.btn-delete','click',function(){
		var id = $(this).attr('data-target-id');
		$('#px-system-useraccess-message-form input[name="id"]').val('');
		$('#px-system-useraccess-message-form input[name="id"]').val(id);
		$('#px-system-useraccess-message-box').addClass('open');
	});
	$('#px-system-useraccess-modal').on('hidden.bs.modal', function (e) {
		$('#px-system-useraccess-form').validate().resetForm();
	});
	$('#px-system-useraccess-modal').on('shown.bs.modal', function (e) {
		$('#px-system-useraccess-form').validate().resetForm();
	});
	$('.px-system-useraccess-form-useraccess-grant-check').click(function(){
		var target = $(this).attr('data-grant');
		if($(this).is(':checked'))
			$('.act_'+target).prop('checked',true);
		else
			$('.act_'+target).prop('checked',false);
	})
})