// search toggle
$(document).on('click', '.search-opener', function() {
    $(this).closest('.search-switcher').toggleClass('showing');
});
$(document).on('click', '.close-popup, .popup-overlay', function() {
    $(this).closest('.search-switcher').removeClass('showing');
});
$(document).on('click', '.search-content-popup li.cat-item a', function() {
    var slug = $(this).data('slug');
    $(this).parent().siblings('.selected').removeClass('selected');
    $(this).parent().addClass('selected');
    $(this).closest('.categories-list').find('input[type="hidden"]').val(slug);
});

// Hide cart side content 
$(document).on('click', '.toggle-cartside', function() {
    $('.cart-side-content').toggleClass('opened');
});
//mobile menu display
$(document).on('click', '.mobile-navigation #close-menu-moblie a', function() {
    $('body').removeClass('mobile-nav-on');
});
$(document).on('click', '.toggle-menu, .mobile-menu-overlay', function() {
    $('body').toggleClass('mobile-nav-on');
});
//mobile menu add opener
$('.mobile-menu .toggle-submenu').on('click', function() {
    $(this).prev().slideToggle()
});

/*========================= Scroll To Top Using Y Practice ==========================*/

let btnUp = document.getElementById("up_btn");

window.addEventListener("scroll", () => {
    if (window.scrollY >= 600) {
        btnUp.classList.add('fade')
    } else {
        btnUp.classList.remove('fade')
    }
})

btnUp.addEventListener("click", () => {
    window.scrollTo({
        top: 0,
        right: 0,
        behavior: "smooth"
    });
})



/*=================== categories owl carousel ===================*/
$(".categories_section .owl-carousel").owlCarousel({
    autoplay: true,
    nav: false,
    dots: false,
    navText: ['<i class="fal fa-chevron-left"></i>', '<i class="fal fa-chevron-right"></i>'],
    loop: true,
    responsive: {
        0: { items: 1.5 },
        450: { items: 2 },
        768: { items: 3 },
        992: { items: 4 },
        1201: { items: 6 },
    }
})

/*=================== products owl carousel ===================*/
$(".products_section .owl-carousel").owlCarousel({
    autoplay: true,
    nav: true,
    dots: false,
    navText: ['<i class="fal fa-chevron-left"></i>', '<i class="fal fa-chevron-right"></i>'],
    loop: true,
    responsive: {
        0: { items: 1 },
        768: { items: 2 },
        992: { items: 3 }
    }
})



/* ===============================  Animated Reveal  =============================== */

var animateReveal = function() {

    var controller = new ScrollMagic.Controller();

    var greveal = $('.gsap-reveal');

    // gsap reveal
    $('.gsap-reveal').each(function() {
        $(this).append('<span class="cover"></span>');
    });
    if (greveal.length) {
        var revealNum = 0;
        greveal.each(function() {
            var cover = $(this).find('.cover');

            var tl = new TimelineMax();

            setTimeout(function() {
                tl
                    .fromTo(cover, 2, { skewX: 0 }, { xPercent: 101, transformOrigin: "0% 100%", ease: Expo.easeInOut })
            }, revealNum * 0);

            var scene = new ScrollMagic.Scene({
                    triggerElement: this,
                    duration: "0%",
                    reverse: false,
                    offset: "-300%",
                })
                .setTween(tl)
                .addTo(controller);

            revealNum++;

        });
    }

    // gsap reveal hero
    $('.gsap-reveal-hero').each(function() {
        var html = $(this).html();
        $(this).html('<span class="reveal-wrap"><span class="cover"></span><span class="reveal-content">' + html + '</span></span>');
    });
    var grevealhero = $('.gsap-reveal-hero');

    if (grevealhero.length) {
        var heroNum = 0;
        grevealhero.each(function() {

            var cover = $(this).find('.cover'),
                revealContent = $(this).find('.reveal-content');

            var tl2 = new TimelineMax();

            setTimeout(function() {

                tl2
                    .to(cover, 1, {
                        marginLeft: '0',
                        ease: Expo.easeInOut,
                        onComplete() {
                            tl2.set(revealContent, { x: 0 });
                            tl2.to(cover, 1, { marginLeft: '102%', ease: Expo.easeInOut });
                        }
                    })
            }, heroNum * 0);

            var scene = new ScrollMagic.Scene({
                    triggerElement: this,
                    duration: "0%",
                    reverse: false,
                    offset: "-300%",
                })
                .setTween(tl2)
                .addTo(controller);

            heroNum++;
        });
    }

}

