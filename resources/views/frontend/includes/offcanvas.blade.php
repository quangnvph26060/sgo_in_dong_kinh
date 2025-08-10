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
    </ul>
</div>
