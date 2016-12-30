$(document).ready(function(){
	$('#px-system-my-profile-form').validate({
		ignore: [],
		rules: {                                            
			username: {
				required: true,
				remote:
				{
					url: 'admin_system/user_check_username',
					type: "post",
					data:
					{
						username: function()
						{
							return $('#px-system-my-profile-form #px-system-my-profile-form-username').val();
						},
						id : function()
						{
							return $('#px-system-my-profile-form #px-system-my-profile-form-id').val();
						}
					}
				}
			},
			realname: {
				required: true
			},
			password: {
				required: true
			},
			'c-password': {
				equalTo: '#px-system-my-profile-form-password'
			},
			email: {
				required: true,
				remote:
				{
					url: 'admin_system/user_check_email',
					type: "post",
					data:
					{
						email: function()
						{
							return $('#px-system-my-profile-form #px-system-my-profile-form-email').val();
						},
						id : function()
						{
							return $('#px-system-my-profile-form #px-system-my-profile-form-id').val();
						}
					}
				}
			}
		},
		messages: {
			email:
			{
				required: "Please enter your email address.",
				email: "Please enter a valid email address.",
				remote: jQuery.validator.format("{0} is already taken.")
			},
			username:
			{
				required: "Please enter your username.",
				remote: jQuery.validator.format("{0} is already taken.")
			}
		},
		submitHandler: function(form) {
			var target = $(form).attr('action');
			$('#px-system-my-profile-form .alert-warning').removeClass('hidden');
			$('#px-system-my-profile-form .alert-success').addClass('hidden');
			$('#px-system-my-profile-form .alert-danger').addClass('hidden');
			$.ajax({
				url : target,
				type : 'POST',
				dataType : 'json',
				data : $(form).serialize(),
				success : function(response){
					$('#px-system-my-profile-form .alert-warning').addClass('hidden');
					if(response.status == 'ok'){
						$('#px-system-my-profile-form .alert-success').removeClass('hidden').children('span').text(response.msg);
						window.location.href = response.redirect;
					}
					else
						$('#px-system-my-profile-form .alert-danger').removeClass('hidden').children('span').text(response.msg);	
				},
				error : function(jqXHR, textStatus, errorThrown) {
					alert(textStatus, errorThrown);
				}
			});
		}
	});
	$("#file-upload").fileupload({
		dataType: 'text',
		autoUpload: false,
		acceptFileTypes: /(\.|\/)(gif|jpe?g|png)$/i,
		maxFileSize: 5000000 // 5 MB
		}).on('fileuploadadd', function(e, data) {
			data.process();
		}).on('fileuploadprocessalways', function (e, data) {
		if (data.files.error) {
			data.abort();
			alert('Image file must be jpeg/jpg, png or gif with less than 5MB');
		} else {
			data.submit();
		}
		}).on('fileuploadprogressall', function (e, data) {
			var progress = parseInt(data.loaded / data.total * 100, 10);
			var target = $('#target-file').val();
			$('#px-system-my-profile-fileupload-'+target+'-progress').text(progress+'%');
			$('#px-system-my-profile-fileupload-'+target+'-upload-button').attr('disabled',true);
		}).on('fileuploaddone', function (e, data) {
			var target = $('#target-file').val();
			$('#px-system-my-profile-fileupload-'+target+'-upload-button').removeAttr('disabled');
			$('#preview_'+target+' a').attr('href',data.result);
			$('#preview_'+target+' img').attr('src',data.result);
			$('[name="'+target+'"]').val(data.result);
		}).on('fileuploadfail', function (e, data) {
			alert('File upload failed.');
			$('#px-system-my-profile-fileupload-upload-button').removeAttr('disabled');
		}).on('fileuploadalways', function() {
	});
	$('.btn-upload').click(function(){
		var target = $(this).attr('data-target');
		var old_temp = $('[name="'+target+'"]').val();
		$('#file-upload #target-file').val(target);
		$('#file-upload #old-file').val(old_temp);
	});
	$('.btn-show-pass').click(function(){
		var status = $(this).attr('data-status');
		if(status == 'hidden'){
			$(this).attr('data-status','visible');
			$(this).removeClass('fa-eye-slash').addClass('fa-eye');
			$('#px-system-my-profile-form-password').attr('type','text');
			$('#px-system-my-profile-form-c-password').attr('type','text');
		}
		else{
			$(this).attr('data-status','hidden');
			$(this).removeClass('fa-eye').addClass('fa-eye-slash');
			$('#px-system-my-profile-form-password').attr('type','password');
			$('#px-system-my-profile-form-c-password').attr('type','password');
		}
	})
})