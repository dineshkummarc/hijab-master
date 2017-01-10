(function ($) {
    "use strict";

    /*----------------------------
     $.tooltip
     ------------------------------ */

    $('[data-toggle="tooltip"]').tooltip({
        animated: 'fade',
        placement: 'top',
        container: 'body'
    });

    /*---------------------
     TOP Menu Stick
     --------------------- */
    var s = $("#sticker");
    $(window).on('scroll', function () {
        if ($(this).scrollTop() > 80) {
            $('#sticker').addClass("stick");
        } else {
            $('#sticker').removeClass("stick");
        }
        ;
    });
    /*----------------------------
     $.scrollUp
     ------------------------------ */
    $.scrollUp({
        scrollName: 'scrollUp', // Element ID
        topDistance: '300', // Distance from top before showing element (px)
        topSpeed: 300, // Speed back to top (ms)
        animation: 'fade', // Fade, slide, none
        scrollSpeed: 900,
        animationInSpeed: 1000, // Animation in speed (ms)
        animationOutSpeed: 1000, // Animation out speed (ms)
        scrollText: 'TOP', // Text for element
        activeOverlay: false, // Set CSS color to display scrollUp active point, e.g '#00FFFF'
    });


    /*----------------------------
     wow js active
     ------------------------------ */
    new WOW().init();

    /*----------------------------
     slider
     ------------------------------ */
    /*  owlCarousel */

    $(".section-carousel").owlCarousel({
        autoPlay: false,
        pagination: false,
        items: 4,
        /* transitionStyle : "fade", */    /* [This code for animation ] */
        navigationText: ["<i class='fa fa-angle-left'></i>", "<i class='fa fa-angle-right'></i>"],
        itemsDesktop: [1199, 3],
        itemsDesktopSmall: [980, 3],
        itemsTablet: [768, 1],
        itemsMobile: [479, 1],
    });
    /*----------------------------
     section carousel home 4
     ------------------------------ */
    $(".section-carousel-home-4").owlCarousel({
        autoPlay: false,
        pagination: false,
        items: 1,
        /* transitionStyle : "fade", */    /* [This code for animation ] */
        navigationText: ["<i class='fa fa-angle-left'></i>", "<i class='fa fa-angle-right'></i>"],
        navigation: true,
        itemsDesktop: [1199, 1],
        itemsDesktopSmall: [980, 1],
        itemsTablet: [768, 1],
        itemsMobile: [479, 1],
    });
    /*----------------------------
     section carousel home 5
     ------------------------------ */
    $(".section-carousel-home-5").owlCarousel({
        autoPlay: false,
        pagination: false,
        items: 1,
        /* transitionStyle : "fade", */    /* [This code for animation ] */
        navigationText: ["<i class='fa fa-angle-left'></i>", "<i class='fa fa-angle-right'></i>"],
        navigation: true,
        itemsDesktop: [1199, 1],
        itemsDesktopSmall: [980, 1],
        itemsTablet: [768, 1],
        itemsMobile: [479, 1],
    });
    /*----------------------------
     featured product carousel
     ------------------------------ */
    $(".featured-product").owlCarousel({

        autoPlay: false, //Set AutoPlay to 3 seconds
        pagination: false,
        navigationText: ["<i class='fa fa-angle-left'></i>", "<i class='fa fa-angle-right'></i>"],
        navigation: false,
        items: 4,
        slideSpeed: 6000,
        itemsDesktop: [1199, 4],
        itemsDesktopSmall: [979, 3],
        itemsTablet: [768, 1],
        itemsMobile: [479, 1],
    });
    /*----------------------------
     featured product carousel home 4
     ------------------------------ */
    $("#featured-product-home-4").owlCarousel({

        autoPlay: false, //Set AutoPlay to 3 seconds
        pagination: false,
        navigationText: ["<i class='fa fa-angle-left'></i>", "<i class='fa fa-angle-right'></i>"],
        navigation: true,
        items: 3,
        slideSpeed: 6000,
        itemsDesktop: [1199, 3],
        itemsDesktopSmall: [979, 3],
        itemsTablet: [768, 1],
        itemsMobile: [479, 1],
    });
    /*----------------------------
     new-product carousel
     ------------------------------ */
    $("#new-product").owlCarousel({

        autoPlay: false, //Set AutoPlay to 3 seconds
        pagination: false,
        navigationText: ["<i class='fa fa-angle-left'></i>", "<i class='fa fa-angle-right'></i>"],
        navigation: true,
        items: 4,
        slideSpeed: 6000,
        itemsDesktop: [1199, 4],
        itemsDesktopSmall: [979, 3],
        itemsTablet: [768, 1],
        itemsMobile: [479, 1],
    });
    /*----------------------------
     new-product carousel home 4
     ------------------------------ */
    $("#new-product-home-4").owlCarousel({

        autoPlay: false, //Set AutoPlay to 3 seconds
        pagination: false,
        navigationText: ["<i class='fa fa-angle-left'></i>", "<i class='fa fa-angle-right'></i>"],
        navigation: true,
        items: 3,
        slideSpeed: 6000,
        itemsDesktop: [1199, 3],
        itemsDesktopSmall: [979, 2],
        itemsTablet: [768, 1],
        itemsMobile: [479, 1],
    });
    /*----------------------------
     onsel-carousel 
     ------------------------------ */
    $("#onsel-carousel").owlCarousel({

        autoPlay: false, //Set AutoPlay to 3 seconds
        pagination: false,
        navigationText: ["<i class='fa fa-angle-left'></i>", "<i class='fa fa-angle-right'></i>"],
        navigation: true,
        items: 4,
        slideSpeed: 6000,
        itemsDesktop: [1199, 4],
        itemsDesktopSmall: [979, 3],
        itemsTablet: [768, 1],
        itemsMobile: [479, 1]
    });
    /*----------------------------
     onsel-carousel home 4
     ------------------------------ */
    $("#onsel-carousel-home-4").owlCarousel({

        autoPlay: false, //Set AutoPlay to 3 seconds
        pagination: false,
        navigationText: ["<i class='fa fa-angle-left'></i>", "<i class='fa fa-angle-right'></i>"],
        navigation: true,
        items: 3,
        slideSpeed: 6000,
        itemsDesktop: [1199, 3],
        itemsDesktopSmall: [979, 2],
        itemsTablet: [768, 1],
        itemsMobile: [479, 1],
    });
    /*----------------------------
     product carousel home 7
     ------------------------------ */
    $(".product-carousel-home-7").owlCarousel({

        autoPlay: true, //Set AutoPlay to 3 seconds
        pagination: false,
        navigationText: ["<i class='fa fa-angle-left'></i>", "<i class='fa fa-angle-right'></i>"],
        navigation: true,
        items: 4,
        slideSpeed: 6000,
        itemsDesktop: [1199, 4],
        itemsDesktopSmall: [979, 3],
        itemsTablet: [768, 1],
        itemsMobile: [479, 1],
    });
    /*----------------------------
     slider-carousel
     ------------------------------ */
    $(".slider-carousel").owlCarousel({

        autoPlay: false, //Set AutoPlay to 3 seconds
        pagination: true,
        items: 1,
        slideSpeed: 6000,
        itemsDesktop: [1199, 1],
        itemsDesktopSmall: [979, 1],
        itemsTablet: [768, 1],
        itemsMobile: [479, 1],

    });
    /*----------------------------
     logo-carousel
     ------------------------------ */
    $(".logo-carousel").owlCarousel({
        autoPlay: false, //Set AutoPlay to 3 seconds
        pagination: false,
        navigationText: ["<i class='fa fa-angle-left'></i>", "<i class='fa fa-angle-right'></i>"],
        navigation: false,
        items: 5,
        slideSpeed: 6000,
        itemsDesktop: [1199, 4],
        itemsDesktopSmall: [979, 3],
        itemsTablet: [768, 1],
        itemsMobile: [479, 1],

    });
    /*----------------------------
     logo-carousel home 5
     ------------------------------ */
    $(".logo-carousel-home-5").owlCarousel({

        autoPlay: false, //Set AutoPlay to 3 seconds
        pagination: false,
        navigationText: ["<i class='fa fa-angle-left'></i>", "<i class='fa fa-angle-right'></i>"],
        navigation: true,
        items: 1,
        slideSpeed: 6000,
        itemsDesktop: [1199, 1],
        itemsDesktopSmall: [979, 2],
        itemsTablet: [768, 2]

    });
    /*----------------------------
     hot product-carousel
     ------------------------------ */
    $(".hot-product-carousel").owlCarousel({

        autoPlay: false, //Set AutoPlay to 3 seconds
        pagination: false,
        navigationText: ["<i class='fa fa-angle-left'></i>", "<i class='fa fa-angle-right'></i>"],
        navigation: true,
        items: 4,
        slideSpeed: 6000,
        itemsDesktop: [1199, 4],
        itemsDesktopSmall: [979, 3],
        itemsTablet: [768, 1],
        itemsMobile: [479, 1]

    });
    /*----------------------------
     hot product-carousel home 4
     ------------------------------ */
    $(".hot-product-carousel-home-4").owlCarousel({

        autoPlay: false, //Set AutoPlay to 3 seconds
        pagination: false,
        navigationText: ["<i class='fa fa-angle-left'></i>", "<i class='fa fa-angle-right'></i>"],
        navigation: true,
        items: 3,
        slideSpeed: 6000,
        itemsDesktop: [1199, 3],
        itemsDesktopSmall: [979, 3],
        itemsTablet: [768, 1],
        itemsMobile: [479, 1]
    });
    /*----------------------------
     hot product-carousel home 7
     ------------------------------ */
    $(".hot-product-carousel-home-7").owlCarousel({
        autoPlay: false, //Set AutoPlay to 3 seconds
        pagination: false,
        navigationText: ["<i class='fa fa-angle-left'></i>", "<i class='fa fa-angle-right'></i>"],
        navigation: true,
        items: 4,
        slideSpeed: 6000,
        itemsDesktop: [1199, 4],
        itemsDesktopSmall: [979, 3],
        itemsTablet: [768, 1],
        itemsMobile: [479, 1]
    });
    /*----------------------------
     top-sell area carousel
     ------------------------------ */
    $(".top-sell-area-carousel").owlCarousel({
        autoPlay: false, //Set AutoPlay to 3 seconds
        pagination: false,
        navigationText: ["<i class='fa fa-angle-left'></i>", "<i class='fa fa-angle-right'></i>"],
        navigation: true,
        items: 1,
        slideSpeed: 6000,
        itemsDesktop: [1199, 1],
        itemsDesktopSmall: [979, 2],
        itemsTablet: [768, 2],
        itemsMobile: [479, 1],

    });
    /*----------------------------
     testimonial-carousel carousel
     ------------------------------ */
    $(".testimonial-carousel").owlCarousel({
        autoPlay: 3000,
        items: 1,
        /* transitionStyle : "fade", */    /* [This code for animation ] */
        navigationText: ["<i class='fa fa-angle-left'></i>", "<i class='fa fa-angle-right'></i>"],
        transitionStyle: "backSlide",
        itemsDesktop: [1199, 1],
        itemsDesktopSmall: [980, 1],
        itemsTablet: [768, 1],
        itemsMobile: [479, 1],
    });
    /*----------------------------
     testimonial-carousel carousel home 4
     ------------------------------ */
    $(".testimonial-carousel-home-4").owlCarousel({
        autoPlay: false,
        items: 1,
        navigationText: ["<i class='fa fa-angle-left'></i>", "<i class='fa fa-angle-right'></i>"],
        navigation: true,
        transitionStyle: "backSlide",
        itemsDesktop: [1199, 1],
        itemsDesktopSmall: [980, 1],
        pagination: false,
        itemsTablet: [768, 1],
        itemsMobile: [479, 1],
    });
    /*----------------------------
     testimonial-carousel carousel home 5
     ------------------------------ */
    $(".testimonial-carousel-home-5").owlCarousel({
        autoPlay: false,
        items: 1,
        navigationText: ["<i class='fa fa-angle-left'></i>", "<i class='fa fa-angle-right'></i>"],
        navigation: true,
        transitionStyle: "backSlide",
        itemsDesktop: [1199, 2],
        itemsDesktopSmall: [980, 2],
        pagination: false,
        itemsTablet: [768, 2],
        itemsMobile: [479, 1],
    });
    /*----------------------------
     nivoSlider
     ------------------------------ */
    $('#mainslider').nivoSlider({
        directionNav: true,
        animSpeed: 500,
        slices: 18,
        pauseTime: 500000,
        pauseOnHover: false,
        controlNav: true,
        prevText: '<i class="fa fa-chevron-left nivo-prev-icon"></i>',
        nextText: '<i class="fa fa-chevron-right nivo-next-icon"></i>'
    });


    /*-----------------------
     cart-plus-minus-button 
     -------------------------*/
    $(".cart-plus-minus").append('<div class="dec qtybutton">-</div><div class="inc qtybutton">+</div>');
    $(".qtybutton").on("click", function () {
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
    /*-----------------------
     meanmenu 
     -------------------------*/
    $('#mobile-menu-active').meanmenu({
        meanScreenWidth: "991",
        meanMenuContainer: ".mobile-menu",
    });

    /*---------------------
     Category menu
     --------------------- */
    $('#cate-toggle li.has-sub>a').on('click', function () {
        $(this).removeAttr('href');
        var element = $(this).parent('li');
        if (element.hasClass('open')) {
            element.removeClass('open');
            element.find('li').removeClass('open');
            element.find('ul').slideUp();
        } else {
            element.addClass('open');
            element.children('ul').slideDown();
            element.siblings('li').children('ul').slideUp();
            element.siblings('li').removeClass('open');
            element.siblings('li').find('li').removeClass('open');
            element.siblings('li').find('ul').slideUp();
        }
    });
    $('#cate-toggle>ul>li.has-sub>a').append('<span class="holder"></span>');

    /*---------------------
     price slider
     --------------------- */
    $("#slider-range").slider({
        range: true,
        min: 40,
        max: 600,
        values: [60, 570],
        slide: function (event, ui) {
            $("#amount").val("$" + ui.values[ 0 ] + " - $" + ui.values[ 1 ]);
        }
    });
    $("#amount").val("$" + $("#slider-range").slider("values", 0) +
            " - $" + $("#slider-range").slider("values", 1));

    $("#zoom_01").elevateZoom({scrollZoom: true});
    $(".zoom_01").elevateZoom({scrollZoom: true,

    });

    /*---------------------
     Checkout page toggle
     --------------------- */
    $(".showlogin").on('click', function () {
        $(".login").slideToggle();
    })
    $(".show-coupon").on('click', function () {
        $(".checkout_coupon").slideToggle();
    });
    $(".showaccount").on('click', function () {
        $(".account-box-hide").slideToggle();
    });
    $(".showship").on('click', function () {
        $(".ship-box-hide").slideToggle();
    });

    $(".payment_method-li").on('click', function () {
        $(".payment_method_bacs").show(500);
        $(".payment_method_cheque").hide(500);
        $(".payment_method_paypal").hide(500);
    });
    $(".payment_method_cheque-li").on('click', function () {
        $(".payment_method_cheque").show(500);
        $(".payment_method_bacs").hide(500);
        $(".payment_method_paypal").hide(500);
    });
    $(".payment_method_paypal-li").on('click', function () {
        $(".payment_method_paypal").show(500);
        $(".payment_method_cheque").hide(500);
        $(".payment_method_bacs").hide(500);
    });

    /*---------------------
     wishlist
     --------------------- */
    $(".click-wishlist").on('click', function () {
        var prod_id = $(this).attr('data-id');
        var user_id = $(this).attr('data-user');
        $.ajax({
            url: "product/addToWishList/" + prod_id,
            type: "post",
            dataType: "JSON",
            data:{"prod_id":prod_id},
            success: function (data) {
                $('#modal .modal-title').html(data.response);
                $('#modal').modal('show');
                // alert(data.response);
            }
        });

    });


})(jQuery); 