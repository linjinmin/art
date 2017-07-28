

$(function () {

    /* 顶部导航栏滚动收缩展开 */
    var $header = $('.header-wrap'),
        $logo = $('.logo>img');

    function scrollFun() {
        var numScrollTop = $(window).scrollTop();
        //导航栏显示
        if (numScrollTop == 0) {
            setTimeout(function () {
                if ($header.hasClass("header-open")) {
                    $header.addClass('header-collapse');
                    $logo.attr({'src': "/images/logo-black.png", 'width': '60%'});
                } else {
                    $header.removeClass('header-collapse');
                    $logo.attr({'src': "/images/logo.png", 'width': '90%'});
                }
            }, 100)
        } else if (numScrollTop > 0) {
            $(".search-image").attr("src", "/images/search.png")
            $header.addClass('header-collapse');
            $logo.attr({'src': "/images/logo-black.png", 'width': '60%'});
        }

    }

    $(window).on("scroll", scrollFun);

    /*
     * 移动端导航
     */
    (function () {
        var button = $(".hamburger-btn"),
            container = button.closest('.header-wrap');
        button.on("click", function () {
            container.toggleClass('header-closed');
            container.toggleClass("header-open");
            $('.white').toggle();
            $('.black').toggle();
            if (container.hasClass("header-open")) {
                $(".mean-mask").addClass("close");
                $header.addClass('header-collapse');
                $logo.attr({'src': "/images/logo-black.png", 'width': '60%'});
            } else {
                $(".mean-mask").removeClass("close");
                $header.removeClass('header-collapse');
                $logo.attr({'src': "/images/logo.png", 'width': '90%'});
            }
        });
        $(".mean-mask").on("click", function () {
            $(".mean-mask").removeClass("close");
            var numScrollTop = $(window).scrollTop();
            if (numScrollTop <= 0) {
                $header.removeClass('header-collapse');
                $logo.attr({'src': "/images/logo.png", 'width': '90%'});
            } else {
                $header.addClass('header-collapse');
                $logo.attr({'src': "/images/logo-black.png", 'width': '60%'});
            }
            container.addClass('header-closed');
            container.removeClass('header-open');
            $('.white').show();
            $('.black').hide();
        })
    })($);

})
