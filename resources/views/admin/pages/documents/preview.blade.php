@extends('admin.master')

@section('content')
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link href='/assets/css/style-content.css' rel='stylesheet'>

    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-body px-0 pb-3 pt-5">
                        <div class="container-fluid d-flex flex-row-reverse mw-960 mr-0-auto mb-4">
                            <button type="button" class="btn mb-3 btn-secondary rounded-pill mx-1" onclick="copyText('{{ route('client.documents', ['slug' => $document['slug']]) }}')" title="Copy link">
                                <i class="ri-file-copy-2-line"></i>
                            </button>
                            <a class="btn mb-3 btn-danger text-white rounded-pill mx-1" onclick="alertModalShow('Xóa bài viết', 'Bạn chắc chắn muốn xóa bài viết này! Bài viết sẽ không khôi phục lại được sau khi xóa!', '{{ route('admin.documents.delete', ['slug' => $document['slug']]) }}');">
                                <i class="ri-delete-bin-line"></i>
                                Xóa
                            </a>
                            <a class="btn mb-3 btn-light rounded-pill mx-1" href="{{ route('admin.documents.edit', ['slug' => $document['slug']]) }}">
                                <i class="ri-edit-2-line"></i>
                                Sửa
                            </a>
                        </div>
                        <div class="container-fluid mw-960 mr-0-auto rounded">
                            <h1>{{ $document['title'] }}</h1>
                            <div class="text-sm pb-3">
                                <span class="" title="Ngày đăng">
                                    <i class='bx bxs-calendar'></i>
                                    {{
                                        $document['created_at']->day . '/' . $document['created_at']->month . '/' . $document['created_at']->year
                                    }}
                                </span>
                            </div>
                            <hr>
                            <div class="ck-content">
                                {!! $document['content'] !!}
                            </div>
                            <div>
                                <h5>File đính kèm:</h5>
                                @foreach ($document->files as $index => $file)
                                    <p>
                                        [{{$index + 1}}] <a href="{{$file['file_url']}}" target="_blank">{{$file['filename']}}</a>
                                    </p>
                                @endforeach
                            </div>
                            <hr class="horizontal dark my-3">
                            <div class="d-flex align-items-center mt-4">
                                <div class="avatar me-3">
                                    <img src="{{ $document->user['avatar'] }}" alt="kal" class="img-fluid rounded" style="width: 40px">
                                </div>
                                <span class="mx-2 font-weight-bold">
                                    {{ $document->user['name'] }}
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
