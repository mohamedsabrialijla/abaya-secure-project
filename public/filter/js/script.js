// Hide Preloader After Loading
$(document).ready(function() {
    $('.loader').fadeOut(100);
    $('body').css('overflow-y', 'hidden');
    if ($('.loader').hide()) {
        $('body').css('overflow-y', 'auto');
    }
}); 

$(document).ready(function() {
    $(".tab-btn").click(function() {
        $(".tab").removeClass("active");
        $(".tab a").removeClass("active");
        $("#bag").removeClass("active");
        $(".tab2").addClass("active");
        $(".tab2 a").addClass("active");
        $("#address").addClass("active");
        // $(".tab").addClass("active"); // instead of this do the below
        $(this).addClass("active");
    });
});

// Remove Top Navbar
$('.remove-top-nav-btn').on('click', function() {
    $('.top-nav').removeClass("show");
});

// Open And Hide Cart
$('.shopping-cart-box > i').on('click', function() {
    $('.dropdown-shopping-cart').toggleClass('active');
});

// Close Cart When Click outside
$(document).mouseup(function(e) {
    var container = $('.dropdown-shopping-cart');
    if (!container.is(e.target) && container.has(e.target).length === 0) {
        container.removeClass('active');
    }
});

// Show Custom Cursor When Cart Open
setInterval(() => {
    if ($(".dropdown-shopping-cart").hasClass('active')) {
        $('body, html').css('cursor', "url('images/close.png'), auto");
        $('.fullbg').css('display', 'block');
    } else {
        $('body, html').css('cursor', "auto");
        $('.fullbg').css('display', 'none')
    }
})

// Hide Sale Now Btn
$('.fixed-btn').fadeOut();

// - Change Navbar Background And Padding
var top = jQuery(document).scrollTop(),
    batas = 300;

if (top > batas) {

    $('.fixed-btn').fadeIn();

} else {

    $('.fixed-btn').fadeOut();

}

$(window).on('scroll', function() {

    var top = jQuery(document).scrollTop(),
        batas = 300;

    if (top > batas) {

        $('.fixed-btn').fadeIn();

    } else {

        $('.fixed-btn').fadeOut();

    }

});

// - Change Navbar Background After Page Load
var top = jQuery(document).scrollTop(),
    batas = 40;
if (top > batas) {
    $('.alaa-navbar').addClass('nav-sticy');
} else {
    $('.alaa-navbar').removeClass('nav-sticy');
}

// - Change Navbar Auto After Page Scroll
$(window).on('scroll', function() {
    var top = jQuery(document).scrollTop(),
        batas = 20;
    if (top > batas) {
        $('.alaa-navbar').addClass('nav-sticy');
    } else {
        $('.alaa-navbar').removeClass('nav-sticy');
    }
});

if ($('.top-nav-slider').length) {
    $('.top-nav-slider').owlCarousel({
        nav: true,
        navText: ['<i class="fa fa-arrow-left" aria-hidden="true"></i>', '<i class="fa fa-arrow-right" aria-hidden="true"></i>'],
        dots: false,
        rtl: true,
        items: 1,
        loop: true,
        autoplay: true,
        autoplayTimeout: 3000,
        autoplayHoverPause: true
    });
}

if ($('.slider-single-res').length) {
    $('.slider-single-res').owlCarousel({
        nav: false,
        navText: ['<i class="fa fa-arrow-left" aria-hidden="true"></i>', '<i class="fa fa-arrow-right" aria-hidden="true"></i>'],
        dots: true,
        rtl: true,
        items: 1,
        loop: true,
        autoplay: true,
        autoplayTimeout: 3000,
        autoplayHoverPause: true
    });
}

if ($('.category-slider').length) {
    $('.category-slider').owlCarousel({
        center: false,
        nav: true,
        navText: ['<i class="fa fa-arrow-left" aria-hidden="true"></i>', '<i class="fa fa-arrow-right" aria-hidden="true"></i>'],
        dots: false,
        rtl: true,
        items: 5,
        loop: false,
        margin: 10,
        responsive: {
            0: {
                items: 2.5,
                dots: true,
                nav: false
            },
            800: {
                items: 3,
                nav: false
            },
            991: {
                items: 4,
            },
            1200: {
                items: 5,
            }
        }
    });
}

