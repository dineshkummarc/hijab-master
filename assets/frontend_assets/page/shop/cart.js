$(document).ready(function(){
  $('#form-checkout').validate({
    ignore: [],
    rules: {                                            
      name_ship: {
        required: true
      },
      tujuan_ship: {
        required: true
      },
      province_ship: {
        required: true
      },
      city_ship: {
        required: true
      },
      region_ship: {
        required: true
      },
      postcode_ship: {
        required: true
      }
    },
    submitHandler: function(form) {
      var target = $(form).attr('action');
      //$('#form-checkout .msg-status').text('');
      $.ajax({
        url : target,
        type : 'POST',
        dataType : 'json',
        data : $(form).serialize(),
        success : function(response){
          if(response.status == 'ok'){
            //$('#form-checkout .msg-status').text('Delete Success...');
            window.location.href = response.redirect;
          }
            //$('#form-checkout .msg-status').text('Delete Failed');
        },
        error : function(jqXHR, textStatus, errorThrown) {
          alert(textStatus, errorThrown);
        }
      });
    }
  });

  $('#form-product-detail').validate({
    ignore: [],
    rules: {},
    submitHandler: function(form) {
      var target = $(form).attr('action');
      $.ajax({
        url : target,
        type : 'POST',
        dataType : 'json',
        data : $(form).serialize(),
        success : function(response){
          if(response.status == 'ok'){
            window.location.href = response.redirect;
          }else if(response.status == 'outofstock') {
            $( ".msg-status" ).html(response.msg);
          }
        },
        error : function(jqXHR, textStatus, errorThrown) {
          alert(textStatus, errorThrown);
        }
      });
    }
  });

   $('#form-voucher').validate({
    ignore: [],
    rules: {      
      coupon: {
        required: true
      }
    },
    submitHandler: function(form) {
      var target = $(form).attr('action');
      $.ajax({
        url : target,
        type : 'POST',
        dataType : 'json',
        data : $(form).serialize(),
        success : function(response){
          if(response.status == 'ok'){
            $( ".disc-total" ).html(response.data['disc']);
            $( ".grand-total" ).html(response.data['total_price']);
            $( ".msg-voucher" ).html(response.msg);
            $( ".disc-percentage" ).html('('+response.data['disc_percentage']+'%)')
            $( ".voucher-price" ).removeClass('hidden');
          }else if(response.status == 'expired'){
            $( ".msg-voucher" ).html(response.msg);
          }else{
            $( ".msg-voucher" ).html(response.msg);
          }
        },
        error : function(jqXHR, textStatus, errorThrown) {
          alert(textStatus, errorThrown);
        }
      });
    }
  });

   $(".btn-voucher").click(function(event){
        $('#form-voucher').submit();
    });

})

$('body').delegate('.btn-add-wishlist','click',function(e){
  e.preventDefault();
  var $button = $(this);

  $.ajax({
    url : 'cart/add_to_wishlist',
    type : 'POST',
    dataType : 'json',
    data : {id: $button.attr('data-id')},
    success: function(response) {
      if (response.status == 'noncustomer') {
        window.location.href = response.redirect;
      }else{
        
        $('#wishlist-msg').html(response.msg);
        $('#wishlist-modal').modal('show');
        //alert(response.msg);
      }
    }
  })
});