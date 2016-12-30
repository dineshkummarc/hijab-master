$(document).ready(function(){
	$('body').delegate('.btn-delete','click',function(){
		$('#px-guest-book-guestbook-message-box').addClass('open');
	});
	$('body').delegate('.btn-do-delete','click',function(){
		$.ajax({
			url : $('#px-guest-book-form').attr('action'),
			type : 'POST',
			dataType : 'json',
			data : $('#px-guest-book-form').serialize(),
			success : function(response){
				if(response.status == 'ok'){
					$('#px-guest-book-guestbook-message-form .msg-status').text('Delete Success...');
					window.location.href = response.redirect;
				}
				else
					$('#px-guest-book-guestbook-message-form .msg-status').text('Delete Failed');	
			},
			error : function(jqXHR, textStatus, errorThrown) {
				alert(textStatus, errorThrown);
			}
		});
	});
});