animateReveal();

/* ===============================  WOW.js  =============================== */

new WOW().init();


/********************** owl carousel thumb ***********************/

var bigimage = $("#big_image");
var thumbs = $("#thumbs_gallary");
var syncedSecondary = true;

bigimage
    .owlCarousel({
        items: 1,
        slideSpeed: 2000,
        nav: true,
        autoplay: false,
        dots: false,
        loop: true,
        responsiveRefreshRate: 200,
        navText: ['<i class="fal fa-chevron-left" aria-hidden="true"></i>', '<i class="fal fa-chevron-right" aria-hidden="true"></i>'],
    })
    .on("changed.owl.carousel", syncPosition);

thumbs
    .on("initialized.owl.carousel", function() {
        thumbs
            .find(".owl-item")
            .eq(0)
            .addClass("current");
    })
    .owlCarousel({
        items: 4,
        dots: false,
        nav: false,
        navText: ['<i class="fal fa-chevron-left" aria-hidden="true"></i>', '<i class="fal fa-chevron-right" aria-hidden="true"></i>'],
        smartSpeed: 200,
        slideSpeed: 500,
        slideBy: 2,
        responsiveRefreshRate: 100
    })
    .on("changed.owl.carousel", syncPosition2);

function syncPosition(el) {
    //if loop is set to false, then you have to uncomment the next line
    //var current = el.item.index;

    //to disable loop, comment this block
    var count = el.item.count - 1;
    var current = Math.round(el.item.index - el.item.count / 2 - 0.5);

    if (current < 0) {
        current = count;
    }
    if (current > count) {
        current = 0;
    }
    //to this
    thumbs
        .find(".owl-item")
        .removeClass("current")
        .eq(current)
        .addClass("current");
    var onscreen = thumbs.find(".owl-item.active").length - 1;
    var start = thumbs
        .find(".owl-item.active")
        .first()
        .index();
    var end = thumbs
        .find(".owl-item.active")
        .last()
        .index();

    if (current > end) {
        thumbs.data("owl.carousel").to(current, 100, true);
    }
    if (current < start) {
        thumbs.data("owl.carousel").to(current - onscreen, 100, true);
    }
}

function syncPosition2(el) {
    if (syncedSecondary) {
        var number = el.item.index;
        bigimage.data("owl.carousel").to(number, 100, true);
    }
}

thumbs.on("click", ".owl-item", function(e) {
    e.preventDefault();
    var number = $(this).index();
    bigimage.data("owl.carousel").to(number, 300, true);
});


// height of slider

function getMaxHeightImg() {
    var imgs = $('#cd-slider-2 li img');
    var maxImgHeight = 0;

    imgs.each(function() {
        var imgHeight = $(this).outerHeight();
        maxImgHeight = maxImgHeight > imgHeight ? maxImgHeight : imgHeight;
    });
    $("#cd-slider-2").height(maxImgHeight)
}

function getMaxHeightImg2() {
    var imgs = $('#cd-slider li img');
    var maxImgHeight = 0;

    imgs.each(function() {
        var imgHeight = $(this).outerHeight();
        maxImgHeight = maxImgHeight > imgHeight ? maxImgHeight : imgHeight;
    });
    $("#cd-slider").height(maxImgHeight)
}

getMaxHeightImg();
getMaxHeightImg2();

$(window).on('resize', function() {
    getMaxHeightImg();
    getMaxHeightImg2();
})

//quantity
var number_click = 1;
$(document).on('click', '.quantity-minus', function() {
    var val_input = $(this).closest('.input-group').find('.quantity').val();
    val_input = val_input ? parseInt(val_input) : 0;
    if (val_input <= number_click) {
        val_input = number_click;
    } else {
        val_input = val_input - number_click;
    }
    $(this).closest('.input-group').find('.quantity').val(val_input);
});
$(document).on('click', '.quantity-plus', function() {
    var val_input = $(this).closest('.input-group').find('.quantity').val();
    val_input = val_input ? parseInt(val_input) : 0;
    val_input = val_input + number_click;
    $(this).closest('.input-group').find('.quantity').val(val_input);
});




