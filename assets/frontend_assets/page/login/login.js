$(document).ready(function(){
	$('#form-login').validate({
		ignore: [],
		rules: {
			email: {
				required: true,
				email: true
			},
			password: {
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
		            window.location.href = response.redirect;
		          } else {
		          	$('.login-msg').html(response.msg);
		          }
		        },
		        error : function(jqXHR, textStatus, errorThrown) {
		          alert(textStatus, errorThrown);
		        }
		      });
		}
	})

	
})