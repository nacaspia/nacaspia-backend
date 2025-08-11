@if($posts->lastPage() > 1)
    <div id="pagination">
        <ul class="pagination">
            <!-- Previous Page Link -->
            @if (!$posts->onFirstPage())
                <li class="page-link prev">
                    <a href="{{ $posts->previousPageUrl() }}">
                        &laquo;
                    </a>
                </li>
            @endif

            <!-- Page Numbers -->
            @foreach (range(1, $posts->lastPage()) as $i)
                @if ($i == 1 || $i == $posts->lastPage() || abs($posts->currentPage() - $i) <= 1)
                    <li class="page-link {{ $posts->currentPage() == $i ? 'active' : '' }}">
                        <a href="{{ $posts->url($i) }}">{{ $i }}</a>
                    </li>
                @elseif (($i == 2 && $posts->currentPage() > 3) || ($i == $posts->lastPage() - 1 && $posts->currentPage() < $posts->lastPage() - 2))
                    <li class="dots">
                        <span>...</span>
                    </li>
                @endif
            @endforeach

            <!-- Next Page Link -->
            @if ($posts->hasMorePages())
                <li class="page-link next">
                    <a href="{{ $posts->nextPageUrl() }}">
                         &raquo;
                    </a>
                </li>
            @endif
        </ul>
    </div>
@endif
