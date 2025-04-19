const swiper1 = new Swiper(".mySwiper1", {
    slidesPerView: 1,
    loop: true,
    autoplay: {
        delay: 2500,
        disableOnInteraction: false,
    },
    pagination: {
        el: ".swiper-pagination",
        clickable: true,
    },
});
const swiper = new Swiper(".swiper-container", {
    loop: true, // Bật vòng lặp cho các slide
    autoplay: {
        delay: 10000, // Tự động chuyển slide sau 6 giây
    },
    pagination: {
        el: ".swiper-pagination", // Hiển thị phân trang
        clickable: true,
    },
    slidesPerView: 1.2, // Số lượng slide hiển thị
    spaceBetween: 10, // Khoảng cách giữa các slide
    centeredSlides: false, // Giữ slide giữa
    allowTouchMove: true,
    breakpoints: {
        768: {
            slidesPerView: 1.2, // Màn hình nhỏ hiển thị 1 slide
        },
        1024: {
            slidesPerView: 2, // Màn hình lớn hơn hiển thị 2 slide
        },
    },
});
const swiper2 = new Swiper(".mySwiper2", {
    slidesPerView: 2,
    spaceBetween: 20,
    allowTouchMove: true,
    loop: true,
    autoplay: {
        delay: 5000,
        disableOnInteraction: false,
    },
    pagination: {
        el: ".swiper-pagination",
        clickable: true,
    },
    breakpoints: {
        640: {
            slidesPerView: 2,
            spaceBetween: 20,
        },
        1024: {
            slidesPerView: 5,
            spaceBetween: 30,
        },
    },
});

// const header = document.querySelector(".header-main");
// let lastScroll = window.scrollY;
// let scrollTimeout;

// window.addEventListener("scroll", () => {
//     const currentScroll = window.scrollY;

//     // Cuộn xuống
//     if (currentScroll > lastScroll) {
//         header.classList.add("hide");
//     }
//     // Cuộn lên
//     else if (currentScroll < lastScroll) {
//         header.classList.remove("hide");
//     }

//     lastScroll = currentScroll;

//     // Nếu dừng cuộn trong 2 giây → ẩn header
//     clearTimeout(scrollTimeout);
//     scrollTimeout = setTimeout(() => {
//         header.classList.add("hide");
//     }, 2000); // 2000 ms = 2 giây
// });

// window.addEventListener("scroll", function () {
//     const header = document.querySelector(".header-wrapper");
//     const dropdowns = document.querySelectorAll(".sub-menu.nav-dropdown");

//     dropdowns.forEach(function (dropdown) {
//         if (!header.classList.contains("stuck")) {
//             dropdown.style.top = "120px";
//         } else {
//             dropdown.style.top = "165px";
//         }
//     });
// });

