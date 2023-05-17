@extends('admin.master')

@section('content')
    
    <div class="row">
        <div class="col-sm-12">
            <a href="{{ route('admin.blogs.create') }}" class="btn mb-3 btn-success text-white">
                <i class="ri-pen-nib-line"></i>
                Viết bài
            </a>
        </div>
        <div class="col-sm-12">
            <div class="iq-card">
               <div class="iq-card-header d-flex justify-content-between">
                  <div class="iq-header-title">
                     <h4 class="card-title">
                        Bài viết chờ duyệt
                        <span class="badge badge-info ml-2">
                            {{ $pendingBlogs->total() }}
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
                              <th scope="col">Bài viết</th>
                              <th scope="col">Danh mục</th>
                              <th scope="col">Tác giả</th>
                              <th scope="col">Trạng thái</th>
                              <th scope="col">Ngày đăng</th>
                              <th scope="col">Chức năng</th>
                           </tr>
                        </thead>
                        <tbody>
                            @foreach ($pendingBlogs as $index => $pendingBlog)
                                <tr>
                                    <th scope="row">{{ $index + 1 }}</th>
                                    <td>
                                        <div class="d-flex px-2 py-1">
                                            <img src="{{ $pendingBlog['thumb'] }}" class="align-self-center mr-3" style="width: 70px" alt="#">
                                            <h5 class="mb-0 font-weight-bold" title="{{$pendingBlog['title']}}">{{ str()->title(str()->limit($pendingBlog['title'], 50)) }}</h5>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="text-secondary text-xs font-weight-bold">
                                            {{ $pendingBlog['category_name']}}
                                        </span>
                                    </td>
                                    <td>
                                        <p class="font-weight-bold mb-0">{{ str()->title($pendingBlog['user_name']) }}</p>
                                        <p class="text-xs text-secondary mb-0">{{ str()->upper($pendingBlog['user_class']) }}</p>
                                    </td>
                                    <td class="text-sm">
                                        <span class="badge badge-pill badge-danger">Wait</span>
                                    </td>
                                    <td>
                                        <span class="text-secondary text-xs font-weight-bold">
                                            {{
                                                $pendingBlog['created_at']->day . '/' . $pendingBlog['created_at']->month . '/' . $pendingBlog['created_at']->year
                                            }}
                                        </span>
                                    </td>
                                    <td>
                                        <a href="{{ route('admin.blogs.preview', [ 'slug' => $pendingBlog['slug'] ]) }}" class="btn mb-3 btn-primary rounded-pill text-white">
                                            <i class="ri-eye-line"></i>
                                            Xem
                                        </a>
                                        <button type="button" onclick="alertModalShow('Duyệt bài viết', 'Bạn chắc chắn muốn duyệt bài viết này! Bài viết sẽ được đăng ngay sau khi nhấn OK!', '{{ route('admin.blogs.active', ['slug' => $pendingBlog['slug'], 'active' => 1]) }}');" class="btn mb-3 btn-success rounded-pill">
                                            <i class="ri-checkbox-circle-line"></i>
                                            Duyệt
                                        </button>
                                        <a class="btn mb-3 btn-light rounded-pill" href="{{ route('admin.blogs.edit', ['slug' => $pendingBlog['slug']]) }}">
                                            <i class="ri-edit-2-line"></i>
                                            Sửa
                                        </a>
                                        <button type="button" class="btn mb-3 btn-danger rounded-pill" onclick="alertModalShow('Cảnh báo', 'Bạn chắc chắn muốn xóa bài viết này! Bài viết sẽ không khôi phục lại được sau khi xóa!', '{{ route('admin.blogs.delete', ['slug' => $pendingBlog['slug']]) }}');">
                                            <i class="ri-delete-bin-line"></i>
                                            Xóa
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                     </table>
                  </div>
               </div>
            </div>
         </div>
    
         <div class="col-sm-12">
            <div class="iq-card">
               <div class="iq-card-header d-flex justify-content-between">
                  <div class="iq-header-title">
                     <h4 class="card-title">
                        Bài viết
                        <span class="badge badge-success ml-2">
                            {{ $blogs->total() }}
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
                              <th scope="col">Bài viết</th>
                              <th scope="col">Danh mục</th>
                              <th scope="col">Tác giả</th>
                              <th scope="col">Trạng thái</th>
                              <th scope="col">Ngày đăng</th>
                              <th scope="col">Chức năng</th>
                           </tr>
                        </thead>
                        <tbody>
                            @foreach ($blogs as $index => $blog)
                                <tr>
                                    <th scope="row">{{ $index + 1 }}</th>
                                    <td>
                                        <div class="d-flex px-2 py-1">
                                            <img src="{{ $blog['thumb'] }}" class="align-self-center mr-3" style="width: 70px" alt="#">
                                            <h5 class="mb-0 font-weight-bold" title="{{$blog['title']}}">{{ str()->title(str()->limit($blog['title'], 50)) }}</h5>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="text-secondary text-xs font-weight-bold">
                                            {{ $blog['category_name']}}
                                        </span>
                                    </td>
                                    <td>
                                        <p class="font-weight-bold mb-0">{{ str()->title($blog['user_name']) }}</p>
                                        <p class="text-xs text-secondary mb-0">{{ str()->upper($blog['user_class']) }}</p>
                                    </td>
                                    <td class="text-sm">
                                        <span class="badge badge-pill badge-success">Show</span>
                                    </td>
                                    <td>
                                        <span class="text-secondary text-xs font-weight-bold">
                                            {{
                                                $blog['created_at']->day . '/' . $blog['created_at']->month . '/' . $blog['created_at']->year
                                            }}
                                        </span>
                                    </td>
                                    <td>
                                        <a href="{{ route('admin.blogs.preview', [ 'slug' => $blog['slug'] ]) }}" class="btn mb-3 btn-primary rounded-pill text-white">
                                            <i class="ri-eye-line"></i>
                                            Xem
                                        </a>
                                        <a class="btn mb-3 btn-light rounded-pill" href="{{ route('admin.blogs.edit', ['slug' => $blog['slug']]) }}">
                                            <i class="ri-edit-2-line"></i>
                                            Sửa
                                        </a>
                                        <button type="button" class="btn mb-3 btn-danger rounded-pill" onclick="alertModalShow('Cảnh báo', 'Bạn chắc chắn muốn xóa bài viết này! Bài viết sẽ không khôi phục lại được sau khi xóa!', '{{ route('admin.blogs.delete', ['slug' => $blog['slug']]) }}');">
                                            <i class="ri-delete-bin-line"></i>
                                            Xóa
                                        </button>
                                        <button type="button" class="btn mb-3 btn-secondary rounded-pill" onclick="copyText('{{ route('client.blogs', ['slug' => $blog['slug']]) }}')" title="Copy link">
                                            <i class="ri-file-copy-2-line"></i>
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                     </table>
                  </div>
                  {{ view('admin.components.paginate', [
                                'items' => $blogs,
                            ]) }}
               </div>
            </div>
         </div>
    </div>

     @include('admin.alerts.modal')

@endsection