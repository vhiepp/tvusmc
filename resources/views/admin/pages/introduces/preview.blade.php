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
                            <button type="button" class="btn mb-3 btn-secondary rounded-pill mx-1" onclick="copyText('{{ route('client.introduces') }}')" title="Copy link">
                                <i class="ri-file-copy-2-line"></i>
                            </button>
                            <a class="btn mb-3 btn-light rounded-pill mx-1" href="{{ route('admin.introduces.edit') }}">
                                <i class="ri-edit-2-line"></i>
                                Sửa
                            </a>
                        </div>
                        <div class="container-fluid mw-1200 mr-0-auto rounded">
                            <h1>Giới thiệu về câu lạc bộ</h1>
                            <hr>
                            <div class="ck-content">
                                @include('introduce')
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
