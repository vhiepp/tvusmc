@extends('admin.master')

@section('content')
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-body px-0 pb-3 pt-5">
                        <div class="container-fluid d-flex flex-row-reverse mw-1200 mr-0-auto mb-4">
                            @if ($event['active'] == 1)
                                <button type="button" class="btn mb-3 btn-secondary rounded-pill mx-1" onclick="copyText('{{ route('client.events', ['slug' => $event['slug']]) }}')" title="Copy link">
                                    <i class="ri-file-copy-2-line"></i>
                                </button>
                            @endif
                            <a class="btn mb-3 btn-danger text-white rounded-pill mx-1" onclick="alertModalShow('Xóa bài viết', 'Bạn chắc chắn muốn xóa bài viết này! Bài viết sẽ không khôi phục lại được sau khi xóa!', '{{ route('admin.events.delete', ['slug' => $event['slug']]) }}');">
                                <i class="ri-delete-bin-line"></i>
                                Xóa
                            </a>
                            <a class="btn mb-3 btn-light rounded-pill mx-1" href="{{ route('admin.events.edit', ['slug' => $event['slug']]) }}">
                                <i class="ri-edit-2-line"></i>
                                Sửa
                            </a>
                            @if ($event['active'] == 0)
                                <a class="btn mb-3 btn-success rounded-pill mx-1" href="
                                {{ route('admin.events.active', [
                                    'slug' => $event['slug'],
                                    'active' => 1
                                ]) }}">
                                <i class="ri-checkbox-circle-line"></i>
                                Duyệt
                            </a>
                            @endif
                            @if ($event['active'] == 1)
                                <a class="btn mb-3 btn-secondary rounded-pill mx-1" href="">
                                    <i class="ri-eye-off-line"></i>
                                    Ẩn
                                </a>
                                
                            @endif
                        </div>
                        <div class="container-fluid mw-1200 mr-0-auto rounded">
                            <h1>{{ $event['title'] }}</h1>
                            <div class="text-sm pb-3">
                                <span class="" title="Ngày đăng">
                                    <i class='bx bxs-calendar'></i>
                                    {{
                                        $event['created_at']->day . '/' . $event['created_at']->month . '/' . $event['created_at']->year
                                    }}
                                </span>
                                <span class="ms-2" title="view">
                                    <i class='bx bx-user-circle' ></i>
                                    2
                                </span>
                            </div>
                            {!! $event['content'] !!}
                            <div class="text-sm">
                                ( Danh mục: {{ $event['category_name'] }} )
                            </div>
                            <hr class="horizontal dark my-3">
                            <div class="d-flex align-items-center mt-4">
                                <div class="avatar me-3">
                                    <img src="{{ $event['user_avatar'] }}" alt="kal" class="img-fluid rounded" style="width: 40px">
                                </div>
                                <span class="mx-2 font-weight-bold">
                                    {{ $event['user_name'] }}
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