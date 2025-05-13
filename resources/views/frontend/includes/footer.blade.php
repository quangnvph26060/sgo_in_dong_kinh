    <section class="section pb-sm-0" id="section_1732474278">
        <div class="bg section-bg fill bg-fill bg-loaded bg-loaded">
            <div class="is-border" style="border-color:rgb(245, 245, 245);border-width:1px 0px 0px 0px;"></div>
        </div>
        <div class="section-content relative">
            <div class="row row-small" id="row-1447570300">
                <div id="col-929872000" class="col medium-4 small-12 large-4">
                    <div class="col-inner">
                        <div class="icon-box featured-box align-middle icon-box-left text-left">
                            {{-- <div class="icon-box-img" style="width: 87px">
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
                            </div> --}}
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
   
    <div class="absolute-footer dark medium-text-center text-center">
        <div class="container clearfix">
            <div class="footer-primary pull-left">
                <div class="copyright-footer"> {{ $setting->copyright }}
                </div>
            </div>
        </div>
    </div>
