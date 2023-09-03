@extends('admin.master')

@section('content')

    <div class="row">
        <div class="col-sm-12">
            <a href="{{ route('admin.documents.create') }}" class="btn mb-3 btn-success text-white">
                <i class="ri-cloud-line"></i>
                Up văn bản
            </a>
        </div>
         <div class="col-sm-12">
            <div class="iq-card">
               <div class="iq-card-header d-flex justify-content-between">
                  <div class="iq-header-title">
                     <h4 class="card-title">
                        Danh sách/ Văn bản
                        <span class="badge badge-success ml-2">
                            {{ $documents->total() }}
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
                              <th scope="col">Văn bản</th>
                              <th scope="col">Người đăng</th>
                              <th scope="col">Ngày đăng</th>
                              <th scope="col">File đính kèm</th>
                              <th scope="col">Chức năng</th>
                           </tr>
                        </thead>
                        <tbody>
                            @foreach ($documents as $index => $document)
                                <tr>
                                    <th scope="row">{{ $index + 1 }}</th>
                                    <td>
                                        <div class="d-flex px-2 py-1">
                                            <img src="{{ $document['thumb'] }}" class="align-self-center mr-3" style="width: 70px" alt="#">
                                            <h5 class="mb-0 font-weight-bold" title="{{$document['title']}}">{{ str()->title(str()->limit($document['title'], 50)) }}</h5>
                                        </div>
                                    </td>
                                    <td>
                                        <p class="font-weight-bold mb-0">{{ str()->title($document->user['name']) }}</p>
                                        <p class="text-xs text-secondary mb-0">{{ str()->upper($document->user['class']) }}</p>
                                    </td>
                                    <td>
                                        <span class="text-secondary text-xs font-weight-bold">
                                            {{
                                                $document['created_at']->day . '/' . $document['created_at']->month . '/' . $document['created_at']->year
                                            }}
                                        </span>
                                    </td>
                                    <td>
                                        <span class="text-secondary text-xs font-weight-bold">
                                            {{$document->files->count()}}
                                        </span>
                                    </td>
                                    <td>
                                        <a href="{{ route('admin.documents.preview', [ 'slug' => $document['slug'] ]) }}" class="btn mb-3 btn-primary rounded-pill text-white">
                                            <i class="ri-eye-line"></i>
                                            Xem
                                        </a>
                                        <a class="btn mb-3 btn-light rounded-pill" href="{{ route('admin.documents.edit', ['slug' => $document['slug']]) }}">
                                            <i class="ri-edit-2-line"></i>
                                            Sửa
                                        </a>
                                        <button type="button" class="btn mb-3 btn-danger rounded-pill" onclick="alertModalShow('Cảnh báo', 'Bạn chắc chắn muốn xóa bài viết này! Bài viết sẽ không khôi phục lại được sau khi xóa!', '{{ route('admin.documents.delete', ['slug' => $document['slug']]) }}');">
                                            <i class="ri-delete-bin-line"></i>
                                            Xóa
                                        </button>
                                        <button type="button" class="btn mb-3 btn-secondary rounded-pill" onclick="copyText('{{ route('client.documents', ['slug' => $document['slug']]) }}')" title="Copy link">
                                            <i class="ri-file-copy-2-line"></i>
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                     </table>
                  </div>
                  {{ view('admin.components.paginate', [
                                'items' => $documents,
                            ]) }}
               </div>
            </div>
         </div>
    </div>

     @include('admin.alerts.modal')

@endsection