if ($('.barnds-list-s').length) {
    $('.barnds-list-s').owlCarousel({
        center: false,
        nav: false,
        navText: ['<i class="fa fa-arrow-left" aria-hidden="true"></i>', '<i class="fa fa-arrow-right" aria-hidden="true"></i>'],
        dots: false,
        rtl: true,
        items: 5,
        loop: false,
        margin: 10,
        responsive: {
            0: {
                items: 2.5,
                nav: false
            },
            800: {
                items: 3,
                nav: false
            },
            991: {
                items: 4,
            },
            1200: {
                items: 6,
            }
        }
    });
}

if ($('.cats-slider').length) {
    $('.cats-slider').owlCarousel({
        nav: false,
        autoplay: true,
        navText: ['<i class="fa fa-arrow-left" aria-hidden="true"></i>', '<i class="fa fa-arrow-right" aria-hidden="true"></i>'],
        dots: false,
        rtl: true,
        items: 6,
        loop: true,
        margin: 10,
        responsive: {
            0: {
                items: 2.5
            },
            768: {
                items: 3,
            },
            991: {
                items: 4,
            },
            1200: {
                items: 6,
            }
        }
    });
}

if ($('.related-products-slider').length) {
    $('.related-products-slider').owlCarousel({
        center: false,
        nav: false,
        navText: ['<i class="fa fa-arrow-left" aria-hidden="true"></i>', '<i class="fa fa-arrow-right" aria-hidden="true"></i>'],
        dots: false,
        rtl: true,
        items: 5,
        loop: true,
        margin: 0,
        responsive: {
            0: {
                items: 2.5
            },
            800: {
                items: 3,
            },
            991: {
                items: 4,
            },
            1200: {
                items: 5,
            }
        }
    });
}