(function ($) {
    $(document).ready(function () {
        $(".btn-go-top").on("click", function (e) {
            e.preventDefault();
            $("html, body").animate(
                {
                    scrollTop: 0,
                },
                "300"
            );
        });
        $("a.btn-view").click(function () {
            $(".text-hidden").toggleClass("show");
            if ($(".text-hidden").hasClass("show")) {
                $(this).text("Thu gọn");
            } else {
                $(this).text("Xem thêm");
            }
        });
        $(".mobile-sidebar ul li.menu-item.menu-item-has-children").addClass(
            "active"
        );
        var showContentFaqs = function () {
            if ($(".dnw-faq .dnw-faq-item").length) {
                $(".dnw-faq .dnw-faq-item .faq-title").on("click", function () {
                    if (
                        $(this)
                            .parent(".dnw-faq .dnw-faq-item")
                            .hasClass("active")
                    ) {
                        $(this)
                            .parent(".dnw-faq .dnw-faq-item")
                            .removeClass("active");
                        $(this)
                            .parent(".dnw-faq .dnw-faq-item")
                            .find(".faq-text")
                            .slideUp("slow");
                    } else {
                        $(".dnw-faq .dnw-faq-item").removeClass("active");
                        $(".dnw-faq .dnw-faq-item")
                            .find(".faq-text")
                            .slideUp("slow");
                        $(this)
                            .parent(".dnw-faq .dnw-faq-item")
                            .addClass("active");
                        $(this)
                            .parent(".dnw-faq .dnw-faq-item")
                            .find(".faq-text")
                            .slideDown("slow");
                    }
                    return !1;
                });
            }
            $("#menu-item-5184").addClass("active");
            _biggerlink();
            var windowwidth =
                window.innerWidth || document.documentElement.clientWidth || 0;
            var pos = 0;
            var header = $("header");
        };
        showContentFaqs();
    });
    var _biggerlink = function () {
        (function ($) {
            $.fn.biggerlink = function (options) {
                var settings = {
                    biggerclass: "bl-bigger",
                    hoverclass: "bl-hover",
                    hoverclass2: "bl-hover2",
                    clickableclass: "bl-hot",
                    otherstriggermaster: !0,
                    follow: "auto",
                };
                if (options) {
                    $.extend(settings, options);
                }
                $(this)
                    .filter(function () {
                        return $("a", this).length > 0;
                    })
                    .addClass(settings.clickableclass)
                    .css("cursor", "pointer")
                    .each(function (i) {
                        var big = $(this).data("biggerlink", {
                            hovered: !1,
                            focused: !1,
                            hovered2: !1,
                            focused2: !1,
                        });
                        var links = {
                            all: $("a", this),
                            big: $(this),
                            master: $("a:first", this)
                                .data("biggerlink", {
                                    status: "master",
                                })
                                .addClass(settings.biggerclass),
                            other: $("a", this)
                                .not($("a:first", this))
                                .data("biggerlink", {
                                    status: "other",
                                }),
                        };
                        $("a", this)
                            .addBack()
                            .each(function () {
                                var newdata = $.extend(
                                    $(this).data("biggerlink"),
                                    links
                                );
                                $(this).data("biggerlink", newdata);
                            });
                        var thistitle = big.attr("title");
                        var newtitle = big
                            .data("biggerlink")
                            .master.attr("title");
                        if (newtitle && !thistitle) {
                            big.attr("title", newtitle);
                        }
                        big.mouseover(function (event) {
                            window.status = $(this)
                                .data("biggerlink")
                                .master.get(0).href;
                            $(this).addClass(settings.hoverclass);
                            $(this).data("biggerlink").hovered = !0;
                        })
                            .mouseout(function (event) {
                                window.status = "";
                                if (!$(this).data("biggerlink").focused) {
                                    $(this).removeClass(settings.hoverclass);
                                }
                                $(this).data("biggerlink").hovered = !1;
                            })
                            .bind("click", function (event) {
                                if (!$(event.target).closest("a").length) {
                                    $(this).data("biggerlink").master.trigger({
                                        type: "click",
                                        source: "biggerlink",
                                    });
                                    event.stopPropagation();
                                }
                            });
                        links.all
                            .bind("focus", function () {
                                $(this)
                                    .data("biggerlink")
                                    .big.addClass(settings.hoverclass);
                                $(this)
                                    .data("biggerlink")
                                    .big.data("biggerlink").focused = !0;
                            })
                            .bind("blur", function () {
                                if (
                                    !$(this)
                                        .data("biggerlink")
                                        .big.data("biggerlink").hovered
                                ) {
                                    $(this)
                                        .data("biggerlink")
                                        .big.removeClass(settings.hoverclass);
                                }
                                $(this)
                                    .data("biggerlink")
                                    .big.data("biggerlink").focused = !1;
                            });
                        links.master.bind("click", function (event) {
                            if (event.source == "biggerlink") {
                                if (
                                    settings.follow === !0 ||
                                    (settings.follow == "auto" &&
                                        event.result !== !1)
                                ) {
                                    window.location = $(this).attr("href");
                                } else {
                                    event.stopPropagation();
                                }
                            }
                        });
                        if (settings.otherstriggermaster) {
                            links.other
                                .addClass(settings.biggerclass)
                                .bind("click", function (event) {
                                    $(this).data("biggerlink").master.trigger({
                                        type: "click",
                                        source: "biggerlink",
                                    });
                                    event.preventDefault();
                                    event.stopPropagation();
                                });
                        } else {
                            links.other
                                .bind("focus", function () {
                                    $(this)
                                        .data("biggerlink")
                                        .big.addClass(settings.hoverclass2);
                                    $(this)
                                        .data("biggerlink")
                                        .big.data("biggerlink").focused2 = !0;
                                })
                                .bind("blur", function () {
                                    if (
                                        !$(this)
                                            .data("biggerlink")
                                            .big.data("biggerlink").hovered2
                                    ) {
                                        $(this)
                                            .data("biggerlink")
                                            .big.removeClass(
                                                settings.hoverclass2
                                            );
                                    }
                                    $(this)
                                        .data("biggerlink")
                                        .big.data("biggerlink").focused2 = !1;
                                })
                                .bind("mouseover", function (event) {
                                    $(this)
                                        .data("biggerlink")
                                        .big.addClass(settings.hoverclass2);
                                    $(this)
                                        .data("biggerlink")
                                        .big.data("biggerlink").hovered2 = !0;
                                    event.stopPropagation();
                                })
                                .bind("mouseout", function (event) {
                                    if (
                                        !$(this)
                                            .data("biggerlink")
                                            .big.data("biggerlink").focused2
                                    ) {
                                        $(this)
                                            .data("biggerlink")
                                            .big.removeClass(
                                                settings.hoverclass2
                                            );
                                    }
                                    $(this)
                                        .data("biggerlink")
                                        .big.data("biggerlink").hovered2 = !1;
                                    event.stopPropagation();
                                });
                            if (!links.other.attr("title")) {
                                links.other.attr("title", "");
                            }
                        }
                    });
                return this;
            };
        })(jQuery);
        $(function () {
            jQuery('.biggerlink a[target="_blank"]').click(function () {
                window.open(this.href);
                return !1;
            });
            jQuery(".biggerlink").biggerlink({
                otherstriggermaster: !1,
            });
        });
    };
})(jQuery);
