@extends('admin.master')

@section('content')
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12 d-flex flex-row-reverse">
                <a class="btn btn-outline-primary btn-sm mb-5" href="{{ route('admin.blogs.create') }}">Viết bài</a>
            </div>
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                        <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                            <h6 class="text-white text-capitalize ps-3">Bài viết chờ duyệt</h6>
                        </div>
                    </div>
                    <div class="card-body px-0 pt-0 pb-2">
                        <div class="table-responsive p-0">
                            <table class="table align-items-center mb-0">
                                <thead>
                                    <tr>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Bài viết</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Tác giả</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">trạng thái</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">ngày đăng</th>
                                        <th class="text-secondary opacity-7"></th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @foreach ($pendingBlogs as $pendingBlog)
                                        <tr>
                                            <td>
                                                <div class="d-flex px-2 py-1 mw-500 miw-500">
                                                    <div>
                                                    <img src="{{ $pendingBlog['thumb'] }}" class="avatar avatar-sm me-3" alt="user2">
                                                    </div>
                                                    <div class="d-flex flex-column justify-content-center">
                                                        <h6 class="mb-0 text-sm" title="{{$pendingBlog['title']}}">{{ str()->title(str()->limit($pendingBlog['title'], 40)) }}</h6>
                                                        <p class="text-xs text-secondary mb-0">{{ $pendingBlog['category_name'] }}</p>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <p class="font-weight-bold mb-0">{{ str()->title($pendingBlog['user_name']) }}</p>
                                                <p class="text-xs text-secondary mb-0">{{ str()->upper($pendingBlog['user_class']) }}</p>
                                            </td>
                                            <td class="align-middle text-center text-sm">
                                                <span class="badge badge-sm bg-gradient-danger">Wait</span>
                                            </td>
                                            <td class="align-middle text-center">
                                                <span class="text-secondary text-xs font-weight-bold">
                                                    {{
                                                        $pendingBlog['created_at']->day . '/' . $pendingBlog['created_at']->month . '/' . $pendingBlog['created_at']->year
                                                    }}
                                                </span>
                                            </td>
                                            <td class="align-middle text-sm">
                                                <a href="{{ route('admin.blogs.preview', [ 'slug' => $pendingBlog['slug'] ]) }}" class="text-success font-weight-bold ms-2" data-toggle="tooltip" data-original-title="Edit user">
                                                    Xem
                                                </a>
                                                <a onclick="alertModalShow('Duyệt bài viết', 'Bạn chắc chắn muốn duyệt bài viết này! Bài viết sẽ được đăng ngay sau khi nhấn OK!', '{{ route('admin.blogs.active', ['slug' => $pendingBlog['slug'], 'active' => 1]) }}');" style="cursor: pointer"
                                                    class="text-secondary font-weight-bold ms-2" data-toggle="tooltip" data-original-title="Edit user">
                                                    Duyệt
                                                </a>
                                                <a href="javascript:;" class="text-danger font-weight-bold ms-2" data-toggle="tooltip" data-original-title="Edit user">
                                                    Xóa
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                    @if (count($pendingBlogs) == 0)
                                        <tr>
                                            <td colspan="5" class="align-middle text-center">
                                                <span class="text-secondary text-xs font-weight-bold">
                                                    Không có bài viết nào đang chờ duyệt
                                                </span>
                                            </td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-12">
                <div class="card my-4">
                    <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                        <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                            <h6 class="text-white text-capitalize ps-3">Bài viết</h6>
                        </div>
                    </div>
                    <div class="card-body px-0 pt-0 pb-2">
                        <div class="table-responsive p-0">
                            <table class="table align-items-center mb-0">
                                <thead>
                                    <tr>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Bài viết</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Tác giả</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">trạng thái</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">ngày đăng</th>
                                        <th class="text-secondary opacity-7"></th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @foreach ($blogs as $blog)
                                    <tr>
                                        <td>
                                            <div class="d-flex px-2 py-1 mw-500 miw-500">
                                                <div>
                                                    <img src="{{ $blog['thumb'] }}" class="avatar avatar-sm me-3" alt="user2">
                                                </div>
                                                <div class="d-flex flex-column justify-content-center">
                                                    <h6 class="mb-0 text-sm" title="{{$blog['title']}}">{{ str()->title(str()->limit($blog['title'], 40)) }}</h6>
                                                    <p class="text-xs text-secondary mb-0">{{ $blog['category_name'] }}</p>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <p class="font-weight-bold mb-0">{{ str()->title($blog['user_name']) }}</p>
                                            <p class="text-xs text-secondary mb-0">{{ str()->upper($blog['user_class']) }}</p>
                                        </td>
                                        <td class="align-middle text-center text-sm">
                                            <span class="badge badge-sm bg-gradient-success">Show</span>
                                        </td>
                                        <td class="align-middle text-center">
                                            <span class="text-secondary text-xs font-weight-bold">
                                                {{
                                                    $blog['created_at']->day . '/' . $blog['created_at']->month . '/' . $blog['created_at']->year
                                                }}
                                            </span>
                                        </td>
                                        <td class="align-middle text-sm">
                                            <a href="{{ route('admin.blogs.preview', [ 'slug' => $blog['slug'] ]) }}" class="text-success font-weight-bold ms-2" data-toggle="tooltip" data-original-title="Edit user">
                                                Xem
                                            </a>
                                            <a href="javascript:;" class="text-secondary font-weight-bold ms-2" data-toggle="tooltip">
                                                Ẩn
                                            </a>
                                            <span onclick="alertModalShow('Cảnh báo', 'Bạn chắc chắn muốn xóa bài viết này! Bài viết sẽ không khôi phục lại được sau khi xóa!', '{{ route('admin.blogs.delete', ['slug' => $blog['slug']]) }}');" style="cursor: pointer" class="text-danger font-weight-bold ms-2">
                                                Xóa
                                            </span>
                                        </td>
                                    </tr>
                                    @endforeach
                                    
                                </tbody>
                            </table>
                            <div class="container mt-2">
                                <div class="row justify-space-between">
                                    <div class="col-lg-4 mx-auto">
                                        <ul class="pagination pagination-primary">
                                            @if ($blogs->currentPage() > 1)
                                                <li class="page-item" title="Trang trước">
                                                    <a class="page-link" href="{{$blogs->previousPageUrl()}}" aria-label="Previous">
                                                        <span aria-hidden="true"><i class="material-icons" aria-hidden="true">chevron_left</i></span>
                                                    </a>
                                                </li>
                                            @endif
                                            @if ($blogs->currentPage() < ceil($blogs->total()/$blogs->perPage()))
                                                <li class="page-item" title="Trang sau">
                                                    <a class="page-link" href="{{$blogs->nextPageUrl()}}" aria-label="Next">
                                                    <span aria-hidden="true"><i class="material-icons" aria-hidden="true">chevron_right</i></span>
                                                    </a>
                                                </li>
                                            @endif
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('admin.alerts.modal')
@endsection