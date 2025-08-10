@if( $posts->lastPage() > 1)
<div id="pagination">
    <div>
        <!-- Previous Page Link -->
        @if (!$posts->onFirstPage())
            <div class="arrow_prev">
                <a href="{{ $posts->previousPageUrl() }}">
                    <img src="{{ asset('site/assets/images/svg/pagination_arrow.svg') }}" alt="" />
                </a>
            </div>
        @endif

    <!-- Page Numbers -->
        @foreach (range(1, $posts->lastPage()) as $i)
            @if ($i == 1 || $i == $posts->lastPage() || abs($posts->currentPage() - $i) <= 1)
            <!-- İlk, sonuncu və cari səhifəyə yaxın səhifələr -->
                <a href="{{ $posts->url($i) }}" class="page-item {{ $posts->currentPage() == $i ? 'active' : '' }}">{{ $i }}</a>
            @elseif (($i == 2 && $posts->currentPage() > 3) || ($i == $posts->lastPage() - 1 && $posts->currentPage() < $posts->lastPage() - 2))
            <!-- Nöqtələr (1-dən sonra və son səhifədən əvvəl) -->
                <div class="dots">
                    <span><img src="{{ asset('site/assets/images/svg/3dots.svg') }}" alt="" /></span>
                    <span><img src="{{ asset('site/assets/images/svg/3dots.svg') }}" alt="" /></span>
                    <span><img src="{{ asset('site/assets/images/svg/3dots.svg') }}" alt="" /></span>
                </div>
            @endif
        @endforeach

    <!-- Next Page Link -->
        @if ($posts->hasMorePages())
            <div class="arrow_next">
                <a href="{{ $posts->nextPageUrl() }}">
                    <img src="{{ asset('site/assets/images/svg/pagination_arrow.svg') }}" alt="" class="arrow_next_img" />
                </a>
            </div>
        @endif
    </div>
</div>
    @endif
