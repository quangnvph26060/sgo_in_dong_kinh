!function() {
    var t, e, i, o, r = {
        634: function() {
            Flatsome.behavior("equalize-box", {
                attach(t) {
                    let e = {
                        ScreenSize: {
                            LARGE: 1,
                            MEDIUM: 2,
                            SMALL: 3
                        },
                        equalizeItems: function(t) {
                            const e = this;
                            e.maxHeight = 0,
                            e.rowEnd = e.disablePerRow ? e.boxCount : e.colPerRow,
                            e.$items = [],
                            e.rating = {
                                present: !1,
                                height: 0,
                                dummy: null
                            },
                            e.swatches = {
                                present: !1,
                                height: 0,
                                dummy: null
                            },
                            jQuery(t, e.currentElement).each((function(t) {
                                const i = jQuery(this);
                                e.$items.push(i),
                                i.height(""),
                                i.children(".js-star-rating").remove();
                                const o = i.children(".star-rating");
                                var r;
                                o.length && (e.rating.present = !0,
                                e.rating.height = o.height(),
                                e.rating.dummy = null !== (r = e.rating.dummy) && void 0 !== r ? r : '<div class="js-star-rating ' + o.attr("class") + '" style="opacity: 0; visibility: hidden"></div>'),
                                i.children(".js-ux-swatches").remove();
                                const a = i.children(".ux-swatches.ux-swatches-in-loop");
                                var n;
                                a.length && (e.swatches.present = !0,
                                e.swatches.height = a.height(),
                                e.swatches.dummy = null !== (n = e.swatches.dummy) && void 0 !== n ? n : '<div class="js-ux-swatches ' + a.attr("class") + '" style="opacity: 0; visibility: hidden"><div class="' + a.find(".ux-swatch").attr("class") + '"></div></div>'),
                                i.height() > e.maxHeight && (e.maxHeight = i.height()),
                                t !== e.rowEnd - 1 && t !== e.boxCount - 1 || (e.$items.forEach((function(t) {
                                    t.height(e.maxHeight),
                                    e.maybeAddDummyRating(t),
                                    e.maybeAddDummySwatches(t)
                                }
                                )),
                                e.rowEnd += e.colPerRow,
                                e.maxHeight = 0,
                                e.$items = [],
                                e.rating.present = !1,
                                e.swatches.present = !1)
                            }
                            ))
                        },
                        getColsPerRow: function() {
                            const t = jQuery(this.currentElement).attr("class")
                              , e = /large-columns-(\d+)/g
                              , i = /medium-columns-(\d+)/g
                              , o = /small-columns-(\d+)/g;
                            let r;
                            switch (this.getScreenSize()) {
                            case this.ScreenSize.LARGE:
                                return r = e.exec(t),
                                r ? parseInt(r[1]) : 3;
                            case this.ScreenSize.MEDIUM:
                                return r = i.exec(t),
                                r ? parseInt(r[1]) : 3;
                            case this.ScreenSize.SMALL:
                                return r = o.exec(t),
                                r ? parseInt(r[1]) : 2
                            }
                        },
                        maybeAddDummyRating: function(t) {
                            let e = t;
                            this.rating.present && e.hasClass("price-wrapper") && (e.children(".star-rating").length || (e.prepend(this.rating.dummy),
                            e.children(".js-star-rating").height(this.rating.height)))
                        },
                        maybeAddDummySwatches: function(t) {
                            const e = t;
                            this.swatches.present && (e.children(".ux-swatches.ux-swatches-in-loop").length || (e.prepend(this.swatches.dummy),
                            e.children(".js-ux-swatches").height(this.swatches.height)))
                        },
                        getScreenSize: function() {
                            return window.matchMedia("(min-width: 850px)").matches ? this.ScreenSize.LARGE : window.matchMedia("(min-width: 550px) and (max-width: 849px)").matches ? this.ScreenSize.MEDIUM : window.matchMedia("(max-width: 549px)").matches ? this.ScreenSize.SMALL : void 0
                        },
                        init: function() {
                            const e = this
                              , i = [".product-title", ".price-wrapper", ".box-excerpt", ".add-to-cart-button"];
                            jQuery(".equalize-box", t).each(( (t, o) => {
                                e.currentElement = o,
                                e.colPerRow = e.getColsPerRow(),
                                1 !== e.colPerRow && (e.disablePerRow = jQuery(o).hasClass("row-slider") || jQuery(o).hasClass("row-grid"),
                                e.boxCount = jQuery(".box-text", e.currentElement).length,
                                i.forEach((t => {
                                    e.equalizeItems(".box-text " + t)
                                }
                                )),
                                e.equalizeItems(".box-text"))
                            }
                            ))
                        }
                    };
                    e.init(),
                    jQuery(window).on("resize", ( () => {
                        e.init()
                    }
                    )),
                    jQuery(document).on("flatsome-equalize-box", ( () => {
                        e.init()
                    }
                    ))
                }
            })
        },
        9222: function() {
            Flatsome.behavior("add-qty", {
                attach(t) {
                    jQuery(".quantity", t).addQty()
                }
            })
        },
        6619: function() {
            Flatsome.plugin("addQty", (function(t, e) {
                const i = jQuery(t);
                String.prototype.uxGetDecimals || (String.prototype.uxGetDecimals = function() {
                    const t = ("" + this).match(/(?:\.(\d+))?(?:[eE]([+-]?\d+))?$/);
                    return t ? Math.max(0, (t[1] ? t[1].length : 0) - (t[2] ? +t[2] : 0)) : 0
                }
                ),
                i.off("click.flatsome", ".plus, .minus").on("click.flatsome", ".plus, .minus", (function() {
                    const t = jQuery(this)
                      , e = t.closest(".quantity").find(".qty");
                    let i = parseFloat(e.val())
                      , o = parseFloat(e.attr("max"))
                      , r = parseFloat(e.attr("min"))
                      , a = e.attr("step");
                    i && "" !== i && "NaN" !== i || (i = 0),
                    "" !== o && "NaN" !== o || (o = ""),
                    "" !== r && "NaN" !== r || (r = 0),
                    "any" !== a && "" !== a && void 0 !== a && "NaN" !== parseFloat(a) || (a = 1),
                    t.is(".plus") ? o && (o === i || i > o) ? e.val(o) : e.val((i + parseFloat(a)).toFixed(a.uxGetDecimals())) : r && (r === i || i < r) ? e.val(r) : i > 0 && e.val((i - parseFloat(a)).toFixed(a.uxGetDecimals())),
                    e.trigger("input"),
                    e.trigger("change")
                }
                ))
            }
            ))
        },
        4168: function(t, e, i) {
            var o, r;
            !function(a, n) {
                "use strict";
                o = [i(9567)],
                r = function(t) {
                    !function(t) {
                        var e, i, o, r, a, n, s = {
                            loadingNotice: "Loading image",
                            errorNotice: "The image could not be loaded",
                            errorDuration: 2500,
                            linkAttribute: "href",
                            preventClicks: !0,
                            beforeShow: t.noop,
                            beforeHide: t.noop,
                            onShow: t.noop,
                            onHide: t.noop,
                            onMove: t.noop
                        };
                        function c(e, i) {
                            this.$target = t(e),
                            this.opts = t.extend({}, s, i, this.$target.data()),
                            void 0 === this.isOpen && this._init()
                        }
                        c.prototype._init = function() {
                            this.$link = this.$target.find("a"),
                            this.$image = this.$target.find("img"),
                            this.$flyout = t('<div class="easyzoom-flyout" />'),
                            this.$notice = t('<div class="easyzoom-notice" />'),
                            this.$target.on({
                                "mousemove.easyzoom touchmove.easyzoom": t.proxy(this._onMove, this),
                                "mouseleave.easyzoom touchend.easyzoom": t.proxy(this._onLeave, this),
                                "mouseenter.easyzoom touchstart.easyzoom": t.proxy(this._onEnter, this)
                            }),
                            this.opts.preventClicks && this.$target.on("click.easyzoom", (function(t) {
                                t.preventDefault()
                            }
                            ))
                        }
                        ,
                        c.prototype.show = function(t, a) {
                            var n = this;
                            if (!1 !== this.opts.beforeShow.call(this)) {
                                if (!this.isReady)
                                    return this._loadImage(this.$link.attr(this.opts.linkAttribute), (function() {
                                        !n.isMouseOver && a || n.show(t)
                                    }
                                    ));
                                this.$target.append(this.$flyout);
                                var s = this.$target.outerWidth()
                                  , c = this.$target.outerHeight()
                                  , l = this.$flyout.width()
                                  , u = this.$flyout.height()
                                  , d = this.$zoom.width()
                                  , h = this.$zoom.height();
                                e = Math.ceil(d - l),
                                i = Math.ceil(h - u),
                                o = (e = e < 0 ? 0 : e) / s,
                                r = (i = i < 0 ? 0 : i) / c,
                                this.isOpen = !0,
                                this.opts.onShow.call(this),
                                t && this._move(t)
                            }
                        }
                        ,
                        c.prototype._onEnter = function(t) {
                            var e = t.originalEvent.touches;
                            this.isMouseOver = !0,
                            e && 1 != e.length || (t.preventDefault(),
                            this.show(t, !0))
                        }
                        ,
                        c.prototype._onMove = function(t) {
                            this.isOpen && (t.preventDefault(),
                            this._move(t))
                        }
                        ,
                        c.prototype._onLeave = function() {
                            this.isMouseOver = !1,
                            this.isOpen && this.hide()
                        }
                        ,
                        c.prototype._onLoad = function(t) {
                            t.currentTarget.width && (this.isReady = !0,
                            this.$notice.detach(),
                            this.$flyout.html(this.$zoom),
                            this.$target.removeClass("is-loading").addClass("is-ready"),
                            t.data.call && t.data())
                        }
                        ,
                        c.prototype._onError = function() {
                            var t = this;
                            this.$notice.text(this.opts.errorNotice),
                            this.$target.removeClass("is-loading").addClass("is-error"),
                            this.detachNotice = setTimeout((function() {
                                t.$notice.detach(),
                                t.detachNotice = null
                            }
                            ), this.opts.errorDuration)
                        }
                        ,
                        c.prototype._loadImage = function(e, i) {
                            var o = new Image;
                            this.$target.addClass("is-loading").append(this.$notice.text(this.opts.loadingNotice)),
                            this.$zoom = t(o).on("error", t.proxy(this._onError, this)).on("load", i, t.proxy(this._onLoad, this)),
                            o.style.position = "absolute",
                            o.src = e
                        }
                        ,
                        c.prototype._move = function(t) {
                            n = 0 === t.type.indexOf("touch") ? (s = t.touches || t.originalEvent.touches,
                            a = s[0].pageX,
                            s[0].pageY) : (a = t.pageX || a,
                            t.pageY || n);
                            var s = this.$target.offset();
                            t = a - s.left,
                            s = n - s.top,
                            t = Math.ceil(t * o),
                            s = Math.ceil(s * r),
                            t < 0 || s < 0 || e < t || i < s ? this.hide() : (s *= -1,
                            t *= -1,
                            "transform"in document.body.style ? this.$zoom.css({
                                transform: "translate(" + t + "px, " + s + "px)"
                            }) : this.$zoom.css({
                                top: s,
                                left: t
                            }),
                            this.opts.onMove.call(this, s, t))
                        }
                        ,
                        c.prototype.hide = function() {
                            this.isOpen && !1 !== this.opts.beforeHide.call(this) && (this.$flyout.detach(),
                            this.isOpen = !1,
                            this.opts.onHide.call(this))
                        }
                        ,
                        c.prototype.swap = function(e, i, o) {
                            this.hide(),
                            this.isReady = !1,
                            this.detachNotice && clearTimeout(this.detachNotice),
                            this.$notice.parent().length && this.$notice.detach(),
                            this.$target.removeClass("is-loading is-ready is-error"),
                            this.$image.attr({
                                src: e,
                                srcset: t.isArray(o) ? o.join() : o
                            }),
                            this.$link.attr(this.opts.linkAttribute, i)
                        }
                        ,
                        c.prototype.teardown = function() {
                            this.hide(),
                            this.$target.off(".easyzoom").removeClass("is-loading is-ready is-error"),
                            this.detachNotice && clearTimeout(this.detachNotice),
                            delete this.$link,
                            delete this.$zoom,
                            delete this.$image,
                            delete this.$notice,
                            delete this.$flyout,
                            delete this.isOpen,
                            delete this.isReady
                        }
                        ,
                        t.fn.easyZoom = function(e) {
                            return this.each((function() {
                                var i = t.data(this, "easyZoom");
                                i ? void 0 === i.isOpen && i._init() : t.data(this, "easyZoom", new c(this,e))
                            }
                            ))
                        }
                    }(t)
                }
                .apply(e, o),
                void 0 === r || (t.exports = r)
            }()
        },
        9567: function(t) {
            "use strict";
            t.exports = window.jQuery
        }
    }, a = {};
    function n(t) {
        var e = a[t];
        if (void 0 !== e)
            return e.exports;
        var i = a[t] = {
            exports: {}
        };
        return r[t].call(i.exports, i, i.exports, n),
        i.exports
    }
    n.m = r,
    e = Object.getPrototypeOf ? function(t) {
        return Object.getPrototypeOf(t)
    }
    : function(t) {
        return t.__proto__
    }
    ,
    n.t = function(i, o) {
        if (1 & o && (i = this(i)),
        8 & o)
            return i;
        if ("object" == typeof i && i) {
            if (4 & o && i.__esModule)
                return i;
            if (16 & o && "function" == typeof i.then)
                return i
        }
        var r = Object.create(null);
        n.r(r);
        var a = {};
        t = t || [null, e({}), e([]), e(e)];
        for (var s = 2 & o && i; "object" == typeof s && !~t.indexOf(s); s = e(s))
            Object.getOwnPropertyNames(s).forEach((function(t) {
                a[t] = function() {
                    return i[t]
                }
            }
            ));
        return a.default = function() {
            return i
        }
        ,
        n.d(r, a),
        r
    }
    ,
    n.d = function(t, e) {
        for (var i in e)
            n.o(e, i) && !n.o(t, i) && Object.defineProperty(t, i, {
                enumerable: !0,
                get: e[i]
            })
    }
    ,
    n.f = {},
    n.e = function(t) {
        return Promise.all(Object.keys(n.f).reduce((function(e, i) {
            return n.f[i](t, e),
            e
        }
        ), []))
    }
    ,
    n.u = function(t) {
        return "js/chunk.popups.js"
    }
    ,
    n.miniCssF = function(t) {}
    ,
    n.o = function(t, e) {
        return Object.prototype.hasOwnProperty.call(t, e)
    }
    ,
    i = {},
    o = "flatsome:",
    n.l = function(t, e, r, a) {
        if (i[t])
            i[t].push(e);
        else {
            var s, c;
            if (void 0 !== r)
                for (var l = document.getElementsByTagName("script"), u = 0; u < l.length; u++) {
                    var d = l[u];
                    if (d.getAttribute("src") == t || d.getAttribute("data-webpack") == o + r) {
                        s = d;
                        break
                    }
                }
            s || (c = !0,
            (s = document.createElement("script")).charset = "utf-8",
            s.timeout = 120,
            n.nc && s.setAttribute("nonce", n.nc),
            s.setAttribute("data-webpack", o + r),
            s.src = t),
            i[t] = [e];
            var h = function(e, o) {
                s.onerror = s.onload = null,
                clearTimeout(m);
                var r = i[t];
                if (delete i[t],
                s.parentNode && s.parentNode.removeChild(s),
                r && r.forEach((function(t) {
                    return t(o)
                }
                )),
                e)
                    return e(o)
            }
              , m = setTimeout(h.bind(null, void 0, {
                type: "timeout",
                target: s
            }), 12e4);
            s.onerror = h.bind(null, s.onerror),
            s.onload = h.bind(null, s.onload),
            c && document.head.appendChild(s)
        }
    }
    ,
    n.r = function(t) {
        "undefined" != typeof Symbol && Symbol.toStringTag && Object.defineProperty(t, Symbol.toStringTag, {
            value: "Module"
        }),
        Object.defineProperty(t, "__esModule", {
            value: !0
        })
    }
    ,
    function() {
        const t = n.u;
        n.u = e => {
            const i = t(e)
              , o = globalThis.flatsomeVars?.theme.version;
            return i + (o ? "?ver=" + o : "")
        }
    }(),
    n.p = globalThis.flatsomeVars?.assets_url ?? "/",
    function() {
        var t = {
            960: 0
        };
        n.f.j = function(e, i) {
            var o = n.o(t, e) ? t[e] : void 0;
            if (0 !== o)
                if (o)
                    i.push(o[2]);
                else {
                    var r = new Promise((function(i, r) {
                        o = t[e] = [i, r]
                    }
                    ));
                    i.push(o[2] = r);
                    var a = n.p + n.u(e)
                      , s = new Error;
                    n.l(a, (function(i) {
                        if (n.o(t, e) && (0 !== (o = t[e]) && (t[e] = void 0),
                        o)) {
                            var r = i && ("load" === i.type ? "missing" : i.type)
                              , a = i && i.target && i.target.src;
                            s.message = "Loading chunk " + e + " failed.\n(" + r + ": " + a + ")",
                            s.name = "ChunkLoadError",
                            s.type = r,
                            s.request = a,
                            o[1](s)
                        }
                    }
                    ), "chunk-" + e, e)
                }
        }
        ;
        var e = function(e, i) {
            var o, r, a = i[0], s = i[1], c = i[2], l = 0;
            if (a.some((function(e) {
                return 0 !== t[e]
            }
            ))) {
                for (o in s)
                    n.o(s, o) && (n.m[o] = s[o]);
                c && c(n)
            }
            for (e && e(i); l < a.length; l++)
                r = a[l],
                n.o(t, r) && t[r] && t[r][0](),
                t[r] = 0
        }
          , i = self.flatsomeChunks = self.flatsomeChunks || [];
        i.forEach(e.bind(null, 0)),
        i.push = e.bind(null, i.push.bind(i))
    }(),
    function() {
        "use strict";
        n(4168),
        n(6619),
        n(9222),
        n(634);
        const t = window.matchMedia("(prefers-reduced-motion: reduce)");
        let e = !1;
        function i() {
            e = "undefined" == typeof UxBuilder && t.matches
        }
        function o() {
            return jQuery.fn.magnificPopup ? Promise.resolve() : n.e(964).then(n.t.bind(n, 4343, 23))
        }
        i(),
        t.addEventListener?.("change", i),
        jQuery.loadMagnificPopup = o,
        jQuery.fn.lazyMagnificPopup = function(t) {
            const e = jQuery(this)
              , i = t.delegate ? e.find(t.delegate) : e;
            return i.one("click", (r => {
                r.preventDefault(),
                o().then(( () => {
                    e.data("magnificPopup") || e.magnificPopup(t),
                    e.magnificPopup("open", i.index(r.currentTarget) || 0)
                }
                ))
            }
            )),
            e
        }
        ,
        Flatsome.behavior("quick-view", {
            attach: function(t) {
                "uxBuilder" !== jQuery("html").attr("ng-app") && jQuery(".quick-view", t).each((function(t, i) {
                    jQuery(i).hasClass("quick-view-added") || (jQuery(i).on("click", (function(t) {
                        if ("" != jQuery(this).attr("data-prod")) {
                            jQuery(this).parent().parent().addClass("processing");
                            var r = {
                                action: "flatsome_quickview",
                                product: jQuery(this).attr("data-prod")
                            };
                            jQuery.post(flatsomeVars.ajaxurl, r, (function(t) {
                                o().then(( () => {
                                    jQuery(".processing").removeClass("processing"),
                                    jQuery.magnificPopup.open({
                                        removalDelay: 300,
                                        autoFocusLast: !1,
                                        closeMarkup: flatsomeVars.lightbox.close_markup,
                                        closeBtnInside: flatsomeVars.lightbox.close_btn_inside,
                                        items: {
                                            src: '<div class="product-lightbox lightbox-content">' + t + "</div>",
                                            type: "inline"
                                        },
                                        callbacks: {
                                            afterClose: () => {
                                                jQuery(i).closest(".box").find(".box-text a:first").trigger("focus")
                                            }
                                        }
                                    }),
                                    setTimeout((function() {
                                        const t = jQuery(".product-lightbox");
                                        t.imagesLoaded((function() {
                                            const t = {
                                                cellAlign: "left",
                                                wrapAround: !0,
                                                autoPlay: !1,
                                                prevNextButtons: !0,
                                                adaptiveHeight: !0,
                                                imagesLoaded: !0,
                                                dragThreshold: 15,
                                                rightToLeft: flatsomeVars.rtl
                                            };
                                            e && (t.friction = 1,
                                            t.selectedAttraction = 1),
                                            jQuery(".product-lightbox .slider").lazyFlickity(t)
                                        }
                                        )),
                                        Flatsome.attach("tooltips", t)
                                    }
                                    ), 300);
                                    let o = jQuery(".product-lightbox form.variations_form");
                                    jQuery(".product-lightbox form").hasClass("variations_form") && o.wc_variation_form();
                                    let r = jQuery(".product-lightbox .product-gallery-slider")
                                      , a = jQuery(".product-lightbox .product-gallery-slider .slide.first img")
                                      , n = jQuery(".product-lightbox .product-gallery-slider .slide.first a")
                                      , s = a.attr("data-src") ? a.attr("data-src") : a.attr("src");
                                    const c = jQuery.Deferred();
                                    r.one("flatsome-flickity-ready", ( () => c.resolve()));
                                    let l = function() {
                                        r.data("flickity") && r.flickity("select", 0)
                                    }
                                      , u = function() {
                                        r.data("flickity") && r.imagesLoaded((function() {
                                            r.flickity("resize")
                                        }
                                        ))
                                    };
                                    jQuery.when(c).done(( () => {
                                        o.on("hide_variation", (function(t, e) {
                                            a.attr("src", s).attr("srcset", ""),
                                            u()
                                        }
                                        )),
                                        o.on("click", ".reset_variations", (function() {
                                            a.attr("src", s).attr("srcset", ""),
                                            l(),
                                            u()
                                        }
                                        ))
                                    }
                                    )),
                                    o.on("show_variation", (function(t, e) {
                                        jQuery.when(c).done(( () => {
                                            e.image.src ? (a.attr("src", e.image.src).attr("srcset", ""),
                                            n.attr("href", e.image_link),
                                            l(),
                                            u()) : e.image_src && (a.attr("src", e.image_src).attr("srcset", ""),
                                            n.attr("href", e.image_link),
                                            l(),
                                            u())
                                        }
                                        ))
                                    }
                                    )),
                                    jQuery(".product-lightbox .quantity").addQty()
                                }
                                ))
                            }
                            )),
                            t.preventDefault()
                        }
                    }
                    )),
                    jQuery(i).addClass("quick-view-added"))
                }
                ))
            }
        }),
        document.documentElement.style,
        window.getComputedStyle(document.documentElement)["scroll-behavior"];
        var r = !1;
        const a = /Android|webOS|iPhone|iPad|iPod|BlackBerry/i.test(navigator.userAgent);
        function s(t) {
            if (jQuery(".cart-item .nav-dropdown").length)
                jQuery(".cart-item").addClass("current-dropdown cart-active"),
                jQuery(".shop-container").on("click", (function() {
                    jQuery(".cart-item").removeClass("current-dropdown cart-active")
                }
                )),
                jQuery(".cart-item").hover((function() {
                    jQuery(".cart-active").removeClass("cart-active")
                }
                )),
                setTimeout((function() {
                    jQuery(".cart-active").removeClass("current-dropdown")
                }
                ), t);
            else {
                let t = 0;
                jQuery.fn.magnificPopup && (t = jQuery.magnificPopup.open ? 300 : 0,
                t && jQuery.magnificPopup.close()),
                setTimeout((function() {
                    jQuery(".cart-item .off-canvas-toggle").trigger("click")
                }
                ), t)
            }
        }
        jQuery(document).on("flatsome-product-gallery-tools-init", ( () => {
            a || (r = jQuery(".has-image-zoom .slide").easyZoom({
                loadingNotice: "",
                preventClicks: !1
            })),
            jQuery(".zoom-button").off("click.flatsome").on("click.flatsome", (function(t) {
                jQuery(".product-gallery-slider").find(".is-selected a").trigger("click"),
                t.preventDefault()
            }
            )),
            jQuery(".has-lightbox .product-gallery-slider").each((function() {
                jQuery(this).lazyMagnificPopup({
                    delegate: "a",
                    type: "image",
                    tLoading: '<div class="loading-spin centered dark"></div>',
                    closeMarkup: flatsomeVars.lightbox.close_markup,
                    closeBtnInside: flatsomeVars.lightbox.close_btn_inside,
                    gallery: {
                        enabled: !0,
                        navigateByImgClick: !0,
                        preload: [0, 1],
                        arrowMarkup: '<button class="mfp-arrow mfp-arrow-%dir%" title="%title%"><i class="icon-angle-%dir%"></i></button>'
                    },
                    image: {
                        tError: '<a href="%url%">The image #%curr%</a> could not be loaded.',
                        verticalFit: !1
                    }
                })
            }
            ))
        }
        )),
        jQuery("table.my_account_orders").wrap('<div class="touch-scroll-table"/>'),
        jQuery((function(t) {
            if (!document.body.classList.contains("single-product"))
                return;
            const e = window.location.hash
              , i = window.location.href;
            function o() {
                !function() {
                    const e = t(".reviews_tab")
                      , i = e.length ? e : t("#reviews").closest(".accordion-item");
                    i.length && i.find("a:not(.active):first").trigger("click")
                }(),
                setTimeout(( () => {
                    t.scrollTo("#reviews", {
                        offset: -window.flatsomeVars.scrollPaddingTop - 15
                    })
                }
                ), 500)
            }
            (e.toLowerCase().indexOf("comment-") >= 0 || "#comments" === e || "#reviews" === e || "#tab-reviews" === e || i.indexOf("comment-page-") > 0 || i.indexOf("cpage=") > 0) && o(),
            t("a.woocommerce-review-link").on("click", (function(t) {
                t.preventDefault(),
                history.pushState(null, null, "#reviews"),
                o()
            }
            ))
        }
        )),
        jQuery(".single_add_to_cart_button").on("click", (function() {
            let t = jQuery(this)
              , e = t.closest("form.cart");
            e ? e.on("submit", (function() {
                t.addClass("loading")
            }
            )) : t.hasClass("disabled") || t.addClass("loading"),
            jQuery(window).on("pageshow", ( () => {
                t.removeClass("loading")
            }
            ))
        }
        )),
        jQuery((function(t) {
            const e = t(".product-thumbnails .first img").attr("data-src") ? t(".product-thumbnails .first img").attr("data-src") : t(".product-thumbnails .first img").attr("src")
              , i = t("form.variations_form")
              , o = t(".product-gallery-slider")
              , n = t(".product-thumbnails");
            let s = null;
            const c = t.Deferred()
              , l = t.Deferred();
            o.one("flatsome-flickity-ready", ( () => c.resolve())),
            n.one("flatsome-flickity-ready", ( () => l.resolve())),
            n.length && !n.is(":hidden") || l.resolve();
            const u = function() {
                r && r.length && (s = r.filter(".has-image-zoom .slide.first").data("easyZoom"),
                s.swap(t(".has-image-zoom .slide.first img").attr("src"), t(".has-image-zoom .slide.first img").attr("data-large_image")))
            }
              , d = function() {
                o.data("flickity") && o.flickity("select", 0)
            }
              , h = function() {
                o.data("flickity") && o.imagesLoaded((function() {
                    o.flickity("resize")
                }
                ))
            };
            t.when(c).then(( () => {
                t(document).trigger("flatsome-product-gallery-tools-init")
            }
            ));
            const m = t.when(c, l).then(( () => {
                a && h(),
                i.on("hide_variation", (function(i, o) {
                    t(".product-thumbnails .first img, .sticky-add-to-cart-img").attr("src", e),
                    h()
                }
                )),
                i.on("click", ".reset_variations", (function() {
                    t(".product-thumbnails .first img, .sticky-add-to-cart-img").attr("src", e),
                    d(),
                    u(),
                    h()
                }
                ))
            }
            ));
            i.on("show_variation", (function(i, o) {
                t.when(m).done(( () => {
                    o.hasOwnProperty("image") && o.image.thumb_src ? (t(".product-gallery-slider-old .slide.first img, .sticky-add-to-cart-img, .product-thumbnails .first img, .product-gallery-slider .slide.first .zoomImg").attr("src", o.image.thumb_src).attr("srcset", ""),
                    d(),
                    u(),
                    h()) : (t(".product-thumbnails .first img").attr("src", e),
                    h())
                }
                ))
            }
            ))
        }
        )),
        flatsomeVars.is_mini_cart_reveal && (jQuery("body").on("added_to_cart", (function() {
            s("5000");
            const t = jQuery("#header")
              , e = t.hasClass("has-sticky")
              , i = jQuery(".header-wrapper", t);
            e && jQuery(".cart-item.has-dropdown").length && t.hasClass("sticky-hide-on-scroll--active") && (i.addClass("stuck"),
            t.removeClass("sticky-hide-on-scroll--active"))
        }
        )),
        jQuery(document).ready((function() {
            jQuery("span.added-to-cart").length && s("5000")
        }
        ))),
        jQuery(document.body).on("updated_cart_totals", (function() {
            jQuery(document).trigger("yith_wcwl_reload_fragments");
            const t = jQuery(".cart-wrapper");
            Flatsome.attach("lazy-load-images", t),
            Flatsome.attach("quick-view", t),
            Flatsome.attach("wishlist", t),
            Flatsome.attach("cart-refresh", t),
            Flatsome.attach("equalize-box", t)
        }
        )),
        jQuery(document).ajaxComplete((function() {
            Flatsome.attach("add-qty", jQuery(".quantity").parent()),
            Flatsome.attach("lightboxes-link", jQuery(".woocommerce-checkout .woocommerce-terms-and-conditions-wrapper"))
        }
        )),
        jQuery(document.body).on("wc_fragments_refreshed wc_fragments_loaded", (function() {
            Flatsome.attach("add-qty", jQuery(".quantity").parent())
        }
        )),
        jQuery(document.body).on("updated_checkout", (function() {
            Flatsome.attach("lightboxes-link", jQuery(".woocommerce-checkout .woocommerce-terms-and-conditions-wrapper"))
        }
        )),
        jQuery(document).on("yith_infs_adding_elem", (function(t) {
            Flatsome.attach(jQuery(".shop-container"))
        }
        )),
        jQuery(".disable-lightbox a").on("click", (function(t) {
            t.preventDefault()
        }
        )),
        jQuery(document).ready((function() {
            if (!jQuery(".custom-product-page").length)
                return;
            const t = jQuery("#respond p.stars");
            if (t.length > 1) {
                let e = t[0].outerHTML;
                t.remove(),
                jQuery('select[id="rating"]').hide().before(e)
            }
        }
        ));
        const c = function(t) {
            return new IntersectionObserver((function(e) {
                for (let i = 0; i < e.length; i++)
                    t(e[i])
            }
            ),{
                rootMargin: "0px",
                threshold: .1,
                ...arguments.length > 1 && void 0 !== arguments[1] ? arguments[1] : {}
            })
        }((t => {
            const {top: e} = t.boundingClientRect
              , i = t.intersectionRatio <= 0 && e <= 0
              , o = jQuery(t.target)
              , r = o.find(".sticky-add-to-cart");
            o.css({
                height: i ? o.outerHeight() : ""
            }),
            r.toggleClass("sticky-add-to-cart--active", i),
            jQuery("body").toggleClass("has-sticky-product-cart", i)
        }
        ), {
            threshold: 0
        });
        jQuery(".sticky-add-to-cart-wrapper").each(( (t, e) => {
            c.observe(e)
        }
        )),
        setTimeout((function() {
            jQuery(document.body).on("country_to_state_changed", (function() {
                "undefined" != typeof floatlabels && floatlabels.rebuild()
            }
            ))
        }
        ), 500),
        jQuery((function(t) {
            t.scroll_to_notices = function(e) {
                t.scrollTo(e)
            }
        }
        ))
    }()
}();
