@if ($paginator->hasPages())
    <nav aria-label="Page navigation">
        <ul class="pagination justify-content-right">
            {{-- Previous Page Link --}}
{{--            @if (!$paginator->onFirstPage())--}}
                <li class="page-item page-pre">
                    <a data-last="{{$paginator->lastPage()}}" class="page-link" href="{{ $paginator->previousPageUrl() }}" rel="prev" aria-label="Previous">
                        <span aria-hidden="true">&laquo;</span>
                    </a>
                </li>
{{--            @endif--}}

            {{-- Pagination Elements --}}
            @foreach (range(1, $paginator->lastPage()) as $i)
{{--                @if($i >= $paginator->currentPage() - 2 && $i <= $paginator->currentPage() + 2)--}}
{{--                    @if ($i == $paginator->currentPage())--}}
{{--                        <li class="page-item active" aria-current="page"><span data-current="current" data-last="{{$paginator->lastPage()}}" class="page-link">{{ $i }}</span></li>--}}
{{--                    @else--}}
                        <li class="page-item {{  $paginator->currentPage() == $i ? 'active' : ''}}"><a data-current="{{ $i }}" data-last="{{$paginator->lastPage()}}" class="page-link" href="{{ $paginator->url($i) }}">{{ $i }}</a></li>
{{--                    @endif--}}
{{--                @endif--}}
            @endforeach

            {{-- Next Page Link --}}
{{--            @if ($paginator->hasMorePages())--}}
                <li class="page-item page-next">
                    <a data-last="{{$paginator->lastPage()}}" class="page-link" href="{{ $paginator->nextPageUrl() }}" rel="next" aria-label="Next">
                        <span aria-hidden="true">&raquo;</span>
                    </a>
                </li>
{{--            @endif--}}
        </ul>
    </nav>
@endif

