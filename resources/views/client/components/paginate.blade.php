<nav aria-label="Page navigation">
    <ul class="pagination justify-content-center">
        <li class="page-item
                    @if ($items->onFirstPage())
                        disabled
                    @endif    
                ">
                    <a class="page-link" href="{{ $items->previousPageUrl() }}"
                    @if ($items->onFirstPage())
                        tabindex="-1"
                    @endif
            >
                <i class="fa fa-angle-left"></i>
                <span class="sr-only">Previous</span>
            </a>
        </li>

        @php

            $paginateStart = $items->currentPage() - 1;
            $paginateEnd = $items->currentPage() + 1 + ($items->currentPage() == 1 || $items->currentPage() == $items->lastPage());

            if ($paginateStart < 1) {
                $i = 1 - $paginateStart;
                $paginateStart += $i;
                $paginateEnd += $i;
            }

            if ($paginateEnd > $items->lastPage()) {
                $i = $paginateEnd - $items->lastPage();
                $paginateStart -= $i;
                $paginateEnd -= $i;
            }

            $paginates = $items->getUrlRange($paginateStart, $paginateEnd);

        @endphp

        <li class="page-item 
            @if ($items->currentPage() == 1) active @endif
            ">
            <a class="page-link @if ($items->currentPage() == 1) no-loader @endif" href="{{ $items->url(1) }}">
                1
                @if ($items->currentPage() == 1)
                    <span class="sr-only">(current)</span>
                @endif
            </a>
        </li>

        @if ($items->currentPage() - 2 > 1)
            <li class="page-item disabled">
                <a class="page-link">...</a>
            </li>
        @endif
        
        @foreach ($paginates as $key => $paginate)
            @if ($key > 1 && $key < $items->lastPage())

                <li class="page-item 
                    @if ($items->currentPage() == $key) active @endif
                ">
                    <a class="page-link @if ($items->currentPage() == $key) no-loader @endif" href="{{ $paginate }}">
                        {{$key}}
                        @if ($items->currentPage() == $key)
                            <span class="sr-only">(current)</span>
                        @endif
                    </a>
                </li>
            @endif
        @endforeach

        
        @if ($items->lastPage() > 4)

            @empty($paginates[$items->lastPage() - 1])
                <li class="page-item disabled">
                    <a class="page-link">...</a>
                </li>
            @endempty
        
        @endif

        @if ($items->lastPage() > 1)
            <li class="page-item
            @if ($items->currentPage() == $items->lastPage()) active @endif
            ">
                <a class="page-link @if ($items->currentPage() == $items->lastPage()) no-loader @endif " href="{{ $items->url($items->lastPage()) }}">
                    {{$items->lastPage()}}
                    @if ($items->currentPage() == $items->lastPage())
                        <span class="sr-only">(current)</span>
                    @endif
                </a>
            </li>
        @endif

        <li class="page-item
            @if ($items->lastPage() == $items->currentPage())
                disabled
            @endif
        ">
            <a class="page-link" href="{{ $items->nextPageUrl() }}"
            @if ($items->lastPage() == $items->currentPage())
                tabindex="-1"
            @endif
            >
                <i class="fa fa-angle-right"></i>
                <span class="sr-only">Next</span>
            </a>
        </li>

    </ul>
</nav>