if ($('.orders-slider').length) {
    $('.orders-slider').owlCarousel({
        center: false,
        nav: false,
        navText: ['<i class="fa fa-arrow-left" aria-hidden="true"></i>', '<i class="fa fa-arrow-right" aria-hidden="true"></i>'],
        dots: false,
        rtl: false,
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

if ($('.cat-slider').length) {
    $('.cat-slider').owlCarousel({
        center: false,
        nav: false,
        navText: ['<i class="fa fa-arrow-left" aria-hidden="true"></i>', '<i class="fa fa-arrow-right" aria-hidden="true"></i>'],
        dots: false,
        rtl: false,
        items: 1,
        loop: true,
        margin: 10,
        responsive: {
            0: {
                items: 2.5
            },
            800: {
                items: 3,
            },
            991: {
                items: 3,
            },
            1200: {
                items: 5,
            }
        }
    });
}

if ($('.mazad-slider').length) {
    $('.mazad-slider').owlCarousel({
        center: false,
        nav: false,
        navText: ['<i class="fa fa-arrow-left" aria-hidden="true"></i>', '<i class="fa fa-arrow-right" aria-hidden="true"></i>'],
        dots: false,
        rtl: false,
        items: 1,
        loop: false,
        margin: 10,
        responsive: {
            0: {
                items: 2.5
            },
            800: {
                items: 3,
            },
            991: {
                items: 3,
            },
            1200: {
                items: 5,
            }
        }
    });
}


// Product single

$('.slider-for').not('setPosition').slick({
    slidesToShow: 1,
    slidesToScroll: 1,
    arrows: false,
    fade: true,
    adaptiveHeight: true,
    asNavFor: '.slider-nav'
});
$('.slider-nav').not('setPosition').slick({
    slidesToShow: 3,
    slidesToScroll: 1,
    vertical: true,
    arrows: false,
    adaptiveHeight: true,
    asNavFor: '.slider-for',
    dots: false,
    focusOnSelect: true,
    verticalSwiping: true,
    responsive: [{
            breakpoint: 992,
            settings: {
                vertical: false,
                slidesToShow: 3,
            }
        },
        {
            breakpoint: 768,
            settings: {
                vertical: false,
                slidesToShow: 4,
            }
        },
        {
            breakpoint: 580,
            settings: {
                vertical: false,
                slidesToShow: 4,
            }
        },
        {
            breakpoint: 380,
            settings: {
                vertical: false,
                slidesToShow: 4,
            }
        }
    ]
});

// if ($('.single-product-slider').length) {
//     $('.single-product-slider').owlCarousel({
//         items: 1,
//         rtl: true,
//         loop: true,
//         dots: true,
//         thumbs: false,
//         nav: false,
//         mouseDrag: true,
//         autoplay: true,
//         touchDrag: true,
//         lazyLoad: true,
//         dotsContainer: '#carousel-custom-dots',
//         autoplayTimeout: 20000 // auto play time
//     });
// }

// $('.owl-dot').click(function() {
//     $('.single-product-slider').trigger('to.owl.carousel',  [$(this).index()]);
//   $( '.owl-dot' ).removeClass( 'active' );
//   $(this).addClass( 'active' );
// });

// Custom Price Filter Range
if ($('.filter-box').length) {
    var lowerSlider = document.querySelector('#lower');
    var upperSlider = document.querySelector('#upper');

    document.querySelector('#two').value = upperSlider.value;
    document.querySelector('#one').value = lowerSlider.value;

    var lowerVal = parseInt(lowerSlider.value);
    var upperVal = parseInt(upperSlider.value);

    upperSlider.oninput = function() {
        lowerVal = parseInt(lowerSlider.value);
        upperVal = parseInt(upperSlider.value);

        if (upperVal < lowerVal + 4) {
            lowerSlider.value = upperVal - 4;
            if (lowerVal == lowerSlider.min) {
                upperSlider.value = 4;
            }
        }
        document.querySelector('#two').value = this.value
    };

    lowerSlider.oninput = function() {
        lowerVal = parseInt(lowerSlider.value);
        upperVal = parseInt(upperSlider.value);
        if (lowerVal > upperVal - 4) {
            upperSlider.value = lowerVal + 4;
            if (upperVal == upperSlider.max) {
                lowerSlider.value = parseInt(upperSlider.max) - 4;
            }
        }
        document.querySelector('#one').value = this.value
    };
}

// Show All Filter Box On Mobile
$('.show-filter-box').on('click', function() {
    $('.filter-box').toggleClass('show');
    $(this).toggleClass('rot');
});


// Show And Hide The Password
$('.show-and-hide-password').on('click', function() {
    if ($(this).parent('.with-icon').find('input').attr('type') == 'text') {
        $(this).removeClass('fa-eye-slash').addClass('fa-eye');
        $(this).parent('.with-icon').find('input').attr('type', 'password');
    } else {
        $(this).removeClass('fa-eye').addClass('fa-eye-slash');
        $(this).parent('.with-icon').find('input').attr('type', 'text');
    }
});

// Custom Accordion
function toggleIcon(e) {
    $(e.target)
        .prev('.panel-heading')
        .find(".more-less")
        .toggleClass('fa fa-plus fa fa-minus');
}
$('.panel-group').on('hidden.bs.collapse', toggleIcon);
$('.panel-group').on('shown.bs.collapse', toggleIcon);

// Custom Wizard Form
$('.wizard-inner .nav-tabs li a').on('click', function() {

    var href = $(this).attr('href');

    if (href == '#address') {

        $('.connecting-line .after').css('width', '100%');

    } else if (href == '#bag') {

        $('.connecting-line .after').css('width', '50%');

    }

});

// Init Nice Select
$('.select').niceSelect();

// Amount Modal
// $('.pbb-content label.checkbox-container input').on('click', function() {
//     if ( $(this).is(':checked') ) {
//         $('.amount-box').addClass('show');
//     } else {
//         $('.amount-box').removeClass('show');
//     }
// })



$('.showSingle input[type="checkbox"]').change(function() {
    var inputValue = $(this).attr("value");
    var targetBox = $("." + inputValue);
    if ($(this).is(":checked")) {
        $(".targetDiv").not(targetBox).hide();
        $(targetBox).show();
    } else {
        $(targetBox).hide();
    }
});


$('.showSingle input[type="radio"]').change(function() {
    var inputValue = $(this).attr("value");
    var targetBox = $("." + inputValue);
    if ($(this).is(":checked")) {
        $(".targetDiv").not(targetBox).hide("slow");
        $(targetBox).show("slow");
    } else {
        $(targetBox).hide("slow");
    }
});



// Init Zoom Plugin
if ($('.pic-zoom').length) {
    $('.pic-zoom').zoom();
}

// Size Box
$('.size-box ul li a').on('click', function(e) {
    e.preventDefault();
    $('.size-box ul li a').removeClass('active');
    $(this).addClass('active');
});

// Color Box
$('.color-box ul li a').on('click', function(e) {
    e.preventDefault();
    $('.color-box ul li a').removeClass('active');
    $(this).addClass('active');
});

// Show Menu In Mobile Mode
$('.mobile-menu .open-mobile-menu').on('click', function() {
    $(this).parent().find('.dropdown-mobile-menu').toggleClass('ss-active');
});

// Close Mobile Menu When Click Outside
$(document).mouseup(function(e) {
    var container = $('.dropdown-mobile-menu');
    if (!container.is(e.target) && container.has(e.target).length === 0) {
        container.removeClass('ss-active');
    }
});

// Show User Box In Mobile Mode
$('.user-dropdown-c').on('click', function() {
    $(this).parent().find('.user-dropdown-b').toggleClass('ss-active');
});
// Close Mobile Menu When Click Outside
$(document).mouseup(function(e) {
    var container = $('.user-dropdown-b');
    if (!container.is(e.target) && container.has(e.target).length === 0) {
        container.removeClass('ss-active');
    }
});

// Book Modal
$('.book-popup').on('click', function(e) {
    e.preventDefault();
    $('.book-popup-box').addClass('show');
});

// Close Book Popup
$('.close-book-popup').on('click', function() {
    $('.book-popup-box').removeClass('show');
});

// Close Book Popup when Click outside
$(document).mouseup(function(e) {
    var container = $('.book-popup-container');
    if (!container.is(e.target) && container.has(e.target).length === 0) {
        container.parent().removeClass('show');
    }
});

// Custom Input Search

$('.search-con-box input').keyup(function() {

    if ( $(this).val().length == 0 ) {

        $('.search-con-list').removeClass('show');
    } else {
        $('.search-con-list').addClass('show');


        $.ajax({
            url: "/alaa/search-header",
            data: {
                word: $(this).val(),
                category: $('.select').val()
            },
            dataType: 'json',
            success: function (data) {
                var len = data.length;

                $('.search-list').empty();
                if (len > 0) {


                    for (var i = 0; i < len; i++) {
                        if ($('#select').val() == 'Brands')
                          /*  $('ul.search-list').append(`<li><a href="">${data[i]['name']}</a></li>`);*/
                        {
                        $('ul.search-list').append(`  <li>
                            
                  <div class="search-img">
                            <img src="#" alt="">
                            </div>
                            <p>${data[i]['name']}</p>
                        </li>`);}



                        else {
                           /* $('ul.search-list').append("<li>" +data[i]["title"]+ "</li>");*/
                        $('ul.search-list').append(`<li>
                            
                        <div class="search-img">
                            <img src="${window.location.origin+'/alaa/public/storage'+ '/'+data[i]["files"][0]["path"]}" alt="">
                            </div>
                            <a href="${window.location.origin+'/alaa/products/'+data[i]['title']+'_'+data[i]['id']}">${data[i]['title']}</a>
                          
                        </li>`);

                        }


                    }}




                else
                    $('ul.search-list').append(`<li>لا يوجد نتيجه للبحث</li>`);


            }
        })




    }
});



// Remove Items From Cart
$('.item-in i').on('click', function() {
    /* var v = $(this).closest('input .product_id').val();*/

    var v = $(this).data('id')
    $(this).parent('.item-in').parent('a').parent('li').remove();

    $.ajax({
        url: '/alaa/cart/remove/' + v,
        method: 'get',
        success: function() {

        }
    })
})

// Hide Cart When Click on X Icon
$('.close-cart').on('click', function() {
    $('.dropdown-shopping-cart').removeClass('active');
})






function ctrls() {
    var _this = this;

    this.counter = 0;
    this.els = {
        decrement: document.querySelector('.ctrl__button--decrement'),
        counter: {
            container: document.querySelector('.ctrl__counter'),
            num: document.querySelector('.ctrl__counter-num'),
            input: document.querySelector('.ctrl__counter-input')
        },
        increment: document.querySelector('.ctrl__button--increment')
    };

    this.decrement = function() {
        var counter = _this.getCounter();
        var nextCounter = (_this.counter > 0) ? --counter : counter;
        _this.setCounter(nextCounter);
    };

    this.increment = function() {
        var counter = _this.getCounter();
        var nextCounter = (counter < 9999999999) ? ++counter : counter;
        _this.setCounter(nextCounter);
    };

    this.getCounter = function() {
        return _this.counter;
    };

    this.setCounter = function(nextCounter) {
        _this.counter = nextCounter;
    };

    this.debounce = function(callback) {
        setTimeout(callback, 100);
    };

    this.render = function(hideClassName, visibleClassName) {
        _this.els.counter.num.classList.add(hideClassName);

        setTimeout(function() {
            _this.els.counter.num.innerText = _this.getCounter();
            _this.els.counter.input.value = _this.getCounter();
            _this.els.counter.num.classList.add(visibleClassName);
        }, 100);

        setTimeout(function() {
            _this.els.counter.num.classList.remove(hideClassName);
            _this.els.counter.num.classList.remove(visibleClassName);
        }, 1100);
    };

    // this.ready = function() {
    //   _this.els.decrement.addEventListener('click', function() {
    //     _this.debounce(function() {
    //       _this.decrement();
    //       _this.render('is-decrement-hide', 'is-decrement-visible');
    //     });
    //   });
    //
    //   _this.els.increment.addEventListener('click', function() {
    //     _this.debounce(function() {
    //       _this.increment();
    //       _this.render('is-increment-hide', 'is-increment-visible');
    //     });
    //   });
    //
    //   _this.els.counter.input.addEventListener('input', function(e) {
    //     var parseValue = parseInt(e.target.value);
    //     if (!isNaN(parseValue) && parseValue >= 0) {
    //       _this.setCounter(parseValue);
    //       _this.render();
    //     }
    //   });
    //
    //   _this.els.counter.input.addEventListener('focus', function(e) {
    //     _this.els.counter.container.classList.add('is-input');
    //   });
    //
    //   _this.els.counter.input.addEventListener('blur', function(e) {
    //     _this.els.counter.container.classList.remove('is-input');
    //     _this.render();
    //   });
    // };
};

// init
var controls = new ctrls();
document.addEventListener('DOMContentLoaded', controls.ready);



$('#add').on('click', function(e) {
    e.preventDefault();
    $('#cart-div').show();
    $.ajax({
        url: '/alaa/send-id/' + $('#product_id').val(),
        type: 'get',
        success: function(data) {
            $('#empty-card').hide();
            $("#add").attr("disabled", true)

            $(".shopping-cart-num").text(parseInt($(".shopping-cart-num").text()) + 1);
            $("#total").text(data['total']);

        }
    });





    $('#ul-cart').append(`

 <li>
                                        <a href="#">
                                            <img src="${$('#pro_image').val()}" class="img-fluid" alt="">
                                            <div class="item-in">
                                                <span class="item-price">${$('#new_price').val()}R.s</span>
                                                <h5>${$("#title-pro").text()}</h5>
                                                <i  data-id="${$('#product_id').val()}"class="fa fa-times delete"></i>
                                            </div>
                                        </a>
                                    </li>


`)





    $('.dropdown-shopping-cart').toggleClass('active');

    $('.item-in i.fa.fa-times.delete').on('click', function() {
        $(this).parents('li').remove();
    })


});







jQuery('<div class="quantity-nav"><div class="quantity-button quantity-up">+</div><div class="quantity-button quantity-down">-</div></div>').insertAfter('.quantity input');
jQuery('.quantity').each(function() {
    var spinner = jQuery(this),
        input = spinner.find('input[type="number"]'),
        btnUp = spinner.find('.quantity-up'),
        btnDown = spinner.find('.quantity-down'),
        min = input.attr('min'),
        max = input.attr('max');

    btnUp.click(function() {
        var oldValue = parseFloat(input.val());
        if (oldValue >= max) {
            var newVal = oldValue;
        } else {
            var newVal = oldValue + 50;
        }
        spinner.find("input").val(newVal);
        spinner.find("input").trigger("change");
    });

    btnDown.click(function() {
        var oldValue = parseFloat(input.val());
        if (oldValue <= min) {
            var newVal = oldValue;
        } else {
            var newVal = oldValue - 50;
        }
        spinner.find("input").val(newVal);
        spinner.find("input").trigger("change");
    });

});


//custom the input type to an image

function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function(e) {
            $('#bebo')
                .attr('src', e.target.result);
        };

        reader.readAsDataURL(input.files[0]);
    }
}


// hide and show porduct


$('.show-more').on('click', function() {

    console.log('beboooo')
        /*
        $('.show-more i').toggleClass('fa-chevron-right fa-chevron-down');
        $('.product-desc').slideToggle();*/
})


// like the product with favourite icon

$('p.favourite-icon i').on('click', function() {
    $(this).toggleClass('liked');
    if ($(this).hasClass('liked')) {
        $(this).removeClass('far');
        $(this).addClass('fas');
    } else {
        $(this).removeClass('fas');
        $(this).addClass('far');
    }
})


$('.close_cart').on('click', function() {
    $('.dropdown-shopping-cart').removeClass('active')
})



$('.raise_content .head').on('click', function() {
    console.log('hello')
    $(this).parents('.raise_content').find('.content').slideToggle();
})

/* ===============================  click on navbar toggler  =============================== */

$('.header_mobile .mobile-menu').on('click', function() {
    $('.mobile-sideList').addClass("opened");
    $('.overlay_gen').fadeIn().on('click', function() {
        $(this).fadeOut();
        $('.mobile-sideList').removeClass("opened");
    });
})

$('.nav-tabs-mobile .box .head').on('click', function() {
    $(this).parents('.box').find('.content').slideToggle();
    $(this).parents('.box').siblings().find('.content').slideUp();
})


$('.drop-link > a').on('click', function(e) {
    e.preventDefault();
    $(this).parent().find('.branch').toggleClass('open')
})




$('#edit_number').on('click', function(e) {
    e.preventDefault();
    $('#input_num').prop('disabled', function(i, v) { return !v; });
})

$(".corousel_m .owl-carousel").owlCarousel({
    autoplay: true,
    nav: true,
    dots: false,
    navText: ['<i class="fa fa-angle-left" aria-hidden="true"></i>', '<i class="fa fa-angle-right" aria-hidden="true"></i>'],
    loop: true,
    responsive: {
        0: { items: 1 },
        576: { items: 2 },
        768: { items: 3 },
    }
});

$('#login-page .radio').on('click', function() {
    $(this).addClass('active').siblings().removeClass('active');
})

//   $(".check-in").datepicker({
//     dateFormat: "d MM yy",
//     duration: "medium"
//   });

$('.btn-re .btn-1').click(function() {
    $('.single-filter-box').toggleClass('open');
})

$('.closeFilter').click(function() {
    $('.single-filter-box').removeClass('open');
})


$(document).ready(function() {
    $('.toggle-res').on('click', function(event) {
        $(this).parent().siblings().removeClass('open');
        $(this).parent().toggleClass('open');
        event.preventDefault();
    });
});
