@extends('admin.master')

@section('content')
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-body px-0 pb-3 pt-5">
                        <div class="container-fluid d-flex flex-row-reverse mw-1200 mr-0-auto mb-4">
                            <a class="btn btn-outline-danger btn-sm mb-2 ms-2" onclick="alertModalShow('Xóa bài viết', 'Bạn chắc chắn muốn xóa bài viết này! Bài viết sẽ không khôi phục lại được sau khi xóa!', '{{ route('admin.blogs.delete', ['slug' => $blog['slug']]) }}');">Xóa</a>
                            @if ($blog['active'] == 0)
                                <a class="btn btn-outline-success btn-sm mb-2" href="
                                {{ route('admin.blogs.active', [
                                    'slug' => $blog['slug'],
                                    'active' => 1
                                ]) }}">Duyệt</a>
                            @endif
                            @if ($blog['active'] == 1)
                                <a class="btn btn-outline-secondary btn-sm mb-2 ms-2" href="">Ẩn</a>
                            @endif
                        </div>
                        <div class="container-fluid mw-1200 mr-0-auto rounded">
                            <h3>{{ $blog['title'] }}</h3>
                            <div class="text-sm pb-3">
                                <span class="" title="Ngày đăng">
                                    <i class='bx bxs-calendar'></i>
                                    {{
                                        $blog['created_at']->day . '/' . $blog['created_at']->month . '/' . $blog['created_at']->year
                                    }}
                                </span>
                                <span class="ms-2" title="view">
                                    <i class='bx bx-user-circle' ></i>
                                    2
                                </span>
                            </div>
                            {!! $blog['content'] !!}
                            <div class="text-sm">
                                ( Danh mục: {{ $blog['category_name'] }} )
                            </div>
                            <hr class="horizontal dark my-3">
                            <div class="d-flex align-items-center mt-4">
                                <div class="avatar me-3">
                                    <img src="{{ $blog['user_avatar'] }}" alt="kal" class="img-fluid rounded" style="width: 40px">
                                </div>
                                <span class="mx-2 font-weight-bold">
                                    {{ $blog['user_name'] }}
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('admin.alerts.modal')

@endsection