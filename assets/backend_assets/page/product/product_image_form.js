$(document).ready(function(){
    $('#px-product_image-form').validate({
        rules: {                                            
            product_id: {
                required: true
            }              
        },
        submitHandler: function(form) {
            var target = $(form).attr('action');
            $('#px-product_image-form .alert-warning').removeClass('hidden');
            $('#px-product_image-form .alert-success').addClass('hidden');
            $('#px-product_image-form .alert-danger').addClass('hidden');
            $('.px-summernote').each(function() {
                $(this).val($(this).code());
            });
            $.ajax({
                url : target,
                type : 'POST',
                dataType : 'json',
                data : $(form).serialize(),
                success : function(response){
                    $('#px-product_image-form .alert-warning').addClass('hidden');
                    if(response.status == 'ok'){
                        $('#px-product_image-form .alert-success').removeClass('hidden').children('span').text(response.msg);
                        window.location.href = response.redirect;
                    }
                    else
                        $('#px-product_image-form .alert-danger').removeClass('hidden').children('span').text(response.msg);	
                },
                error : function(jqXHR, textStatus, errorThrown) {
                    alert(textStatus, errorThrown);
                }
            });
        }
    });
    function sendFile(file, editor, welEditable) {
        data = new FormData();
        data.append('image', file);
        $.ajax({
            data: data,
            type: 'post',
            url: 'upload/image',
            cache: false,
            contentType: false,
            processData: false,
            success: function(url) {
                editor.insertImage(welEditable, url);
                $('#px-product_image-form .panel-body').after('<input type="hidden" name="images[]" value="'+url+'">');
            }
        });
    }
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
			$('#px-product_image-fileupload-'+target+'-progress').text(progress+'%');
			$('#px-product_image-fileupload-'+target+'-upload-button').attr('disabled',true);
		}).on('fileuploaddone', function (e, data) {
			var target = $('#target-file').val();
			$('#px-product_image-fileupload-'+target+'-upload-button').removeAttr('disabled');
			$('#preview-'+target).removeClass('hidden');
			$('[name="'+target+'"]').val(data.result);
			$('#image-original-previews').html('<img src="'+data.result+'" alt="preview" id="original-image">');
			$('#image-crop-previews-banner_zakat').html('<img src="'+data.result+'" alt="preview" id="crop-image">');
			$('#image').val(data.result);
		}).on('fileuploadfail', function (e, data) {
			alert('File upload failed.');
			$('#px-product_image-fileupload-upload-button').removeAttr('disabled');
		}).on('fileuploadalways', function() {
	});
        $('.btn-upload').click(function(){
		var target = $(this).attr('data-target');
		var old_temp = $('[name="'+target+'"]').val();
		$('#file-upload #target-file').val(target);
		$('#file-upload #old-file').val(old_temp);
	})
	$('body').delegate('.btn-delete-file','click',function(){
		$(this).parent().remove();
	});
})