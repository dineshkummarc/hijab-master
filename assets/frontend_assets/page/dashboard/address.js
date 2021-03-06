$(document).ready(function(){
$('#confirm-delete').on('show.bs.modal', function(e) {
    $(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
});
  
$("#list_shipp").change(function (){
    var id = $(this).val();
  $.ajax({
    url:"cart/get_shipping_address/" + id,
    type: 'GET',
    success: function(response) {
      document.getElementById("form-shiiping").className = "";
      $( "#name_ship" ).val(response.receiver_name);
      $( "#tujuan_ship" ).val(response.title);
       $( "#postcode_ship" ).val(response.postal_code);
       $( "#address_ship" ).val(response.address);
       $( "#cost" ).val(response.cost);
       var cost = idr(response.cost);
        $( "#cost_text" ).html("Rp. "+ cost);
         var totprice = idr(response.tot_price);
        $( "#tot_price_text" ).html("Rp. "+ totprice);
        $( "#tot_price" ).val(response.tot_price);
        $('#province_ship option[value='+response.province+']').attr('selected','selected'); 
        $('#city_ship').html("");
        $('#city_ship').append($("<option></option>")
                    .attr("value",response.city)
                    .text(response.name_city)); 
         $('#region_ship').html("");
         $('#region_ship').append($("<option></option>")
                    .attr("value",response.region)
                    .text(response.name_region)); 
         $( '#btn-proceed' ).removeAttr( 'disabled' );
    },
    dataType: "json",
  });
});

$("#newshipping").click(function (){
  $.ajax({
    url:"cart/get_new_address",
    type: 'GET',
    dataType: "json",
    success: function(response)
    {
      $( "#cost" ).val(0);
      var cost = idr(0);
      $( "#cost_text" ).html("Rp. "+ cost);
      $( "#tot_price" ).val(response);
      var totprice = idr(response);
      $( "#tot_price_text" ).html("Rp. "+ totprice);
      $("#list_shipp").val('0');
      $("#name_ship").val('');
      $("#tujuan_ship").val('');
      $("#postcode_ship").val('');
      $("#address_ship").val('');
      $("#province_ship").val('0'); 
      $('#city_ship').html('');
      $('#region_ship').html('');
      $( '#btn-proceed' ).removeAttr( 'disabled' );
      document.getElementById("form-shiiping").className = "";
    }
  });
});

$("#province_ship").change(function (){
    var id=$(this).val();
      $.ajax({
    url:"dashboard/get_city/" + id,
    type: 'GET',
    success: function(response) {
     $('#city_ship').html(response);
    },
    dataType: "json",
  });
});
$("#city_ship").change(function (){
    var id=$(this).val();
      $.ajax({
    url:"dashboard/get_region/" + id,
    type: 'GET',
    success: function(response) {
     $('#region_ship').html(response);
    },
    dataType: "json",
  });
});
$("#region_ship").change(function (){
    var id=$(this).val();
    $.ajax({
      url:"cart/get_ongkir/",
      data: {'region_id' : id},
      dataType: "json",
      type: 'POST',
      success: function(response) {
        var cost = idr(response.cost);
        $( "#cost_text" ).html("Rp. "+ cost);
        $( "#cost" ).val(response.cost);
         var totprice = idr(response.tot_price);
        $( "#tot_price_text" ).html("Rp. "+ totprice);
        $( "#tot_price" ).val(response.tot_price);
      },
      
    });
});
$("#province").change(function (){
    var id=$(this).val();
      $.ajax({
    url:"dashboard/kabupaten/" + id,
    type: 'GET',
    success: function(response) {
     $('#kabupaten').html(response);
    },
    dataType: "json",
  });
});
$("#kabupaten").change(function (){
    var id=$(this).val();
      $.ajax({
    url:"dashboard/region/" + id,
    type: 'GET',
    success: function(response) {
     $('#region').html(response);
    },
    dataType: "json",
  });
});
})

function idr(nStr)
{
    nStr += '';
    x = nStr.split('.');
    x1 = x[0];
    x2 = x.length > 1 ? '.' + x[1] : '';
    var rgx = /(\d+)(\d{3})/;
    while (rgx.test(x1)) {
        x1 = x1.replace(rgx, '$1' + '.' + '$2');
    }
    return x1 + x2;
}