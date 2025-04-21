    <section class="section pb-sm-0" id="section_1732474278">
        <div class="bg section-bg fill bg-fill bg-loaded bg-loaded">
            <div class="is-border" style="border-color:rgb(245, 245, 245);border-width:1px 0px 0px 0px;"></div>
        </div>
        <div class="section-content relative">
            <div class="row row-small" id="row-1447570300">
                <div id="col-929872000" class="col medium-4 small-12 large-4">
                    <div class="col-inner">
                        <div class="icon-box featured-box align-middle icon-box-left text-left">
                            <div class="icon-box-img" style="width: 87px">
                                <div class="icon">
                                    <div class="icon-inner"><img data-lazyloaded="1"
                                            src="https://inhoalong.vn/wp-content/uploads/2024/04/logo-cong-ty-in-hoa-long.jpg"
                                            width="100" height="100"
                                            data-src="https://inhoalong.vn/wp-content/uploads/2024/04/logo-cong-ty-in-hoa-long.jpg"
                                            class="attachment-medium size-medium entered litespeed-loaded"
                                            alt="Logo Công ty in ấn Hoa Long" decoding="async"
                                            data-ll-status="loaded"><noscript><img width="100" height="100"
                                                src="https://inhoalong.vn/wp-content/uploads/2024/04/logo-cong-ty-in-hoa-long.jpg"
                                                class="attachment-medium size-medium" alt="Logo Công ty in ấn Hoa Long"
                                                decoding="async" /></noscript></div>
                                </div>
                            </div>
                            <div class="icon-box-text last-reset">
                                <div id="text-1815218023" class="text">
                                    <h3>
                                        {{ $setting->company }}
                                    </h3>
                                    <style>
                                        #text-1815218023 {
                                            color: #1596e2
                                        }

                                        #text-1815218023>* {
                                            color: #1596e2
                                        }
                                    </style>
                                </div>
                            </div>
                        </div>
                        <div id="gap-999853103" class="gap-element clearfix hide-for-medium"
                            style="display:block; height:auto;">
                            <style>
                                #gap-999853103 {
                                    padding-top: 30px
                                }
                            </style>
                        </div>
                        <div id="text-4050542790" class="text">
                            <p><strong>Văn phòng giao dịch</strong>: {{ $setting->address }}</p>
                            <p><strong>Website</strong>: {{ $setting->website }}</p>
                            <p><strong>Hotline:</strong> {{ $setting->phone }}</p>
                            <p><strong>Email:</strong> {{ $setting->email }}</p>

                            <style>
                                #text-4050542790 {
                                    color: rgb(0, 0, 0)
                                }

                                #text-4050542790>* {
                                    color: rgb(0, 0, 0)
                                }
                            </style>
                        </div>
                    </div>
                </div>
                <div id="col-686376698" class="col box-link-footer medium-3 small-6 large-3">
                    <div class="col-inner">
                        <div id="text-289136863" class="text">
                            <p><strong>Top Sản phẩm in ấn</strong></p>
                            <style>
                                #text-289136863 {
                                    color: rgb(0, 0, 0)
                                }

                                #text-289136863>* {
                                    color: rgb(0, 0, 0)
                                }
                            </style>
                        </div>
                        <div class="ux-menu stack stack-col justify-start">
                            @foreach ($topProducts->take(6) as $topProduct)
                                <div class="ux-menu-link flex menu-item">
                                    <a class="ux-menu-link__link flex" href="https://inhoalong.vn/in-tem-nhan-decal/">
                                        <span class="ux-menu-link__text">
                                            {{ $topProduct->short_name }}
                                        </span>
                                    </a>
                                </div>
                            @endforeach
                        </div>

                        <div class="social-icons follow-icons hide-for-small"><a
                                href="https://www.facebook.com/inhoalong.vn/" target="_blank"
                                rel="noopener noreferrer nofollow" data-label="Facebook"
                                class="icon primary button circle facebook tooltip" title="Follow on Facebook"
                                aria-label="Follow on Facebook"><i class="icon-facebook"></i></a><a
                                href="https://www.instagram.com/inhoalongvn/" target="_blank"
                                rel="noopener noreferrer nofollow" data-label="Instagram"
                                class="icon primary button circle instagram tooltip tooltipstered"
                                aria-label="Follow on Instagram"><i class="icon-instagram"></i></a><a
                                href="https://twitter.com/inhoalongvn" data-label="Twitter" target="_blank"
                                rel="noopener noreferrer nofollow"
                                class="icon primary button circle twitter tooltip tooltipstered"
                                aria-label="Follow on Twitter"><i class="icon-twitter"></i></a><a
                                href="https://www.pinterest.com/inhoalong/" data-label="Pinterest" target="_blank"
                                rel="noopener noreferrer nofollow"
                                class="icon primary button circle pinterest tooltip tooltipstered"
                                aria-label="Follow on Pinterest"><i class="icon-pinterest"></i></a><a
                                href="https://www.youtube.com/@inhoalong" data-label="YouTube" target="_blank"
                                rel="noopener noreferrer nofollow"
                                class="icon primary button circle youtube tooltip tooltipstered"
                                aria-label="Follow on YouTube"><i class="icon-youtube"></i></a></div>
                    </div>
                </div>
                <div id="col-976516526" class="col box-link-footer medium-2 small-6 large-2">
                    <div class="col-inner">
                        <div id="text-3127782211" class="text">
                            <p><strong>Ấn phẩm Tết</strong></p>
                            <style>
                                #text-3127782211 {
                                    color: rgb(0, 0, 0)
                                }

                                #text-3127782211>* {
                                    color: rgb(0, 0, 0)
                                }
                            </style>
                        </div>
                        <div class="ux-menu stack stack-col justify-start">
                            @foreach ($tetProducts as $tetProduct)
                                <div class="ux-menu-link flex menu-item">
                                    <a class="ux-menu-link__link flex"
                                        href="{{ route('products.detail', [$tetProduct->category->slug, $tetProduct->slug]) }}">
                                        <span class="ux-menu-link__text">{{ $tetProduct->short_name }}
                                        </span>
                                    </a>
                                </div>
                            @endforeach

                        </div>
                        <p><a href="http://online.gov.vn/Home/WebDetails/123711" rel="nofollow"><img data-lazyloaded="1"
                                    src="https://inhoalong.vn/wp-content/uploads/2024/05/Logo-dang-ky-bo-cong-thuong-in-hoa-long.png"
                                    class="size-full wp-image-15797 entered litespeed-loaded"
                                    data-src="https://inhoalong.vn/wp-content/uploads/2024/05/Logo-dang-ky-bo-cong-thuong-in-hoa-long.png"
                                    alt="Đăng ký website với bộ công thương" width="121" height="45"
                                    data-ll-status="loaded"><noscript><img class="size-full wp-image-15797"
                                        src="https://inhoalong.vn/wp-content/uploads/2024/05/Logo-dang-ky-bo-cong-thuong-in-hoa-long.png"
                                        alt="Đăng ký website với bộ công thương" width="121"
                                        height="45" /></noscript></a></p>
                        <div id="text-2240402811" class="text hide-for-small"><a class="dmca-badge"
                                href="//www.dmca.com/Protection/Status.aspx?ID=d6932113-0a8f-410e-9b6a-442f1e5e963b"
                                rel="nofollow"><img data-lazyloaded="1"
                                    src="https://images.dmca.com/Badges/dmca_protected_17_120.png?ID=d6932113-0a8f-410e-9b6a-442f1e5e963b"
                                    class="alignnone entered litespeed-loaded"
                                    data-src="https://images.dmca.com/Badges/dmca_protected_17_120.png?ID=d6932113-0a8f-410e-9b6a-442f1e5e963b"
                                    alt="Bản quyền bài viết thuộc về In Hoa Long được xác thực bởi DMCA.com Protection Status"
                                    width="121" height="39" data-ll-status="loaded"><noscript><img
                                        class="alignnone"
                                        src="https://images.dmca.com/Badges/dmca_protected_17_120.png?ID=d6932113-0a8f-410e-9b6a-442f1e5e963b"
                                        alt="Bản quyền bài viết thuộc về In Hoa Long được xác thực bởi DMCA.com Protection Status"
                                        width="121" height="39" /></noscript></a></div>
                    </div>
                </div>
                <div id="col-972248304" class="col box-link-footer medium-3 small-6 large-3">
                    <div class="col-inner">
                        <div id="text-1062116691" class="text"><strong>Chính sách và hỗ trợ</strong>
                            <style>
                                #text-1062116691 {
                                    color: rgb(0, 0, 0)
                                }

                                #text-1062116691>* {
                                    color: rgb(0, 0, 0)
                                }
                            </style>
                        </div>
                        <div class="ux-menu stack stack-col justify-start">

                            @foreach ($policyPosts as $policyPost)
                                <div class="ux-menu-link flex menu-item"><a class="ux-menu-link__link flex"
                                        href="#" rel="nofollow"><span class="ux-menu-link__text">-
                                            {{ $policyPost->subject }}</span></a></div>
                            @endforeach
                        </div>
                        <div id="gap-1338488655" class="gap-element clearfix" style="display:block; height:auto;">
                            <style>
                                #gap-1338488655 {
                                    padding-top: 15px
                                }
                            </style>
                        </div>
                        <div id="text-2092391113" class="text hide-for-small"><strong>Làm việc</strong>
                            <style>
                                #text-2092391113 {
                                    color: rgb(0, 0, 0)
                                }

                                #text-2092391113>* {
                                    color: rgb(0, 0, 0)
                                }
                            </style>
                        </div>
                        <div id="text-3676758643" class="text p-mb-half hide-for-small">{{ $setting->working_time }}
                        </div>
                    </div>
                </div>
                <div id="col-941442331" class="col show-for-small medium-4 small-6 large-4">
                    <div class="col-inner">
                        <div id="text-2730485257" class="text"><strong>Làm việc</strong>
                            <style>
                                #text-2730485257 {
                                    color: rgb(0, 0, 0)
                                }

                                #text-2730485257>* {
                                    color: rgb(0, 0, 0)
                                }
                            </style>
                        </div>
                        <div id="text-3122576191" class="text p-mb-half">Thứ 2 đến T7
                            Sáng từ: 8h00 - 12h00
                            Chiều từ: 13h00 - 17h00
                            (Nghỉ Chủ nhật)</div>
                        <div id="gap-545165213" class="gap-element clearfix" style="display:block; height:auto;">
                            <style>
                                #gap-545165213 {
                                    padding-top: 15px
                                }

                                @media (min-width:550px) {
                                    #gap-545165213 {
                                        padding-top: 30px
                                    }
                                }
                            </style>
                        </div>
                        <p><a class="dmca-badge"
                                href="//www.dmca.com/Protection/Status.aspx?ID=d6932113-0a8f-410e-9b6a-442f1e5e963b"
                                rel="nofollow"><img data-lazyloaded="1"
                                    src="data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSIxMjEiIGhlaWdodD0iMzkiIHZpZXdCb3g9IjAgMCAxMjEgMzkiPjxyZWN0IHdpZHRoPSIxMDAlIiBoZWlnaHQ9IjEwMCUiIHN0eWxlPSJmaWxsOiNjZmQ0ZGI7ZmlsbC1vcGFjaXR5OiAwLjE7Ii8+PC9zdmc+"
                                    class="alignnone"
                                    data-src="https://images.dmca.com/Badges/dmca_protected_17_120.png?ID=d6932113-0a8f-410e-9b6a-442f1e5e963b"
                                    alt="Bản quyền bài viết thuộc về In Hoa Long được xác thực bởi DMCA.com Protection Status"
                                    width="121" height="39"><noscript><img class="alignnone"
                                        src="https://images.dmca.com/Badges/dmca_protected_17_120.png?ID=d6932113-0a8f-410e-9b6a-442f1e5e963b"
                                        alt="Bản quyền bài viết thuộc về In Hoa Long được xác thực bởi DMCA.com Protection Status"
                                        width="121" height="39" /></noscript></a></p>
                    </div>
                </div>
            </div>
        </div>
        <style>
            #section_1732474278 {
                padding-top: 50px;
                padding-bottom: 50px
            }
        </style>
    </section>
    <section class="section box-fixed" id="section_2108972034">
        <div class="bg section-bg fill bg-fill bg-loaded bg-loaded"></div>
        <div class="section-content relative">
            <div class="row align-middle align-center" id="row-128073130">
                <div id="col-1944623293" class="col pb-0 medium-4 small-12 large-4">
                    <div class="col-inner">
                        <div class="icon-box featured-box icon-box-left text-left">
                            <div class="icon-box-img" style="width: 24px">
                                <div class="icon">
                                    <div class="icon-inner"></div>
                                </div>
                            </div>
                            <div class="icon-box-text last-reset">
                                <div id="text-3516885906" class="text">TƯ VẤN 24/7 :&nbsp;{{ $setting->phone }}
                                    <style>
                                        #text-3516885906 {
                                            color: rgb(255, 255, 255)
                                        }

                                        #text-3516885906>* {
                                            color: rgb(255, 255, 255)
                                        }
                                    </style>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="col-427171683" class="col pb-0 medium-5 small-12 large-5">
                    <div class="col-inner">
                        <div class="wpcf7 js" id="wpcf7-f35-o3" lang="vi" dir="ltr" data-wpcf7-id="35">
                            <div class="screen-reader-response">
                                <p role="status" aria-live="polite" aria-atomic="true"></p>
                                <ul></ul>
                            </div>
                            <form action="/#wpcf7-f35-o3" method="post" class="wpcf7-form init"
                                aria-label="Form liên hệ" novalidate="novalidate" data-status="init">
                                <div style="display: none;"><input type="hidden" name="_wpcf7"
                                        value="35"><input type="hidden" name="_wpcf7_version"
                                        value="6.0"><input type="hidden" name="_wpcf7_locale"
                                        value="vi"><input type="hidden" name="_wpcf7_unit_tag"
                                        value="wpcf7-f35-o3"><input type="hidden" name="_wpcf7_container_post"
                                        value="0"><input type="hidden" name="_wpcf7_posted_data_hash"
                                        value=""></div>
                                <div class="form-group form-fixed"><span class="wpcf7-form-control-wrap"
                                        data-name="your-tel"><input size="40" maxlength="400"
                                            class="wpcf7-form-control wpcf7-tel wpcf7-validates-as-required wpcf7-text wpcf7-validates-as-tel"
                                            aria-required="true" aria-invalid="false" placeholder="Nhập sđt của bạn"
                                            value="" type="tel" name="your-tel"></span><input
                                        class="wpcf7-form-control wpcf7-submit has-spinner tc1" type="submit"
                                        value="Đăng ký tư vấn"><span class="wpcf7-spinner"></span></div>
                                <p style="display: none !important;" class="akismet-fields-container"
                                    data-prefix="_wpcf7_ak_"><label>Δ
                                        <textarea name="_wpcf7_ak_hp_textarea" cols="45" rows="8" maxlength="100"></textarea>
                                    </label><input type="hidden" id="ak_js_3" name="_wpcf7_ak_js"
                                        value="1744710231578">
                                    <script
                                        src="data:text/javascript;base64,ZG9jdW1lbnQuZ2V0RWxlbWVudEJ5SWQoImFrX2pzXzMiKS5zZXRBdHRyaWJ1dGUoInZhbHVlIiwobmV3IERhdGUoKSkuZ2V0VGltZSgpKQ=="
                                        defer=""></script>
                                </p>
                                <div class="wpcf7-response-output" aria-hidden="true"></div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <style>
            #section_2108972034 {
                padding-top: 12px;
                padding-bottom: 12px;
                background-color: rgb(21, 150, 226)
            }
        </style>
    </section>
    <div class="absolute-footer dark medium-text-center text-center">
        <div class="container clearfix">
            <div class="footer-primary pull-left">
                <div class="copyright-footer"> {{ $setting->copyright }}
                </div>
            </div>
        </div>
    </div>
