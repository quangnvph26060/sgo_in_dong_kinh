@if ($paginator->hasPages())
    <ul class="page-numbers nav-pagination links text-center">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            {{-- Không có nút "previous" nếu đang ở trang đầu --}}
        @else
            <li>
                <a class="page-number prev" href="{{ $paginator->previousPageUrl() }}" rel="prev">
                    <i class="icon-angle-left"></i>
                </a>
            </li>
        @endif

        {{-- Pagination Elements --}}
        @foreach ($elements as $element)
            {{-- Dấu chấm ba chấm --}}
            @if (is_string($element))
                <li><span class="page-number dots">{{ $element }}</span></li>
            @endif

            {{-- Liệt kê các trang --}}
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <li>
                            <span aria-current="page" class="page-number current">{{ $page }}</span>
                        </li>
                    @else
                        <li>
                            <a class="page-number" href="{{ $url }}">{{ $page }}</a>
                        </li>
                    @endif
                @endforeach
            @endif
        @endforeach

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <li>
                <a class="next page-number" href="{{ $paginator->nextPageUrl() }}" rel="next">
                    <i class="icon-angle-right"></i>
                </a>
            </li>
        @endif
    </ul>
@endif
