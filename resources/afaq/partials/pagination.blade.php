<style>
    .pagination-bar {
        width: 100%;
        display: flex !important;
        justify-content: end !important;
        text-align: center;
    }

    .list-pages ul {
        display: flex;
        list-style: none;
        padding-left: 1px;
        padding-right: 1px;
        text-align: center;
        margin: 0 !important;
    }

    .list-pages ul li {
        padding-left: 5px;
        padding-right: 5px;
        cursor: pointer;
        font-size: 1rem;
        /* font-weight: 900; */
    }
    li.active{
        color: rgb(48, 175, 48);
    }
    .pagination {
        display: none;
    }

    .dataTables_info {
        display: none;
    }
    .priv-page{
        color: rgb(48, 175, 48);
    }
</style>
@if ($paginator->hasPages())
    <div class="pagination-bar d-flex align-items-center justify-content-center mt-2 mb-5">
        @if ($paginator->onFirstPage())
            <div class="priv-page icon-pagination disabled">{{ __('global.previous') }}</div>
        @else
            <div class="priv-page icon-pagination" onclick="window.location.href='{{ $paginator->previousPageUrl() }}'">
                {{ __('global.previous') }}</div>
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
            <div class="priv-page icon-pagination" onclick="window.location.href='{{ $paginator->nextPageUrl() }}'">
                {{ __('global.next') }}</div>
        @else
            <div class="priv-page icon-pagination disabled">{{ __('global.next') }}</div>
        @endif
    </div>
@endif
