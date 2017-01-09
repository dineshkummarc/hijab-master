$(document).ready(function(){
$("#list_shipp").change(function (){
    var id=$(this).val();
      $.ajax({
    url:"cart/address/" + id,
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
       $('#province_ship')
         .append($("<option></option>")
                    .attr("value",response.province)
                    .text(response.name_province)); 
        $('#city_ship')
         .append($("<option></option>")
                    .attr("value",response.city)
                    .text(response.name_city)); 
         $('#region_ship')
         .append($("<option></option>")
                    .attr("value",response.region)
                    .text(response.name_region)); 
    },
    dataType: "json",
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