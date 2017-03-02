$(document).ready(function(){
    var url= $( "#base_url" ).val();
    var sess_id = '';
    var id = '';
    var stock = '';

    var url_param = getUrlVars();
    if (url_param.length == 1 && url_param == 'brand') {
      var arrValue = getUrlParameter('brand').split(",");
      $.ajax({
        url: 'shop/brand_only',
        method: 'post',
        dataType: 'json',
        data: {value : arrValue},
        success: function(response){
          //console.log(response);
          $('.brand-header').html(response.data);
        }
      })
    }

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

    //modal jquery
    $('#shopModal').on('shown.bs.modal', function (e) {
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
      
      $('#select-color').change(function() {
        var product_id = $('input[name=id_product]').val();
        var color_id = this.value;
        var size_id = $('#select-size option:selected').val();
        $.ajax({
          url : 'shop/select_color',
          method: 'post',
          data: {product_id: product_id, color_id: color_id, size_id: size_id},
          dataType: 'json',
          success: function(response){
            $('#select-size').find('option').remove();
            $.each(response.data.size, function (i, item) {
                $('#select-size').append($('<option>', { 
                    value: item.size_id,
                    text : item.name+' ('+item.stock+' Left)'
                }));
            });
            $('#availability').html(response.data.stock_status);
            if (response.data.stock == 0) {
              $('input[name=qty]').val(0);
              $('.btn-add-cart').attr('disabled', 'disabled');
            }else{
              $('input[name=qty]').val(1);
              $('.btn-add-cart').removeAttr('disabled');
            }
          },
        })
      });

      $('#select-size').change(function() {
        var product_id = $('input[name=id_product]').val();
        var color_id = $('#select-color option:selected').val();
        var size_id = this.value;
        $.ajax({
          url : 'shop/checking_stock',
          method: 'post',
          data: {product_id: product_id, color_id: color_id, size_id: size_id},
          dataType: 'json',
          success: function(response){
            $('#availability').html(response.data.stock_status);
            if (response.data.stock == 0) {
              $('input[name=qty]').val(0);
              $('.btn-add-cart').attr('disabled', 'disabled');
            }else{
              $('input[name=qty]').val(1);
              $('.btn-add-cart').removeAttr('disabled');
            }
          },
        })
      });

      /*-----------------------
       cart-plus-minus-button 
       -------------------------*/
      $(".detail-plus-minus").append('<div class="dec detail-qtybutton">-</div><div class="detail-inc detail-qtybutton">+</div>');
      $(".detail-qtybutton").on("click", function () {
          var product_id = $('input[name=id_product]').val();
          var size_id = $('#select-size option:selected').val();
          var color_id = $('#select-color option:selected').val();
          var $button = $(this);
          var oldValue = $button.parent().find("input").val();
          if ($button.text() == "+") {
              $.ajax({
                  url: 'shop/check_product_stock',
                  type: 'POST',
                  dataType: 'json',
                  data: {'product_id' : product_id, 'size_id': size_id, 'color_id': color_id},
                  success: function(response) {
                      if (oldValue == response.stock) {
                          var newVal = parseFloat(response.stock);
                      }else{
                          var newVal = parseFloat(oldValue) + 1;
                      }
                      $button.parent().find("input").val(newVal);
                  }
              });
              
          } else {
              // Don't allow decrementing below zero
              if (oldValue > 1) {
                  var newVal = parseFloat(oldValue) - 1;
              } else {
                  newVal = 0;
              }
          }
          $button.parent().find("input").val(newVal);
      });
      $('.detail-plus-minus').find("input").focusout(function () {
           var product_id = $('input[name=id_product]').val();
           var size_id = $('#select-size option:selected').val();
           var color_id = $('#select-color option:selected').val();
           var $field = $(this);
           var oldValue = this.value;
           $.ajax({
                  url: 'shop/check_product_stock',
                  type: 'POST',
                  dataType: 'json',
                  data: {'product_id' : product_id, 'size_id': size_id, 'color_id': color_id},
                  success: function(response) {
                      if (parseFloat(oldValue) > parseFloat(response.stock)) {
                          var newVal = parseFloat(response.stock);
                      }else if(oldValue == 0 || oldValue < 0){
                          var newVal = 1;
                      }else{
                          var newVal = parseFloat(oldValue);
                      }
                      $field.val(newVal);
                  }
              });
      });

     
    });

    $('#select-color').change(function() {
      var product_id = $('input[name=id_product]').val();
      var color_id = this.value;
      var size_id = $('#select-size option:selected').val();
      $.ajax({
        url : 'shop/select_color',
        method: 'post',
        data: {product_id: product_id, color_id: color_id, size_id: size_id},
        dataType: 'json',
        success: function(response){
          $('#select-size').find('option').remove();
          $.each(response.data.size, function (i, item) {
              $('#select-size').append($('<option>', { 
                  value: item.size_id,
                  text : item.name+' ('+item.stock+' Left)'
              }));
          });
          $('#availability').html(response.data.stock_status);
          if (response.data.stock == 0) {
            $('input[name=qty]').val(0);
            $('.btn-add-cart').attr('disabled', 'disabled');
          }else{
            $('input[name=qty]').val(1);
            $('.btn-add-cart').removeAttr('disabled');
          }
        },
      })
    });

    $('#select-size').change(function() {
      var product_id = $('input[name=id_product]').val();
      var color_id = $('#select-color option:selected').val();
      var size_id = this.value;
      $.ajax({
        url : 'shop/checking_stock',
        method: 'post',
        data: {product_id: product_id, color_id: color_id, size_id: size_id},
        dataType: 'json',
        success: function(response){
          $('#availability').html(response.data.stock_status);
          if (response.data.stock == 0) {
            $('input[name=qty]').val(0);
            $('.btn-add-cart').attr('disabled', 'disabled');
          }else{
            $('input[name=qty]').val(1);
            $('.btn-add-cart').removeAttr('disabled');
          }
        },
      })
    });

    /*-----------------------
     cart-plus-minus-button 
     -------------------------*/
    $(".detail-plus-minus").append('<div class="dec detail-qtybutton">-</div><div class="detail-inc detail-qtybutton">+</div>');
    $(".detail-qtybutton").on("click", function () {
        var product_id = $('input[name=id_product]').val();
        var size_id = $('#select-size option:selected').val();
        var color_id = $('#select-color option:selected').val();
        var $button = $(this);
        var oldValue = $button.parent().find("input").val();
        if ($button.text() == "+") {
            $.ajax({
                url: 'shop/check_product_stock',
                type: 'POST',
                dataType: 'json',
                data: {'product_id' : product_id, 'size_id': size_id, 'color_id': color_id},
                success: function(response) {
                    if (oldValue == response.stock) {
                        var newVal = parseFloat(response.stock);
                    }else{
                        var newVal = parseFloat(oldValue) + 1;
                    }
                    $button.parent().find("input").val(newVal);
                }
            });
            
        } else {
            // Don't allow decrementing below zero
            if (oldValue > 1) {
                var newVal = parseFloat(oldValue) - 1;
            } else {
                newVal = 0;
            }
        }
        $button.parent().find("input").val(newVal);
    });
    $('.detail-plus-minus').find("input").focusout(function () {
         var product_id = $('input[name=id_product]').val();
         var size_id = $('#select-size option:selected').val();
         var color_id = $('#select-color option:selected').val();
         var $field = $(this);
         var oldValue = this.value;
         $.ajax({
                url: 'shop/check_product_stock',
                type: 'POST',
                dataType: 'json',
                data: {'product_id' : product_id, 'size_id': size_id, 'color_id': color_id},
                success: function(response) {
                    if (parseFloat(oldValue) > parseFloat(response.stock)) {
                        var newVal = parseFloat(response.stock);
                    }else if(oldValue == 0 || oldValue < 0){
                        var newVal = 1;
                    }else{
                        var newVal = parseFloat(oldValue);
                    }
                    $field.val(newVal);
                }
            });
    });

    $('#form-search').validate({
      ignore: [],
      rules: {},
      submitHandler: function(form) {
        var target = $(form).attr('action');
        setGetParameter('shop', 'search', $(form).find('input').val());
      }
    });

    if (getUrlParameter('price')) {
      var val_min = getUrlParameter('price').split(',')[0];
      var val_max = getUrlParameter('price').split(',')[1];
    } else {
      var val_min = 0;
      var val_max = 1000000;
    }
    $( "#slider-range" ).slider({
      range: true,
      min: 0,
      max: 1000000,
      values: [ val_min , val_max ],
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
      id = $(this).attr('data-target-id');
      $.ajax({
        url: "shop/quick_view/" + id,
        type: "GET",
        dataType: "html",
        success: function(data) {
          $('#shop-detail').html(data);
        }
      });
    });

    if (getUrlParameter('search')) {
      var value = getUrlParameter('search').split(",");
        $('input[name="search"]').val(value);
    }
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
      console.log(url.indexOf(paramName + "="));
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
        if ($.isEmptyObject(pars)) {
          url = url.replace('?','');
        }

        return url;
    } else {
        return url;
    }
}

// Read a page's GET URL variables and return them as an associative array.
function getUrlVars()
{
    var vars = [], hash;
    var hashes = window.location.href.slice(window.location.href.indexOf('?') + 1).split('&');
    for(var i = 0; i < hashes.length; i++)
    {
        hash = hashes[i].split('=');
        vars.push(hash[0]);
        vars[hash[0]] = hash[1];
    }
    return vars;
}

$(document).ready(function() {
   if ($(window).width() < 1000) {
   $("#sidebar_menu").click();
    }
});



