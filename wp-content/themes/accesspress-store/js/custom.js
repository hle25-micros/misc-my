jQuery(function ($) {

    //Navigation toggle
    $("#toggle").click(function () {
        $(this).toggleClass("on");
        $("#menu").slideToggle();
    });
         

    $('.search-icon a').click(function () {
        $('.search-box').addClass('active');
    });

    $('.search-box .close').click(function () {
        $('.search-box').removeClass('active');
    });

    // Woocommerce single page thumbinal image slide
    $('.single-img .img-wrap .images > .thumbnails').slick({
        infinite: true,
        centerMode: false,
        useCss: false,
        easing: 'linear',
        edgeFriction: '0.15',
        lazyLoad: 'ondemand',
        speed: 500,
        slidesToShow: 4,
        slidesToScroll: 1,
        cssEase: 'ease',
        responsive: [
            {
                breakpoint: 1024,
                settings: {
                    slidesToShow: 3,
                    slidesToScroll: 1,
                    dots: true
                }
            },
            {
                breakpoint: 600,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 1
                }
            },
            {
                breakpoint: 480,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1
                }
            }

        ]
    });

// end

    $('.new-prod-slide').slick({
        infinite: true,
        centerMode: false,
        useCss: false,
        easing: 'linear',
        edgeFriction: '0.15',
        lazyLoad: 'ondemand',
        speed: 500,
        slidesToShow: 4,
        slidesToScroll: 1,
        cssEase: 'ease',
        responsive: [
            {
                breakpoint: 1024,
                settings: {
                    slidesToShow: 3,
                    slidesToScroll: 1,
                    dots: true
                }
            },
            {
                breakpoint: 600,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 1
                }
            },
            {
                breakpoint: 480,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1
                }
            }
        ]
    });

    $('.feature-cat-product').slick({
        infinite: true,
        centerMode: false,
        useCss: false,
        easing: 'linear',
        edgeFriction: '0.15',
        lazyLoad: 'ondemand',
        speed: 500,
        slidesToShow: 2,
        slidesToScroll: 1,
        cssEase: 'ease',
        responsive: [
            {
                breakpoint: 1024,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 1,
                    dots: true
                }
            },
            {
                breakpoint: 600,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1
                }
            },
            {
                breakpoint: 480,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1
                }
            }
        ]
    });

    new WOW().init();

    $('#ak-top').css('right', -65);
    $(window).scroll(function () {
        if ($(this).scrollTop() > 300) {
            $('#ak-top').css('right', 20);
        } else {
            $('#ak-top').css('right', -65);
        }
    });

    $("#ak-top").click(function () {
        $('html,body').animate({scrollTop: 0}, 600);
    });

    $('.ticker-wrapper').show();

$('.navigation').addClass("clearfix");

});//doc close

jQuery(function ($) {
	var items = $('.tabbed-content-control>ul>li').each(function () {
		$(this).click(function () {			
			//remove previous class and add it to clicked tab
			items.removeClass('active');
			$(this).addClass('active');
			$('.tabbed-content-control>div.tab-content>div.tab-pane').hide().eq(items.index($(this))).show();
			//window.location.hash = $(this).attr('tab');
		});
	});
	
	showTab("tab_current");
   

	function showTab(tab) {
		$("#"+tab).click();
	}

	
});