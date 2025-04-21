@extends('frontend.master')

@section('title', $setting->title ?? $setting->seo_title)
@section('description', $setting->seo_description)
@section('image', showImage($setting->logo))

@section('content')
    <div id="content" class="content-area page-wrapper" role="main">
        <div class="row row-main">
            <div class="large-12 col">
                <div class="col-inner">
                    {!! $setting->introduce !!}
                </div>
            </div>
        </div>
    </div>
@endsection


@push('styles')
    <style>
        .image-with-alt {
            display: inline-block;
            /* Đảm bảo không chiếm full chiều ngang */
            text-align: center;
            margin-bottom: 1rem;
        }

        .image-alt-wrapper {
            background-color: #f2f2f2;
            padding: 5px 10px;
            font-style: italic;
            color: #666;
            font-size: 0.9rem;
            width: 100%;
            /* chiếm 100% chiều rộng của .image-with-alt */
            box-sizing: border-box;
        }
    </style>
@endpush

@push('scripts')
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const images = document.querySelectorAll('.content-area page-wrapper. col-inner img');

            images.forEach(img => {
                const altText = img.getAttribute('alt');

                if (altText) {
                    // Tạo thẻ chứa alt
                    const caption = document.createElement('div');
                    caption.classList.add('image-alt-wrapper');
                    caption.textContent = altText;

                    // Tạo wrapper để gói ảnh và caption
                    const wrapper = document.createElement('div');
                    wrapper.classList.add('image-with-alt');

                    // Chèn wrapper thay ảnh cũ
                    img.parentNode.insertBefore(wrapper, img);
                    wrapper.appendChild(img);
                    wrapper.appendChild(caption);
                }
            });
        });
    </script>
@endpush
