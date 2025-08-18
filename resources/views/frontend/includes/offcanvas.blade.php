<div class="offcanvas-header border-bottom">
    <h5 class="offcanvas-title fw-bold" id="offcanvasMenuLabel">In Đông Kinh</h5>
    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Đóng"></button>
</div>

<div class="offcanvas-body p-0">
    <ul class="menu-list">
        <li><a href="/">Trang chủ</a></li>
        <li><a href="{{ route('introduce') }}">Giới thiệu</a></li>

        {{-- Top sản phẩm in ấn --}}
        <li class="has-submenu">
            <a href="javascript:void(0)" class="submenu-toggle">Top sản phẩm in ấn</a>
            <ul class="submenu">
                @foreach ($categories as $item)
                    <li>
                        <a href="{{ route('category.product', $item->slug) }}">
                            {{ $item->name }}
                        </a>
                    </li>
                @endforeach
            </ul>
        </li>

        <li><a href="{{ route('quote') }}">Báo giá</a></li>
        <li><a href="{{ route('news') }}">Tin tức</a></li>
        <li><a href="{{ route('contact') }}">Liên hệ</a></li>
        <li><a href="{{ route('products.listFast') }}">In nhanh</a></li>
    </ul>
</div>