/* =============================== Settings of content tabs =============================== */
$('.mou_tab').on('click', function(e) {

    e.preventDefault();

    $(this).addClass('active').siblings().removeClass('active');

    var id = $(this).attr('data-content')

    $('.box_content[id="' + id + '"]').addClass('active').siblings().removeClass('active')

})


$(".submit-review-toggle").on('click', function() {
    $(".review-form-section").addClass("opened")
})

$(".review-overlay").on('click', function() {
    $(".review-form-section").removeClass("opened")
})

/* ===============================  show password =============================== */
$(".toggle-password").click(function() {
    $(this).toggleClass("fa-eye fa-eye-slash");
    var input = $($(this).attr("toggle"));
    if (input.attr("type") == "password") {
        input.attr("type", "text");
    } else {
        input.attr("type", "password");
    }
});


$(".btn--coupon").on('click', function() {
    $(this).toggleClass('active');
    $(".form--coupon").slideToggle();
    $("#coupon_field").focus();
})


$("#coupon_field").on('keyup', function() {
    if ($(this).val().length) {
        $(".form--coupon").addClass('touched')
    } else {
        $(".form--coupon").removeClass('touched')
    }
})

$(".coupon_box .clear-input").on('click', function() {
    $("#coupon_field").prop('value', "")
    $(".form--coupon").removeClass('touched')
})


//Select2 js
function isSelect2() {
    // Select2 Activation
    var $select2 = $('.select2');
    if ($select2.length) {
        $select2.select2({
            theme: 'classic',
            dropdownAutoWidth: true,
            width: '100%',
        });
    }
}
isSelect2();


/*=================== testimonials owl carousel ===================*/
$(".testimonials_section .owl-carousel").owlCarousel({
    autoplay: false,
    nav: true,
    dots: false,
    navText: ['<i class="fal fa-chevron-left"></i>', '<i class="fal fa-chevron-right"></i>'],
    loop: true,
    responsive: {
        0: { items: 1 },
        768: { items: 2 }
    }
});


//Odometer
$(".count-text").each(function() {
    $(this).isInViewport(function(status) {
        if (status === "entered") {
            for (var i = 0; i < document.querySelectorAll(".odometer").length; i++) {
                var el = document.querySelectorAll('.odometer')[i];
                el.innerHTML = el.getAttribute("data-odometer-final");
            }
        }
    });
});


// Init Nice Select
$('.select').niceSelect();


// filter 

$(".filter_row .filter-title").on('click', function() {
    $(this).next().slideToggle();
    $(this).toggleClass('rotate')
})


// quick btn
$(".btn-quickview").on('click', function(e) {
    e.preventDefault();
    $(".quickview_box").addClass("show")
    $(".quickview_box_overlay").addClass("show")
})

$(".mfp-close").on('click', function() {
    $(".quickview_box").removeClass("show")
    $(".quickview_box_overlay").removeClass("show")
})


/* ===============================  show image after uploading  =============================== */

function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function(e) {
            $('#personalImg').attr('src', e.target.result);
        };

        reader.readAsDataURL(input.files[0]);
    }
}

/*** web-share-api ***/
var shareBtn = document.getElementById('share-btn');
pageUrl = "https://lazywasabi.com/blog/share-button-with-web-share-api/";
if (shareBtn) {
    shareBtn.addEventListener("click", function(ev) {
        if (navigator.share) {
            navigator.share({
                url: pageUrl
            });
        } else {
            alert('your browser not support share api')
        }
    });
}


$(function() {
    $(".bg_lazy").lazyload({
        effect: "fadeIn"
    });
});


document.addEventListener('DOMContentLoaded', function(e) {
    let shareBtn = document.querySelectorAll('.box_product .btn-quickview');
    let field = document.querySelector('.field-share');
    let input = document.querySelector('.field-input');
    let copyBtn = document.querySelector('.field-share button');


    shareBtn.forEach((Btn) => {
        Btn.onclick = (e) => {
            e.preventDefault();
            input.value = Btn.getAttribute("href");
        }
    })

    copyBtn.onclick = () => {
        input.select();
        if (document.execCommand("copy")) {
            field.classList.add('active');
            copyBtn.innerText = 'Copied';
            setTimeout(() => {
                field.classList.remove('active');
                copyBtn.innerText = 'Copy';
            }, 3500)
        }
    }
})