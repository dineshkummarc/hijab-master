$(document).ready(function(){
	$('#px-site-content-album-form').validate({
		rules: {                                            
			name: {
				required: true
			}
		},
		submitHandler: function(form) {
			var target = $(form).attr('action');
			$('#px-site-content-album-form .alert-warning').removeClass('hidden');
			$('#px-site-content-album-form .alert-success').addClass('hidden');
			$('#px-site-content-album-form .alert-danger').addClass('hidden');
			$('.px-summernote').each(function() {
				$(this).val($(this).code());
			});
			$.ajax({
				url : target,
				type : 'POST',
				dataType : 'json',
				data : $(form).serialize(),
				success : function(response){
					$('#px-site-content-album-form .alert-warning').addClass('hidden');
					if(response.status == 'ok'){
						$('#px-site-content-album-form .alert-success').removeClass('hidden').children('span').text(response.msg);
						window.location.href = response.redirect;
					}
					else
						$('#px-site-content-album-form .alert-danger').removeClass('hidden').children('span').text(response.msg);	
				},
				error : function(jqXHR, textStatus, errorThrown) {
					alert(textStatus, errorThrown);
				}
			});
		}
	});
	$('#px-site-content-album-form-summary,#px-site-content-album-form-description').summernote({
		toolbar: [
			['font', ['bold', 'italic', 'underline', 'clear']],
			['insert', ['link']]
		],
		height: '300px'
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
			$('#px-site-content-'+target+'-form-file-upload-progress').text('Upload Progress '+progress+'%');
		}).on('fileuploaddone', function (e, data) {
			var target = $('#target-file').val();
			var preview_template = '<a class="gallery-item">'
										+'<div class="col-sm-12 col-md-12">'
										+'<span class="btn-delete-file">Hapus</span>'
										+'<input type="hidden" name="album[]" value="'+data.result+'">'
										+'<div class="image">'
											+'<img src="'+data.result+'" alt="project"/>'                                                                                                          
										+'</div>'
										+'<input class="form-control" type="text" name="album_image_caption[]" value="" placeholder="Caption">                            '                            
										+'</div>'
									+'</a>';	
			$('#preview-'+target).append(preview_template);
		}).on('fileuploadfail', function (e, data) {
			alert('File upload failed.');
		}).on('fileuploadalways', function() {
	});
	$('.btn-upload').click(function(){
		var target = $(this).attr('data-target');
		var old_temp = $('[name="'+target+'"]').val();
		$('#file-upload #target-file').val(target);
		$('#file-upload #old-file').val(old_temp);
	});
	$('body').delegate('.btn-delete-file','click',function(){
		$(this).parent().remove();
	});
})