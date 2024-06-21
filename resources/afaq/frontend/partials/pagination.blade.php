@if ($paginator->hasPages())
    <div class="pagination-bar d-flex align-items-center justify-content-center mt-2 mb-5">
        @if ($paginator->onFirstPage())
            <div class="priv-page icon-pagination disabled"><i class="fa-solid fa-chevron-{{ app()->getLocale() == 'en' ? 'left' :'right' }}"></i></div>
        @else
            <div class="priv-page icon-pagination" onclick="window.location.href='{{ $paginator->previousPageUrl() }}'"><i
                    class="fa-solid fa-chevron-{{ app()->getLocale() == 'en' ? 'left' :'right' }}"></i></div>
        @endif
        <div class="list-pages">
            <ul>
                {{-- Pagination Elements --}}
                @foreach ($elements as $element)
                    {{-- "Three Dots" Separator --}}
                    @if (is_string($element))
                        <li class="disabled">{{ $element }}</li>
                    @endif

                    {{-- Array Of Links --}}
                    @if (is_array($element))
                        @foreach ($element as $page => $url)
                            @if ($page == $paginator->currentPage())
                                <li class="active">{{ $page }}</li>
                            @else
                                <li onclick="window.location.href='{{ $url }}'">{{ $page }}</li>
                            @endif
                        @endforeach
                    @endif
                @endforeach

            </ul>
        </div>
        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())

            <div class="priv-page icon-pagination" onclick="window.location.href='{{ $paginator->nextPageUrl() }}'"><i
                    class="fa-solid fa-chevron-{{ app()->getLocale() == 'en' ? 'right' :'left' }}"></i></div>
        @else
            <div class="priv-page icon-pagination disabled"><i class="fa-solid fa-chevron-{{ app()->getLocale() == 'en' ? 'right' :'left' }}"></i></div>
        @endif
    </div>
@endif
