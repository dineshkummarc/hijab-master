$(document).ready(function(){
	$('#px-site-content-album-message-form').validate({
		ignore: [],
		rules: {                                            
			id: {
				required: true
			}
		},
		submitHandler: function(form) {
			var target = $(form).attr('action');
			$('#px-site-content-album-message-form .msg-status').text('Deleting data');
			$.ajax({
				url : target,
				type : 'POST',
				dataType : 'json',
				data : $(form).serialize(),
				success : function(response){
					if(response.status == 'ok'){
						$('#px-site-content-album-message-form .msg-status').text('Delete Success...');
						window.location.href = response.redirect;
					}
					else
						$('#px-site-content-album-message-form .msg-status').text('Delete Failed');	
				},
				error : function(jqXHR, textStatus, errorThrown) {
					alert(textStatus, errorThrown);
				}
			});
		}
	});
	$('body').delegate('.btn-delete','click',function(){
		$('#px-site-content-album-message-box').addClass('open');
		var id = $(this).attr('data-target-id');
		$('#px-site-content-album-message-form input[name="id"]').val('');
		$('#px-site-content-album-message-form input[name="id"]').val(id);
	});
	$('body').delegate('.btn-status','click',function(){
		var id = $(this).attr('data-id');
		var target = $(this).attr('data-target');
		var status = $(this).children('input').val();
		var update_status = 0;
		if(status == 1){
			update_status = 0;
			$(this).children('input').val(0);
		}
		else{
			update_status = 1;
			$(this).children('input').val(1);
		}
		$.ajax({
			url : target,
			type : 'POST',
			dataType : 'json',
			data : {
				'id_album' : id,
				'status' : update_status
			},
			success : function(response){
					console.log(response.status+' and '+response.msg);	
			},
			error : function(jqXHR, textStatus, errorThrown) {
				alert(textStatus, errorThrown);
			}
		});
	});
})