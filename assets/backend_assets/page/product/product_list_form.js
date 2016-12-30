$(document).ready(function(){
	$('#px-product-product_list-form').validate({
		rules: {                                            
			name: {
				required: true
			},
                        product_category_id: {
				required: true
			},
                        price: {
				required: true
			},
                        special_product: {
				required: true
			}
		},
		submitHandler: function(form) {
			var target = $(form).attr('action');
			$('#px-product-product_list-form .alert-warning').removeClass('hidden');
			$('#px-product-product_list-form .alert-success').addClass('hidden');
			$('#px-product-product_list-form .alert-danger').addClass('hidden');
			$('.px-summernote').each(function() {
				$(this).val($(this).code());
			});
			$.ajax({
				url : target,
				type : 'POST',
				dataType : 'json',
				data : $(form).serialize(),
				success : function(response){
					$('#px-product-product_list-form .alert-warning').addClass('hidden');
					if(response.status == 'ok'){
						$('#px-product-product_list-form .alert-success').removeClass('hidden').children('span').text(response.msg);
						window.location.href = response.redirect;
					}
					else
						$('#px-product-product_list-form .alert-danger').removeClass('hidden').children('span').text(response.msg);	
				},
				error : function(jqXHR, textStatus, errorThrown) {
					alert(textStatus, errorThrown);
				}
			});
		}
	});
	$('#px-product-product_list-form-short_description,#px-product-product_list-form-description,#px-product-product_list-form-specification').summernote({
		toolbar: [
			['font', ['bold', 'italic', 'underline', 'clear']],
			['insert', ['link']]
		],
		height: '50px'
	});
})