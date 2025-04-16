!(function () {
    var e,
        t,
        n,
        o,
        i = {
            7387: function () {
                Flatsome.behavior("back-to-top", {
                    attach(e) {
                        const t = jQuery(".back-to-top", e);
                        if (!t.length) return;
                        let n = null;
                        window.addEventListener(
                            "scroll",
                            () => {
                                var e;
                                const o = jQuery(window).scrollTop();
                                (n =
                                    null !== (e = n) && void 0 !== e
                                        ? e
                                        : jQuery(window).height()),
                                    t.toggleClass("active", o >= n);
                            },
                            {
                                passive: !0,
                            }
                        );
                    },
                });
            },
            1478: function () {
                Flatsome.behavior("commons", {
                    attach(e) {
                        jQuery("select.resizeselect").resizeselect(),
                            jQuery("[data-parallax]", e).flatsomeParallax(),
                            jQuery.fn.packery &&
                                (jQuery(
                                    "[data-packery-options], .has-packery",
                                    e
                                ).each(function () {
                                    let e = jQuery(this);
                                    e.packery({
                                        originLeft: !flatsomeVars.rtl,
                                    }),
                                        setTimeout(function () {
                                            e.imagesLoaded(function () {
                                                e.packery("layout");
                                            });
                                        }, 100);
                                }),
                                jQuery(".banner-grid-wrapper").imagesLoaded(
                                    function () {
                                        jQuery(this.elements).removeClass(
                                            "processing"
                                        );
                                    }
                                )),
                            "objectFitPolyfill" in window &&
                                window.objectFitPolyfill();
                    },
                    detach(e) {},
                });
            },
            7467: function (e, t, n) {
                function o(e) {
                    e.addClass("current-dropdown"),
                        e.find(".nav-top-link").attr("aria-expanded", !0),
                        (function (e) {
                            const t = e,
                                o = t.closest(".container").width(),
                                i = t.closest("li.menu-item"),
                                a = i.hasClass("menu-item-design-full-width"),
                                r = i.hasClass(
                                    "menu-item-design-container-width"
                                ),
                                s = i.parent().hasClass("ux-nav-vertical-menu"),
                                l = !a && !r,
                                c = n.g.flatsomeVars.rtl;
                            if (l && !s) {
                                if (o < 750) return !1;
                                var u = t.outerWidth(),
                                    d = t.offset(),
                                    h = Math.max(
                                        document.documentElement.clientWidth,
                                        window.innerWidth || 0
                                    ),
                                    f = d.left - (h - o) / 2;
                                c &&
                                    (f =
                                        jQuery(window).width() -
                                        (d.left + u) -
                                        (h - o) / 2);
                                var p = t.width(),
                                    y = o - (f + p),
                                    g = !1;
                                f > y && f < p && (g = (f + y) / 3),
                                    y < 0 && (g = -y),
                                    g && c
                                        ? t.css("margin-right", -g)
                                        : g && t.css("margin-left", -g),
                                    p > o && t.addClass("nav-dropdown-full");
                            }
                            if (r) {
                                t.css({
                                    inset: "0",
                                });
                                const e = t
                                        .closest(".container")
                                        .get(0)
                                        .getBoundingClientRect(),
                                    n = t.get(0).getBoundingClientRect();
                                t.css({
                                    width: s ? o - i.width() : o,
                                    ...(!c && {
                                        left: e.left - n.left + 15,
                                    }),
                                    ...(c && {
                                        right: 15 - (e.right - n.right),
                                    }),
                                });
                            }
                            if (a) {
                                t.css({
                                    inset: "0",
                                });
                                const e = document.body,
                                    n = e.getBoundingClientRect(),
                                    o = t.get(0).getBoundingClientRect(),
                                    a = e.clientWidth;
                                t.css({
                                    ...(!c && {
                                        width: s
                                            ? a -
                                              i.get(0).getBoundingClientRect()
                                                  .right
                                            : a,
                                    }),
                                    ...(c && {
                                        width: s
                                            ? i.get(0).getBoundingClientRect()
                                                  .left
                                            : a,
                                    }),
                                    ...(!c && {
                                        left: n.left - o.left,
                                    }),
                                    ...(c && {
                                        right: -(n.right - o.right),
                                    }),
                                });
                            }
                            if ((r || a) && !s) {
                                let e = null;
                                if (
                                    (i.closest("#top-bar").length &&
                                        (e =
                                            document.querySelector("#top-bar")),
                                    i.closest("#masthead").length &&
                                        (e =
                                            document.querySelector(
                                                "#masthead"
                                            )),
                                    i.closest("#wide-nav").length &&
                                        (e =
                                            document.querySelector(
                                                "#wide-nav"
                                            )),
                                    null !== e)
                                ) {
                                    const n = e.getBoundingClientRect(),
                                        o = i.get(0).getBoundingClientRect();
                                    t.css({
                                        top: n.bottom - o.bottom + o.height,
                                    });
                                }
                            }
                        })(e.find(".nav-dropdown"));
                }
                function i(e) {
                    e.removeClass("current-dropdown"),
                        e.find(".nav-top-link").attr("aria-expanded", !1),
                        e.find(".nav-dropdown").attr("style", "");
                }
                function a(e) {
                    e.each((e, t) => {
                        const n = jQuery(t);
                        n.hasClass("current-dropdown") && i(n);
                    });
                }
                function r(e, t) {
                    e.length && e.addClass(`ux-body-overlay--${t}-active`);
                }
                function s(e, t) {
                    e.length && e.removeClass(`ux-body-overlay--${t}-active`);
                }
                Flatsome.behavior("dropdown", {
                    attach(e) {
                        const t = jQuery(".nav li.has-dropdown", e),
                            n = "uxBuilder" === jQuery("html").attr("ng-app"),
                            l = jQuery(".ux-body-overlay"),
                            c = "ontouchstart" in window;
                        let u = !1,
                            d = null;
                        jQuery(
                            ".header-nav > li > a, .top-bar-nav > li > a",
                            e
                        ).on("focus", () => {
                            a(t);
                        }),
                            t.each(function (e, h) {
                                const f = jQuery(h),
                                    p = f.hasClass("nav-dropdown-toggle") && !c;
                                let y = !1,
                                    g = !1;
                                f.on("touchstart click", function (e) {
                                    "touchstart" === e.type && (y = !0),
                                        "click" === e.type &&
                                            y &&
                                            (y && !g && e.preventDefault(),
                                            (g = !0));
                                }),
                                    n || p
                                        ? ((u = !0),
                                          f.on(
                                              "click",
                                              "a:first",
                                              function (e) {
                                                  if (
                                                      (e.preventDefault(),
                                                      (d = f),
                                                      f.hasClass(
                                                          "current-dropdown"
                                                      ))
                                                  )
                                                      return (
                                                          i(f),
                                                          void s(l, "click")
                                                      );
                                                  a(t),
                                                      o(f),
                                                      r(l, "click"),
                                                      jQuery(document).trigger(
                                                          "flatsome-dropdown-opened",
                                                          [f]
                                                      );
                                              }
                                          ))
                                        : (f.on(
                                              "keydown",
                                              "a:first",
                                              function (e) {
                                                  "Space" === e.code &&
                                                      (e.preventDefault(),
                                                      f.hasClass(
                                                          "current-dropdown"
                                                      )
                                                          ? (i(f),
                                                            s(l, "click"))
                                                          : (a(t),
                                                            o(f),
                                                            r(l, "click"),
                                                            jQuery(
                                                                document
                                                            ).trigger(
                                                                "flatsome-dropdown-opened",
                                                                [f]
                                                            )));
                                              }
                                          ),
                                          f.hoverIntent({
                                              sensitivity: 3,
                                              interval: 20,
                                              timeout: 70,
                                              over(e) {
                                                  a(t),
                                                      o(f),
                                                      s(l, "click"),
                                                      jQuery(document).trigger(
                                                          "flatsome-dropdown-opened",
                                                          [f]
                                                      );
                                              },
                                              out() {
                                                  (g = !1), (y = !1), i(f);
                                              },
                                          })
                                        );
                            }),
                            !n &&
                                u &&
                                jQuery(document).on("click", function (e) {
                                    null === d ||
                                        d === e.target ||
                                        d.has(e.target).length ||
                                        (i(d), s(l, "click"));
                                }),
                            jQuery(document).on(
                                "flatsome-dropdown-opened",
                                function (e, t) {
                                    t.hasClass("menu-item-has-block") &&
                                        jQuery.fn.packery &&
                                        t
                                            .find("[data-packery-options]")
                                            .packery("layout");
                                }
                            ),
                            jQuery(document).on(
                                "flatsome-header-sticky",
                                function () {
                                    a(t), s(l, "click");
                                }
                            );
                    },
                });
            },
            9086: function () {
                Flatsome.behavior("nav-hover", {
                    attach(e) {
                        const t = jQuery(".ux-body-overlay", e);
                        t.length &&
                            jQuery(
                                [
                                    ".nav-prompts-overlay li.menu-item",
                                    ".nav-prompts-overlay .header-vertical-menu__opener",
                                ].join(", "),
                                e
                            ).on({
                                mouseenter: () => {
                                    t.addClass("ux-body-overlay--hover-active");
                                },
                                mouseleave: () => {
                                    t.removeClass(
                                        "ux-body-overlay--hover-active"
                                    );
                                },
                            });
                    },
                });
            },
            7725: function () {
                function e(e) {
                    e.attr("aria-hidden", "true"),
                        e
                            .find("> li > a, > li > button")
                            .attr("tabindex", "-1");
                }
                Flatsome.behavior("sidebar-slider", {
                    attach(t) {
                        const n = jQuery("body").hasClass(
                            "mobile-submenu-toggle"
                        );
                        jQuery(".mobile-sidebar-slide", t).each((t, o) => {
                            const i =
                                    parseInt(jQuery(o).data("levels"), 10) || 1,
                                a = jQuery(".sidebar-menu", o),
                                r = jQuery(".nav-sidebar", o);
                            jQuery(
                                [
                                    "> li > ul.children",
                                    "> li > .sub-menu",
                                    i > 1
                                        ? "> li > ul.children > li > ul"
                                        : null,
                                ]
                                    .filter(Boolean)
                                    .join(", "),
                                r
                            ).each((t, o) => {
                                const i = jQuery(o),
                                    r = i.parent(),
                                    s = r.parents("ul:first"),
                                    l = jQuery(
                                        [
                                            "> .toggle",
                                            '> a[href="#"]',
                                            n && "> a",
                                        ]
                                            .filter(Boolean)
                                            .join(","),
                                        r
                                    ),
                                    c = r.find("> a").text().trim(),
                                    u = i.parents("ul").length,
                                    d = Boolean(window.flatsomeVars.rtl),
                                    h = jQuery(
                                        `\n            <li class="nav-slide-header pt-half pb-half">\n              <button class="toggle">\n                <i class="icon-angle-left"></i>\n                ${
                                            c ||
                                            window.flatsomeVars.i18n.mainMenu
                                        }\n              </button>\n            </li>\n          `
                                    );
                                i.prepend(h), e(i);
                                let f = null;
                                l.off("click").on("click", (e) => {
                                    var t;
                                    r.attr("aria-expanded", "true"),
                                        s.addClass("is-current-parent"),
                                        i.addClass("is-current-slide"),
                                        a.css(
                                            "transform",
                                            `translateX(${d ? "" : "-"}${
                                                100 * u
                                            }%)`
                                        ),
                                        (t = i).attr("aria-hidden", "false"),
                                        t
                                            .find("> li > a, > li > button")
                                            .attr("tabindex", ""),
                                        clearTimeout(f),
                                        e.preventDefault();
                                }),
                                    h.find(".toggle").on("click", () => {
                                        a.css(
                                            "transform",
                                            `translateX(${d ? "" : "-"}${
                                                100 * (u - 1)
                                            }%)`
                                        ),
                                            e(i),
                                            (f = setTimeout(() => {
                                                i.removeClass(
                                                    "is-current-slide"
                                                ),
                                                    s.removeClass(
                                                        "is-current-parent"
                                                    );
                                            }, 300)),
                                            r.removeClass("active"),
                                            r.attr("aria-expanded", "false");
                                    });
                            });
                        });
                    },
                });
            },
            1284: function () {
                Flatsome.behavior("sidebar-tabs", {
                    attach(e) {
                        jQuery(".sidebar-menu-tabs", e).each((e, t) => {
                            const n = jQuery(t),
                                o = n.find(".sidebar-menu-tabs__tab"),
                                i = n.parent().find("ul.nav-sidebar");
                            o.each((e, t) => {
                                jQuery(t).on("click", function (t) {
                                    !(function (e, t, n) {
                                        t.each((t, n) =>
                                            jQuery(n).toggleClass(
                                                "active",
                                                t === e
                                            )
                                        ),
                                            n.each((t, n) =>
                                                jQuery(n).toggleClass(
                                                    "hidden",
                                                    t === e
                                                )
                                            );
                                    })(e, o, i),
                                        t.preventDefault(),
                                        t.stopPropagation();
                                });
                            });
                        });
                    },
                });
            },
            // 2394: function () {
            //     Flatsome.behavior("scroll-to", {
            //         attach() {
            //             const e = jQuery("span.scroll-to"),
            //                 t = parseInt(flatsomeVars.sticky_height, 10),
            //                 n = jQuery("#wpadminbar");
            //             if (!e.length) return;
            //             let o = jQuery(".scroll-to-bullets");
            //             o.length
            //                 ? (o.children().lazyTooltipster("destroy"),
            //                   o.empty())
            //                 : ((o = jQuery(
            //                       '<div class="scroll-to-bullets hide-for-medium"/>'
            //                   )),
            //                   jQuery("body").append(o)),
            //                 jQuery("li.scroll-to-link").remove(),
            //                 e.each(function (e, t) {
            //                     let i = jQuery(t),
            //                         a = i.data("link"),
            //                         r = i.data("title"),
            //                         s = `a[href="${a || "<nolink>"}"]`;
            //                     if (i.data("bullet")) {
            //                         let e = jQuery(
            //                             `\n          <a href="${a}" data-title="${r}" title="${r}">\n          <strong></strong>\n          </a>\n        `
            //                         );
            //                         e.lazyTooltipster({
            //                             position: "left",
            //                             delay: 50,
            //                             contentAsHTML: !0,
            //                             touchDevices: !1,
            //                         }),
            //                             o.append(e);
            //                     }
            //                     let l = jQuery(
            //                         `\n          <li class="scroll-to-link"><a data-animate="fadeIn" href="${a}" data-title="${r}" title="${r}">\n          ${r}\n          </a></li>\n        `
            //                     );
            //                     jQuery("li.nav-single-page").before(l),
            //                         setTimeout(function () {
            //                             jQuery(".scroll-to-link a").attr(
            //                                 "data-animated",
            //                                 "true"
            //                             );
            //                         }, 300),
            //                         jQuery(s)
            //                             .off("click")
            //                             .on("click", function (e) {
            //                                 const t = jQuery(this)
            //                                     .attr("href")
            //                                     .split("#")[1];
            //                                 if (!t) return;
            //                                 let o = i.attr("data-offset");
            //                                 o &&
            //                                     n.length &&
            //                                     n.is(":visible") &&
            //                                     (o =
            //                                         Number(o) +
            //                                         Number(n.height())),
            //                                     setTimeout(() => {
            //                                         jQuery.scrollTo(
            //                                             `a[name=${t}`,
            //                                             {
            //                                                 ...(!isNaN(o) && {
            //                                                     offset: -o,
            //                                                 }),
            //                                             }
            //                                         );
            //                                     }, 0),
            //                                     jQuery.fn.magnificPopup &&
            //                                         jQuery.magnificPopup.close(),
            //                                     e.preventDefault();
            //                             });
            //                 });
            //             let i = 0;
            //             const a = () => {
            //                 clearTimeout(i),
            //                     (i = setTimeout(() => {
            //                         const n = e
            //                             .get()
            //                             .map(
            //                                 (e) => e.getBoundingClientRect().y
            //                             );
            //                         o.find("a").each((e, o) => {
            //                             const i = n[e],
            //                                 a = n[e + 1] || window.innerHeight,
            //                                 r = i <= t + 100 && a > t + 100;
            //                             jQuery(o).toggleClass("active", r);
            //                         });
            //                     }, 100));
            //             };
            //             if (
            //                 (window.addEventListener("scroll", a, {
            //                     passive: !0,
            //                 }),
            //                 window.addEventListener("resize", a),
            //                 a(),
            //                 location.hash)
            //             ) {
            //                 const e = location.hash.replace("#", "");
            //                 let t = jQuery(`a[name=${e}`)
            //                     .closest(".scroll-to")
            //                     .attr("data-offset");
            //                 t &&
            //                     n.length &&
            //                     n.is(":visible") &&
            //                     (t = Number(t) + Number(n.height())),
            //                     jQuery.scrollTo(`a[name=${e}`, {
            //                         ...(!isNaN(t) && {
            //                             offset: -t,
            //                         }),
            //                     });
            //             }
            //         },
            //         detach() {
            //             jQuery("span.scroll-to").length &&
            //                 setTimeout(this.attach, 0);
            //         },
            //     });
            // },
            5855: function () {
                function e(e, t, n) {
                    t.each((t, n) => {
                        jQuery(n).toggleClass("active", t === e),
                            jQuery(n)
                                .find("> a")
                                .attr(
                                    "aria-selected",
                                    t === e ? "true" : "false"
                                )
                                .attr("tabindex", t === e ? null : "-1");
                    }),
                        n.each((t, n) =>
                            jQuery(n).toggleClass("active", t === e)
                        ),
                        jQuery.fn.packery &&
                            jQuery("[data-packery-options]", n[e]).packery(
                                "layout"
                            );
                }
                Flatsome.behavior("tabs", {
                    attach(t) {
                        const n = window.location.hash;
                        let o = !1;
                        jQuery(".tabbed-content", t).each(function (t, i) {
                            const a = jQuery(i),
                                r = a.find("> .nav > li"),
                                s = a.find("> .tab-panels > .panel"),
                                l = a
                                    .find("> .nav")
                                    .hasClass("active-on-hover"),
                                c = a.find("> .nav").hasClass("nav-vertical");
                            s.removeAttr("style"),
                                r.each(function (t, i) {
                                    const u = jQuery(i).find("a");
                                    u.on("click", function (n) {
                                        e(t, r, s),
                                            n.preventDefault(),
                                            n.stopPropagation();
                                    }),
                                        u.on("keydown", (e) => {
                                            let n;
                                            switch (e.key) {
                                                case c
                                                    ? "ArrowDown"
                                                    : "ArrowRight":
                                                    n = r.eq(
                                                        (t + 1) % r.length
                                                    );
                                                    break;
                                                case c
                                                    ? "ArrowUp"
                                                    : "ArrowLeft":
                                                    n = r.eq(
                                                        (t - 1) % r.length
                                                    );
                                                    break;
                                                case "Home":
                                                    n = r.first();
                                                    break;
                                                case "End":
                                                    n = r.last();
                                            }
                                            n &&
                                                (n.find("> a").trigger("focus"),
                                                e.stopPropagation(),
                                                e.preventDefault());
                                        }),
                                        l &&
                                            u.hoverIntent({
                                                sensitivity: 3,
                                                interval: 20,
                                                timeout: 70,
                                                over(n) {
                                                    e(t, r, s);
                                                },
                                                out() {},
                                            }),
                                        n.substring(1).length &&
                                            n.substring(1) ===
                                                u.attr("href")?.split("#")[1] &&
                                            (e(t, r, s),
                                            o ||
                                                ((o = !0),
                                                setTimeout(() => {
                                                    jQuery.scrollTo(a);
                                                }, 500)));
                                });
                        });
                    },
                });
            },
            1092: function () {
                Flatsome.behavior("toggle", {
                    attach(e) {
                        function t(e) {
                            const t = jQuery(e.currentTarget).parent();
                            t.toggleClass("active"),
                                t.attr(
                                    "aria-expanded",
                                    "false" === t.attr("aria-expanded")
                                        ? "true"
                                        : "false"
                                ),
                                e.preventDefault();
                        }
                        jQuery(
                            [
                                ".widget ul.children",
                                ".nav ul.children",
                                ".menu .sub-menu",
                                ".mobile-sidebar-levels-2 .nav ul.children > li > ul",
                            ].join(", "),
                            e
                        ).each(function () {
                            const e = jQuery(this).parents(".nav-slide").length
                                ? "right"
                                : "down";
                            jQuery(this)
                                .parent()
                                .addClass("has-child")
                                .attr("aria-expanded", "false"),
                                jQuery(this).before(
                                    `<button class="toggle" aria-label="${window.flatsomeVars.i18n.toggleButton}"><i class="icon-angle-${e}"></i></button>`
                                );
                        }),
                            jQuery(".current-cat-parent", e)
                                .addClass("active")
                                .attr("aria-expanded", "true")
                                .removeClass("current-cat-parent"),
                            jQuery(".toggle", e).on("click", t);
                        const n = jQuery("body").hasClass(
                            "mobile-submenu-toggle"
                        );
                        jQuery(".sidebar-menu li.menu-item.has-child", e).each(
                            function () {
                                let e = jQuery(this),
                                    o = e.find("> a:first");
                                "#" === o.attr("href")
                                    ? o.on("click", function (t) {
                                          t.preventDefault(),
                                              e.toggleClass("active"),
                                              e.attr(
                                                  "aria-expanded",
                                                  "false" ===
                                                      e.attr("aria-expanded")
                                                      ? "true"
                                                      : "false"
                                              );
                                      })
                                    : n &&
                                      o.next(".toggle").length &&
                                      o.on("click", t);
                            }
                        );
                    },
                });
            },
            5560: function () {
                Flatsome.behavior("tooltips", {
                    attach(e) {
                        jQuery(
                            ".tooltip, .has-tooltip, .tip-top, li.chosen a",
                            e
                        ).lazyTooltipster(),
                            jQuery(".tooltip-as-html", e).lazyTooltipster({
                                interactive: !0,
                                contentAsHTML: !0,
                            });
                    },
                });
            },
            9075: function () {
                Flatsome.behavior("youtube", {
                    attach(e) {
                        var t,
                            n,
                            o,
                            i,
                            a,
                            r = jQuery(".ux-youtube", e);
                        0 !== r.length &&
                            ((window.onYouTubePlayerAPIReady = function () {
                                r.each(function () {
                                    var e = jQuery(this),
                                        t = e.attr("id"),
                                        n = e.data("videoid"),
                                        o = e.data("loop"),
                                        i = e.data("audio");
                                    new YT.Player(t, {
                                        height: "100%",
                                        width: "100%",
                                        playerVars: {
                                            html5: 1,
                                            autoplay: 1,
                                            controls: 0,
                                            rel: 0,
                                            modestbranding: 1,
                                            playsinline: 1,
                                            showinfo: 0,
                                            fs: 0,
                                            loop: o,
                                            el: 0,
                                            playlist: o ? n : void 0,
                                        },
                                        videoId: n,
                                        events: {
                                            onReady: function (e) {
                                                0 === i && e.target.mute();
                                            },
                                        },
                                    });
                                });
                            }),
                            (n = "script"),
                            (o = "youtube-jssdk"),
                            (a = (t = document).getElementsByTagName(n)[0]),
                            t.getElementById(o) ||
                                (((i = t.createElement(n)).id = o),
                                (i.src = "https://www.youtube.com/player_api"),
                                a.parentNode.insertBefore(i, a)));
                    },
                });
            },
            9343: function (e, t, n) {
                n.g.Flatsome = {
                    behaviors: {},
                    plugin(e, t, n) {
                        (n = n || {}),
                            (jQuery.fn[e] = function (o) {
                                if ("string" == typeof arguments[0]) {
                                    var i = null,
                                        a = arguments[0],
                                        r = Array.prototype.slice.call(
                                            arguments,
                                            1
                                        );
                                    return (
                                        this.each(function () {
                                            if (
                                                !jQuery.data(
                                                    this,
                                                    "plugin_" + e
                                                ) ||
                                                "function" !=
                                                    typeof jQuery.data(
                                                        this,
                                                        "plugin_" + e
                                                    )[a]
                                            )
                                                throw new Error(
                                                    "Method " +
                                                        a +
                                                        " does not exist on jQuery." +
                                                        e
                                                );
                                            i = jQuery
                                                .data(this, "plugin_" + e)
                                                [a].apply(this, r);
                                        }),
                                        "destroy" === a &&
                                            this.each(function () {
                                                jQuery(this).removeData(
                                                    "plugin_" + e
                                                );
                                            }),
                                        void 0 !== i ? i : this
                                    );
                                }
                                if ("object" == typeof o || !o)
                                    return this.each(function () {
                                        jQuery.data(this, "plugin_" + e) ||
                                            ((o = jQuery.extend({}, n, o)),
                                            jQuery.data(
                                                this,
                                                "plugin_" + e,
                                                new t(this, o)
                                            ));
                                    });
                            });
                    },
                    behavior(e, t) {
                        this.behaviors[e] = t;
                    },
                    attach(e) {
                        let t =
                            arguments.length > 1 && void 0 !== arguments[1]
                                ? arguments[1]
                                : e;
                        if ("string" == typeof e)
                            return this.behaviors.hasOwnProperty(e) &&
                                "function" == typeof this.behaviors[e].attach
                                ? this.behaviors[e].attach(t || document)
                                : null;
                        for (let e in this.behaviors)
                            "function" == typeof this.behaviors[e].attach &&
                                this.behaviors[e].attach(t || document);
                    },
                    detach(e) {
                        let t =
                            arguments.length > 1 && void 0 !== arguments[1]
                                ? arguments[1]
                                : e;
                        if ("string" == typeof e)
                            return this.behaviors.hasOwnProperty(e) &&
                                "function" == typeof this.behaviors[e].detach
                                ? this.behaviors[e].detach(t || document)
                                : null;
                        for (let e in this.behaviors)
                            "function" == typeof this.behaviors[e].detach &&
                                this.behaviors[e].detach(t || document);
                    },
                };
            },
            5299: function () {
                jQuery(
                    ".section .loading-spin, .banner .loading-spin, .page-loader"
                ).fadeOut(),
                    jQuery("#top-link").on("click", function (e) {
                        jQuery.scrollTo(0), e.preventDefault();
                    }),
                    jQuery(".scroll-for-more").on("click", function () {
                        jQuery.scrollTo(jQuery(this));
                    }),
                    jQuery(".search-dropdown button").on("click", function (e) {
                        jQuery(this).parent().find("input").trigger("focus"),
                            e.preventDefault();
                    }),
                    jQuery(".current-cat").addClass("active"),
                    jQuery("html").removeClass("loading-site"),
                    setTimeout(function () {
                        jQuery(".page-loader").remove();
                    }, 1e3),
                    jQuery(".resize-select").resizeselect(),
                 
                    document.addEventListener("uxb_app_ready", () => {
                        const e = new URLSearchParams(
                                window.top.location.search
                            ),
                            t = parseInt(e.get("menu_id"));
                        t &&
                            setTimeout(() => {
                                const e = jQuery(`#menu-item-${t}`),
                                    n = e
                                        .parent()
                                        .hasClass("ux-nav-vertical-menu");
                                e.hasClass(
                                    "menu-item-has-block has-dropdown"
                                ) &&
                                    !e.hasClass("current-dropdown") &&
                                    (n &&
                                        jQuery(
                                            ".header-vertical-menu__fly-out"
                                        ).addClass(
                                            "header-vertical-menu__fly-out--open"
                                        ),
                                    jQuery(`#menu-item-${t} a:first`).trigger(
                                        "click"
                                    ));
                            }, 1e3);
                    }),
                    jQuery("#hotspot").on("click", function (e) {
                        e.preventDefault();
                    }),
                    jQuery(".wpcf7-form .wpcf7-submit").on(
                        "click",
                        function (e) {
                            jQuery(this)
                                .parent()
                                .parent()
                                .addClass("processing");
                        }
                    ),
                    jQuery(".wpcf7").on(
                        "wpcf7invalid wpcf7spam wpcf7mailsent wpcf7mailfailed",
                        function (e) {
                            jQuery(".processing").removeClass("processing");
                        }
                    ),
                    jQuery(document).ajaxComplete(function (e, t, n) {
                        jQuery(".processing").removeClass("processing");
                    });
            },
            5402: function (e, t, n) {
                jQuery.fn.lazyTooltipster = function (e) {
                    return this.each((t, o) => {
                        const i = jQuery(o);
                        "string" == typeof e
                            ? jQuery.fn.tooltipster &&
                              i.hasClass("tooltipstered") &&
                              i.tooltipster(e)
                            : i.one("mouseenter", (t) => {
                                  !(function (e, t) {
                                      (jQuery.fn.tooltipster
                                          ? Promise.resolve()
                                          : n.e(255).then(n.t.bind(n, 8382, 23))
                                      ).then(() => {
                                          e.hasClass("tooltipstered") ||
                                              e.tooltipster({
                                                  theme: "tooltipster-default",
                                                  delay: 10,
                                                  animationDuration: 300,
                                                  ...t,
                                              }),
                                              e.tooltipster("show");
                                      });
                                  })(i, e);
                              });
                    });
                };
            },
            8417: function () {
                Flatsome.plugin("resizeselect", function (e, t) {
                    jQuery(e)
                        .on("change", function () {
                            var e = jQuery(this),
                                t = e.find("option:selected").val(),
                                n = e.find("option:selected").text(),
                                o = jQuery(
                                    '<span class="select-resize-ghost">'
                                ).html(n);
                            o.appendTo(e.parent());
                            var i = o.width();
                            o.remove(),
                                e.width(i + 7),
                                t &&
                                    e
                                        .parent()
                                        .parent()
                                        .find("input.search-field")
                                        .focus();
                        })
                        .trigger("change");
                });
            },
            4944: function (e, t, n) {
                var o, i;
                "undefined" != typeof window && window,
                    void 0 ===
                        (i =
                            "function" ==
                            typeof (o = function () {
                                "use strict";
                                function e() {}
                                var t = e.prototype;
                                return (
                                    (t.on = function (e, t) {
                                        if (e && t) {
                                            var n = (this._events =
                                                    this._events || {}),
                                                o = (n[e] = n[e] || []);
                                            return (
                                                -1 == o.indexOf(t) && o.push(t),
                                                this
                                            );
                                        }
                                    }),
                                    (t.once = function (e, t) {
                                        if (e && t) {
                                            this.on(e, t);
                                            var n = (this._onceEvents =
                                                this._onceEvents || {});
                                            return (
                                                ((n[e] = n[e] || {})[t] = !0),
                                                this
                                            );
                                        }
                                    }),
                                    (t.off = function (e, t) {
                                        var n = this._events && this._events[e];
                                        if (n && n.length) {
                                            var o = n.indexOf(t);
                                            return (
                                                -1 != o && n.splice(o, 1), this
                                            );
                                        }
                                    }),
                                    (t.emitEvent = function (e, t) {
                                        var n = this._events && this._events[e];
                                        if (n && n.length) {
                                            (n = n.slice(0)), (t = t || []);
                                            for (
                                                var o =
                                                        this._onceEvents &&
                                                        this._onceEvents[e],
                                                    i = 0;
                                                i < n.length;
                                                i++
                                            ) {
                                                var a = n[i];
                                                o &&
                                                    o[a] &&
                                                    (this.off(e, a),
                                                    delete o[a]),
                                                    a.apply(this, t);
                                            }
                                            return this;
                                        }
                                    }),
                                    (t.allOff = function () {
                                        delete this._events,
                                            delete this._onceEvents;
                                    }),
                                    e
                                );
                            })
                                ? o.call(t, n, t, e)
                                : o) || (e.exports = i);
            },
            6239: function (e, t, n) {
                var o;
                (o = void 0 !== n.g ? n.g : this),
                    (e.exports = function (e, t, n) {
                        if (void 0 === t) {
                            var i = ("; " + o.document.cookie).split(
                                "; " + e + "="
                            );
                            return 2 === i.length
                                ? i.pop().split(";").shift()
                                : null;
                        }
                        !1 === t && (n = -1);
                        var a = "";
                        if (n) {
                            var r = new Date();
                            r.setTime(r.getTime() + 24 * n * 60 * 60 * 1e3),
                                (a = "; expires=" + r.toGMTString());
                        }
                        o.document.cookie = e + "=" + t + a + "; path=/";
                    });
            },
            7243: function () {
                !(function () {
                    var e =
                            window.MutationObserver ||
                            window.WebKitMutationObserver,
                        t =
                            "ontouchstart" in window ||
                            (window.DocumentTouch &&
                                document instanceof DocumentTouch);
                    if (
                        void 0 ===
                            document.documentElement.style["touch-action"] &&
                        !document.documentElement.style["-ms-touch-action"] &&
                        t &&
                        e
                    ) {
                        window.Hammer = window.Hammer || {};
                        var n = /touch-action[:][\s]*(none)[^;'"]*/,
                            o = /touch-action[:][\s]*(manipulation)[^;'"]*/,
                            i = /touch-action/,
                            a =
                                /(iP(ad|hone|od))/.test(navigator.userAgent) &&
                                ("indexedDB" in window || !!window.performance);
                        (window.Hammer.time = {
                            getTouchAction: function (e) {
                                return this.checkStyleString(
                                    e.getAttribute("style")
                                );
                            },
                            checkStyleString: function (e) {
                                if (i.test(e))
                                    return n.test(e)
                                        ? "none"
                                        : !o.test(e) || "manipulation";
                            },
                            shouldHammer: function (e) {
                                var t = e.target.hasParent;
                                return (
                                    !(
                                        !t ||
                                        (a &&
                                            !(
                                                Date.now() -
                                                    e.target.lastStart <
                                                125
                                            ))
                                    ) && t
                                );
                            },
                            touchHandler: function (e) {
                                var t = this.shouldHammer(e);
                                if ("none" === t) this.dropHammer(e);
                                else if ("manipulation" === t) {
                                    var n = e.target.getBoundingClientRect();
                                    n.top === this.pos.top &&
                                        n.left === this.pos.left &&
                                        this.dropHammer(e);
                                }
                                (this.scrolled = !1),
                                    delete e.target.lastStart,
                                    delete e.target.hasParent;
                            },
                            dropHammer: function (e) {
                                "touchend" === e.type &&
                                    (e.target.focus(),
                                    setTimeout(function () {
                                        e.target.click();
                                    }, 0)),
                                    e.preventDefault();
                            },
                            touchStart: function (e) {
                                (this.pos = e.target.getBoundingClientRect()),
                                    (e.target.hasParent = this.hasParent(
                                        e.target
                                    )),
                                    a &&
                                        e.target.hasParent &&
                                        (e.target.lastStart = Date.now());
                            },
                            styleWatcher: function (e) {
                                e.forEach(this.styleUpdater, this);
                            },
                            styleUpdater: function (e) {
                                if (e.target.updateNext)
                                    e.target.updateNext = !1;
                                else {
                                    var t = this.getTouchAction(e.target);
                                    t
                                        ? "none" !== t &&
                                          (e.target.hadTouchNone = !1)
                                        : !t &&
                                          ((e.oldValue &&
                                              this.checkStyleString(
                                                  e.oldValue
                                              )) ||
                                              e.target.hadTouchNone) &&
                                          ((e.target.hadTouchNone = !0),
                                          (e.target.updateNext = !1),
                                          e.target.setAttribute(
                                              "style",
                                              e.target.getAttribute("style") +
                                                  " touch-action: none;"
                                          ));
                                }
                            },
                            hasParent: function (e) {
                                for (
                                    var t, n = e;
                                    n && n.parentNode;
                                    n = n.parentNode
                                )
                                    if ((t = this.getTouchAction(n))) return t;
                                return !1;
                            },
                            installStartEvents: function () {
                                document.addEventListener(
                                    "touchstart",
                                    this.touchStart.bind(this)
                                ),
                                    document.addEventListener(
                                        "mousedown",
                                        this.touchStart.bind(this)
                                    );
                            },
                            installEndEvents: function () {
                                document.addEventListener(
                                    "touchend",
                                    this.touchHandler.bind(this),
                                    !0
                                ),
                                    document.addEventListener(
                                        "mouseup",
                                        this.touchHandler.bind(this),
                                        !0
                                    );
                            },
                            installObserver: function () {
                                this.observer = new e(
                                    this.styleWatcher.bind(this)
                                ).observe(document, {
                                    subtree: !0,
                                    attributes: !0,
                                    attributeOldValue: !0,
                                    attributeFilter: ["style"],
                                });
                            },
                            install: function () {
                                this.installEndEvents(),
                                    this.installStartEvents(),
                                    this.installObserver();
                            },
                        }),
                            window.Hammer.time.install();
                    }
                })();
            },
            2702: function (e, t, n) {
                var o, i;
                !(function (a, r) {
                    "use strict";
                    (o = [n(4944)]),
                        (i = function (e) {
                            return (function (e, t) {
                                var n = e.jQuery,
                                    o = e.console;
                                function i(e, t) {
                                    for (var n in t) e[n] = t[n];
                                    return e;
                                }
                                var a = Array.prototype.slice;
                                function r(e, t, s) {
                                    if (!(this instanceof r))
                                        return new r(e, t, s);
                                    var l,
                                        c = e;
                                    "string" == typeof e &&
                                        (c = document.querySelectorAll(e)),
                                        c
                                            ? ((this.elements =
                                                  ((l = c),
                                                  Array.isArray(l)
                                                      ? l
                                                      : "object" == typeof l &&
                                                        "number" ==
                                                            typeof l.length
                                                      ? a.call(l)
                                                      : [l])),
                                              (this.options = i(
                                                  {},
                                                  this.options
                                              )),
                                              "function" == typeof t
                                                  ? (s = t)
                                                  : i(this.options, t),
                                              s && this.on("always", s),
                                              this.getImages(),
                                              n &&
                                                  (this.jqDeferred =
                                                      new n.Deferred()),
                                              setTimeout(this.check.bind(this)))
                                            : o.error(
                                                  "Bad element for imagesLoaded " +
                                                      (c || e)
                                              );
                                }
                                (r.prototype = Object.create(t.prototype)),
                                    (r.prototype.options = {}),
                                    (r.prototype.getImages = function () {
                                        (this.images = []),
                                            this.elements.forEach(
                                                this.addElementImages,
                                                this
                                            );
                                    }),
                                    (r.prototype.addElementImages = function (
                                        e
                                    ) {
                                        "IMG" == e.nodeName && this.addImage(e),
                                            !0 === this.options.background &&
                                                this.addElementBackgroundImages(
                                                    e
                                                );
                                        var t = e.nodeType;
                                        if (t && s[t]) {
                                            for (
                                                var n =
                                                        e.querySelectorAll(
                                                            "img"
                                                        ),
                                                    o = 0;
                                                o < n.length;
                                                o++
                                            ) {
                                                var i = n[o];
                                                this.addImage(i);
                                            }
                                            if (
                                                "string" ==
                                                typeof this.options.background
                                            ) {
                                                var a = e.querySelectorAll(
                                                    this.options.background
                                                );
                                                for (o = 0; o < a.length; o++) {
                                                    var r = a[o];
                                                    this.addElementBackgroundImages(
                                                        r
                                                    );
                                                }
                                            }
                                        }
                                    });
                                var s = {
                                    1: !0,
                                    9: !0,
                                    11: !0,
                                };
                                function l(e) {
                                    this.img = e;
                                }
                                function c(e, t) {
                                    (this.url = e),
                                        (this.element = t),
                                        (this.img = new Image());
                                }
                                return (
                                    (r.prototype.addElementBackgroundImages =
                                        function (e) {
                                            var t = getComputedStyle(e);
                                            if (t)
                                                for (
                                                    var n =
                                                            /url\((['"])?(.*?)\1\)/gi,
                                                        o = n.exec(
                                                            t.backgroundImage
                                                        );
                                                    null !== o;

                                                ) {
                                                    var i = o && o[2];
                                                    i &&
                                                        this.addBackground(
                                                            i,
                                                            e
                                                        ),
                                                        (o = n.exec(
                                                            t.backgroundImage
                                                        ));
                                                }
                                        }),
                                    (r.prototype.addImage = function (e) {
                                        var t = new l(e);
                                        this.images.push(t);
                                    }),
                                    (r.prototype.addBackground = function (
                                        e,
                                        t
                                    ) {
                                        var n = new c(e, t);
                                        this.images.push(n);
                                    }),
                                    (r.prototype.check = function () {
                                        var e = this;
                                        function t(t, n, o) {
                                            setTimeout(function () {
                                                e.progress(t, n, o);
                                            });
                                        }
                                        (this.progressedCount = 0),
                                            (this.hasAnyBroken = !1),
                                            this.images.length
                                                ? this.images.forEach(function (
                                                      e
                                                  ) {
                                                      e.once("progress", t),
                                                          e.check();
                                                  })
                                                : this.complete();
                                    }),
                                    (r.prototype.progress = function (e, t, n) {
                                        this.progressedCount++,
                                            (this.hasAnyBroken =
                                                this.hasAnyBroken ||
                                                !e.isLoaded),
                                            this.emitEvent("progress", [
                                                this,
                                                e,
                                                t,
                                            ]),
                                            this.jqDeferred &&
                                                this.jqDeferred.notify &&
                                                this.jqDeferred.notify(this, e),
                                            this.progressedCount ==
                                                this.images.length &&
                                                this.complete(),
                                            this.options.debug &&
                                                o &&
                                                o.log("progress: " + n, e, t);
                                    }),
                                    (r.prototype.complete = function () {
                                        var e = this.hasAnyBroken
                                            ? "fail"
                                            : "done";
                                        if (
                                            ((this.isComplete = !0),
                                            this.emitEvent(e, [this]),
                                            this.emitEvent("always", [this]),
                                            this.jqDeferred)
                                        ) {
                                            var t = this.hasAnyBroken
                                                ? "reject"
                                                : "resolve";
                                            this.jqDeferred[t](this);
                                        }
                                    }),
                                    (l.prototype = Object.create(t.prototype)),
                                    (l.prototype.check = function () {
                                        this.getIsImageComplete()
                                            ? this.confirm(
                                                  0 !== this.img.naturalWidth,
                                                  "naturalWidth"
                                              )
                                            : ((this.proxyImage = new Image()),
                                              this.proxyImage.addEventListener(
                                                  "load",
                                                  this
                                              ),
                                              this.proxyImage.addEventListener(
                                                  "error",
                                                  this
                                              ),
                                              this.img.addEventListener(
                                                  "load",
                                                  this
                                              ),
                                              this.img.addEventListener(
                                                  "error",
                                                  this
                                              ),
                                              (this.proxyImage.src =
                                                  this.img.src));
                                    }),
                                    (l.prototype.getIsImageComplete =
                                        function () {
                                            return (
                                                this.img.complete &&
                                                this.img.naturalWidth
                                            );
                                        }),
                                    (l.prototype.confirm = function (e, t) {
                                        (this.isLoaded = e),
                                            this.emitEvent("progress", [
                                                this,
                                                this.img,
                                                t,
                                            ]);
                                    }),
                                    (l.prototype.handleEvent = function (e) {
                                        var t = "on" + e.type;
                                        this[t] && this[t](e);
                                    }),
                                    (l.prototype.onload = function () {
                                        this.confirm(!0, "onload"),
                                            this.unbindEvents();
                                    }),
                                    (l.prototype.onerror = function () {
                                        this.confirm(!1, "onerror"),
                                            this.unbindEvents();
                                    }),
                                    (l.prototype.unbindEvents = function () {
                                        this.proxyImage.removeEventListener(
                                            "load",
                                            this
                                        ),
                                            this.proxyImage.removeEventListener(
                                                "error",
                                                this
                                            ),
                                            this.img.removeEventListener(
                                                "load",
                                                this
                                            ),
                                            this.img.removeEventListener(
                                                "error",
                                                this
                                            );
                                    }),
                                    (c.prototype = Object.create(l.prototype)),
                                    (c.prototype.check = function () {
                                        this.img.addEventListener("load", this),
                                            this.img.addEventListener(
                                                "error",
                                                this
                                            ),
                                            (this.img.src = this.url),
                                            this.getIsImageComplete() &&
                                                (this.confirm(
                                                    0 !== this.img.naturalWidth,
                                                    "naturalWidth"
                                                ),
                                                this.unbindEvents());
                                    }),
                                    (c.prototype.unbindEvents = function () {
                                        this.img.removeEventListener(
                                            "load",
                                            this
                                        ),
                                            this.img.removeEventListener(
                                                "error",
                                                this
                                            );
                                    }),
                                    (c.prototype.confirm = function (e, t) {
                                        (this.isLoaded = e),
                                            this.emitEvent("progress", [
                                                this,
                                                this.element,
                                                t,
                                            ]);
                                    }),
                                    (r.makeJQueryPlugin = function (t) {
                                        (t = t || e.jQuery) &&
                                            ((n = t).fn.imagesLoaded =
                                                function (e, t) {
                                                    return new r(
                                                        this,
                                                        e,
                                                        t
                                                    ).jqDeferred.promise(
                                                        n(this)
                                                    );
                                                });
                                    }),
                                    r.makeJQueryPlugin(),
                                    r
                                );
                            })(a, e);
                        }.apply(t, o)),
                        void 0 === i || (e.exports = i);
                })("undefined" != typeof window ? window : this);
            },
            5114: function (e, t, n) {
                var o, i, a;
                !(function (r) {
                    "use strict";
                    (i = [n(9567)]),
                        void 0 ===
                            (a =
                                "function" ==
                                typeof (o = function (e) {
                                    var t = (e.scrollTo = function (t, n, o) {
                                        return e(window).scrollTo(t, n, o);
                                    });
                                    function n(t) {
                                        return (
                                            !t.nodeName ||
                                            -1 !==
                                                e.inArray(
                                                    t.nodeName.toLowerCase(),
                                                    [
                                                        "iframe",
                                                        "#document",
                                                        "html",
                                                        "body",
                                                    ]
                                                )
                                        );
                                    }
                                    function o(e) {
                                        return "function" == typeof e;
                                    }
                                    function i(t) {
                                        return o(t) || e.isPlainObject(t)
                                            ? t
                                            : {
                                                  top: t,
                                                  left: t,
                                              };
                                    }
                                    return (
                                        (t.defaults = {
                                            axis: "xy",
                                            duration: 0,
                                            limit: !0,
                                        }),
                                        (e.fn.scrollTo = function (a, r, s) {
                                            "object" == typeof r &&
                                                ((s = r), (r = 0)),
                                                "function" == typeof s &&
                                                    (s = {
                                                        onAfter: s,
                                                    }),
                                                "max" === a && (a = 9e9),
                                                (s = e.extend(
                                                    {},
                                                    t.defaults,
                                                    s
                                                )),
                                                (r = r || s.duration);
                                            var l =
                                                s.queue && s.axis.length > 1;
                                            return (
                                                l && (r /= 2),
                                                (s.offset = i(s.offset)),
                                                (s.over = i(s.over)),
                                                this.each(function () {
                                                    if (null !== a) {
                                                        var c,
                                                            u = n(this),
                                                            d = u
                                                                ? this
                                                                      .contentWindow ||
                                                                  window
                                                                : this,
                                                            h = e(d),
                                                            f = a,
                                                            p = {};
                                                        switch (typeof f) {
                                                            case "number":
                                                            case "string":
                                                                if (
                                                                    /^([+-]=?)?\d+(\.\d+)?(px|%)?$/.test(
                                                                        f
                                                                    )
                                                                ) {
                                                                    f = i(f);
                                                                    break;
                                                                }
                                                                f = u
                                                                    ? e(f)
                                                                    : e(f, d);
                                                            case "object":
                                                                if (
                                                                    0 ===
                                                                    f.length
                                                                )
                                                                    return;
                                                                (f.is ||
                                                                    f.style) &&
                                                                    (c = (f =
                                                                        e(
                                                                            f
                                                                        )).offset());
                                                        }
                                                        var y =
                                                            (o(s.offset) &&
                                                                s.offset(
                                                                    d,
                                                                    f
                                                                )) ||
                                                            s.offset;
                                                        e.each(
                                                            s.axis.split(""),
                                                            function (e, n) {
                                                                var o =
                                                                        "x" ===
                                                                        n
                                                                            ? "Left"
                                                                            : "Top",
                                                                    i =
                                                                        o.toLowerCase(),
                                                                    a =
                                                                        "scroll" +
                                                                        o,
                                                                    r = h[a](),
                                                                    m = t.max(
                                                                        d,
                                                                        n
                                                                    );
                                                                if (c)
                                                                    (p[a] =
                                                                        c[i] +
                                                                        (u
                                                                            ? 0
                                                                            : r -
                                                                              h.offset()[
                                                                                  i
                                                                              ])),
                                                                        s.margin &&
                                                                            ((p[
                                                                                a
                                                                            ] -=
                                                                                parseInt(
                                                                                    f.css(
                                                                                        "margin" +
                                                                                            o
                                                                                    ),
                                                                                    10
                                                                                ) ||
                                                                                0),
                                                                            (p[
                                                                                a
                                                                            ] -=
                                                                                parseInt(
                                                                                    f.css(
                                                                                        "border" +
                                                                                            o +
                                                                                            "Width"
                                                                                    ),
                                                                                    10
                                                                                ) ||
                                                                                0)),
                                                                        (p[a] +=
                                                                            y[
                                                                                i
                                                                            ] ||
                                                                            0),
                                                                        s.over[
                                                                            i
                                                                        ] &&
                                                                            (p[
                                                                                a
                                                                            ] +=
                                                                                f[
                                                                                    "x" ===
                                                                                    n
                                                                                        ? "width"
                                                                                        : "height"
                                                                                ]() *
                                                                                s
                                                                                    .over[
                                                                                    i
                                                                                ]);
                                                                else {
                                                                    var v =
                                                                        f[i];
                                                                    p[a] =
                                                                        v.slice &&
                                                                        "%" ===
                                                                            v.slice(
                                                                                -1
                                                                            )
                                                                            ? (parseFloat(
                                                                                  v
                                                                              ) /
                                                                                  100) *
                                                                              m
                                                                            : v;
                                                                }
                                                                s.limit &&
                                                                    /^\d+$/.test(
                                                                        p[a]
                                                                    ) &&
                                                                    (p[a] =
                                                                        p[a] <=
                                                                        0
                                                                            ? 0
                                                                            : Math.min(
                                                                                  p[
                                                                                      a
                                                                                  ],
                                                                                  m
                                                                              )),
                                                                    !e &&
                                                                        s.axis
                                                                            .length >
                                                                            1 &&
                                                                        (r ===
                                                                        p[a]
                                                                            ? (p =
                                                                                  {})
                                                                            : l &&
                                                                              (g(
                                                                                  s.onAfterFirst
                                                                              ),
                                                                              (p =
                                                                                  {})));
                                                            }
                                                        ),
                                                            g(s.onAfter);
                                                    }
                                                    function g(t) {
                                                        var n = e.extend(
                                                            {},
                                                            s,
                                                            {
                                                                queue: !0,
                                                                duration: r,
                                                                complete:
                                                                    t &&
                                                                    function () {
                                                                        t.call(
                                                                            d,
                                                                            f,
                                                                            s
                                                                        );
                                                                    },
                                                            }
                                                        );
                                                        h.animate(p, n);
                                                    }
                                                })
                                            );
                                        }),
                                        (t.max = function (t, o) {
                                            var i =
                                                    "x" === o
                                                        ? "Width"
                                                        : "Height",
                                                a = "scroll" + i;
                                            if (!n(t))
                                                return (
                                                    t[a] -
                                                    e(t)[i.toLowerCase()]()
                                                );
                                            var r = "client" + i,
                                                s =
                                                    t.ownerDocument ||
                                                    t.document,
                                                l = s.documentElement,
                                                c = s.body;
                                            return (
                                                Math.max(l[a], c[a]) -
                                                Math.min(l[r], c[r])
                                            );
                                        }),
                                        (e.Tween.propHooks.scrollLeft =
                                            e.Tween.propHooks.scrollTop =
                                                {
                                                    get: function (t) {
                                                        return e(t.elem)[
                                                            t.prop
                                                        ]();
                                                    },
                                                    set: function (t) {
                                                        var n = this.get(t);
                                                        if (
                                                            t.options
                                                                .interrupt &&
                                                            t._last &&
                                                            t._last !== n
                                                        )
                                                            return e(
                                                                t.elem
                                                            ).stop();
                                                        var o = Math.round(
                                                            t.now
                                                        );
                                                        n !== o &&
                                                            (e(t.elem)[t.prop](
                                                                o
                                                            ),
                                                            (t._last =
                                                                this.get(t)));
                                                    },
                                                }),
                                        t
                                    );
                                })
                                    ? o.apply(t, i)
                                    : o) || (e.exports = a);
                })();
            },
            9567: function (e) {
                "use strict";
                e.exports = window.jQuery;
            },
        },
        a = {};

        (t = Object.getPrototypeOf
            ? function (e) {
                  return Object.getPrototypeOf(e);
              }
            : function (e) {
                  return e.__proto__;
              }),

        (function () {
            "use strict";

            const n = document.body,
                o = "body-scroll-lock--active",
                i = /Android|webOS|iPhone|iPad|iPod|BlackBerry/i.test(
                    navigator.userAgent
                );
            let a = 0;
            function s() {
                if (!i) return;
                a = window.pageYOffset;
                const e = document.getElementById("wpadminbar"),
                    t = a - (e ? e.offsetHeight : 0);
                (n.style.overflow = "hidden"),
                    (n.style.position = "fixed"),
                    (n.style.top = `-${t}px`),
                    (n.style.width = "100%"),
                    n.classList.add(o);
            }
            function l() {
                i &&
                    (n.style.removeProperty("overflow"),
                    n.style.removeProperty("position"),
                    n.style.removeProperty("top"),
                    n.style.removeProperty("width"),
                    window.scrollTo(0, a),
                    n.classList.remove(o));
            }
            function c(e) {
                let t =
                        arguments.length > 1 && void 0 !== arguments[1]
                            ? arguments[1]
                            : {},
                    n = 0;
                const o = (t) => {
                    const o = window.scrollY;
                    e(t, {
                        direction: o > n ? "down" : "up",
                        scrollY: o,
                    }),
                        (n = o);
                };
                return (
                    window.addEventListener("scroll", o, {
                        ...t,
                        passive: !0,
                    }),
                    () => {
                        window.removeEventListener("scroll", o);
                    }
                );
            }
            const u = jQuery("#header"),
                d = u.find(".header-wrapper"),
                h = jQuery(".header-top", u),
                f = jQuery(".header-main", u),
                p = u.hasClass("has-sticky"),
                y = u.hasClass("sticky-hide-on-scroll");
            let g, m, v;
            function b(e) {
                let t =
                    arguments.length > 1 && void 0 !== arguments[1]
                        ? arguments[1]
                        : "down";
                void 0 === m &&
                    void 0 === v &&
                    (jQuery(".sticky-shrink .header-wrapper").length
                        ? ((m = h.hasClass("hide-for-sticky") ? h.height() : 0),
                          (m += f.hasClass("hide-for-sticky") ? f.height() : 0),
                          (v = 1 + m))
                        : ((m = d.height() + 100),
                          (v = h.hasClass("hide-for-sticky")
                              ? h.height() + 1
                              : 1))),
                    y
                        ? "down" === t || e < v
                            ? e < v
                                ? w()
                                : (g = setTimeout(w, 100))
                            : e > m && (g = setTimeout(j, 100))
                        : e > m
                        ? j()
                        : e < v && w();
            }
            function j() {
                const e = u.height();
                jQuery(document).trigger("flatsome-header-sticky"),
                    d.addClass("stuck"),
                    u.height(e),
                    jQuery(".has-transparent").removeClass("transparent"),
                    jQuery(".toggle-nav-dark").removeClass("nav-dark"),
                    y && u.addClass("sticky-hide-on-scroll--active");
            }
            function w() {
                u.height(""),
                    jQuery(".header-wrapper").removeClass("stuck"),
                    jQuery(".has-transparent").addClass("transparent"),
                    jQuery(".toggle-nav-dark").addClass("nav-dark"),
                    y && u.removeClass("sticky-hide-on-scroll--active");
            }
            p &&
                document.addEventListener("DOMContentLoaded", () => {
                    c((e, t) => {
                        let { scrollY: i, direction: a } = t;
                        clearTimeout(g), n.classList.contains(o) || b(i, a);
                    }),
                        (g = setTimeout(() => {
                            window.scrollY && b(window.scrollY);
                        }, 100));
                });
            const k = window.matchMedia("(prefers-reduced-motion: reduce)");
            let Q = !1;
            function x() {
                Q = "undefined" == typeof UxBuilder && k.matches;
            }
            x(), k.addEventListener?.("change", x);
            const C = [];
            let E;
            function T() {
                C.length &&
                    (cancelAnimationFrame(E),
                    (E = requestAnimationFrame(() => {
                        for (let e = 0; e < C.length; e++)
                            C[e].element.offsetParent
                                ? L(C[e])
                                : C.splice(e, 1);
                    })));
            }
            function L(e) {
                !(function (e) {
                    let { element: t, type: n } = e,
                        o = O(t.dataset.parallax),
                        i = I(t),
                        a = (window.innerHeight - i.offsetHeight) * o;
                    switch (n) {
                        case "backgroundImage":
                            t.style.backgroundSize = o ? "100% auto" : null;
                            break;
                        case "backgroundElement":
                            t.style.height = o
                                ? `${i.offsetHeight + a}px`
                                : null;
                    }
                })(e),
                    (function (e) {
                        let { element: t, type: n } = e,
                            o = O(
                                t.dataset.parallax ||
                                    t.dataset.parallaxBackground
                            ),
                            i = window.innerHeight,
                            a = I(t),
                            r = t.offsetHeight - a.offsetHeight,
                            s = t.getBoundingClientRect(),
                            l = a !== t ? a.getBoundingClientRect() : s,
                            c = s.top + t.offsetHeight / 2,
                            u = i / 2 - c,
                            d = i / 2 - (l.top + a.offsetHeight / 2),
                            h = c + _() < i / 2 ? _() : u,
                            f = (Math.abs(u), Math.abs(h) / (i / 2)),
                            p = 0;
                        var y;
                        if (!(l.top > i || l.top + a.offsetHeight < 0))
                            switch (n) {
                                case "backgroundImage":
                                    (p = l.top * o),
                                        (t.style.backgroundPosition = o
                                            ? `50% ${p.toFixed(0)}px`
                                            : null),
                                        (t.style.backgroundAttachment = o
                                            ? "fixed"
                                            : null);
                                    break;
                                case "backgroundElement":
                                    (p = d * o - r / 2),
                                        (t.style.transform = o
                                            ? `translate3d(0, ${p.toFixed(
                                                  2
                                              )}px, 0)`
                                            : null),
                                        (t.style.backfaceVisibility = o
                                            ? "hidden"
                                            : null);
                                    break;
                                case "element":
                                    (p = h * o),
                                        (t.style.transform = o
                                            ? `translate3d(0, ${p.toFixed(
                                                  2
                                              )}px, 0)`
                                            : null),
                                        (t.style.backfaceVisibility = o
                                            ? "hidden"
                                            : null),
                                        void 0 !== t.dataset.parallaxFade &&
                                            (t.style.opacity = o
                                                ? ((y = 1 - f),
                                                  y * (2 - y)).toFixed(2)
                                                : null);
                            }
                    })(e);
            }
            function P(e) {
                return void 0 !== e.dataset.parallaxBackground
                    ? "backgroundElement"
                    : void 0 !== e.dataset.parallaxElemenet
                    ? "element"
                    : "" !== e.style.backgroundImage
                    ? "backgroundImage"
                    : "element";
            }
            function _() {
                return (
                    document.documentElement.scrollTop ||
                    document.body.scrollTop
                );
            }
            function I(e) {
                return (
                    (function (e) {
                        let t =
                            arguments.length > 1 && void 0 !== arguments[1]
                                ? arguments[1]
                                : null;
                        for (; e && !F(e).call(e, t); ) e = e.parentElement;
                        return e;
                    })(
                        e,
                        e.dataset.parallaxContainer ||
                            "[data-parallax-container]"
                    ) || e
                );
            }
            function F(e) {
                return (
                    e.matches ||
                    e.webkitMatchesSelector ||
                    e.mozMatchesSelector ||
                    e.msMatchesSelector
                );
            }
            function O(e) {
                return ((e / 10) * -1) / (2 - Math.abs(e) / 10);
            }
            function B(e) {
                return new IntersectionObserver(
                    function (t) {
                        for (let n = 0; n < t.length; n++) e(t[n]);
                    },
                    {
                        rootMargin: "0px",
                        threshold: 0.1,
                        ...(arguments.length > 1 && void 0 !== arguments[1]
                            ? arguments[1]
                            : {}),
                    }
                );
            }
            function D() {
                return (
                    console.warn(
                        "Flatsome: Flickity is lazy loaded. Use 'lazyFlickity()' to instantiate and 'flatsome-flickity-ready' event to interact with Flickity instead."
                    ),
                    this
                );
            }
            function M() {
                return jQuery.fn.magnificPopup
                    ? Promise.resolve()
                    : r.e(964).then(r.t.bind(r, 4343, 23));
            }
            window.addEventListener("scroll", T, {
                passive: !0,
            }),
                window.addEventListener("resize", T),
                new MutationObserver(T).observe(document.body, {
                    childList: !0,
                }),
                window.jQuery &&
                    (window.jQuery.fn.flatsomeParallax = function (e) {
                        Q ||
                            ("destroy" !== e &&
                                this.each((e, t) =>
                                    (function (e) {
                                        e.classList.add("parallax-active"),
                                            (!document
                                                .querySelector("body")
                                                .classList.contains(
                                                    "parallax-mobile"
                                                ) &&
                                                /Android|webOS|iPhone|iPad|iPod|BlackBerry/i.test(
                                                    navigator.userAgent
                                                )) ||
                                                (e.classList &&
                                                    e.dataset &&
                                                    (C.push({
                                                        element: e,
                                                        type: P(e),
                                                    }),
                                                    L(C[C.length - 1])));
                                    })(t)
                                ));
                    }),
                // r(8417),
                jQuery.fn.flickity ||
                    ((D.isFlickityStub = !0), (jQuery.fn.flickity = D)),
                (jQuery.fn.lazyFlickity = function (e) {
                    const t = B((n) => {
                        if (n.isIntersecting) {
                            if (
                                (t.unobserve(n.target),
                                !jQuery.fn.flickity || jQuery.fn.flickity === D)
                            )
                                return r
                                    .e(309)
                                    .then(r.t.bind(r, 2066, 23))
                                    .then(() => {
                                        jQuery(n.target).flickity(e),
                                            jQuery(n.target).trigger(
                                                "flatsome-flickity-ready"
                                            );
                                    });
                            jQuery(n.target).flickity(e),
                                jQuery(n.target).trigger(
                                    "flatsome-flickity-ready"
                                );
                        }
                    });
                    return this.each((n, o) => {
                        "string" == typeof e
                            ? jQuery.fn.flickity && jQuery(o).flickity(e)
                            : t.observe(o);
                    });
                }),
                (jQuery.loadMagnificPopup = M),
                (jQuery.fn.lazyMagnificPopup = function (e) {
                    const t = jQuery(this),
                        n = e.delegate ? t.find(e.delegate) : t;
                    return (
                        n.one("click", (o) => {
                            o.preventDefault(),
                                M().then(() => {
                                    t.data("magnificPopup") ||
                                        t.magnificPopup(e),
                                        t.magnificPopup(
                                            "open",
                                            n.index(o.currentTarget) || 0
                                        );
                                });
                        }),
                        t
                    );
                })
                // r(5402),
                // r(5299);
                ;
            const S = B((e) => {
                e.intersectionRatio > 0 &&
                    (S.unobserve(e.target),
                    setTimeout(() => {
                        jQuery(e.target).attr("data-animated", "true");
                    }, 300));
            });

            ;
            let V = 0;
            let R = 0;
            const q = "scrollBehavior" in document.documentElement.style,
                N = window.getComputedStyle(document.documentElement)[
                    "scroll-behavior"
                ];
            function W() {
                window.removeEventListener("pointermove", W),
                    window.removeEventListener("touchstart", W),
                    (function () {
                        const e = jQuery("#header");
                        if (!e.hasClass("has-sticky")) return;
                        const t = e.clone();
                        t.attr("id", "header-clone").css(
                            "visibility",
                            "hidden"
                        );
                        const n = t.find(".header-wrapper");
                        n.addClass("stuck"),
                            jQuery("body").append(t),
                            (V = Math.round(n.height())),
                            t.remove(),
                            // (window.flatsomeVars.stickyHeaderHeight = V),
                            (function (e) {
                                let t =
                                    arguments.length > 1 &&
                                    void 0 !== arguments[1]
                                        ? arguments[1]
                                        : "";
                                t &&
                                    document.documentElement.style.setProperty(
                                        e,
                                        t
                                    ),
                                    window
                                        .getComputedStyle(
                                            document.documentElement
                                        )
                                        .getPropertyValue(e);
                            })("--flatsome--header--sticky-height", `${V}px`);
                    })(),
                    (function () {
                        const e = jQuery("#wpadminbar"),
                            t = e.length && e.is(":visible") ? e.height() : 0;

                    })();
            }
            document.addEventListener("DOMContentLoaded", () => {
                window.location.hash || window.scrollY > 200
                    ? W()
                    : (window.addEventListener("pointermove", W, {
                          once: !0,
                      }),
                      window.addEventListener("touchstart", W, {
                          once: !0,
                      }));
            });
            for (const e of ["touchstart", "touchmove"])
                jQuery.event.special[e] = {
                    setup(t, n, o) {
                        this.addEventListener &&
                            this.addEventListener(e, o, {
                                passive: !n.includes("noPreventDefault"),
                            });
                    },
                };
            for (const e of ["wheel", "mousewheel"])
                jQuery.event.special[e] = {
                    setup(t, n, o) {
                        this.addEventListener &&
                            this.addEventListener(e, o, {
                                passive: !0,
                            });
                    },
                };
            // jQuery(() => r.g.Flatsome.attach(document)), (r.g.cookie = t());
        })();
})();
