$(document).ready(function(){
	$('#form-update-pass').validate({
		ignore: [],
		rules: {
			oldpassword: {
				required: true,
			},
			password: {
				required: true,
				rangelength: [4, 12]
			},
			cpassword: {
				required: true,
				rangelength: [4, 12]
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
		           $('.update-pass-msg').html(response.msg);
		          } else {
		          	$('.update-pass-msg').html(response.msg);
		          }
		        },
		        error : function(jqXHR, textStatus, errorThrown) {
		          alert(textStatus, errorThrown);
		        }
		      });
		}
	})

	
})