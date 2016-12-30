$(document).ready(function(){
    $('#px-site-content-static-content-form-static-content-content').summernote({
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
    $('#px-product-form').validate({
        rules: {                                            
            name_product: {
                required: true
            },
            category_id: {
                required: true
            },
            brand_id: {
                required: true
            },
            stock_id: {
                required: true
            },
            price: {
                required: true
            },
            weight: {
                required: true
            },
            barcode: {
                required: true
            },
            description: {
                required: true
            }                        
        },
        submitHandler: function(form) {
            var target = $(form).attr('action');
            $('#px-product-form .alert-warning').removeClass('hidden');
            $('#px-product-form .alert-success').addClass('hidden');
            $('#px-product-form .alert-danger').addClass('hidden');
            $('.px-summernote').each(function() {
                $(this).val($(this).code());
            });
            $.ajax({
                url : target,
                type : 'POST',
                dataType : 'json',
                data : $(form).serialize(),
                success : function(response){
                    $('#px-product-form .alert-warning').addClass('hidden');
                    if(response.status == 'ok'){
                        $('#px-product-form .alert-success').removeClass('hidden').children('span').text(response.msg);
                        window.location.href = response.redirect;
                    }
                    else
                        $('#px-product-form .alert-danger').removeClass('hidden').children('span').text(response.msg);	
                },
                error : function(jqXHR, textStatus, errorThrown) {
                    alert(textStatus, errorThrown);
                }
            });
        }
    });
})