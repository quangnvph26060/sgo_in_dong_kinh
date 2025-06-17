    <section class="section pb-sm-0" id="section_1732474278">
        <div class="bg section-bg fill bg-fill bg-loaded bg-loaded">
            <div class="is-border" style="border-color:rgb(245, 245, 245);border-width:1px 0px 0px 0px;"></div>
        </div>
        <div class="section-content relative">
            <div class="row row-small" id="row-1447570300">
                <div id="col-929872000" class="col medium-4 small-12 large-4">
                    <div class="col-inner">
                        <div class="icon-box featured-box align-middle icon-box-left text-left">
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
                                    <a class="ux-menu-link__link flex" href="{{ route('products.detail', [$topProduct->category->slug, $topProduct->slug]) }}">
                                        <span class="ux-menu-link__text">
                                            {{ $topProduct->short_name }}
                                        </span>
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div id="col-976516526" class="col box-link-footer medium-2 small-6 large-2">
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
                        <div id="text-3122576191" class="text p-mb-half">{!! $setting->working_time !!}</div>
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
                    </div>
                </div>
            </div>
        </div>
        <style>
            /* #section_1732474278 {
                padding-top: 50px;
                padding-bottom: 50px
            } */
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
