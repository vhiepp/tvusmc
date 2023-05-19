@extends('admin.master')

@section('content')

    <div class="row">
        <div class="col-sm-12">
            <a href="{{ route('admin.files.create') }}" class="btn mb-3 btn-success text-white">
                <i class="ri-pen-nib-line"></i>
                Upload file
                
            </a>
        </div>

        <div class="col-sm-12">
            <div class="iq-card">
                <div class="iq-card-header d-flex justify-content-between">
                    <div class="iq-header-title">
                        <h4 class="card-title">
                            File đã chia sẻ
                            <span class="badge badge-success ml-2">
                                {{ $files->total() }}
                            </span>
                        </h4>
                    </div>
                </div>
                <div class="iq-card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Tên file</th>
                                    <th scope="col">Type</th>
                                    <th scope="col">Loại</th>
                                    <th scope="col">Người đăng</th>
                                    <th scope="col">GG Driver</th>
                                    <th scope="col">Ngày Upload</th>
                                    <th scope="col">Chức năng</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($files as $index => $file)
                                    <tr>
                                        <th scope="row">{{ $index + 1 }}</th>
                                        <td>
                                            <div class="d-flex px-2 py-1">
                                                <h5 class="mb-0 font-weight-bold" title="{{$file['file_name']}}">{{
                                                    str()->limit($file['file_name'], 60) }}</h5>
                                            </div>
                                        </td>
                                        <td>
                                            <span class="text-secondary text-xs font-weight-bold">
                                                {{ $file['extension'] }}
                                            </span>
                                        </td>
                                        <td>
                                            <span class="text-secondary text-xs font-weight-bold">
                                                {{ $file['type'] == 0 ? 'DS' : 'VB' }}
                                            </span>
                                        </td>
                                        <td>
                                            <span class="text-secondary text-xs font-weight-bold">
                                                {{ $file['user_name'] }}
                                            </span>
                                        </td>
                                        <td>
                                            <span class="text-secondary text-xs font-weight-bold" title="{{ 'TVUSMC/' . $file['path'] }}">
                                                {{
                                                    'TVUSMC/' . str()->limit($file['path'], 30)
                                                }}
                                            </span>
                                        </td>
                                        <td>
                                            <span class="text-secondary text-xs font-weight-bold">
                                                {{
                                                    date('H:i d/m/Y', strtotime($file['created_at']));
                                                }}
                                            </span>
                                        </td>
                                        <td>
                                            <button type="button" class="btn mb-3 btn-danger rounded-pill"
                                            onclick="alertModalShow('Cảnh báo', 'Bạn chắc chắn muốn xóa file này! Sau khi bạn xóa file sẽ được chuyển đến thùng rác của Google Driver', '{{ route('admin.files.delete', [ 'id' => $file['id'], ]) }}');">
                                                <i class="ri-delete-bin-line"></i>
                                                Xóa
                                            </button>
                                            <a href="{{ route('admin.files.download', [ 'path' => $file['path'] ]) }}" class="btn mb-3 btn-primary rounded-pill text-white" title="Tải xuống">
                                                <i class="ri-download-line"></i>
                                                Tải
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                                @if (count($files) == 0)
                                    <tr>
                                        <td colspan="7" class="text-center">
                                            Không có file nào
                                        </td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                    
                    {{ view('admin.components.paginate', [
                        'items' => $files,
                     ]) }}
                </div>
            </div>
        </div>

    </div>

    @include('admin.alerts.modal')
@endsection