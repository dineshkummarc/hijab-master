$(document).ready(function(){
    var url= $( "#base_url" ).val();
    var sess_id = '';
    var id = '';
    var stock = '';

    if (getUrlParameter('sortby')) {
      $('#sort-by').val(getUrlParameter('sortby'));
    }

    $('#sort-by').on('change', function(e) {
      e.preventDefault();
      setGetParameter('', 'sortby', this.value);
    });

    if (getUrlParameter('show')) {
      $('#show-per-page').val(getUrlParameter('show'));
    }
    $('#show-per-page').on('change', function(e) {
      e.preventDefault();
      setGetParameter('', 'show', this.value);
    });

    if (getUrlParameter('sortby')) {
      $('#sort-by-bot').val(getUrlParameter('sortby'));
    }

    $('#sort-by-bot').on('change', function(e) {
      e.preventDefault();
      setGetParameter('', 'sortby', this.value);
    });

    if (getUrlParameter('show')) {
      $('#show-per-page-bot').val(getUrlParameter('show'));
    }
    $('#show-per-page-bot').on('change', function(e) {
      e.preventDefault();
      setGetParameter('', 'show', this.value);
    });

    $('#form-search').validate({
      ignore: [],
      rules: {},
      submitHandler: function(form) {
        var target = $(form).attr('action');
        setGetParameter('shop', 'search', $(form).find('input').val());
      }
    });

    $( "#slider-range" ).slider({
      range: true,
      min: 0,
      max: 1000000,
      values: [ 0, 1000000 ],
      slide: function( event, ui ) {
        $( "#amount" ).val( "Rp." + ui.values[ 0 ] + " - Rp." + ui.values[ 1 ] );
      }
      });
    $( "#amount" ).val( "Rp." + $( "#slider-range" ).slider( "values", 0 )+ " - Rp." + $( "#slider-range" ).slider( "values", 1 ) );


    $('#btn-price-range').on('click', function(){
      var price = $('input[name="price"]').val();
      price = price.replace("Rp.","");
      price = price.replace(" - ",",");
      price = price.replace("Rp.","");
      setGetParameter('', 'price', price);
    }); 

    $('input[type=date]')
        .datepicker({
            format: 'yyyy-mm-dd'
        });

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
                   var nox =0;
                $.getJSON('product/get_product_image/'+ product_id, { get_param: 'value' }, function(datax) {
                    $.each(datax, function(index, images) {
                        if(nox == 0){
                            $('#content' + i).append('<div role="tabpanel" class="tab-pane active" id="home"><img class="zoom_01" class="img-responsive img-thumbnail" src="assets/uploads/product/' + product_id + '/'+ images.photo +'" /></div>');
                            nox =1;
                        }
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

    if (getUrlParameter('category')) {
      var arrValue = getUrlParameter('category').split(",");
      $.each(arrValue, function(key, value){
        $('input[name="category"][value="' + value.toString() + '"]').prop("checked", true);
      })
    }
    $('.box-category').click(function(){
      var newVal = '';
      var arr = $('.box-category:checked').map(function(){
        return this.value;
      }).get();
      $.each(arr, function(key, value){
        newVal += value+',';
      })
      setGetParameterFilter('', 'category', newVal.slice(0, -1));
    });

    if (getUrlParameter('brand')) {
      var arrValue = getUrlParameter('brand').split(",");
      $.each(arrValue, function(key, value){
        $('input[name="brand"][value="' + value.toString() + '"]').prop("checked", true);
      })
    }
    $('.box-brand').click(function(){
      var newVal = '';
      var arr = $('.box-brand:checked').map(function(){
        return this.value;
      }).get();
      $.each(arr, function(key, value){
        newVal += value+',';
      })
      setGetParameterFilter('', 'brand', newVal.slice(0, -1));
    });

    if (getUrlParameter('color')) {
      var arrValue = getUrlParameter('color').split(",");
      $.each(arrValue, function(key, value){
        $('input[name="color"][value="' + value.toString() + '"]').prop("checked", true);
      })
    }
    $('.box-color').click(function(){
      var newVal = '';
      var arr = $('.box-color:checked').map(function(){
        return this.value;
      }).get();
      $.each(arr, function(key, value){
        newVal += value+',';
      })
      setGetParameterFilter('', 'color', newVal.slice(0, -1));
    });

    if (getUrlParameter('size')) {
      var arrValue = getUrlParameter('size').split(",");
      $.each(arrValue, function(key, value){
        $('input[name="size"][value="' + value.toString() + '"]').prop("checked", true);
      })
    }
    $('.box-size').click(function(){
      var newVal = '';
      var arr = $('.box-size:checked').map(function(){
        return this.value;
      }).get();
      $.each(arr, function(key, value){
        newVal += value+',';
      })
      setGetParameterFilter('', 'size', newVal.slice(0, -1));
    });
})

/*
* Adds or changes a GET parameter
* See http://stackoverflow.com/a/13064060/703581
* Adapted to handle '#' in the URL 
*/
function setGetParameter(url, paramName, paramValue)
{
  if (url == '') {
    url = window.location.href;
  }else{
    url = 'shop';
  }
  var splitAtAnchor = url.split('#');
  url = splitAtAnchor[0];
  var anchor = typeof splitAtAnchor[1] === 'undefined' ? '' : '#' + splitAtAnchor[1];
    if (url.indexOf(paramName + "=") >= 0)
    {
        var prefix = url.substring(0, url.indexOf(paramName));
        var suffix = url.substring(url.indexOf(paramName));
        suffix = suffix.substring(suffix.indexOf("=") + 1);
        suffix = (suffix.indexOf("&") >= 0) ? suffix.substring(suffix.indexOf("&")) : "";
        url = prefix + paramName + "=" + paramValue + suffix;
    }
    else
    {
    if (url.indexOf("?") < 0)
        url += "?" + paramName + "=" + paramValue;
    else
        url += "&" + paramName + "=" + paramValue;
    }
    window.location.href = url + anchor;
}

function setGetParameterFilter(url, paramName, paramValue)
{
  if (url == '') {
    url = window.location.href;
  }else{
    url = 'shop';
  }
  var splitAtAnchor = url.split('#');
  url = splitAtAnchor[0];
  var anchor = typeof splitAtAnchor[1] === 'undefined' ? '' : '#' + splitAtAnchor[1];
    if (url.indexOf(paramName + "=") >= 0)
    {
        var prefix = url.substring(0, url.indexOf(paramName));
        var suffix = url.substring(url.indexOf(paramName));
        suffix = suffix.substring(suffix.indexOf("=") + 1);
        suffix = (suffix.indexOf("&") >= 0) ? suffix.substring(suffix.indexOf("&")) : "";
        url = prefix + paramName + "=" + paramValue + suffix;
    }
    else
    {
    if (url.indexOf("?") < 0)
        url += "?" + paramName + "=" + paramValue;
    else
        url += "&" + paramName + "=" + paramValue;
    }
    if (!paramValue) {
      url = removeURLParameter(url, paramName);
    }
    url = removeURLParameter(url, 'per_page');
    window.location.href = url + anchor;
}

var getUrlParameter = function getUrlParameter(sParam) {
    var sPageURL = decodeURIComponent(window.location.search.substring(1)),
        sURLVariables = sPageURL.split('&'),
        sParameterName,
        i;

    for (i = 0; i < sURLVariables.length; i++) {
        sParameterName = sURLVariables[i].split('=');

        if (sParameterName[0] === sParam) {
            return sParameterName[1] === undefined ? true : sParameterName[1];
        }
    }
}

function removeURLParameter(url, parameter) {
    //prefer to use l.search if you have a location/link object
    var urlparts= url.split('?');   
    if (urlparts.length>=2) {

        var prefix= encodeURIComponent(parameter)+'=';
        var pars= urlparts[1].split(/[&;]/g);

        //reverse iteration as may be destructive
        for (var i= pars.length; i-- > 0;) {    
            //idiom for string.startsWith
            if (pars[i].lastIndexOf(prefix, 0) !== -1) {  
                pars.splice(i, 1);
            }
        }

        url= urlparts[0]+'?'+pars.join('&');
        return url;
    } else {
        return url;
    }
};

