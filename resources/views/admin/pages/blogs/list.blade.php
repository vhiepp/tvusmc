@extends('admin.master')

@section('content')
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12 d-flex flex-row-reverse">
                <a class="btn btn-outline-primary btn-sm mb-2" href="{{ route('admin.blogs.create') }}">Viết blogs</a>
            </div>
            <div class="col-12">
                <div class="card mb-4">
                <div class="card-header pb-0">
                    <h6>Chờ duyệt</h6>
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
                                <tr>
                                    <td>
                                    <div class="d-flex px-2 py-1 mw-500">
                                        <div>
                                        <img src="/assets/admin/img/team-3.jpg" class="avatar avatar-sm me-3" alt="user2">
                                        </div>
                                        <div class="d-flex flex-column justify-content-center">
                                            <h6 class="mb-0 text-sm">Alexa Liras</h6>
                                            <p class="text-xs text-secondary mb-0">alexa@creative-tim.com</p>
                                        </div>
                                    </div>
                                    </td>
                                    <td>
                                    <p class="text-xs font-weight-bold mb-0">Programator</p>
                                    <p class="text-xs text-secondary mb-0">Developer</p>
                                    </td>
                                    <td class="align-middle text-center text-sm">
                                        <span class="badge badge-sm bg-gradient-secondary">Chờ</span>
                                    </td>
                                    <td class="align-middle text-center">
                                        <span class="text-secondary text-xs font-weight-bold">11/01/19</span>
                                    </td>
                                    <td class="align-middle text-sm">
                                        <a href="javascript:;" class="text-success font-weight-bold ms-2" data-toggle="tooltip" data-original-title="Edit user">
                                            Xem
                                        </a>
                                        <a href="javascript:;" class="text-secondary font-weight-bold ms-2" data-toggle="tooltip" data-original-title="Edit user">
                                            Duyệt ngay
                                        </a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                </div>
            </div>
        </div>
    </div>
@endsection