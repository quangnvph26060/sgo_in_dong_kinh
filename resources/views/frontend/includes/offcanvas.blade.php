<div class="offcanvas-header">
    <h5 class="offcanvas-title" id="offcanvasMenuLabel">In Đông Kinh</h5>
    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Đóng"></button>
</div>
<div class="offcanvas-body">
    <ul class="list-group">
        @foreach ($categories as $item)
            <li class="list-group-item">
                <a href="{{ route('category.product', $item->slug) }}">{{ $item->name }}</a>
            </li>
        @endforeach

        {{-- <li class="html header-button-1 list-group-item">
            <div class="header-button">
                <a href="tel:{{ preg_replace('/\D+/', '', strip_tags($setting->phone)) }}" class="button secondary"
                    style="border-radius: 8px">
                    <span>{{ preg_replace('/\D+/', '', strip_tags($setting->phone)) }}</span>
                </a>
            </div>
        </li>
        <li class="html header-button-2 list-group-item">
            <div class="header-button">
                <a href="#tu-van-247" class="button plain is-link" style="border-radius: 99px">
                    <span>Tư vấn 24/7</span>
                </a>
            </div>
        </li> --}}
    </ul>
</div>
