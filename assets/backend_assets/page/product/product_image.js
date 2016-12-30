$(document).ready(function(){
	var ratio = $('[name="orientation"]').val();
	var a = 1.4;
	var b = 1;
	var w = 140;
	var h = 100;
	$('#px-product-productimage-form').validate({
		ignore: [],
		rules: {                                            
			content: {
				required: true
			}
		},
		submitHandler: function(form) {
			var target = $(form).attr('action');
			$('#px-product-productimage-form .alert-warning').removeClass('hidden');
			$('#px-product-productimage-form .alert-success').addClass('hidden');
			$('#px-product-productimage-form .alert-danger').addClass('hidden');
			$.ajax({
				url : target,
				type : 'POST',
				dataType : 'json',
				data : $(form).serialize(),
				success : function(response){
					$('#px-product-productimage-form .alert-warning').addClass('hidden');
					if(response.status == 'ok'){
						$('#px-product-productimage-form .alert-success').removeClass('hidden').children('span').text(response.msg);
						window.location.href = response.redirect;
					}
					else
						$('#px-product-productimage-form .alert-danger').removeClass('hidden').children('span').text(response.msg);	
				},
				error : function(jqXHR, textStatus, errorThrown) {
					alert(textStatus, errorThrown);
				}
			});
		}
	});
	$('#px-product-productimage-message-form').validate({
		ignore: [],
		rules: {                                            
			id: {
				required: true
			}
		},
		submitHandler: function(form) {
			var target = $(form).attr('action');
			$('#px-product-productimage-message-form .msg-status').text('Deleting data');
			$.ajax({
				url : target,
				type : 'POST',
				dataType : 'json',
				data : $(form).serialize(),
				success : function(response){
					if(response.status == 'ok'){
						$('#px-product-productimage-message-form .msg-status').text('Delete Success...');
						window.location.href = response.redirect;
					}
					else
						$('#px-product-productimage-message-form .msg-status').text('Delete Failed');	
				},
				error : function(jqXHR, textStatus, errorThrown) {
					alert(textStatus, errorThrown);
				}
			});
		}
	});
	$('.btn-add').click(function(){
		var target_form = $(this).attr('data-target-form');
		$('#px-product-productimage-form').attr('action',target_form);
		$('#px-product-productimage-form-id').val('');
		$('#px-product-productimage-form-caption').val('');
		$('#preview-photo').addClass('hidden');
		$('#px-product-productimage-modal').modal('show');
	});
	$('body').delegate('.btn-edit','click',function(){
		var target_form = $(this).attr('data-target-form');
		var target = $(this).attr('data-target-get');
		var id = $(this).attr('data-target-id');
		$('#px-product-productimage-form').attr('action',target_form);
		$.ajax({
			url : target,
			type : 'POST',
			dataType : 'json',
			data : {'id':id},
			success : function(response){
				$('#px-product-productimage-form-id').val(response.data.row.id);
				$('#px-product-productimage-form-caption').val(response.data.row.caption);
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
				$('#px-product-productimage-modal').modal('show');
			},
			error : function(jqXHR, textStatus, errorThrown) {
				alert(textStatus, errorThrown);
			}
		});
	});
	$('body').delegate('.btn-delete','click',function(){
		var id = $(this).attr('data-target-id');
		$('#px-product-productimage-message-form input[name="id"]').val('');
		$('#px-product-productimage-message-form input[name="id"]').val(id);
		$('#px-product-productimage-message-box').addClass('open');
	});
	$('#px-product-productimage-modal').on('hidden.bs.modal', function (e) {
		$('#px-product-productimage-form').validate().resetForm();
	});
	$('#px-product-productimage-modal').on('shown.bs.modal', function (e) {
		$('#px-product-productimage-form').validate().resetForm();
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
			$('#px-product-productimage-fileupload-'+target+'-progress').text(progress+'%');
			$('#px-product-productimage-fileupload-'+target+'-upload-button').attr('disabled',true);
		}).on('fileuploaddone', function (e, data) {
			var target = $('#target-file').val();
			$('#px-product-productimage-fileupload-'+target+'-upload-button').removeAttr('disabled');
                        a = 1.17;
                        w = 117;
                        b = 1 ;
                        h = 100;
			$('#px-product-pageimage-fileupload-'+target+'-upload-button').removeAttr('disabled');
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
			$('#px-product-productimage-fileupload-upload-button').removeAttr('disabled');
		}).on('fileuploadalways', function() {
	});
		$('[name="orientation"]').click(function(){
		ratio = $(this).val();
			$('#image-crop-previews').removeAttr('class').addClass('image-crop-previews');
			a = 1.17;
			w = 117;
			b = 1 ;
			h = 100;
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