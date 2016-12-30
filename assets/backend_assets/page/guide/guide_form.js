$(document).ready(function(){
	$('#px-guide-guide-form').validate({
		rules: {                                            
			title: {
				required: true
			}
		},
		submitHandler: function(form) {
			var target = $(form).attr('action');
			$('#px-guide-guide-form .alert-warning').removeClass('hidden');
			$('#px-guide-guide-form .alert-success').addClass('hidden');
			$('#px-guide-guide-form .alert-danger').addClass('hidden');
			$('.px-summernote').each(function() {
				$(this).val($(this).code());
			});
			$.ajax({
				url : target,
				type : 'POST',
				dataType : 'json',
				data : $(form).serialize(),
				success : function(response){
					$('#px-guide-guide-form .alert-warning').addClass('hidden');
					if(response.status == 'ok'){
						$('#px-guide-guide-form .alert-success').removeClass('hidden').children('span').text(response.msg);
						window.location.href = response.redirect;
					}
					else
						$('#px-guide-guide-form .alert-danger').removeClass('hidden').children('span').text(response.msg);	
				},
				error : function(jqXHR, textStatus, errorThrown) {
					alert(textStatus, errorThrown);
				}
			});
		}
	});
	$('#px-guide-guide-form-guide-content').summernote({
		toolbar: [
			['style', ['style']],
			['font', ['bold', 'italic', 'underline', 'clear']],
			['fontname', ['fontname']],
			['color', ['color']],
			['para', ['ul', 'ol', 'paragraph']],
			['height', ['height']],
			['table', ['table']],
			['insert', ['link', 'picture', 'hr']],
			['view', ['fullscreen', 'codeview']],
			['help', ['help']]
		],
		height: '300px',
		onImageUpload: function(files, editor, welEditable) {
            sendFile(files[0], editor, welEditable);
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
                $('#px-guide-guide-form .panel-body').after('<input type="hidden" name="images[]" value="'+url+'">');
            }
        });
    }
})