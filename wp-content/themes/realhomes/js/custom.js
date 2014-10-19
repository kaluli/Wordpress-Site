(function($){

    "use strict";

    $(document).ready(function() {

        /*-----------------------------------------------------------------------------------*/
        /* For RTL Languages
         /*-----------------------------------------------------------------------------------*/
        if( $('body').hasClass('rtl') ){
            $('.contact-number .fa-phone,' +
                '.more-details .fa-caret-right').addClass('fa-flip-horizontal');
        }

        /*-----------------------------------------------------------------------------------*/
        /* Cross Browser
        /*-----------------------------------------------------------------------------------*/
        $('.property-item .features span:last-child').css('border', 'none');
        $('.dsidx-prop-title').css('margin','0 0 15px 0');
        $('.dsidx-prop-summary a img').css('border','none');


        /*-----------------------------------------------------------------------------------*/
        /* Main Menu Dropdown Control
        /*-----------------------------------------------------------------------------------*/
        $('.main-menu ul li').hover(function(){
            $(this).children('ul').stop(true, true).slideDown(200);
        },function(){
            $(this).children('ul').stop(true, true).delay(50).slideUp(750);
        });


        /*-----------------------------------------------------------------------------------*/
        /*	Responsive Nav
        /*-----------------------------------------------------------------------------------*/
        var $mainNav    = $('.main-menu > div > ul');
        var optionsList = '<option value="" selected>'+ localized.nav_title +'</option>';

        $mainNav.find('li').each(function() {
            var $this   = $(this),
                $anchor = $this.children('a'),
                depth   = $this.parents('ul').length - 1,
                indent  = '';
            if( depth ) {
                while( depth > 0 ) {
                    indent += ' - ';
                    depth--;
                }
            }
            optionsList += '<option value="' + $anchor.attr('href') + '">' + indent + ' ' + $anchor.text() + '</option>';
        }).end().last()
            .after('<select class="responsive-nav">' + optionsList + '</select>');

        $('.responsive-nav').on('change', function() {
            window.location = $(this).val();
        });


        /*-----------------------------------------------------------------------------------*/
        /*	Flex Slider
        /*-----------------------------------------------------------------------------------*/
        if(jQuery().flexslider)
        {
            // Flex Slider for Homepage
            $('#home-flexslider .flexslider').flexslider({
                animation: "fade",
                slideshowSpeed: 7000,
                animationSpeed:	1500,
                directionNav: true,
                controlNav: false,
                keyboardNav: true,
                start: function (slider) {
                    slider.removeClass('loading');
                }
            });

            // Remove Flex Slider Navigation for Smaller Screens Like IPhone Portrait
            $('.slider-wrapper , .listing-slider').hover(function(){
                var mobile = $('body').hasClass('probably-mobile');
                if(!mobile)
                {
                    $('.flex-direction-nav').stop(true,true).fadeIn('slow');
                }
            },function(){
                $('.flex-direction-nav').stop(true,true).fadeOut('slow');
            });

            // Flex Slider for Detail Page
            $('#property-detail-flexslider .flexslider').flexslider({
                animation: "slide",
                directionNav: false,
                controlNav: "thumbnails"
            });

            // Flex Slider Gallery Post
            $('.listing-slider ').flexslider({
                animation: "slide"
            });

            /* Property detail page slider variation two */
            $('#property-carousel-two').flexslider({
                animation: "slide",
                controlNav: false,
                animationLoop: false,
                slideshow: false,
                itemWidth: 113,
                itemMargin: 10,
                // move: 1,
                asNavFor: '#property-slider-two'
            });
            $('#property-slider-two').flexslider({
                animation: "slide",
                directionNav: true,
                controlNav: false,
                animationLoop: false,
                slideshow: false,
                sync: "#property-carousel-two",
                start: function (slider) {
                    slider.removeClass('loading');
                }
            });

        }


        /*-----------------------------------------------------------------------------------*/
        /*	jCarousel
        /*-----------------------------------------------------------------------------------*/
        if(jQuery().jcarousel){
            // Jcarousel for Detail Page
            jQuery('#property-detail-flexslider .flex-control-nav').jcarousel({
                vertical: true,
                scroll:1
            });

            // Jcarousel for partners
            jQuery('.brands-carousel .brands-carousel-list ').jcarousel({
                scroll:1
            });
        }


        /*-----------------------------------------------------------------------------------*/
        /*	Carousel - Elastislide
        /*-----------------------------------------------------------------------------------*/
        var param = {
            speed : 500,
            imageW : 245,
            minItems : 1,
            margin : 30,
            onClick : function($object) {
                window.location = $object.find('a').first().attr('href');
                return true;
            }
        };

        function cstatus(a,b,c){
            var temp = a.children("li");
            temp.last().attr('style', 'margin-right: 0px !important');
            if ( temp.length > c ) { b.elastislide(param); }
        };

        if(jQuery().elastislide){
            var fp = $('.featured-properties-carousel .es-carousel-wrapper ul'),
                fpCarousel = $('.featured-properties-carousel .carousel');

            cstatus(fp,fpCarousel,4);
        }


        /*-------------------------------------------------------*/
        /*	Select Box
        /* -----------------------------------------------------*/
        if(jQuery().selectbox){
            $('.search-select').selectbox();

            /* dropdown fix - to close dropdown if opened by clicking anywhere out */
            $('body').on('click',function(e){
                if ($(e.target).hasClass('selectbox')) return;
                $('.selectbox-wrapper').css('display','none');
            });
        }


        /*-------------------------------------------------------*/
        /*	 Focus and Blur events with input elements
        /* -----------------------------------------------------*/
        var addFocusAndBlur = function($input, $val){
            $input.focus(function(){
                if ( $(this).value == $val ){
                    $(this).value = '';
                }
            });

            $input.blur(function(){
                if ( $(this).value == '' ) {
                    $(this).value = $val;
                }
            });
        };

        // Attach the events
        addFocusAndBlur(jQuery('#principal'),'Principal');
        addFocusAndBlur(jQuery('#interest'),'Interest');
        addFocusAndBlur(jQuery('#payment'),'Payment');
        addFocusAndBlur(jQuery('#texes'),'Texes');
        addFocusAndBlur(jQuery('#insurance'),'Insurance');
        addFocusAndBlur(jQuery('#pmi'),'PMI');
        addFocusAndBlur(jQuery('#extra'),'Extra');

    /*    addFocusAndBlur(jQuery('.agent-detail .contact-form #name'),'Name');
        addFocusAndBlur(jQuery('.agent-detail .contact-form #email'),'Email');
        addFocusAndBlur(jQuery('.agent-detail .contact-form #comment'),'Message'); */


        /*-----------------------------------------------------------------------------------*/
        /*	Apply Bootstrap Classes on Comment Form Fields to Make it Responsive
        /*-----------------------------------------------------------------------------------*/
        $('#respond #submit, #dsidx-contact-form-submit').addClass('real-btn');
        $('.pages-nav > a').addClass('real-btn');
        $('.dsidx-search-button .submit').addClass('real-btn');
        $('.wpcf7-submit').addClass('real-btn');

        /*----------------------------------------------------------------------------------*/
        /* Contact Form AJAX validation and submission
        /* Validation Plugin : http://bassistance.de/jquery-plugins/jquery-plugin-validation/
        /* Form Ajax Plugin : http://www.malsup.com/jquery/form/
        /*---------------------------------------------------------------------------------- */
        if(jQuery().validate && jQuery().ajaxSubmit)
        {
            // Contact Form Handling
            var contact_options = {
                target: '#message-sent',
                beforeSubmit: function(){
                    $('#contact-loader').fadeIn('fast');
                    $('#message-sent').fadeOut('fast');
                },
                success: function(){
                    $('#contact-loader').fadeOut('fast');
                    $('#message-sent').fadeIn('fast');
                }
            };

            $('#contact-form .contact-form').validate({
                errorLabelContainer: $("div.error-container"),
                submitHandler: function(form) {
                    $(form).ajaxSubmit(contact_options);
                }
            });


            // Agent Message Form Handling
            var agent_form_options = {
                target: '#message-sent',
                beforeSubmit: function(){
                    $('#contact-loader').fadeIn('fast');
                    $('#message-sent').fadeOut('fast');
                },
                success: function(){
                    $('#contact-loader').fadeOut('fast');
                    $('#message-sent').fadeIn('fast');
                }
            };

            $('#agent-contact-form').validate({
                errorLabelContainer: $("div.error-container"),
                submitHandler: function(form) {
                    $(form).ajaxSubmit(agent_form_options);
                }
            });

        }



        /*-----------------------------------------------------------------------------------*/
        /* Swipe Box Lightbox
        /*-----------------------------------------------------------------------------------*/
        if( jQuery().swipebox )
        {
            $(".swipebox").swipebox();
        }


        /*-----------------------------------------------------------------------------------*/
        /* Pretty Photo Lightbox
        /*-----------------------------------------------------------------------------------*/
        if( jQuery().prettyPhoto )
        {
            $(".pretty-photo").prettyPhoto({
                deeplinking: false,
                social_tools: false
            });

            $('a[data-rel]').each(function() {
                $(this).attr('rel', $(this).data('rel'));
            });

            $("a[rel^='prettyPhoto']").prettyPhoto({
                overlay_gallery: false,
                social_tools:false
            });
        }



        /*-------------------------------------------------------*/
        /*	Isotope
        /*------------------------------------------------------*/
        if( jQuery().isotope )
        {
            $(function() {

                var container = $('.isotope'),
                    filterLinks = $('#filter-by a');

                filterLinks.click(function(e){
                    var selector = $(this).attr('data-filter');
                    container.isotope({
                        filter : '.' + selector,
                        itemSelector : '.isotope-item',
                        layoutMode : 'fitRows',
                        animationEngine : 'best-available'
                    });

                    filterLinks.removeClass('active');
                    $('#filter-by li').removeClass('current-cat');
                    $(this).addClass('active');
                    e.preventDefault();
                });

                /* to fix floating bugs due to variation in height */
                setTimeout(function () {
                    container.isotope({
                        filter: "*",
                        layoutMode: 'fitRows',
                        itemSelector: '.isotope-item',
                        animationEngine: 'best-available'
                    });
                }, 1000);

            });
        }



        /* ---------------------------------------------------- */
        /*	Gallery Hover Effect
        /* ---------------------------------------------------- */

        var $mediaContainer=$('.gallery-item .media_container'),
            $media=$('.gallery-item .media_container a');

        var $margin= -($media.height()/2);
        $media.css('margin-top',$margin);

        $(function(){

            $('.gallery-item figure').hover(

                function(){
                    var media= $media.width(),
                        container= ($mediaContainer.width()/2)-(media+2);

                    $(this).children('.media_container').stop().fadeIn(300);
                    $(this).find('.media_container').children('a.link').stop().animate({'right':container}, 300);
                    $(this).find('.media_container').children('a.zoom').stop().animate({'left':container}, 300);
                },
                function(){
                    $(this).children('.media_container').stop().fadeOut(300);
                    $(this).find('.media_container').children('a.link').stop().animate({'right':'0'}, 300);
                    $(this).find('.media_container').children('a.zoom').stop().animate({'left':'0'}, 300);
                }

            );

        });



        /* ---------------------------------------------------- */
        /*  Sizing Header Outer Strip
        /* ---------------------------------------------------- */
        function outer_strip(){
            var $item    = $('.outer-strip'),
                $c_width = $('.header-wrapper .container').width(),
                $w_width = $(window).width(),
                $i_width = ($w_width -  $c_width)/2;

            if( $('body').hasClass('rtl') ){
                $item.css({
                    left: -$i_width,
                    width: $i_width
                });
            }else{
                $item.css({
                    right: -$i_width,
                    width: $i_width
                });
            }
        }

        outer_strip();
        $(window).resize(function(){
            outer_strip();
        });


        /* ---------------------------------------------------- */
        /*	Notification Hide Function
        /* ---------------------------------------------------- */
        $(".icon-remove").click(function() {
           $(this).parent().fadeOut(300);
        });


        /*-----------------------------------------------------------------------------------*/
        /*	Image Hover Effect
        /*-----------------------------------------------------------------------------------*/
        if(jQuery().transition)
        {
            $('.zoom_img_box img').hover(function(){
                $(this).stop(true,true).transition({
                    scale: 1.1
                },300);
            },function(){
                $(this).stop(true,true).transition({
                    scale: 1
                },150);
            });
        }


        /*-----------------------------------------------------------------------------------*/
        /*	Grid and Listing Toggle View
        /*-----------------------------------------------------------------------------------*/
        if($('.lisitng-grid-layout').hasClass('property-toggle')) {
            $('.listing-layout  .property-item-grid').hide();
            $('a.grid').on('click', function(){
                      $('.listing-layout').addClass('property-grid');
                      $('.property-item-grid').show();
                      $('.property-item-list').hide();
                      $('a.grid').addClass('active');
                      $('a.list').removeClass('active');
            });
            $('a.list').on('click', function(){
                $('.listing-layout').removeClass('property-grid');
                $('.property-item-grid').hide();
                $('.property-item-list').show();
                $('a.grid').removeClass('active');
                $('a.list').addClass('active');
            });
         }


        /*-----------------------------------------------------------------------------------*/
        /* Calendar Widget Border Fix
        /*-----------------------------------------------------------------------------------*/
        var $calendar = $('.sidebar .widget #wp-calendar');
        if( $calendar.length > 0){
            $calendar.each(function(){
                $(this).closest('.widget').css('border','none').css('background','transparent');
            });
        }

        var $single_listing = $('.sidebar .widget .dsidx-widget-single-listing');
        if( $single_listing.length > 0){
            $single_listing.each(function(){
                $(this).closest('.widget').css('border','none').css('background','transparent');
            });
        }

        /*-----------------------------------------------------------------------------------*/
        /*	Tags Cloud
        /*-----------------------------------------------------------------------------------*/
        $('.tagcloud').addClass('clearfix');
        $('.tagcloud a').removeAttr('style');

        /*-----------------------------------------------------------------------------------*/
        /*	Max and Min Price Related JavaScript - to show red outline of min is bigger than max
        /*-----------------------------------------------------------------------------------*/
        $('#select-min-price,#select-max-price').change(function(obj, e){
            var min_text_val = $('#select-min-price').val();
            var min_int_val = (isNaN(min_text_val))?0:parseInt(min_text_val);

            var max_text_val = $('#select-max-price').val();
            var max_int_val = (isNaN(max_text_val))?0:parseInt(max_text_val);

            if( (min_int_val >= max_int_val) && (min_int_val != 0) && (max_int_val != 0)){
                $('#select-max-price_input,#select-min-price_input').css('outline','2px solid red');
            }else{
                $('#select-max-price_input,#select-min-price_input').css('outline','none');
            }
        });

        $('#select-min-price-for-rent, #select-max-price-for-rent').change(function(obj, e){
            var min_text_val = $('#select-min-price-for-rent').val();
            var min_int_val = (isNaN(min_text_val))?0:parseInt(min_text_val);

            var max_text_val = $('#select-max-price-for-rent').val();
            var max_int_val = (isNaN(max_text_val))?0:parseInt(max_text_val);

            if( (min_int_val >= max_int_val) && (min_int_val != 0) && (max_int_val != 0)){
                $('#select-max-price-for-rent_input,#select-min-price-for-rent_input').css('outline','2px solid red');
            }else{
                $('#select-max-price-for-rent_input,#select-min-price-for-rent_input').css('outline','none');
            }
        });

        /*-----------------------------------------------------------------------------------*/
        /*	Max and Min Area Related JavaScript - to show red outline of min is bigger than max
         /*-----------------------------------------------------------------------------------*/
        $('#min-area,#max-area').change(function(obj, e){
            var min_text_val = $('#min-area').val();
            var min_int_val = (isNaN(min_text_val))?0:parseInt(min_text_val);

            var max_text_val = $('#max-area').val();
            var max_int_val = (isNaN(max_text_val))?0:parseInt(max_text_val);

            if( (min_int_val >= max_int_val) && (min_int_val != 0) && (max_int_val != 0)){
                $('#min-area,#max-area').css('outline','2px solid red');
            }else{
                $('#min-area,#max-area').css('outline','none');
            }
        });

        /*-----------------------------------------------------------------------------------*/
        /*	Property ID Change Event
        /*-----------------------------------------------------------------------------------*/
        /*$('.advance-search-form #property-id-txt').change(function(obj, e){
            var search_form = $(this).closest('form.advance-search-form');
            var input_controls = search_form.find('input').not('#property-id-txt, .real-btn');
            if( $(this).val().length > 0  ){
                input_controls.prop('disabled', true);
            }else{
                input_controls.prop('disabled', false);
            }
        });*/

        /*-----------------------------------------------------------------------------------*/
        /* Submit Property Page
        /*-----------------------------------------------------------------------------------*/

        // Google Map
        var mapField = {};

        (function(){

            var thisMapField = this;

            this.container = null;
            this.canvas = null;
            this.latlng = null;
            this.map = null;
            this.marker = null;
            this.geocoder = null;

            this.init = function($container)
            {
                this.container = $container;
                this.canvas = $container.find('.map-canvas');
                this.initLatLng(53.346881, -6.258860);
                this.initMap();
                this.initMarker();
                this.initGeocoder();
                this.initMarkerPosition();
                this.initListeners();
                this.initAutoComplete();
                this.bindHandlers();
            }

            this.initLatLng = function($lat, $lng)
            {
                this.latlng = new window.google.maps.LatLng($lat, $lng);
            }

            this.initMap = function()
            {
                this.map = new window.google.maps.Map(this.canvas[0], {
                    zoom: 8,
                    center: this.latlng,
                    streetViewControl: 0,
                    mapTypeId: window.google.maps.MapTypeId.ROADMAP
                });
            }

            this.initMarker = function()
            {
                this.marker = new window.google.maps.Marker({position: this.latlng, map: this.map, draggable: true});
            }

            this.initMarkerPosition = function()
            {
                var coord = this.container.find('.map-coordinate').val();
                var addressField = this.container.find('.goto-address-button').val();
                var l;
                var zoom;

                if (coord)
                {
                    l = coord.split( ',' );
                    this.marker.setPosition( new window.google.maps.LatLng( l[0], l[1] ) );

                    zoom = l.length > 2 ? parseInt( l[2], 10 ) : 15;

                    this.map.setCenter(this.marker.position);
                    this.map.setZoom(zoom);
                }
                else if (addressField)
                {
                    this.geocodeAddress(addressField);
                }

            }

            this.initGeocoder = function()
            {
                this.geocoder = new window.google.maps.Geocoder();
            }

            this.initListeners = function()
            {
                var that = thisMapField;
                window.google.maps.event.addListener(this.map, 'click', function (event)
                {
                    that.marker.setPosition(event.latLng);
                    that.updatePositionInput(event.latLng);
                });
                window.google.maps.event.addListener(this.marker, 'drag', function (event)
                {
                    that.updatePositionInput(event.latLng);
                });
            }

            this.updatePositionInput = function(latLng)
            {
                this.container.find('.map-coordinate').val(latLng.lat() + ',' + latLng.lng());
            }

            this.geocodeAddress = function(addressField)
            {
                var address = '';
                var fieldList = addressField.split(',');
                var loop;

                for (loop = 0; loop < fieldList.length; loop++)
                {
                    address += jQuery('#' + fieldList[loop] ).val();
                    if(loop+1 < fieldList.length) {  address += ', '; }
                }

                address = address.replace( /\n/g, ',' );
                address = address.replace( /,,/g, ',' );

                var that = thisMapField;
                this.geocoder.geocode({'address': address}, function (results, status)
                {
                    if ( status == window.google.maps.GeocoderStatus.OK )
                    {
                        that.updatePositionInput(results[0].geometry.location);
                        that.marker.setPosition(results[0].geometry.location);
                        that.map.setCenter(that.marker.position);
                        that.map.setZoom(15);
                    }
                });
            }

            this.initAutoComplete = function()
            {
                var addressField = this.container.find('.goto-address-button').val();
                if (!addressField) return null;

                var that = thisMapField;
                $('#' + addressField).autocomplete({
                    source: function(request, response) {
                        // TODO: add 'region' option, to help bias geocoder.
                        that.geocoder.geocode( {'address': request.term }, function(results, status) {
                            response($.map(results, function(item) {
                                return {
                                    label: item.formatted_address,
                                    value: item.formatted_address,
                                    latitude: item.geometry.location.lat(),
                                    longitude: item.geometry.location.lng()
                                };
                            }));
                        });
                    },
                    select: function(event, ui) {
                        that.container.find(".map-coordinate").val(ui.item.latitude + ',' + ui.item.longitude );
                        var location = new window.google.maps.LatLng(ui.item.latitude, ui.item.longitude);
                        that.map.setCenter(location);
                        // Drop the Marker
                        setTimeout(function(){
                            that.marker.setValues({
                                position: location,
                                animation: window.google.maps.Animation.DROP
                            });
                        }, 1500);
                    }
                });
            }

            this.bindHandlers = function()
            {
                var that = thisMapField;
                this.container.find('.goto-address-button').bind('click', function() { that.onFindAddressClick($(this)); });
            }

            this.onFindAddressClick = function($that)
            {
                var $this = $that;
                this.geocodeAddress($this.val());
            }

        }).apply(mapField);

        $('.map-wrapper').each(function(){
            mapField.init($(this));
        });

        /* Add More Gallery Button */
        var files_count = $('#gallery-images-container .gallery-image').length;
        $('#add-more').click(function(e){
            e.preventDefault();
            files_count++;
            $('#gallery-images-container').append('<div class="controls-holder"><input class="gallery-image image" name="gallery_image_'+ files_count +'" type="file" /></div>');
        });

        /* Validate Image File Extension */
        function validateImage(file){
            var validFileExtensions = ["jpg", "jpeg", "gif", "png", "pdf"];
            var ext = file.split('.').pop();
            if( $.inArray( ext, validFileExtensions ) == -1) {
                return false;
            }
            return true;
        }

        /* Validate Submit Property Form */
        if(jQuery().validate){
            jQuery.validator.addMethod("image", function(value, element) {
                    return this.optional(element) || validateImage(value);
                }, "* Please provide image with proper extension! Only .jpg .gif and .png are allowed.");

            $('#submit-property-form').validate({
                rules: {
                    bedrooms: {
                        number: true
                    },
                    bathrooms: {
                        number: true
                    },
                    garages: {
                        number: true
                    },
                    price: {
                        number: true
                    },
                    size: {
                        number: true
                    }
                }
            });

            /* Login , Register and Forgot Password Form */
            $('#login-form').validate();
            $('#register-form').validate();
            $('#forgot-form').validate();
        }

        /* Forgot Form */
        $('.login-register #forgot-form').slideUp('fast');
        $('.login-register .toggle-forgot-form').click(function(event){
            event.preventDefault();
            $('.login-register #forgot-form').slideToggle('fast');
        });


        /* Edit Property Related Script */
        // Remove Featured Image
        $('a.remove-featured-image').click(function(event){
            event.preventDefault();

            var $this = $(this);
            var gallery_thumb = $this.closest('.gallery-thumb');
            var loader = $this.siblings('.loader');

            loader.show();

            var removal_request = $.ajax({
                url: $this.attr('href'),
                type: "POST",
                data: {
                    property_id : $this.data('property-id'),
                    action : "remove_featured_image"
                },
                dataType: "html"
            });

            removal_request.done(function( msg ) {
                var code = parseInt(msg);
                loader.hide();

                if(code == 3){
                    gallery_thumb.remove();
                    $("#featured-file-container").removeClass('hidden');
                }else if( code == 2){
                    alert( "Failed to remove!" );
                }else if( code == 1){
                    alert( "Invalide Parameters!" );
                }else{
                    alert( "Unexpected response: " + msg );
                }

            });

            removal_request.fail(function( jqXHR, textStatus ) {
                alert( "Request failed: " + textStatus );
            });
        });


        // Remove Gallery Image
        $('a.remove-image').click(function(event){
            event.preventDefault();

            var $this = $(this);
            var gallery_thumb = $this.closest('.gallery-thumb');
            var loader = $this.siblings('.loader');

            loader.show();

            var removal_request = $.ajax({
                url: $this.attr('href'),
                type: "POST",
                data: {
                    property_id : $this.data('property-id'),
                    gallery_img_id : $this.data('gallery-img-id'),
                    action : "remove_gallery_image"
                },
                dataType: "html"
            });

            removal_request.done(function( msg ) {
                var code = parseInt(msg);
                loader.hide();

                if(code == 3){
                    gallery_thumb.remove();
                }else if( code == 2){
                    alert( "Failed to remove!" );
                }else if( code == 1){
                    alert( "Invalide Parameters!" );
                }else{
                    alert( "Unexpected response: " + msg );
                }

            });

            removal_request.fail(function( jqXHR, textStatus ) {
                alert( "Request failed: " + textStatus );
            });
        });


        /* dsIDXpress */
        $('#dsidx-top-search #dsidx-search-form table td').removeClass('label');
        $('.dsidx-tag-pre-foreclosure br').replaceWith(' ');


        /*-----------------------------------------------------------------------------------*/
        /* Display Price Fields Based on Status Selection
        /*-----------------------------------------------------------------------------------*/
        if ( typeof localized.rent_slug !== "undefined" ){
            var property_status_changed = function( new_status ){
                var price_for_others = $('.advance-search-form .price-for-others');
                var price_for_rent = $('.advance-search-form .price-for-rent');
                if( price_for_others.length > 0 && price_for_rent.length > 0){
                    if( new_status == localized.rent_slug ){
                        price_for_others.addClass('hide-fields').find('select').prop('disabled', true);
                        price_for_rent.removeClass('hide-fields').find('select').prop('disabled', false);
                    }else{
                        price_for_rent.addClass('hide-fields').find('select').prop('disabled', true);
                        price_for_others.removeClass('hide-fields').find('select').prop('disabled', false);
                    }
                }
            }
            $('.advance-search-form #select-status').change(function(e){
                var selected_status = $(this).val();
                property_status_changed(selected_status);
            });
            /* On page load ( as on search page ) */
            var selected_status = $('.advance-search-form #select-status').val();
            if( selected_status == localized.rent_slug ){
                property_status_changed(selected_status);
            }
        }

        /*-----------------------------------------------------------------------------------*/
        /* Properties Sorting
        /*-----------------------------------------------------------------------------------*/
        function insertParam(key, value) {
            key = encodeURI(key);
            value = encodeURI(value);

            var kvp = document.location.search.substr(1).split('&');

            var i = kvp.length;
            var x;
            while (i--) {
                x = kvp[i].split('=');

                if (x[0] == key) {
                    x[1] = value;
                    kvp[i] = x.join('=');
                    break;
                }
            }

            if (i < 0) {
                kvp[kvp.length] = [key, value].join('=');
            }

            //this will reload the page, it's likely better to store this until finished
            document.location.search = kvp.join('&');
        }

        $('#sort-properties').on('change', function() {
            var key = 'orderby';
            var value = $(this).val();
            insertParam( key, value );
        });

        /*-----------------------------------------------------------------------------------*/
        /* Modal dialog for Login and Register
        /*-----------------------------------------------------------------------------------*/
        $('.activate-section').click(function(e){
            e.preventDefault();
            var $this = $(this);
            var target_section = $this.data('section');
            $this.closest('.modal-section').hide();
            $this.closest('.forms-modal').find('.'+target_section).show();
        });

        /*-----------------------------------------------------------------------------------*/
        /* Add to favorites
        /*-----------------------------------------------------------------------------------*/
        $('a#add-to-favorite').click(function(e){
            e.preventDefault();
            var $star = $(this).find('i');
            var add_to_fav_opptions = {
                target:        '#fav_target',   // target element(s) to be updated with server response
                beforeSubmit:  function(){
                    $star.addClass('fa-spin');
                },  // pre-submit callback
                success:       function(){
                    $star.removeClass('fa-spin');
                    $('#add-to-favorite').hide(0,function(){
                        $('#fav_output').delay(200).show();
                    });
                }
            };

            $('#add-to-favorite-form').ajaxSubmit( add_to_fav_opptions );
        });

        /*-----------------------------------------------------------------------------------*/
        /* Remove from favorites
        /*-----------------------------------------------------------------------------------*/
        $('a.remove-from-favorite').click(function(event){
            event.preventDefault();
            var $this = $(this);
            var property_item = $this.closest('.property-item');
            var loader = $this.siblings('.loader');
            var ajax_response = property_item.find('.ajax-response');

            $this.hide();
            loader.show();

            var remove_favorite_request = $.ajax({
                url: $this.attr('href'),
                type: "POST",
                data: {
                    property_id : $this.data('property-id'),
                    user_id : $this.data('user-id'),
                    action : "remove_from_favorites"
                },
                dataType: "html"
            });


            remove_favorite_request.done(function( msg ) {
                var code = parseInt(msg);
                loader.hide();

                if(code == 3){
                    property_item.remove();
                }else if( code == 2){
                    ajax_response.text("Failed to remove!");
                }else if( code == 1){
                    ajax_response.text("Invalide Parameters!");
                }else{
                    ajax_response.text("Unexpected Response: "+ msg);
                }

            });

            remove_favorite_request.fail(function( jqXHR, textStatus ) {
                ajax_response.text( "Request failed: " + textStatus );
            });
        });

    });

})(jQuery);