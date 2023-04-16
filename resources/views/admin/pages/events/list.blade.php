@extends('admin.master')


@section('content')

    @php

        $timeNow = \App\Helpers\Date::getNow();
        echo $timeNow;
        
    @endphp

    <div class="container-fluid py-4">

        <div class="row">
            <div class="col-12 d-flex flex-row-reverse">
                <a class="btn btn-outline-primary btn-sm mb-5" href="{{ route('admin.events.create') }}">Tạo mới</a>
            </div>

            <div class="col-12">
                <div class="card my-4">
                    <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                        <div class="bg-gradient-dark shadow-primary border-radius-lg pt-4 pb-3">
                            <h6 class="text-white text-capitalize ps-3">Sự kiện sắp tới</h6>
                        </div>
                    </div>
                    <div class="card-body px-0 pt-0 pb-2">
                        <div class="table-responsive p-0">
                            <table class="table align-items-center mb-0">
                                <thead>
                                    <tr>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Sự kiện</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Người đăng</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">trạng thái</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Ngày bắt đầu</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Ngày kết thúc</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">ngày đăng</th>
                                        <th class="text-secondary opacity-7"></th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @foreach ($events as $event)
                                        @php
                                            $timeStart = date("H:i d/m/Y", strtotime($event['time_start']));
                                            $timeEnd = date("H:i d/m/Y", strtotime($event['time_end']));
                                        @endphp
                                        @if (strtotime($event['time_start']) > strtotime($timeNow))
                                            <tr>
                                                <td>
                                                    <div class="d-flex px-2 py-1 mw-500 miw-500">
                                                        <div class="d-flex flex-column justify-content-center">
                                                            <h6 class="mb-0 text-sm" title="{{$event['name']}}">{{ str()->title(str()->limit($event['name'], 40)) }}</h6>
                                                            <p class="text-xs text-secondary mb-0">{{ $event['category_name'] }}</p>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <p class="font-weight-bold mb-0">{{ str()->title($event['user_name']) }}</p>
                                                    <p class="text-xs text-secondary mb-0">{{ str()->upper($event['user_class']) }}</p>
                                                </td>
                                                <td class="align-middle text-center text-sm">
                                                    <span class="badge badge-sm bg-gradient-success">Show</span>
                                                </td>
                                                <td class="align-middle text-center">
                                                    <span class="text-secondary text-xs font-weight-bold">
                                                        {{
                                                            $timeStart
                                                        }}
                                                    </span>
                                                </td>
                                                <td class="align-middle text-center">
                                                    <span class="text-secondary text-xs font-weight-bold">
                                                        {{
                                                            $timeEnd
                                                        }}
                                                    </span>
                                                </td>
                                                <td class="align-middle text-center">
                                                    <span class="text-secondary text-xs font-weight-bold">
                                                        {{
                                                            $event['created_at']->day . '/' . $event['created_at']->month . '/' . $event['created_at']->year
                                                        }}
                                                    </span>
                                                </td>
                                                <td class="align-middle text-sm">
                                                    <a href="{{ route('admin.blogs.preview', [ 'slug' => $event['slug'] ]) }}" class="text-success font-weight-bold ms-2" data-toggle="tooltip" data-original-title="Edit user">
                                                        Xem
                                                    </a>
                                                    <a href="{{ route('admin.blogs.preview', [ 'slug' => $event['slug'] ]) }}" class="text-info font-weight-bold ms-2" data-toggle="tooltip" data-original-title="Edit user">
                                                        Sửa
                                                    </a>
                                                    <a href="javascript:;" class="text-secondary font-weight-bold ms-2" data-toggle="tooltip">
                                                        Ẩn
                                                    </a>
                                                    <span onclick="alertModalShow('Cảnh báo', 'Bạn chắc chắn muốn xóa sự kiện này! Dữ liệu sẽ không khôi phục lại được sau khi xóa!', '{{ route('admin.events.delete', ['slug' => $event['slug']]) }}');" style="cursor: pointer" class="text-danger font-weight-bold ms-2">
                                                        Xóa
                                                    </span>
                                                </td>
                                            </tr>
                                        @endif
                                    @endforeach
                                    
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12">
                <div class="card my-4">
                    <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                        <div class="bg-gradient-dark shadow-primary border-radius-lg pt-4 pb-3">
                            <h6 class="text-white text-capitalize ps-3">Sự kiện đang diễn ra</h6>
                        </div>
                    </div>
                    <div class="card-body px-0 pt-0 pb-2">
                        <div class="table-responsive p-0">
                            <table class="table align-items-center mb-0">
                                <thead>
                                    <tr>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Sự kiện</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Người đăng</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">trạng thái</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Ngày bắt đầu</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Ngày kết thúc</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">ngày đăng</th>
                                        <th class="text-secondary opacity-7"></th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @foreach ($events as $event)
                                        @php
                                            $timeStart = date("H:i d/m/Y", strtotime($event['time_start']));
                                            $timeEnd = date("H:i d/m/Y", strtotime($event['time_end']));
                                        @endphp
                                        @if (strtotime($event['time_start']) <= strtotime($timeNow) && strtotime($timeNow) <= strtotime($event['time_end']))
                                            <tr>
                                                <td>
                                                    <div class="d-flex px-2 py-1 mw-500 miw-500">
                                                        <div class="d-flex flex-column justify-content-center">
                                                            <h6 class="mb-0 text-sm" title="{{$event['name']}}">{{ str()->title(str()->limit($event['name'], 40)) }}</h6>
                                                            <p class="text-xs text-secondary mb-0">{{ $event['category_name'] }}</p>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <p class="font-weight-bold mb-0">{{ str()->title($event['user_name']) }}</p>
                                                    <p class="text-xs text-secondary mb-0">{{ str()->upper($event['user_class']) }}</p>
                                                </td>
                                                <td class="align-middle text-center text-sm">
                                                    <span class="badge badge-sm bg-gradient-success">Show</span>
                                                </td>
                                                <td class="align-middle text-center">
                                                    <span class="text-secondary text-xs font-weight-bold">
                                                        {{
                                                            $timeStart
                                                        }}
                                                    </span>
                                                </td>
                                                <td class="align-middle text-center">
                                                    <span class="text-secondary text-xs font-weight-bold">
                                                        {{
                                                            $timeEnd
                                                        }}
                                                    </span>
                                                </td>
                                                <td class="align-middle text-center">
                                                    <span class="text-secondary text-xs font-weight-bold">
                                                        {{
                                                            $event['created_at']->day . '/' . $event['created_at']->month . '/' . $event['created_at']->year
                                                        }}
                                                    </span>
                                                </td>
                                                <td class="align-middle text-sm">
                                                    <a href="{{ route('admin.blogs.preview', [ 'slug' => $event['slug'] ]) }}" class="text-success font-weight-bold ms-2" data-toggle="tooltip" data-original-title="Edit user">
                                                        Xem
                                                    </a>
                                                    <a href="{{ route('admin.blogs.preview', [ 'slug' => $event['slug'] ]) }}" class="text-info font-weight-bold ms-2" data-toggle="tooltip" data-original-title="Edit user">
                                                        Sửa
                                                    </a>
                                                    <a href="javascript:;" class="text-secondary font-weight-bold ms-2" data-toggle="tooltip">
                                                        Ẩn
                                                    </a>
                                                    <span onclick="alertModalShow('Cảnh báo', 'Bạn chắc chắn muốn xóa bài viết này! Bài viết sẽ không khôi phục lại được sau khi xóa!', '{{ route('admin.blogs.delete', ['slug' => $event['slug']]) }}');" style="cursor: pointer" class="text-danger font-weight-bold ms-2">
                                                        Xóa
                                                    </span>
                                                </td>
                                            </tr>
                                        @endif
                                    @endforeach
                                    
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12">
                <div class="card my-4">
                    <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                        <div class="bg-gradient-dark shadow-primary border-radius-lg pt-4 pb-3">
                            <h6 class="text-white text-capitalize ps-3">Sự kiện đã kết thúc</h6>
                        </div>
                    </div>
                    <div class="card-body px-0 pt-0 pb-2">
                        <div class="table-responsive p-0">
                            <table class="table align-items-center mb-0">
                                <thead>
                                    <tr>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Sự kiện</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Người đăng</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">trạng thái</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Ngày bắt đầu</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Ngày kết thúc</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">ngày đăng</th>
                                        <th class="text-secondary opacity-7"></th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @foreach ($events as $event)
                                        @php
                                            $timeStart = date("H:i d/m/Y", strtotime($event['time_start']));
                                            $timeEnd = date("H:i d/m/Y", strtotime($event['time_end']));
                                        @endphp
                                        @if (strtotime($event['time_end']) < strtotime($timeNow))
                                            <tr>
                                                <td>
                                                    <div class="d-flex px-2 py-1 mw-500 miw-500">
                                                        <div class="d-flex flex-column justify-content-center">
                                                            <h6 class="mb-0 text-sm" title="{{$event['name']}}">{{ str()->title(str()->limit($event['name'], 40)) }}</h6>
                                                            <p class="text-xs text-secondary mb-0">{{ $event['category_name'] }}</p>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <p class="font-weight-bold mb-0">{{ str()->title($event['user_name']) }}</p>
                                                    <p class="text-xs text-secondary mb-0">{{ str()->upper($event['user_class']) }}</p>
                                                </td>
                                                <td class="align-middle text-center text-sm">
                                                    <span class="badge badge-sm bg-gradient-success">Show</span>
                                                </td>
                                                <td class="align-middle text-center">
                                                    <span class="text-secondary text-xs font-weight-bold">
                                                        {{
                                                            $timeStart
                                                        }}
                                                    </span>
                                                </td>
                                                <td class="align-middle text-center">
                                                    <span class="text-secondary text-xs font-weight-bold">
                                                        {{
                                                            $timeEnd
                                                        }}
                                                    </span>
                                                </td>
                                                <td class="align-middle text-center">
                                                    <span class="text-secondary text-xs font-weight-bold">
                                                        {{
                                                            $event['created_at']->day . '/' . $event['created_at']->month . '/' . $event['created_at']->year
                                                        }}
                                                    </span>
                                                </td>
                                                <td class="align-middle text-sm">
                                                    <a href="{{ route('admin.blogs.preview', [ 'slug' => $event['slug'] ]) }}" class="text-success font-weight-bold ms-2" data-toggle="tooltip" data-original-title="Edit user">
                                                        Xem
                                                    </a>
                                                    <a href="{{ route('admin.blogs.preview', [ 'slug' => $event['slug'] ]) }}" class="text-info font-weight-bold ms-2" data-toggle="tooltip" data-original-title="Edit user">
                                                        Sửa
                                                    </a>
                                                    <a href="javascript:;" class="text-secondary font-weight-bold ms-2" data-toggle="tooltip">
                                                        Ẩn
                                                    </a>
                                                    <span onclick="alertModalShow('Cảnh báo', 'Bạn chắc chắn muốn xóa bài viết này! Bài viết sẽ không khôi phục lại được sau khi xóa!', '{{ route('admin.blogs.delete', ['slug' => $event['slug']]) }}');" style="cursor: pointer" class="text-danger font-weight-bold ms-2">
                                                        Xóa
                                                    </span>
                                                </td>
                                            </tr>
                                        @endif
                                    @endforeach
                                    
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        
    </div>

    @include('admin.alerts.modal')
@endsection