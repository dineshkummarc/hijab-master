$(document).ready(function(){
	var ratio = $('[name="orientation"]').val();
	var a = 1;
	var b = 1;
	var w = 100;
	var h = 100;
	$('#px-sitecontent-albumimage-form').validate({
		ignore: [],
		rules: {                                            
			content: {
				required: true
			}
		},
		submitHandler: function(form) {
			var target = $(form).attr('action');
			$('#px-sitecontent-albumimage-form .alert-warning').removeClass('hidden');
			$('#px-sitecontent-albumimage-form .alert-success').addClass('hidden');
			$('#px-sitecontent-albumimage-form .alert-danger').addClass('hidden');
			$.ajax({
				url : target,
				type : 'POST',
				dataType : 'json',
				data : $(form).serialize(),
				success : function(response){
					$('#px-sitecontent-albumimage-form .alert-warning').addClass('hidden');
					if(response.status == 'ok'){
						$('#px-sitecontent-albumimage-form .alert-success').removeClass('hidden').children('span').text(response.msg);
						window.location.href = response.redirect;
					}
					else
						$('#px-sitecontent-albumimage-form .alert-danger').removeClass('hidden').children('span').text(response.msg);	
				},
				error : function(jqXHR, textStatus, errorThrown) {
					alert(textStatus, errorThrown);
				}
			});
		}
	});
	$('#px-sitecontent-albumimage-message-form').validate({
		ignore: [],
		rules: {                                            
			id: {
				required: true
			}
		},
		submitHandler: function(form) {
			var target = $(form).attr('action');
			$('#px-sitecontent-albumimage-message-form .msg-status').text('Deleting data');
			$.ajax({
				url : target,
				type : 'POST',
				dataType : 'json',
				data : $(form).serialize(),
				success : function(response){
					if(response.status == 'ok'){
						$('#px-sitecontent-albumimage-message-form .msg-status').text('Delete Success...');
						window.location.href = response.redirect;
					}
					else
						$('#px-sitecontent-albumimage-message-form .msg-status').text('Delete Failed');	
				},
				error : function(jqXHR, textStatus, errorThrown) {
					alert(textStatus, errorThrown);
				}
			});
		}
	});
	$('.btn-add').click(function(){
		var target_form = $(this).attr('data-target-form');
		$('#px-sitecontent-albumimage-form').attr('action',target_form);
		$('#px-sitecontent-albumimage-form-id').val('');
		$('#px-sitecontent-albumimage-form-caption').val('');
		$('#preview-photo').addClass('hidden');
		$('#px-sitecontent-albumimage-modal').modal('show');
	});
	$('body').delegate('.btn-edit','click',function(){
		var target_form = $(this).attr('data-target-form');
		var target = $(this).attr('data-target-get');
		var id = $(this).attr('data-target-id');
		$('#px-sitecontent-albumimage-form').attr('action',target_form);
		$.ajax({
			url : target,
			type : 'POST',
			dataType : 'json',
			data : {'id':id},
			success : function(response){
				$('#px-sitecontent-albumimage-form-id').val(response.data.row.id);
				$('#px-sitecontent-albumimage-form-caption').val(response.data.row.caption);
				if(response.data.row.photo_status == 'ok'){
					$('[name="old_photo"]').val(response.data.row.file);
					$('#preview-photo img').attr('src',response.data.row.photo_file);
					$('#preview-photo').removeClass('hidden');
				}
				else{
					$('[name="old_photo"]').val(response.data.row.file);
					$('#preview-photo img').attr('src',response.data.row.photo_file);
					$('#preview-photo').addClass('hidden');
				}
				$('#px-sitecontent-albumimage-modal').modal('show');
			},
			error : function(jqXHR, textStatus, errorThrown) {
				alert(textStatus, errorThrown);
			}
		});
	});
	$('body').delegate('.btn-delete','click',function(){
		var id = $(this).attr('data-target-id');
		$('#px-sitecontent-albumimage-message-form input[name="id"]').val('');
		$('#px-sitecontent-albumimage-message-form input[name="id"]').val(id);
		$('#px-sitecontent-albumimage-message-box').addClass('open');
	});
	$('#px-sitecontent-albumimage-modal').on('hidden.bs.modal', function (e) {
		$('#px-sitecontent-albumimage-form').validate().resetForm();
	});
	$('#px-sitecontent-albumimage-modal').on('shown.bs.modal', function (e) {
		$('#px-sitecontent-albumimage-form').validate().resetForm();
		origImageVal();
		var imgwidth = $('#original-image').width();
		var imgheight = $('#original-image').height();
		$('#fakeheight').val(imgheight);
		$('#fakewidth').val(imgwidth);
		var ratios = a / b;
		$('#original-image').Jcrop({
			onChange: showPreview,
			onSelect: showPreview,
			aspectRatio: ratios
		});
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
			$('#px-sitecontent-albumimage-fileupload-'+target+'-progress').text(progress+'%');
			$('#px-sitecontent-albumimage-fileupload-'+target+'-upload-button').attr('disabled',true);
		}).on('fileuploaddone', function (e, data) {
			var target = $('#target-file').val();
			$('#px-sitecontent-albumimage-fileupload-'+target+'-upload-button').removeAttr('disabled');
			if(ratio == 'landscape'){
				$('#image-crop-previews').removeAttr('class').addClass('image-crop-previews');
				a = 1;
				w = 100;
				b = 1 ;
				h = 100;
			}
			else {
				$('#image-crop-previews').removeAttr('class').addClass('image-crop-previews-pot');
				a = 1;
				w = 100;
				b = 1;
				h = 100;
			}
			$('#px-site-content-pageimage-fileupload-'+target+'-upload-button').removeAttr('disabled');
			$('#preview-'+target).removeClass('hidden');
			$('[name="'+target+'"]').val(data.result);
			$('#image-original-previews').html('<img src="'+data.result+'" alt="preview" id="original-image">');
			$('#image-crop-previews').html('<img src="'+data.result+'" alt="preview" id="crop-image">');
			$('#image').val(data.result);
			origImageVal();
			var ratios = a / b;
			$('#original-image').Jcrop({
				onChange: showPreview,
				onSelect: showPreview,
				aspectRatio: ratios,
				setSelect:  [ 0, 12, 569, 227.6 ]
			});
		}).on('fileuploadfail', function (e, data) {
			alert('File upload failed.');
			$('#px-sitecontent-albumimage-fileupload-upload-button').removeAttr('disabled');
		}).on('fileuploadalways', function() {
	});
		$('[name="orientation"]').click(function(){
		ratio = $(this).val();
		if(ratio == 'landscape'){
			$('#image-crop-previews').removeAttr('class').addClass('image-crop-previews');
			a = 1;
			w = 100;
			b = 1 ;
			h = 100;
		}
		else {
			$('#image-crop-previews').removeAttr('class').addClass('image-crop-previews-pot');
			a = 1;
			w = 100;
			b = 1;
			h = 100;
		}
		var ratios = a / b;
		$('#original-image').Jcrop({
			onChange: showPreview,
			onSelect: showPreview,
			aspectRatio: ratios
		});
	});
	function origImageVal(){
		var origImg = new Image();
		origImg.src = $('#original-image').attr('src');
		origImg.onload = function() {
			var origheight = origImg.height;
			var origwidth = origImg.width;
			$('#origheight').val(origheight);
			$('#origwidth').val(origwidth);
		}
	}
	function showPreview(coords)
	{
		var image_asli = $('#original-image').attr('src');
		var imgwidth = $('#original-image').width();
		var imgheight = $('#original-image').height();
		$('#fakeheight').val(imgheight);
		$('#fakewidth').val(imgwidth);
		var rx = w / coords.w;
		var ry = h / coords.h;

		$('#crop-image').attr('src',image_asli).css({
			width: Math.round(rx * imgwidth) + 'px',
			height: Math.round(ry * imgheight) + 'px',
			marginLeft: '-' + Math.round(rx * coords.x) + 'px',
			marginTop: '-' + Math.round(ry * coords.y) + 'px'
		});
		$('#x').val(coords.x);
		$('#y').val(coords.y);
		$('#w').val(coords.w);
		$('#h').val(coords.h);
	}
	$('.btn-upload').click(function(){
		var target = $(this).attr('data-target');
		var old_temp = $('[name="'+target+'"]').val();
		$('#file-upload #target-file').val(target);
		$('#file-upload #old-file').val(old_temp);
	})
})