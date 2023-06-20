
$(window).on('load', function () {
    $('.full-w-h').fadeOut(200);
    $('body').css('overflow-y', 'auto');
})


$(document).ready(function () {


    if ( $("#bn1").length ) {
        $("#bn1").breakingNews({
            effect: "slide-h",
            autoplay: true,
            timer: 3500,
            color: "#fff",
        });
    }
    
    $('.form-control').focus(function () {
        $(this).parents('.form-group').addClass('focused');
    });
    
    $('.form-control').blur(function () {
        var inputValue = $(this).val();
        if (inputValue == "") {
            $(this).removeClass('filled');
            $(this).parents('.form-group').removeClass('focused');
        } else {
            $(this).addClass('filled');
        }
    });


    topNav = $('.top-nav').outerHeight();
    navbarHeight = $('.navbar').outerHeight();
    var wt = $('.lasted-news').outerWidth();
    $('.lasted-news-title').css('width', `calc(100% - (${ wt }px + 70px) )`);



    // Int nice select
    if ($('.select').length) {
        $('.select').niceSelect();
    }



    // Clients Slider
    if ( $('.uniq-players-slider').length ) {
        $('.uniq-players-slider').owlCarousel({
            center: false,
            nav: false,
            dots: false,
            rtl: false,
            items: 2,
            loop: true,
            margin: 10,
            responsive: {
                0: {
                    items: 1
                },
                800: {
                    items: 2,
                }
            }
        });
    }

    

    if ( $(".full-product-imgs-slider").length ) {
        let owl = $(".full-product-imgs-slider").owlCarousel({
            loop: true,
            dots: true,
            autoplay: 4000,
            margin: 10,
            items: 1,
            dotsContainer: '#products-custom-dots',
            rtl: false,
        });
        $('#products-custom-dots .owl-dot').on('click', function(e) {
            owl.trigger('to.owl.carousel', [$(this).index(), 300]);
        });
    }




    if ( $(".articles-s").length ) {
        $(".articles-s").owlCarousel({
            nav: false,
            navigation:false,
            loop: true,
            navText: ['<i class="fa fa-arrow-right" aria-hidden="true"></i>','<i class="fa fa-arrow-left" aria-hidden="true"></i>'],
            dots: false,
            autoplay: 4000,
            margin: 10,
            items: 5.7,
            autoplayHoverPause: false,
            center: true,
            responsiveClass: false,
            rtl: false,
            responsive: {
                0: {
                    items: 1.3
                },
                768: {
                    items: 3.5
                },
                1000: {
                    items: 5.7,
                }
            }
        });
    }
    


    if ( $(".home-shopping-slider").length ) {
        $(".home-shopping-slider").owlCarousel({
            nav: false,
            navigation:false,
            loop: true,
            dots: false,
            autoplay: 3000,
            margin: 10,
            items: 3,
            autoplayHoverPause: false,
            center: true,
            responsiveClass: true,
            rtl: false,
            responsive: {
                0: {
                    items: 2
                },
                768: {
                    items: 3
                }
            }
        });
    }
    
    
    

    if ( $('.orders-slider').length ) {
        $('.orders-slider').owlCarousel({
            center: false,
            nav: false,
            navText: ['<i class="fa fa-arrow-left" aria-hidden="true"></i>','<i class="fa fa-arrow-right" aria-hidden="true"></i>'],
            dots: false,
            rtl: true,
            items: 1,
            loop: true,
            margin: 10,
            responsive: {
                0: {
                    items: 1
                },
                800: {
                    items: 1,
                },
                991: {
                    items: 1,
                },
                1200: {
                    items: 1,
                }
            }
        });
    }




    if ( $('.world-team-slider').length ) {
        $('.world-team-slider').owlCarousel({
            center: false,
            nav: true,
            navText: ['<i class="fa fa-arrow-right" aria-hidden="true"></i>','<i class="fa fa-arrow-left" aria-hidden="true"></i>'],
            dots: false,
            rtl: false,
            items: 3,
            loop: true,
            margin: 10,
            responsive: {
                0: {
                    items: 1
                },
                800: {
                    items: 2,
                },
                991: {
                    items: 3,
                }
            }
        });
    }

    if ( $('.lasted-videos-slider').length ) {
        $('.lasted-videos-slider').owlCarousel({
            center: false,
            nav: true,
            navText: ['<i class="fa fa-arrow-right" aria-hidden="true"></i>','<i class="fa fa-arrow-left" aria-hidden="true"></i>'],
            dots: false,
            rtl: false,
            items: 3,
            loop: true,
            margin: 10,
            responsive: {
                0: {
                    items: 1
                },
                800: {
                    items: 2,
                },
                991: {
                    items: 4,
                }
            }
        });
    }

    

    if ( $('.coachs-slider').length ) {
        $('.coachs-slider').owlCarousel({
            center: false,
            nav: true,
            navText: ['<i class="fa fa-arrow-right" aria-hidden="true"></i>','<i class="fa fa-arrow-left" aria-hidden="true"></i>'],
            dots: false,
            rtl: false,
            items: 3,
            loop: true,
            margin: 10,
            responsive: {
                0: {
                    items: 1
                },
                800: {
                    items: 2,
                },
                991: {
                    items: 3,
                }
            }
        });
    }
    
    if ( $('.accade-slider').length ) {
        $('.accade-slider').owlCarousel({
            center: false,
            nav: true,
            navText: ['<i class="fa fa-arrow-right" aria-hidden="true"></i>','<i class="fa fa-arrow-left" aria-hidden="true"></i>'],
            dots: false,
            rtl: false,
            items: 2,
            singleItem: true,
            loop: true,
            responsive: {
                0: {
                    items: 1
                },
                800: {
                    items: 2,
                }
            }
        });
    }



    // Search Box show when clicked on btn
    $('.sca').on('click', function () {
        $('.search-area').toggleClass('show');
    })


    $(document).mouseup(function (e) {
        var container = $(".search-area");

        // if the target of the click isn't the container nor a descendant of the container
        if (!container.is(e.target) && container.has(e.target).length === 0) {
            container.removeClass('show');


        }

    });

    setInterval(() => {
        if ($(".search-area").hasClass('show')) {
            $('html').css('cursor', "url('images/close.png'), auto");
            $(".search-area").css('cursor', "auto");
        } else {
            $('html').css('cursor', "auto");
        }
    })


    //Date
    var fixd;
    function isGregLeapYear(year) {
        return year % 4 == 0 && year % 100 != 0 || year % 400 == 0;
    }
    function gregToFixed(year, month, day) {
        var a = Math.floor((year - 1) / 4);
        var b = Math.floor((year - 1) / 100);
        var c = Math.floor((year - 1) / 400);
        var d = Math.floor((367 * month - 362) / 12);
        if (month <= 2)
            e = 0;
        else if (month > 2 && isGregLeapYear(year))
            e = -1;
        else
            e = -2;
        return 1 - 1 + 365 * (year - 1) + a - b + c + d + e + day;
    }
    function Hijri(year, month, day) { this.year = year; this.month = month; this.day = day; this.toFixed = hijriToFixed; this.toString = hijriToString; }
    function hijriToFixed() {
        return this.day + Math.ceil(29.5 * (this.month - 1)) + (this.year - 1) * 354 + Math.floor((3 + 11 * this.year) / 30) + 227015 - 1;
    }
    function hijriToString() {
        var months = new Array("Mahram ", "Safar ", "Rabi al-Awwal", "Rabi al-Thany", "Jumada al-Awwal ", "Jumada al-Thany", "Rajab ", "Shaban ", "Ramadan ", "Shawwal ", "Dhul-Qidah", "Dhul-Hijjah");
        return this.day + " " + months[this.month - 1] + " " + this.year;
    }
    function fixedToHijri(f) {
        var i = new Hijri(1100, 1, 1);
        i.year = Math.floor((30 * (f - 227015) + 10646) / 10631);
        var i2 = new Hijri(i.year, 1, 1);
        var m = Math.ceil((f - 29 - i2.toFixed()) / 29.5) + 1;
        i.month = Math.min(m, 12); i2.year = i.year; i2.month = i.month; i2.day = 1;
        i.day = f - i2.toFixed() + 1;
        return i;
    }
    var tod = new Date();
    var weekday = new Array("Sunday ", "Monday ", "Tuesday ", "Wednesday", "Thursday ", "Friday ", "Saturday ");
    var monthname = new Array("January ", "February ", "March", "April ", "May ", "June ", "July ", "August ", "September ", "October ", "November ", "December ");
    var y = tod.getFullYear();
    var m = tod.getMonth();
    var d = tod.getDate();
    var dow = tod.getDay();
    m++;
    fixd = gregToFixed(y, m, d);
    var h = new Hijri(1421, 11, 28);
    h = fixedToHijri(fixd);
    window.datenow.innerHTML = h.toString() + ' - ' + weekday[dow] + " " + d + " " + monthname[m] + " " + y






    // Custom Slider DeshaXii
    var mainBannerArea = $('.banner-area');

    if (mainBannerArea.length) {
        mainBannerArea.owlCarousel({
            items: 1,
            rtl: false,
            loop: true,
            dots: true,
            animateOut: 'zoomOutDown  ',
            animateIn: 'zoomInDown',
            thumbs: false,
            nav: true,
            mouseDrag: true,
            navText: ['<i class="fa fa-arrow-left" aria-hidden="true"></i><div class="itemprebg"></div>', '<div class="itemnextbg"></div><i class="fa fa-arrow-right" aria-hidden="true"></i>'],
            autoplay: true,
            touchDrag: true,
            lazyLoad: true,
            dotsContainer: '#carousel-custom-dots',
            autoplayTimeout: 20000 // auto play time
        });
    }
    

    var itemBg = $('.itembg');

    $('.banner-area .single-banner').each(function () {
        var itmeImg = $(this).find('.itembg img').attr('src');
        $(this).css({
            background: 'url(' + itmeImg + ')'
        });
    });

    function slideThumb() {

        $('.banner-area .owl-item').removeClass('next prev');

        var currenSlide = $('.banner-area .owl-item.active');
        currenSlide.next('.owl-item').addClass('next');
        currenSlide.prev('.owl-item').addClass('prev');

        var nextSlideImg = $('.owl-item.next').find('.itembg img').attr('src');
        var prevSlideImg = $('.owl-item.prev').find('.itembg img').attr('src');

        $('.banner-area .owl-nav .owl-prev .itemprebg').css({
            background: 'url(' + prevSlideImg + ')'
        });

        $('.banner-area .owl-nav .owl-next .itemnextbg').css({
            background: 'url(' + nextSlideImg + ')'
        });

    }

    slideThumb();

    mainBannerArea.on('translate.owl.carousel', function () {
        $('.single-banner a, .single-banner h1, .single-banner .head-date').removeClass('slideInLeft animated').hide();
    });

    mainBannerArea.on('translated.owl.carousel', function () { 
        slideThumb();
        $('.owl-item.active .single-banner a, .owl-item.active .single-banner h1, .owl-item.active .single-banner .head-date').addClass('slideInLeft animated').show();
    });


    $('.owl-dot').click(function () {
        mainBannerArea.trigger('to.owl.carousel', [$(this).index(), 300]);
    });





    // DeshaXii --- custom owl slider code
    // var offset = document.getElementById( 'big-el' ),
    //         other  = document.getElementsByClassName( 'accade-box' )[1];
    //     window.Object.defineProperty( Element.prototype, 'documentOffsetTop', {
    //         get: function () { 
    //             return this.offsetTop + ( this.offsetParent ? this.offsetParent.documentOffsetTop : 0 );
    //         }
    //     } );
        // var acc = document.getElementsByClassName('accade')[0];
        // var accPaddingTop = window.getComputedStyle(acc, null).getPropertyValue('padding-top');
        // var accPaddingBottom = window.getComputedStyle(acc, null).getPropertyValue('padding-bottom');
        // var t = offset.documentOffsetTop + parseInt(accPaddingTop);
        // var b = offset.documentOffsetTop + parseInt(accPaddingBottom);
        // var d = offset.documentOffsetTop;
        // var n = $('.accade-half-box').outerHeight();
        // var z = $('.accade-box').outerHeight();
        // var c = t - d
        // var x = n - z;
        // x = x / 2
        

        

        //Custom Owl Carousel By DeshaXii 
        var src = $('.accade .accade-slider .active:first .item-background img').attr('src');
        $('.image-from-item').css('background-image', `url(${src})`)
        

        setInterval(function () {
            $('.accade .accade-slider .active').removeClass('uniq-color');
            $('.accade .accade-slider .active:first').addClass('uniq-color');
        }, 1000)


        var owl = $('.accade-slider');

        
        owl.on('changed.owl.carousel', function(event) {
            var src = $('.accade .accade-slider .active:last .item-background img').attr('src');
            
            $('.image-from-item').css('background-image', `url(${src})`);
        })

        owl.owlCarousel();
        // Go to the next item
        $('.owl-nav .owl-next').click(function() {
            var src = $('.accade .accade-slider .active:last .item-background img').attr('src');
            $('.image-from-item').css('background-image', `url(${src})`);
        })
        // Go to the previous item
        $('.owl-nav .owl-prev').click(function() {
            var src = $('.accade .accade-slider .active:first .item-background img').attr('src');
            $('.image-from-item').css('background-image', `url(${src})`);
         })











});


