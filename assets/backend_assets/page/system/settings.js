$(document).ready(function(){
	$('#px-system-settings-form').validate({
		ignore: [],
		rules: {                                            
			title: {
				required: true
			},
			desc: {
				required: true
			}
		},
		submitHandler: function(form) {
			var target = $(form).attr('action');
			$('#px-system-settings-form .alert-warning').removeClass('hidden');
			$('#px-system-settings-form .alert-success').addClass('hidden');
			$('#px-system-settings-form .alert-danger').addClass('hidden');
			$.ajax({
				url : target,
				type : 'POST',
				dataType : 'json',
				data : $(form).serialize(),
				success : function(response){
					$('#px-system-settings-form .alert-warning').addClass('hidden');
					if(response.status == 'ok'){
						$('#px-system-settings-form .alert-success').removeClass('hidden').children('span').text(response.msg);
						window.location.href = response.redirect;
					}
					else
						$('#px-system-settings-form .alert-danger').removeClass('hidden').children('span').text(response.msg);	
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
			$('#px-system-settings-fileupload-'+target+'-progress').text(progress+'%');
			$('#px-system-settings-fileupload-'+target+'-upload-button').attr('disabled',true);
		}).on('fileuploaddone', function (e, data) {
			var target = $('#target-file').val();
			$('#px-system-settings-fileupload-'+target+'-upload-button').removeAttr('disabled');
			$('#preview_'+target+' a').attr('href',data.result);
			$('#preview_'+target+' img').attr('src',data.result);
			$('[name="'+target+'"]').val(data.result);
		}).on('fileuploadfail', function (e, data) {
			alert('File upload failed.');
			$('#px-system-settings-fileupload-upload-button').removeAttr('disabled');
		}).on('fileuploadalways', function() {
	});
	$('.btn-upload').click(function(){
		var target = $(this).attr('data-target');
		var old_temp = $('[name="'+target+'"]').val();
		$('#file-upload #target-file').val(target);
		$('#file-upload #old-file').val(old_temp);
	})

        $('#underconstruct_button').click(function(){
            var value = $(this).attr('data-value');
            $.ajax({
                url : 'admin_system/change_status_underconstruction',
                type : 'POST',
                dataType : 'json',
                data : {value:value},
                success : function(response){
                    if(response.status == 'ok')
                    {
                        if(response.underconstruct_status == 0)
                        {
                            $('#underconstruct_button').removeClass('btn-danger');
                            $('#underconstruct_button').addClass('btn-success');
                            $('#underconstruct_button').html('');
                            $('#underconstruct_button').html('Website Online');
                            $('#underconstruct_button').attr('data-value', response.underconstruct_status);
                        }
                        else
                        {
                            $('#underconstruct_button').removeClass('btn-success');
                            $('#underconstruct_button').addClass('btn-danger');
                            $('#underconstruct_button').html('');
                            $('#underconstruct_button').html('Website Underconstruction');
                            $('#underconstruct_button').attr('data-value', response.underconstruct_status);
                        }
                    }
                    else
                        alert('Perubahan Gagal, silahkan coba lagi');
                }
            });
        });
})