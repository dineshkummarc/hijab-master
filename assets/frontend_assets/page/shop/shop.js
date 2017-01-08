/**
 * Created by Zubair on 22-12-2016.
 */
$(document).ready(function(){
    var url= $( "#base_url" ).val();
    var sess_id = '';
    var id = '';
    var stock = '';

    $('body').delegate('.btn-quick-view','click',function(){
        // $('#px-shop').addClass('open');
         id = $(this).attr('data-target-id');
         sess_id = $('#session_id').val();
        var container = $(document.getElementById('shop-detail'));
        $(container).empty();
        var i=1;
        $.getJSON('product/get_product/'+ id, { get_param: 'value' }, function(data) {

            $.each(data, function(index, element) {
                var product_id = element.id;
                //alert(element.name_product);
                $(container).append('<div id="mod' + i + '" class="modal-header"><button type="button" class="close" data-dismiss="modal">&times;</button></div>');
                $('#mod'+i).append('<div  class="product-details-area"><div class="container"><div id="modd' + i + '" class="row"></div></div></div>');
                $('#modd'+i).append('<div class="col-lg-3 col-md-3 col-sm-3"><div id="moddd' + i + '" class="single-pro-tab"></div></div>');
                $('#moddd'+i).append('<div id="content' + i + '" class="tab-content"></div>');
                // $('#moddd'+i).append('<ul id="contents' + i + '" class="pro-show-tab " role="tablist"></ul>');

                $.getJSON('product/get_product_image/'+ product_id, { get_param: 'value' }, function(datax) {
                    $.each(datax, function(index, images) {
                        $('#content' + i).append('<div role="tabpanel" class="tab-pane active" id="home"><img class="zoom_01" class="img-responsive" src="assets/uploads/product/' + product_id + '/'+ images.photo +'" /></div>');
                    });
                });

                $('#modd'+i).append('<div class=" col-lg-7 col-md-7 col-sm-7"><div id="modddd' + i + '" class="product-details-modal pro-right-modal fashion"   margin-top="0px" ;></div></div>');
                $('#modddd'+i).append('<h1>'+ element.name_product + '</h1><div id="price-start'+ i +'" class="price-star"><div class="rating">Rating : <i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i></div><label> Product code : '+ id+' </label>');
                if( parseInt(element.stock) > 0)
                    stock = 'In Stock'
                else
                    stock = 'Out Of Stock'

                $('#price-start' + i).append('<div class="price fix row-modal"><div class="low-price special-price floatleft"><h4><span>' + addCommas(element.price) + '</h4><div><div class="availability floatright"><label>Availability:</label> <span id="stocks" class="stock">'+ stock +'</span></div></div>');
                $('#price-start'+i).append('<div id="product-size'+ i +'" class="row"></div>');
                $('#product-size'+i).append('<form id="form'+ i +'" action="#"></form>');
                $('#form' +i).append('<div id="color' + i + '" ><div class="col-sm-2" >Color <span>*</span></div></div>');
                $.getJSON('product/get_product_color/'+ product_id, { get_param: 'value' }, function(datax) {
                    var selects = $('<select id="select-color" class="col-sm-2 col-sm-2-select"></select>');
                    $('<option>', {value: 0, text: "-- Choose --"}).appendTo(selects);
                    $.each(datax, function(index, element) {
                        $('<option>', {value: element.color_id, text: element.color_name }).appendTo(selects);
                    });
                    selects.appendTo('#color' +i);
                });

                $('#form' +i).append('<div id="size' + i + '" ><div class="col-sm-2" >Size <span>*</span></div></div>');
                $('#size' +i).append('<select id="select-size" class="col-sm-2 col-sm-2-select"></select>');
                $('<option>', {value: 0, text: "-- Choose --"}).appendTo('#select-size');
                $('#price-start'+i).append('<div class="row"><div id="actionx" class="actions-modal"></div></div>');
                $('#actionx').append('<div class="plus-minus col-sm-2"><div class="quantity cart-plus-minus"><input class="text" type="text" value="1"/></div></div>');
                $('#actionx').append('<a class="col-sm-2-a" title="Add to Cart" href="shop/addToCart/'+ id +'"><i class="fa fa-shopping-cart" aria-hidden="true"></i></a>')
                $('#actionx').append('<a class="col-sm-2-b" title="Add to Wishlist" href="wishlist/wishlist_add/' + sess_id + '/' + id +'"><i class="fa fa-heart" aria-hidden="true"></i></a>')
                $(".cart-plus-minus").append('<div class="dec qtybutton">-</div><div class="inc qtybutton">+</div>');
                $(".qtybutton").on("click", function() {
                    var $button = $(this);
                    var oldValue = $button.parent().find("input").val();
                    if ($button.text() == "+") {
                        var newVal = parseFloat(oldValue) + 1;
                    } else {
                        // Don't allow decrementing below zero
                        if (oldValue > 0) {
                            var newVal = parseFloat(oldValue) - 1;
                        } else {
                            newVal = 0;
                        }
                    }
                    $button.parent().find("input").val(newVal);
                });
            });
        });
    });

    $('body').delegate('#select-color', 'change', function(){
        var id_color = $(this).val();
        var container = $(document.getElementById('select-size'));
        $(container).empty();
        $.getJSON('product/get_product_size/'+ id +'/'+ id_color, { get_param: 'value' }, function(datax) {
            $('<option>', {value: 0, text: "-- Choose --"}).appendTo(container);
            $.each(datax, function(index, element) {
                $('<option>', {value: element.color_id, text: element.color_name }).appendTo(container);
            });
            selects.appendTo('#size' +i);
        });
    })

    function addCommas(nStr)
    {
        if(nStr != null) {
            nStr += '';
            x = nStr.split('.');
            x1 = x[0];
            x2 = x.length > 1 ? '.' + x[1] : '';
            var rgx = /(\d+)(\d{3})/;
            while (rgx.test(x1)) {
                x1 = x1.replace(rgx, '$1' + '.' + '$2');
            }
            return 'Rp.' + x1 + x2;
        }
        else{
            return 'Rp.0';
        }
    }

    $(function() {
     $( "#slider-range" ).slider({
     range: true,
     min: 0,
     max: 1000000,
     values: [ 0, 1000000 ],
     slide: function( event, ui ) {
     $( "#amount" ).val( "Rp." + ui.values[ 0 ] + " - Rp." + ui.values[ 1 ] );
     }
     
     });
     $( "#amount" ).val( "Rp." + $( "#slider-range" ).slider( "values", 0 ) +
     " - Rp." + $( "#slider-range" ).slider( "values", 1 ) );
     
     });
    
     $('.box').click(function(){
    var value_price = $('input[name="price"]').val();
    var price = value_price.replace("Rp.","");
    var price= price.replace(" - ",",");
     var price= price.replace("Rp.","");
     console.log(this);
     if(this.checked){
      var category = $('input[name="category[]"]:checked').serialize();
      var brand = $('input[name="brand[]"]:checked').serialize();
       var color = $('input[name="color[]"]:checked').serialize();
       var size = $('input[name="size[]"]:checked').serialize();
        history.pushState(null, null, url+'shop/search?'+category+brand+price+color+size);

     }else{
      var category = $('input[name="category[]"]:checked').serialize();
      var brand = $('input[name="brand[]"]:checked').serialize();
       var color = $('input[name="color[]"]:checked').serialize();
       var size = $('input[name="size[]"]:checked').serialize();
        history.pushState(null, null, url+'shop/search?'+category+brand+price+color+size);
     }
     $.ajax({
    url:"shop/search",
    type: "post",
    data:{
        category: category,
        brand: brand,
        color: color,
        price: price,
        size : size,
    },
    dataType: "JSON",
    success: function(data) {
      $('#row_product').html(data.response);
    },
    error: function(jqXHR, textStatus, errorThrown) {
      alert('Error get data from ajax');
    }
  });
    });
})

