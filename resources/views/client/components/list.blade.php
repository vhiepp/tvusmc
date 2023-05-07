@php
    $timeNow = \App\Helpers\Date::getNow();
@endphp
<div class="row">
    @foreach ($data as $index => $item)
        
        <a class="col-md-12 mb-2 list-item" href="
                                                {{ 
                                                    route('client.' . $url, [
                                                                'slug' => $item['slug']
                                                            ])
                                                }}
        ">

            @isset($item['thumb'])
            <div class="thumb">
                <img src="{{ $item['thumb'] }}" alt="Raised image" class="rounded shadow-lg">
            </div>
            @endisset
            
            <div class="content">
                <div class="col-12 title" title="{{ $item['title'] }}">
                    <span class="text-dark">
                        {{ 
                            str()->of($item['title'])->limit(70);
                        }}
                    </span>
                </div>
                <div class="col-12">
                    <span class="text-muted">
                        <small>
                            @if (isset($item['time_start']) && isset($item['time_end']))
                                @php
                                    $timeStart = date("H:i d/m/y", strtotime($item['time_start']));
                                    $timeEnd = date("H:i d/m/y", strtotime($item['time_end']));
                                @endphp
                                {{ 
                                    $timeStart . ' đến ' . $timeEnd
                                }}
                                <small>
                                    <i>
                                        @if (strtotime($item['time_start']) > strtotime($timeNow))
                                            <span class="text-info">Sắp tới</span>
                                        @endif
                                        @if (strtotime($item['time_start']) <= strtotime($timeNow) && strtotime($timeNow) <= strtotime($item['time_end']))
                                            <span class="text-success">Đang diễn ra</span>
                                        @endif
                                        @if (strtotime($item['time_end']) < strtotime($timeNow))
                                            <span class="text-danger">Đã kết thúc</span>
                                        @endif
                                    </i>
                                </small>
                            @else 
                                {{ 
                                    $item['created_at']->day . '/' . $item['created_at']->month . '/' . $item['created_at']->year
                                }}
                            @endif
                        </small>
                    </span>
                </div>
            </div>
            
        </a>
    @endforeach

    @isset($page)    
        <nav aria-label="Page navigation example">
            <ul class="pagination justify-content-center">

                <li class="page-item @if ($data->currentPage() == 1) disabled @endif" title="trước">
                    <a class="page-link" href="{{$data->previousPageUrl()}}" tabindex="-1">
                        <i class="fa fa-angle-left"></i>
                        <span class="sr-only">Previous</span>
                    </a>
                </li>

                <li class="page-item @if ($data->currentPage() >= ceil($data->total()/$data->perPage())) disabled @endif" title="sau">
                    <a class="page-link" href="{{$data->nextPageUrl()}}" >
                        <i class="fa fa-angle-right"></i>
                        <span class="sr-only">Next</span>
                    </a>
                </li>
            </ul>
        </nav>
    @endisset
</div>

