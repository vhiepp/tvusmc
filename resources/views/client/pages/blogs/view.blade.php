@extends('client.master')

@section('header')
        <div class="container mt-3">
            @include('client.components.btn.previous')
        </div>
@endsection

@section('content')
        {{-- @dd($blog) --}}
    <div class="section section-typography pt-4">

        
        <div class="container">

            <h1 class="font-weight-bold mb-0">
                {{ $blog['title'] }}
            </h1>

            <div class="text-dark mb-3">
                <small>
                    <i class="ni ni-calendar-grid-58"></i>
                    {{ 
                        $blog['created_at']->day . '/' . $blog['created_at']->month . '/' . $blog['created_at']->year
                    }}
                </small>
            </div>
            
            {!! $blog['content'] !!}

            <div class="text-dark mt-3 ">
                <small>
                    (Danh mục: {{ $blog['category_name'] }})
                </small>
            </div>

            <div class="mt-4">
                <a class="d-flex align-items-center ">
                    <span class="avatar avatar-xs mr-2">
                        <img alt="avatar" class="rounded" src="{{ $blog['user_avatar'] }}">
                    </span>
                    <span class="text-dark font-weight-bold">
                        {{ $blog['user_name'] }}
                    </span>
                    
                </a>
            </div>


            <hr class="mt-2">

            <div class="row">

                <div class="col-md-6">
                    {!! view('client.components.blogs.list', [
                        'header' => 'Bài viết liên quan',
                        'blogs' => $blogs,
                    ]) !!}
                </div>

            </div>

        </div>

    </div>
@endsection