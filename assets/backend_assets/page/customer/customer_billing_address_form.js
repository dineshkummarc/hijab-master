$(document).ready(function(){
    $('#px-customer-address-form').validate({
        rules: {                                            
            nama_depan: {
                required: true
            },
            nama_belakang: {
                required: true
            },
            username: {
                required: true,
                minlength: 12
            },
            password: {
                required: true
            },
            password_confirm: {
                required: true
            },
            tgl_lahir: {
                required: true
            }
        },
        submitHandler: function(form) {
            var target = $(form).attr('action');
            $('#px-customer-address-form .alert-warning').removeClass('hidden');
            $('#px-customer-address-form .alert-success').addClass('hidden');
            $('#px-customer-address-form .alert-danger').addClass('hidden');
            $('.px-summernote').each(function() {
                $(this).val($(this).code());
            });
            $.ajax({
                url : target,
                type : 'POST',
                dataType : 'json',
                data : $(form).serialize(),
                success : function(response){
                    $('#px-customer-address-form .alert-warning').addClass('hidden');
                    if(response.status == 'ok'){
                        $('#px-customer-address-form .alert-success').removeClass('hidden').children('span').text(response.msg);
                        window.location.href = response.redirect;
                    }
                    else
                        $('#px-customer-address-form .alert-danger').removeClass('hidden').children('span').text(response.msg);	
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
                $('#px-customer-address-form .panel-body').after('<input type="hidden" name="images[]" value="'+url+'">');
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
			$('#px-customer-address-fileupload-'+target+'-progress').text(progress+'%');
			$('#px-customer-address-fileupload-'+target+'-upload-button').attr('disabled',true);
		}).on('fileuploaddone', function (e, data) {
			var target = $('#target-file').val();
			$('#px-customer-address-fileupload-'+target+'-upload-button').removeAttr('disabled');
			$('#preview-'+target).removeClass('hidden');
			$('[name="'+target+'"]').val(data.result);
			$('#image-original-previews').html('<img src="'+data.result+'" alt="preview" id="original-image">');
			$('#image-crop-previews-banner_zakat').html('<img src="'+data.result+'" alt="preview" id="crop-image">');
			$('#image').val(data.result);
		}).on('fileuploadfail', function (e, data) {
			alert('File upload failed.');
			$('#px-customer-address-fileupload-upload-button').removeAttr('disabled');
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

    $('body').delegate('.province', 'click',function (){
        var id = $(this).val(); 
        $.ajax({
            url:'customer/city',
            type:'POST',
            dataType:'json',
            data : {
                'id':id
            },
            success: function(response)
            {
                if(response.status = 'ok')
                {
                    $('#px-customer-address-form-city').html("");
                        $.each(response.data, function(i, data){
                        {
                            $('#px-customer-address-form-city').append('<option value="'+data.id+'">'+data.type+' '+data.name+'</option>');
                        }
                    });
                }                        
            }
        });
    });

    $(".city").change(function (){
        var id = $(this).val();
        $.ajax({
            url:'customer/region',
            type:'POST',
            dataType:'json',
            data : {
                'id':id
            },
            success: function(response)
            {
                if(response.status = 'ok')
                {
                    $('#px-customer-address-form-region').html("");
                        $.each(response.data, function(i, data){
                        {
                            $('#px-customer-address-form-region').append('<option value="'+data.id+'">'+data.name+'</option>');
                        }
                    });
                }                        
            }
        });
    });
})