$(document).ready(function(){
	$('#px-system-menu-form').validate({
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
			$('#px-system-menu-form .alert-warning').removeClass('hidden');
			$('#px-system-menu-form .alert-success').addClass('hidden');
			$('#px-system-menu-form .alert-danger').addClass('hidden');
			$.ajax({
				url : target,
				type : 'POST',
				dataType : 'json',
				data : $(form).serialize(),
				success : function(response){
					$('#px-system-menu-form .alert-warning').addClass('hidden');
					if(response.status == 'ok'){
						$('#px-system-menu-form .alert-success').removeClass('hidden').children('span').text(response.msg);
						window.location.href = response.redirect;
					}
					else
						$('#px-system-menu-form .alert-danger').removeClass('hidden').children('span').text(response.msg);	
				},
				error : function(jqXHR, textStatus, errorThrown) {
					alert(textStatus, errorThrown);
				}
			});
		}
	});
	$('#px-system-menu-message-form').validate({
		ignore: [],
		rules: {                                            
			id: {
				required: true
			}
		},
		submitHandler: function(form) {
			var target = $(form).attr('action');
			$('#px-system-menu-message-form .msg-status').text('Deleting data');
			$.ajax({
				url : target,
				type : 'POST',
				dataType : 'json',
				data : $(form).serialize(),
				success : function(response){
					if(response.status == 'ok'){
						$('#px-system-menu-message-form .msg-status').text('Delete Success...');
						window.location.href = response.redirect;
					}
					else
						$('#px-system-menu-message-form .msg-status').text('Delete Failed');	
				},
				error : function(jqXHR, textStatus, errorThrown) {
					alert(textStatus, errorThrown);
				}
			});
		}
	});
	$('.btn-add').click(function(){
		var target_form = $(this).attr('data-target-form');
		$('#px-system-menu-form').attr('action',target_form);
		$('#px-system-menu-form-id').val('');
		$('#px-system-menu-form-name').val('');
		$('#px-system-menu-form-target').val('');
		$('#px-system-menu-form-id-parent option').removeAttr('selected');
		$('#px-system-menu-form-icon option').removeAttr('selected');
		$('#px-system-menu-form-icon-preview span').attr('class','fa fa-adjust');
		$('#px-system-menu-form-orders').val(0);
		$('#px-system-menu-modal').modal('show');
	});
	$('body').delegate('.btn-edit','click',function(){
		var target_form = $(this).attr('data-target-form');
		var target = $(this).attr('data-target-get');
		var id = $(this).attr('data-target-id');
		$('#px-system-menu-form').attr('action',target_form);
		$.ajax({
			url : target,
			type : 'POST',
			dataType : 'json',
			data : {'id':id},
			success : function(response){
				$('#px-system-menu-form-id').val(response.data.row.id);
				$('#px-system-menu-form-name').val(response.data.row.name);
				$('#px-system-menu-form-target').val(response.data.row.target);
				$('#px-system-menu-form-id-parent option[value="'+response.data.row.id_parent+'"]').prop('selected',true);
				$('#px-system-menu-form-icon option[value="'+response.data.row.icon+'"]').prop('selected',true);
				$('#px-system-menu-form-icon-preview span').attr('class','fa '+response.data.row.icon);
				$('#px-system-menu-form-orders').val(response.data.row.orders);
				$('#px-system-menu-modal').modal('show');
			},
			error : function(jqXHR, textStatus, errorThrown) {
				alert(textStatus, errorThrown);
			}
		});
	});
	$('body').delegate('.btn-delete','click',function(){
		var id = $(this).attr('data-target-id');
		$('#px-system-menu-message-form input[name="id"]').val('');
		$('#px-system-menu-message-form input[name="id"]').val(id);
		$('#px-system-menu-message-box').addClass('open');
	});
	$('#px-system-menu-modal').on('hidden.bs.modal', function (e) {
		$('#px-system-menu-form').validate().resetForm();
	});
	$('#px-system-menu-modal').on('shown.bs.modal', function (e) {
		$('#px-system-menu-form').validate().resetForm();
	});
	$('#px-system-menu-form-icon option').hover(function(){
		var icon = $(this).val();
		$('#px-system-menu-form-icon-preview span').attr('class','fa '+icon);
	})
})