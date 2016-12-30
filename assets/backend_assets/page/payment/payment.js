$(document).ready(function(){
	$('body').delegate('.btn-delete','click',function(){
		$('#px-payment-payment-message-box').addClass('open');
		var id = $(this).attr('data-target-id');
		$('#px-payment-payment-message-form input[name="id"]').val('');
		$('#px-payment-payment-message-form input[name="id"]').val(id);
	});
})