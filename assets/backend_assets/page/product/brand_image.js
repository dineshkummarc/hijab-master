$(document).ready(function(){
	$('#pixel-warehouse-productimage-form').bootstrapValidator({
		excluded: [':disabled', ':hidden', ':not(:visible)'],
		feedbackIcons: {
			valid: '',
			invalid: '',
			validating: ''
		},
		live: 'enabled',
		message: 'Form tidak valid',
		submitButtons: '#pixel-warehouse-productimage-add-button',
		fields: {
			'productimage-caption': {
				validators: {
					notEmpty: {
						message: 'Required'
					}
				}
			}
		}
	}).on('success.form.bv', function(e) {
		$('#pixel-warehouse-productimage-form .alert-danger').addClass('hidden').text('');
		$('#pixel-warehouse-productimage-form .alert-success').addClass('hidden').text('');
		$('#pixel-warehouse-productimage-form .alert-warning').removeClass('hidden').text('Please Wait');
		e.preventDefault();
		var $form = $(e.target);
		var bv = $form.data('bootstrapValidator');
		$.ajax({
			url : $form.attr('action'),
			dataType : 'json',
			data : $form.serialize(),
			type : 'POST',
			success : function(result){
				$('#pixel-warehouse-productimage-form .alert-warning').addClass('hidden').text('');
				if(result.status == 'ok'){
					$('#pixel-warehouse-productimage-form .alert-danger').addClass('hidden').text('');
					$('#pixel-warehouse-productimage-form .alert-success').removeClass('hidden').text(result.message);
					window.location.href = result.redirect;
				}
				else {
					$('#pixel-warehouse-productimage-form .alert-success').addClass('hidden').text('');
					$('#pixel-warehouse-productimage-form .alert-danger').removeClass('hidden').text(result.message);
				}
			}
		})
	});
	$('.btn-pop').click(function(){
		target = $(this).attr('data-target-add');
		$('#pixel-warehouse-productimage-form .alert-danger').addClass('hidden').text('');
		$('#pixel-warehouse-productimage-form .alert-success').addClass('hidden').text('');
		$('#pixel-warehouse-productimage-form .alert-warning').addClass('hidden').text('');
		$('#pixel-warehouse-productimage-form').attr('action',target);
		$('#warehouse-productimage-id').val('');
		$('#warehouse-productimage-caption').val('');
		$('#image').val('');
		$('#old-image').val('');
		$('.image-original-preview').html('');
		$('.image-productimage-crop-preview').html('');
	});
	$('body').delegate('.btn-edit','click',function(){
		$('#pixel-warehouse-productimage-form .alert-danger').addClass('hidden').text('');
		$('#pixel-warehouse-productimage-form .alert-success').addClass('hidden').text('');
		$('#pixel-warehouse-productimage-form .alert-warning').addClass('hidden').text('');
		var target = $(this).attr('data-target-edit');
		var target_get = $(this).attr('data-target-get-data');
		var id = $(this).attr('data-target-id');
		$.ajax({
			url : target_get,
			type : 'POST',
			dataType : 'json',
			data : {'id':id},
			success : function(result){
				$('#pixel-warehouse-productimage-form').attr('action',target);
				$('#warehouse-productimage-id').val(result.data.id);
				$('#warehouse-productimage-caption').val(result.data.caption);
				$('#old-image').val(result.data.image);
				$('.image-original-preview').html('<img src="assets/uploads/brand/'+result.data.id+'/'+result.data.photo+'" alt="images" id="original-image"/>');
				$('.image-productimage-crop-preview').html('<img src="assets/uploads/brand/'+result.data.id+'/'+result.data.photo+'" alt="images" id="crop-image"/>');
				origImageVal();
				$('#pixel-modal-warehouse-productimage').modal('show');
			},	
			error : function(){
				alert('Error, Please Try Again');
			}
		})
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
			$('#warehouse-productimage-progress .progress-bar').attr('aria-valuenow',progress).attr('style','width:'+progress+'%');
			$('#warehouse-productimage-upload-button').attr('disabled',true);
		}).on('fileuploaddone', function (e, data) {
			$('#warehouse-productimage-upload-button').removeAttr('disabled');
			$('.image-original-preview').html('<img src="'+data.result+'" alt="preview" id="original-image">');
			$('.image-productimage-crop-preview').html('<img src="'+data.result+'" alt="preview" id="crop-image">');
			$('#image').val(data.result);
			origImageVal();
			$('#original-image').Jcrop({
				onChange: showPreview,
				onSelect: showPreview,
				aspectRatio: 575 / 491,
				setSelect:  [ 0, 12, 569, 227.6 ]
			});
		}).on('fileuploadfail', function (e, data) {
			alert('File upload failed.');
			$('#warehouse-productimage-upload-button').removeAttr('disabled');
		}).on('fileuploadalways', function() {
	});
	$('#pixel-modal-warehouse-productimage').on('shown.bs.modal', function (e) {
		var imgwidth = $('#original-image').width();
		var imgheight = $('#original-image').height();
		$('#fakeheight').val(imgheight);
		$('#fakewidth').val(imgwidth);
		$('#original-image').Jcrop({
			onChange: showPreview,
			onSelect: showPreview,
			aspectRatio: 575 / 491
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
		var rx = 575 / coords.w;
		var ry = 491 / coords.h;

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
});