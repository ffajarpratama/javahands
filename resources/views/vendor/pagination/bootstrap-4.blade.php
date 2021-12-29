@if ($paginator->hasPages())
    <nav>
        <ul class="pagination justify-content-start mb-0">
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <li class="page-item disabled px-2" aria-disabled="true" aria-label="@lang('pagination.previous')">
                    <span class="page-link" aria-hidden="true" style="border-color: transparent; color: #a7a7a7;">
                        <i class="fas fa-angle-double-left"></i>
                    </span>
                </li>
            @else
                <li class="page-item px-2">
                    <a class="page-link" href="{{ $paginator->url(1) . '&category=' . request()->query('category') . '&sortBy=' . request()->query('sortBy') }}" rel="prev"
                       aria-label="@lang('pagination.previous')" style="border-color: transparent; color: #a7a7a7;">
                        <i class="fas fa-angle-double-left" style="color: #564134;"></i>
                    </a>
                </li>
                <li class="page-item px-2">
                    <a class="page-link" href="{{ $paginator->previousPageUrl() . '&category=' . request()->query('category') . '&sortBy=' . request()->query('sortBy') }}" rel="prev"
                       aria-label="@lang('pagination.previous')" style="border-color: transparent; color: #a7a7a7;">
                        <i class="fas fa-angle-left" style="color: #564134;"></i>
                    </a>
                </li>
            @endif

            {{-- Pagination Elements --}}
            @foreach ($elements as $element)
                {{-- "Three Dots" Separator --}}
                @if (is_string($element))
                    <li class="page-item disabled px-2" aria-disabled="true"><span class="page-link">{{ $element }}</span>
                    </li>
                @endif

                {{-- Array Of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li class="page-item active px-2" aria-current="page">
                                <span class="page-link" style="background-color: #564134; border-color: transparent">{{ $page }}</span>
                            </li>
                        @else
                            <li class="page-item px-2">
                                <a class="page-link" href="{{ $url . '&category=' . request()->query('category') . '&sortBy=' . request()->query('sortBy') }}" style="border-color: transparent; color: #564134;">{{ $page }}</a>
                            </li>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <li class="page-item px-2">
                    <a class="page-link" href="{{ $paginator->nextPageUrl() . '&category=' . request()->query('category') . '&sortBy=' . request()->query('sortBy') }}" rel="next"
                       aria-label="@lang('pagination.next')" style="border-color: transparent; color: #a7a7a7;">
                        <i class="fas fa-angle-right" style="color: #564134;"></i>
                    </a>
                </li>
                <li class="page-item px-2">
                    <a class="page-link" href="{{ $paginator->url($paginator->lastPage()) . '&category=' . request()->query('category') . '&sortBy=' . request()->query('sortBy') }}" rel="next"
                       aria-label="@lang('pagination.next')" style="border-color: transparent; color: #a7a7a7;">
                        <i class="fas fa-angle-double-right" style="color: #564134;"></i>
                    </a>
                </li>
            @else
                <li class="page-item disabled px-2" aria-disabled="true" aria-label="@lang('pagination.next')">
                    <span class="page-link" aria-hidden="true" style="border-color: transparent; color: #a7a7a7;">
                        <i class="fas fa-angle-double-right"></i>
                    </span>
                </li>
            @endif
        </ul>
    </nav>
@endif
