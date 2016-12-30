$(document).ready(function(){
	$('#px-site-content-banner-message-form').validate({
		ignore: [],
		rules: {                                            
			id: {
				required: true
			}
		},
		submitHandler: function(form) {
			var target = $(form).attr('action');
			$('#px-site-content-banner-message-form .msg-status').text('Deleting data');
			$.ajax({
				url : target,
				type : 'POST',
				dataType : 'json',
				data : $(form).serialize(),
				success : function(response){
					if(response.status == 'ok'){
						$('#px-site-content-banner-message-form .msg-status').text('Delete Success...');
						window.location.href = response.redirect;
					}
					else
						$('#px-site-content-banner-message-form .msg-status').text('Delete Failed');	
				},
				error : function(jqXHR, textStatus, errorThrown) {
					alert(textStatus, errorThrown);
				}
			});
		}
	});
	$('body').delegate('.btn-delete','click',function(){
		$('#px-site-content-banner-message-box').addClass('open');
		var id = $(this).attr('data-target-id');
		$('#px-site-content-banner-message-form input[name="id"]').val('');
		$('#px-site-content-banner-message-form input[name="id"]').val(id);
	});
})