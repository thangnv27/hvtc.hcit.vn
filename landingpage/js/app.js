(function (d, s, id) {
    var js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id))
        return;
    js = d.createElement(s);
    js.id = id;
    js.src = "//connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v2.7";
    fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));

var viewport_width = Math.max(document.documentElement.clientWidth, window.innerWidth || 0);
var viewport_height = Math.max(document.documentElement.clientHeight, window.innerHeight || 0);
var PPOFixed = {
    mainMenu:function(){
        var msie6 = jQuery.browser == 'msie' && jQuery.browser.version < 7;
        if (!msie6) {
            var top = 10;
//            var top = jQuery('.desktop-header').offset().top - parseFloat(jQuery('.desktop-header').css('margin-top').replace(/auto/, 0));
            jQuery(window).scroll(function(event){
                if (jQuery(this).scrollTop() >= top){
                    var wpadminbar_height = 0;
                    if(jQuery(this).width() > 583){
                        wpadminbar_height = jQuery('#wpadminbar').outerHeight(true);
                    }
                    jQuery('.desktop-header').css({
                        'top':wpadminbar_height + 0
                    }).addClass('fixed');
                } else {
                    jQuery('.desktop-header').css({
                        'top':0
                    }).removeClass('fixed');
                }
            });
        }
    }
};
function getChromeVersion() {
    var raw = navigator.userAgent.match(/Chrom(e|ium)\/([0-9]+)\./);
    return raw ? parseInt(raw[2], 10) : false;
}
function getFirefoxVersion() {
    var raw = navigator.userAgent.match(/Firefox\/([0-9]+)/);
    return raw ? parseInt(raw[1], 10) : false;
}
function ReplaceAll(Source, stringToFind, stringToReplace) {
    var temp = Source;
    var index = temp.indexOf(stringToFind);
    while (index != -1) {
        temp = temp.replace(stringToFind, stringToReplace);
        index = temp.indexOf(stringToFind);
    }
    return temp;
}
function scrollToElement(id) {
    jQuery('body,html').animate({
        scrollTop: jQuery(id).offset().top - 10
    }, 800);
}
jQuery(document).ready(function ($) {
    if(is_fixed_menu){
        PPOFixed.mainMenu();
    }
    
    // Scroll to element - desktop
    jQuery(".main-menu > .nav > li > a, .header-button .btn2").click(function (){
        var _href = jQuery(this).attr('href');
        if(_href.lastIndexOf("#") !== -1){
            var _id = _href.split("#");
            if( !is_home && (_id[1] === "intro" || _id[1] === "tuyensinh" || _id[1] === "news") ){
                window.location = siteUrl + "#" + _id[1];
                return false;
            }
            if(jQuery('.desktop-header').hasClass('fixed')){
                jQuery('body,html').animate({
                    scrollTop: jQuery("#" + _id[1]).offset().top - jQuery('.desktop-header').height() - jQuery("#wpadminbar").outerHeight(true)
                }, 400);
            } else {
                jQuery('body,html').animate({
                    scrollTop: jQuery("#" + _id[1]).offset().top - (jQuery('.desktop-header').height() * 2) - jQuery("#wpadminbar").outerHeight(true)
                }, 400);
            }
            return false;
        }
    });
    // Scroll to element - mobile
    jQuery(".st-menu > .nav > li > a").click(function (){
        var _href = jQuery(this).attr('href');
        if(_href.lastIndexOf("#") !== -1){
            var _id = _href.split("#");
            jQuery('body,html').animate({
                scrollTop: jQuery("#" + _id[1]).offset().top - jQuery('.mobile-header').height()
            }, 400);
            return false;
        }
    });
    
    if(window.location.hash.length > 0){
        if(is_mobile){
            jQuery('body,html').animate({
                scrollTop: jQuery(window.location.hash).offset().top - (jQuery('.desktop-header').height()*2) - jQuery("#wpadminbar").outerHeight(true)
            }, 400);
        } else {
            jQuery('body,html').animate({
                scrollTop: jQuery(window.location.hash).offset().top - (jQuery('.mobile-header').height()*2)
            }, 400);
        }
        window.history.pushState("", document.title, window.location.pathname);
    }
    
    jQuery(document).mouseup(function (e) {
        if (viewport_width < 992) {
            var container = jQuery(".st-container");
            if (container.find('.mobile-header').hasClass('mobile-clicked')) {
                if (!container.is(e.target) && container.has(e.target).length === 0) {
                    jQuery('button.left-menu').trigger('click');
                }
            }
        }
    });

    jQuery(window).scroll(function () {
        if (jQuery(this).scrollTop() > 100) {
            jQuery("#scroll-to-top").fadeIn();
        } else {
            jQuery("#scroll-to-top").fadeOut();
        }
    });
    if(!is_mobile){
        jQuery("#scroll-to-top, .btn-reg, .header-button .btn1, .pricing-plan .pricing-signup .pricing-button").click(function () {
            jQuery('body,html').animate({
                scrollTop: 0
            }, 400);
            return false;
        });
    } else {
        jQuery(".btn-reg, .header-button .btn1, .pricing-plan .pricing-signup .pricing-button").click(function () {
            jQuery('body,html').animate({
                scrollTop: jQuery(".frm-register-wrap").offset().top
            }, 400);
            return false;
        });
    }

    // Expand/Collapse menu on sidebar
    jQuery(".st-menu .nav li.menu-item-has-children > ul.sub-menu").hide();
    jQuery(".st-menu .nav li.menu-item-has-children.current-menu-item > ul.sub-menu").show();
    jQuery(".st-menu .nav li.menu-item-has-children.current-menu-parent > ul.sub-menu").show();
    if (viewport_width > 991) {
        jQuery(".st-menu .nav > li.menu-item-has-children > ul.sub-menu").show();
        jQuery(".st-menu .nav > li.menu-item-has-children").addClass('dropdown');
        jQuery(".st-menu .nav li.menu-item-has-children.current-menu-parent").addClass('dropdown');
    }
    jQuery(".st-menu .nav > li.menu-item-has-children > a").click(function () {
        if (jQuery(this).parent().hasClass('dropdown')) {
            jQuery(this).parent().removeClass('dropdown');
            jQuery(this).next().slideUp();
        } else {
            jQuery(this).parent().addClass('dropdown');
            jQuery(this).next().slideDown();
        }
        return false;
    });

    // Menu mobile
    jQuery('button.left-menu').click(function () {
        var effect = jQuery(this).attr('data-effect');
        if (jQuery(this).parent().parent().hasClass('mobile-clicked')) {
            jQuery('.st-menu').animate({
                width: 0
            }).css({
                display: 'none',
                transform: 'translate(0px, 0px)',
                transition: 'transform 400ms ease 0s'
            });
            jQuery(this).parent().parent().addClass('mobile-unclicked').removeClass('mobile-clicked').css({
                transform: 'translate(0px, 0px)',
                transition: 'transform 400ms ease 0s'
            });
            jQuery(this).parent().parent().parent().removeClass('st-menu-open ' + effect);
        } else {
            jQuery(this).parent().parent().parent().addClass('st-menu-open ' + effect);
            jQuery('.st-menu').animate({
                width: 250
            }).css({
                display: 'block',
                transform: 'translate(250px, 0px)',
                transition: 'transform 400ms ease 0s'
            });
            jQuery(this).parent().parent().addClass('mobile-clicked').removeClass('mobile-unclicked').css({
                transform: 'translate(250px, 0px)',
                transition: 'transform 400ms ease 0s'
            });
        }
    });
    jQuery('button.right-menu').click(function () {
        scrollToElement(".frm-register-wrap");
    });
});