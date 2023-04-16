<div class="row">
    @foreach ($data as $index => $item)
        
        <a class="col-md-12 mb-2 list-item" href="
                                                {{ 
                                                    route('client.' . $url, [
                                                                'slug' => $item['slug']
                                                            ])
                                                }}
        ">


            <img src="{{ $item['thumb'] }}" alt="Raised image" class="rounded shadow-lg thumb">
            
            <div class="content">
                <div class="col-12 title">
                    <span class="text-dark">
                        {{ 
                            str()->of($item['title'])->limit(70);
                        }}
                    </span>
                </div>
                <div class="col-12">
                    <span class="text-muted">
                        <small>
                            {{ 
                                $item['created_at']->day . '/' . $item['created_at']->month . '/' . $item['created_at']->year
                            }}
                        </small>
                    </span>
                </div>
            </div>
            
        </a>
    
    @endforeach
</div>

