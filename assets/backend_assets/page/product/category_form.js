$(document).ready(function(){
    $('#px-category-form').validate({
        rules: {                                            
            name: {
                required: true
            }
                        
        },
        submitHandler: function(form) {
            var target = $(form).attr('action');
            $('#px-category-form .alert-warning').removeClass('hidden');
            $('#px-category-form .alert-success').addClass('hidden');
            $('#px-category-form .alert-danger').addClass('hidden');
            $('.px-summernote').each(function() {
                $(this).val($(this).code());
            });
            $.ajax({
                url : target,
                type : 'POST',
                dataType : 'json',
                data : $(form).serialize(),
                success : function(response){
                    $('#px-category-form .alert-warning').addClass('hidden');
                    if(response.status == 'ok'){
                        $('#px-category-form .alert-success').removeClass('hidden').children('span').text(response.msg);
                        window.location.href = response.redirect;
                    }
                    else
                        $('#px-category-form .alert-danger').removeClass('hidden').children('span').text(response.msg);	
                },
                error : function(jqXHR, textStatus, errorThrown) {
                    alert(textStatus, errorThrown);
                }
            });
        }
    });
});

$(document).ready(function(){
    //potrait-form
    $('#category-image-potrait-form').bootstrapValidator({
        excluded: [':disabled', ':hidden', ':not(:visible)'],
        feedbackIcons: {
            valid: '',
            invalid: '',
            validating: ''
        },
        live: 'enabled',
        message: 'Form tidak valid',
        submitButtons: '#category-image-potrait-upload-button',
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
        $('#category-image-potrait-form .alert-danger').addClass('hidden').text('');
        $('#category-image-potrait-form .alert-success').addClass('hidden').text('');
        $('#category-image-potrait-form .alert-warning').removeClass('hidden').text('Please Wait');
        e.preventDefault();
        var $form = $(e.target);
        var bv = $form.data('bootstrapValidator');
        $.ajax({
            url : $form.attr('action'),
            dataType : 'json',
            data : $form.serialize(),
            type : 'POST',
            success : function(result){
                $('#category-image-potrait-form .alert-warning').addClass('hidden').text('');
                if(result.status == 'ok'){
                    $('#category-image-potrait-form .alert-danger').addClass('hidden').text('');
                    $('#category-image-potrait-form .alert-success').removeClass('hidden').text(result.message);
                    window.location.href = result.redirect;
                }
                else {
                    $('#category-image-potrait-form .alert-success').addClass('hidden').text('');
                    $('#category-image-potrait-form .alert-danger').removeClass('hidden').text(result.message);
                }
            }
        })
    });
    $('.btn-pop').click(function(){
        target = $(this).attr('data-target-add');
        $('#category-image-potrait-form .alert-danger').addClass('hidden').text('');
        $('#category-image-potrait-form .alert-success').addClass('hidden').text('');
        $('#category-image-potrait-form .alert-warning').addClass('hidden').text('');
        $('#category-image-potrait-form').attr('action',target);
        $('#warehouse-productimage-id').val('');
        $('#warehouse-productimage-caption').val('');
        $('#image').val('');
        $('#old-image').val('');
        $('.image-original-preview').html('');
        $('.category-image-crop-preview-potrait').html('');
    });
    $('body').delegate('.btn-edit','click',function(){
        $('#category-image-potrait-form .alert-danger').addClass('hidden').text('');
        $('#category-image-potrait-form .alert-success').addClass('hidden').text('');
        $('#category-image-potrait-form .alert-warning').addClass('hidden').text('');
        var target = $(this).attr('data-target-edit');
        var target_get = $(this).attr('data-target-get-data');
        var id = $(this).attr('data-target-id');
        $.ajax({
            url : target_get,
            type : 'POST',
            dataType : 'json',
            data : {'id':id},
            success : function(result){
                $('#category-image-potrait-form').attr('action',target);
                $('#warehouse-productimage-id').val(result.data.id);
                $('#warehouse-productimage-caption').val(result.data.caption);
                $('#old-image').val(result.filename);
                $('.image-original-preview').html('<img src="assets/uploads/category/'+result.data.id+'/'+result.filename+'" alt="images" id="original-image"/>');
                $('.category-image-crop-preview-potrait').html('<img src="assets/uploads/category/'+result.data.id+'/'+result.filename+'" alt="images" id="crop-image"/>');
                origImageVal();
                $('#upload-potrait').modal('show');
            },  
            error : function(){
                alert('Error, Please Try Again');
            }
        })
    });

    //landscape-form
     $('#category-image-landscape-form').bootstrapValidator({
        excluded: [':disabled', ':hidden', ':not(:visible)'],
        feedbackIcons: {
            valid: '',
            invalid: '',
            validating: ''
        },
        live: 'enabled',
        message: 'Form tidak valid',
        submitButtons: '#category-image-landscape-upload-button',
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
        $('#category-image-landscape-form .alert-danger').addClass('hidden').text('');
        $('#category-image-landscape-form .alert-success').addClass('hidden').text('');
        $('#category-image-landscape-form .alert-warning').removeClass('hidden').text('Please Wait');
        e.preventDefault();
        var $form = $(e.target);
        var bv = $form.data('bootstrapValidator');
        $.ajax({
            url : $form.attr('action'),
            dataType : 'json',
            data : $form.serialize(),
            type : 'POST',
            success : function(result){
                $('#category-image-landscape-form .alert-warning').addClass('hidden').text('');
                if(result.status == 'ok'){
                    $('#category-image-landscape-form .alert-danger').addClass('hidden').text('');
                    $('#category-image-landscape-form .alert-success').removeClass('hidden').text(result.message);
                    window.location.href = result.redirect;
                }
                else {
                    $('#category-image-landscape-form .alert-success').addClass('hidden').text('');
                    $('#category-image-landscape-form .alert-danger').removeClass('hidden').text(result.message);
                }
            }
        })
    });
    $('.btn-pop').click(function(){
        target = $(this).attr('data-target-add');
        $('#category-image-landscape-form .alert-danger').addClass('hidden').text('');
        $('#category-image-landscape-form .alert-success').addClass('hidden').text('');
        $('#category-image-landscape-form .alert-warning').addClass('hidden').text('');
        $('#category-image-landscape-form').attr('action',target);
        $('#warehouse-productimage-id').val('');
        $('#warehouse-productimage-caption').val('');
        $('#image').val('');
        $('#old-image').val('');
        $('.image-original-preview').html('');
        $('.category-image-crop-preview-landscape').html('');
    });
    $('body').delegate('.btn-edit','click',function(){
        $('#category-image-landscape-form .alert-danger').addClass('hidden').text('');
        $('#category-image-landscape-form .alert-success').addClass('hidden').text('');
        $('#category-image-landscape-form .alert-warning').addClass('hidden').text('');
        var target = $(this).attr('data-target-edit');
        var target_get = $(this).attr('data-target-get-data');
        var id = $(this).attr('data-target-id');
        $.ajax({
            url : target_get,
            type : 'POST',
            dataType : 'json',
            data : {'id':id},
            success : function(result){
                $('#category-image-landscape-form').attr('action',target);
                $('#warehouse-productimage-id').val(result.data.id);
                $('#warehouse-productimage-caption').val(result.data.caption);
                $('#old-image').val(result.filename);
                $('.image-original-preview').html('<img src="assets/uploads/category/'+result.data.id+'/'+result.filename+'" alt="images" id="original-image"/>');
                $('.category-image-crop-preview-landscape').html('<img src="assets/uploads/category/'+result.data.id+'/'+result.filename+'" alt="images" id="crop-image"/>');
                origImageVal();
                $('#upload-landscape').modal('show');
            },  
            error : function(){
                alert('Error, Please Try Again');
            }
        })
    });

    $("#file-upload-potrait").fileupload({
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
            $('#category-image-potrait-upload-button').attr('disabled',true);
        }).on('fileuploaddone', function (e, data) {
            $('#category-image-potrait-upload-button').removeAttr('disabled');
            $('.image-original-preview').html('<img src="'+data.result+'" alt="preview" id="original-image">');
            $('.category-image-crop-preview-potrait').html('<img src="'+data.result+'" alt="preview" id="crop-image">');
            $('#image').val(data.result);
            origImageVal();
            $('#original-image').Jcrop({
                onChange: showPreview,
                onSelect: showPreview,
                aspectRatio: 1.171 / 1,
                setSelect:  [ 0, 12, 569, 227.6 ]
            });
        }).on('fileuploadfail', function (e, data) {
            alert('File upload failed.');
            $('#category-image-potrait-upload-button').removeAttr('disabled');
        }).on('fileuploadalways', function() {
    });

        $("#file-upload-landscape").fileupload({
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
            $('#category-image-landscape-upload-button').attr('disabled',true);
        }).on('fileuploaddone', function (e, data) {
            $('#category-image-landscape-upload-button').removeAttr('disabled');
            $('.image-original-preview').html('<img src="'+data.result+'" alt="preview" id="original-image">');
            $('.category-image-crop-preview-landscape').html('<img src="'+data.result+'" alt="preview" id="crop-image">');
            $('#image').val(data.result);
            origImageVal();
            $('#original-image').Jcrop({
                onChange: showPreview,
                onSelect: showPreview,
                aspectRatio: 1.171 / 1,
                setSelect:  [ 0, 12, 569, 227.6 ]
            });
        }).on('fileuploadfail', function (e, data) {
            alert('File upload failed.');
            $('#category-image-landscape-upload-button').removeAttr('disabled');
        }).on('fileuploadalways', function() {
    });


    $('#upload-potrait').on('shown.bs.modal', function (e) {
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

    $('#upload-landscape').on('shown.bs.modal', function (e) {
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
            // width: Math.round(rx * imgwidth) + 'px',
            // height: Math.round(ry * imgheight) + 'px',
            width: '575' + 'px',
            height: '491' + 'px',
            marginLeft: '-' + Math.round(rx * coords.x) + 'px',
            marginTop: '-' + Math.round(ry * coords.y) + 'px'
        });
        $('#x').val(coords.x);
        $('#y').val(coords.y);
        $('#w').val(coords.w);
        $('#h').val(coords.h);
    }
});