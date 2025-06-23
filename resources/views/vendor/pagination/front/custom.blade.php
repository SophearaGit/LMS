@if ($paginator->hasPages())
    <ul class="pagination">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            <li class="page-item">
                <a class="page-link" href="javascript:;" aria-label="Previous">
                    <i class="far fa-arrow-left" aria-hidden="true"></i>
                </a>
            </li>
        @else
            <li class="page-item">
                <a class="page-link" href="{{ $paginator->previousPageUrl() }}" aria-label="Previous">
                    <i class="far fa-arrow-left" aria-hidden="true"></i>
                </a>
            </li>
        @endif

        {{-- Page Number Links --}}
        @foreach ($elements as $element)
            @if (is_string($element))
                <li class="page-item">
                    <span class="page-link">{{ $element }}</span>
                </li>
            @endif

            @if (is_array($element))
                @foreach ($element as $page => $url)
                    <li class="page-item">
                        @if ($page == $paginator->currentPage())
                            <a class="page-link active" href="#">{{ str_pad($page, 2, '0', STR_PAD_LEFT) }}</a>
                        @else
                            <a class="page-link"
                                href="{{ $url }}">{{ str_pad($page, 2, '0', STR_PAD_LEFT) }}</a>
                        @endif
                    </li>
                @endforeach
            @endif
        @endforeach

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <li class="page-item">
                <a class="page-link" href="{{ $paginator->nextPageUrl() }}" aria-label="Next">
                    <i class="far fa-arrow-right" aria-hidden="true"></i>
                </a>
            </li>
        @else
            <li class="page-item">
                <a class="page-link" href="javascript:;" aria-label="Next">
                    <i class="far fa-arrow-right" aria-hidden="true"></i>
                </a>
            </li>
        @endif
    </ul>
@endif