// Zoom Script
$.fn.lightzoom=function(a){a=$.extend({zoomPower:3,glassSize:175},a);var l=a.glassSize/2,m=a.glassSize/4,n=a.zoomPower;$("body").append('<div id="glass"></div>');$("html > head").append($("<style> #glass{width: "+a.glassSize+"px; height: "+a.glassSize+"px;}</style>"));var k;$("#glass").mousemove(function(a){var c=this.targ;a.target=c;k(a,c)});this.mousemove(function(a){k(a,this)});k=function(a,c){document.getElementById("glass").targ=c;var d=a.pageX,e=a.pageY,g=c.offsetWidth,h=c.offsetHeight,b=$(c).offset(),
f=b.left,b=b.top;d>f&&d<f+g&&b<e&&b+h>e?(offsetXfixer=(d-f-g/2)/(g/2)*m,offsetYfixer=(e-b-h/2)/(h/2)*m,f=(d-f+offsetXfixer)/g*100,b=(e-b+offsetYfixer)/h*100,e-=l,d-=l,$("#glass").css({top:e,left:d,"background-image":" url('"+c.src+"')","background-size":g*n+"px "+h*n+"px","background-position":f+"% "+b+"%",display:"inline-block"}),$("body").css("cursor","none")):($("#glass").css("display","none"),$("body").css("cursor","default"))};return this};


    $(document).ready(function () {
        $('img.light-zoom').lightzoom({
            zoomPower   : 2,    //Default
            glassSize   : 180,  //Default
        });
    });


    
