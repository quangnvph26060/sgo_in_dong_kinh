@extends('frontend.master')

@section('title', $setting->title ?? $setting->seo_title)
@section('og:description', $setting->seo_description)
@section('description', $setting->seo_description)
@section('image', showImage($setting->logo))

@section('content')
    <div id="content" role="main" class="content-area">
        <section class="section" id="section_744202346">
            <div class="bg section-bg fill bg-fill bg-loaded bg-loaded"></div>
            <div class="section-content relative">
                <div class="row align-middle" id="row-329039277">
                    <div id="col-647663038" class="col small-12 large-12">
                        <div class="col-inner">
                            <div class="map-lien-he">
                                <p>
                                    <iframe data-lazyloaded="1" src="{{ extractIframeSrc($setting->map) }}"
                                        style="border: 0" title="" data-src="{{ extractIframeSrc($setting->map) }}"
                                        width="100%" height="500" allowfullscreen="allowfullscreen"
                                        data-ll-status="loaded" class="entered litespeed-loaded"></iframe><noscript><iframe
                                            style="border: 0" title="" src="{{ extractIframeSrc($setting->map) }}"
                                            width="100%" height="500"
                                            allowfullscreen="allowfullscreen"></iframe></noscript><br />
                                </p>
                            </div>
                        </div>
                    </div>
                    <div id="col-613875305" class="col medium-6 small-12 large-6">
                        <div class="col-inner">
                            @php
                                function vn_to_str($str)
                                {
                                    $str = mb_convert_case($str, MB_CASE_LOWER, 'UTF-8'); // để đồng bộ
                                    $unicode = [
                                        'a' => 'á|à|ả|ã|ạ|ă|ắ|ằ|ẳ|ẵ|ặ|â|ấ|ầ|ẩ|ẫ|ậ',
                                        'd' => 'đ',
                                        'e' => 'é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ',
                                        'i' => 'í|ì|ỉ|ĩ|ị',
                                        'o' => 'ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ',
                                        'u' => 'ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự',
                                        'y' => 'ý|ỳ|ỷ|ỹ|ỵ',
                                    ];
                                    foreach ($unicode as $nonUnicode => $uni) {
                                        $str = preg_replace("/($uni)/iu", $nonUnicode, $str);
                                    }
                                    return $str;
                                }

                                $no_diacritic = vn_to_str($setting->company); // Bỏ dấu
                                $snake = Str::snake($no_diacritic, '_'); // Chuyển sang snake_case
                                $result = strtoupper($snake); // In hoa
                            @endphp

                            <h2 class="widget-title">
                                <span class="ez-toc-section" id="{{ $result }}"
                                    ez-toc-data-id="#{{ $result }}"></span>
                                {{ $setting->company }}
                                <span class="ez-toc-section-end"></span>
                            </h2>


                            <div class="textwidget">
                                <p>
                                    Địa chỉ: {{ $setting->address }}
                                    <a href="https://www.google.com/maps/search/?api=1&query={{ urlencode($setting->address) }}"
                                        target="_blank" rel="noopener">
                                        Xem trên Google Maps
                                    </a>
                                </p>
                                <p>
                                    Điện thoại: {{ $setting->phone }}
                                </p>
                                <p>
                                    Website:
                                    <a href="{{ $setting->website }}">{{ $setting->website }}</a>
                                </p>
                                <p>Email: {{ $setting->email }}</p>
                            </div>
                        </div>
                    </div>

                    <div id="col-292530230" class="col medium-6 small-12 large-6">
                        <div class="col-inner">
                            <h2>
                                <span class="ez-toc-section" id="Gui_lien_he" ez-toc-data-id="#Gui_lien_he"></span>Gửi liên
                                hệ<span class="ez-toc-section-end"></span>
                            </h2>
                            <div id="gap-77396167" class="gap-element clearfix" style="display: block; height: auto">
                                <style>
                                    #gap-77396167 {
                                        padding-top: 30px;
                                    }
                                </style>
                            </div>
                            <div class="wpcf7 js" id="wpcf7-f123-p2-o1" lang="vi" dir="ltr" data-wpcf7-id="123">
                                <div class="screen-reader-response">
                                    <p role="status" aria-live="polite" aria-atomic="true"></p>
                                    <ul></ul>
                                </div>
                                <form action="" method="post" class="wpcf7-form init" aria-label="Form liên hệ"
                                    novalidate="novalidate" data-status="init">
                                    @csrf
                                    <div class="row">
                                        <div class="col">
                                            <div class="form-group">
                                                <span class="wpcf7-form-control-wrap" data-name="your-name"><input
                                                        size="40" maxlength="400"
                                                        class="wpcf7-form-control wpcf7-text wpcf7-validates-as-required form-control"
                                                        aria-required="true" aria-invalid="false" placeholder="Họ và Tên*"
                                                        value="" type="text" name="your-name" /></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col large-6">
                                            <div class="form-group">
                                                <span class="wpcf7-form-control-wrap" data-name="your-phone"><input
                                                        size="40" maxlength="400"
                                                        class="wpcf7-form-control wpcf7-tel wpcf7-validates-as-required wpcf7-text wpcf7-validates-as-tel form-control"
                                                        id="your-phone" aria-required="true" aria-invalid="false"
                                                        placeholder="Số điện thoại*" value="" type="tel"
                                                        name="your-phone" /></span>
                                            </div>
                                        </div>
                                        <div class="col large-6">
                                            <div class="form-group">
                                                <span class="wpcf7-form-control-wrap" data-name="your-email"><input
                                                        size="40" maxlength="400"
                                                        class="wpcf7-form-control wpcf7-email wpcf7-validates-as-required wpcf7-text wpcf7-validates-as-email form-control"
                                                        aria-required="true" aria-invalid="false" placeholder="Email*"
                                                        value="" type="email" name="your-email" /></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            <div class="form-group">
                                                <span class="wpcf7-form-control-wrap" data-name="your-message">
                                                    <textarea cols="40" rows="10" maxlength="2000"
                                                        class="wpcf7-form-control wpcf7-textarea wpcf7-validates-as-required form-control" aria-required="true"
                                                        aria-invalid="false" placeholder="Nội dung liên hệ*" name="your-message"></textarea>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            <div class="form-group">
                                                <input class="wpcf7-form-control wpcf7-submit has-spinner btn btn-primary"
                                                    id="btn-submit" type="submit" value="Đăng ký tư vấn" /><span
                                                    class="wpcf7-spinner"></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="wpcf7-response-output" aria-hidden="true"></div>
                                </form>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <style>
                #section_744202346 {
                    padding-top: 30px;
                    padding-bottom: 30px;
                }
            </style>
        </section>
    </div>
@endsection

@push('scripts')
    <script></script>
@endpush
