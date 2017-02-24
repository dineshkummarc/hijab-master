$(document).ready(function(){
	$('#form-order-confirmation').validate({
		ignore: [],
		rules: {
			code: {
				required: true
			},
			acc_name: {
				required: true
			},
			acc_bank: {
				required: true
			},
			bank_target: {
				required: true
			},
			tot_payment: {
				required: true
			},
			date_tf: {
				required: true
			}
		},
		submitHandler: function(form) {
			 var target = $(form).attr('action');
			 $.ajax({
		        url : target,
		        type : 'POST',
		        dataType : 'json',
		        data : $(form).serialize(),
		        success : function(response){
		          if(response.status == 'ok'){
		           $('.order-confirm-msg').html(response.msg);
		           $('#form-order-confirmation').find("input[type=text], input[type=date], select").val("");
		          } else {
		          	$('.order-confirm-msg').html(response.msg);
		          	$('#form-order-confirmation').find("input[type=text], input[type=date], select").val("");
		          }

		        },
		        error : function(jqXHR, textStatus, errorThrown) {
		          alert(textStatus, errorThrown);
		        }
		      });
		}
	});
})