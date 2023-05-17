<div class="row justify-content-between mt-3">
    <div id="user-list-page-info" class="col-md-6">
    </div>
    <div class="col-md-6">
        <nav aria-label="Page navigation example">
            <ul class="pagination justify-content-end mb-0">

                <li class="page-item
                    @if ($items->onFirstPage())
                        disabled
                    @endif    
                ">
                    <a class="page-link" href="{{ $items->previousPageUrl() }}"
                    @if ($items->onFirstPage())
                        tabindex="-1" aria-disabled="true"
                    @endif
                    >Previous</a>
                </li>
                
                @php

                    $paginateStart = $items->currentPage() - 2;
                    $paginateEnd = $items->currentPage() + 2 + ($items->currentPage() == 1 || $items->currentPage() == $items->lastPage()) * 2;

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
                <a class="page-link" href="{{ $items->url(1) }}">1</a>
                </li>

                @if ($items->currentPage() - 3 > 1)
                    <li class="page-item">
                        <a class="page-link">...</a>
                    </li>
                @endif
                
                @foreach ($paginates as $key => $paginate)
                    @if ($key > 1 && $key < $items->lastPage())

                        <li class="page-item 
                            @if ($items->currentPage() == $key) active @endif
                        ">
                            <a class="page-link" href="{{ $paginate }}">{{$key}}</a>
                        </li>
                    @endif
                @endforeach

                
                @if ($items->lastPage() > 6)

                    @empty($paginates[$items->lastPage() - 1])
                        <li class="page-item">
                            <a class="page-link">...</a>
                        </li>
                    @endempty
                
                @endif

                @if ($items->lastPage() > 1)
                    <li class="page-item
                    @if ($items->currentPage() == $items->lastPage()) active @endif
                    ">
                        <a class="page-link" href="{{ $items->url($items->lastPage()) }}">{{$items->lastPage()}}</a>
                    </li>
                @endif

                <li class="page-item
                    @if ($items->lastPage() == $items->currentPage())
                        disabled
                    @endif
                ">
                    <a class="page-link" href="{{ $items->nextPageUrl() }}"
                    @if ($items->lastPage() == $items->currentPage())
                        tabindex="-1" aria-disabled="true"
                    @endif
                    >Next</a>
                </li>
            </ul>
        </nav>
    </div>
</div>