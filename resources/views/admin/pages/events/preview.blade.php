@extends('admin.master')

@section('content')

    @php

        $timeNow = \App\Helpers\Date::getNow();

    @endphp
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link href='/assets/css/style-content.css' rel='stylesheet'>

    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-body px-0 pb-3 pt-5">
                        <div class="container-fluid d-flex flex-row-reverse mw-960 mr-0-auto mb-4">
                            @if ($event['active'] == 1)
                                <button type="button" class="btn mb-3 btn-secondary rounded-pill mx-1" onclick="copyText('{{ route('client.events', ['slug' => $event['slug']]) }}')" title="Copy link">
                                    <i class="ri-file-copy-2-line"></i>
                                </button>
                            @endif
                            <a class="btn mb-3 btn-danger text-white rounded-pill mx-1" onclick="alertModalShow('Xóa sự kiện', 'Bạn chắc chắn muốn xóa sự kiện này! Dữ liệu sẽ không khôi phục lại được sau khi xóa!', '{{ route('admin.events.delete', ['slug' => $event['slug']]) }}');">
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
                                {{-- <a class="btn mb-3 btn-secondary rounded-pill mx-1" href="">
                                    <i class="ri-eye-off-line"></i>
                                    Ẩn
                                </a> --}}

                            @endif
                        </div>
                        <div class="container-fluid mw-960 mr-0-auto rounded">
                            @if (strtotime($event['time_start']) > strtotime($timeNow))
                                <span class="badge badge-info">Sắp diễn ra</span>
                            @endif
                            @if (strtotime($event['time_start']) <= strtotime($timeNow) && strtotime($timeNow) <= strtotime($event['time_end']))
                                <span class="badge badge-success">Đang diễn ra</span>
                            @endif
                            @if (strtotime($event['time_end']) < strtotime($timeNow))
                                <span class="badge badge-danger">Đã kết thúc</span>
                            @endif
                            <h1>
                                {{ $event['title'] }}
                            </h1>
                            <div class="text-sm pb-3">
                                <span class="" title="Ngày đăng">
                                    <i class='bx bxs-calendar'></i>
                                    {{
                                        $event['created_at']->day . '/' . $event['created_at']->month . '/' . $event['created_at']->year
                                    }}
                                </span>
                            </div>
                            <hr>
                            @php
                                $timeStart = date("H:i - d/m/Y", strtotime($event['time_start']));
                                $timeEnd = date("H:i - d/m/Y", strtotime($event['time_end']));
                            @endphp
                            <h3>Thời gian bắt đầu:  {{ $timeStart }}</h3>
                            <h3>Thời gian kết thúc:  {{ $timeEnd }}</h3>
                            @if ($event['address'])
                                <h3>Địa chỉ:  {{ $event['address'] }}</h3>
                            @endif
                            <h4>Nội dung:</h4>
                            <div class="ck-content">
                                {!! $event['content'] !!}
                            </div>
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

            <div class="col-sm-12">
                <div class="iq-card">
                    <div class="iq-card-header d-flex justify-content-between">
                        <div class="iq-header-title">
                            <h4 class="card-title">
                                Công việc
                            </h4>
                        </div>
                    </div>
                    <div class="iq-card-body">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Công việc</th>
                                        <th scope="col">Bắt đầu</th>
                                        <th scope="col">Kết thúc</th>
                                        <th scope="col">Địa điểm</th>
                                        <th scope="col">Đã đăng ký</th>
                                        <th scope="col">Chức năng</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($jobs as $index => $job)
                                        @php
                                            $timeStart = date("H:i d/m/Y", strtotime($job['time_start']));
                                            $timeEnd = date("H:i d/m/Y", strtotime($job['time_end']));

                                        @endphp
                                        <tr>
                                            <th scope="row">{{ $index + 1 }}</th>
                                            <td>
                                                <div class="d-flex px-2 py-1">
                                                    <h5 class="mb-0 font-weight-bold" title="{{$job['name']}}">{{
                                                        str()->title(str()->limit($job['name'], 60)) }}</h5>
                                                </div>
                                            </td>
                                            <td>
                                                <span class="text-secondary text-xs font-weight-bold">
                                                    {{
                                                        $timeStart
                                                    }}
                                                </span>
                                            </td>
                                            <td>
                                                <span class="text-secondary text-xs font-weight-bold">
                                                    {{
                                                        $timeEnd
                                                    }}
                                                </span>
                                            </td>
                                            <td>
                                                <span class="text-secondary text-xs font-weight-bold">
                                                    {{
                                                        $job['address']
                                                    }}
                                                </span>
                                            </td>
                                            <td>
                                                <span class="text-secondary text-xs font-weight-bold">
                                                    {{
                                                        $job['user_count'] . ' / ' . $job['quantity']
                                                    }}
                                                </span>
                                            </td>
                                            <td>
                                                <button type="button" onclick="openPopup('{{ route('admin.jobs.preview', [ 'id' => $job['id'] ]) }}')" class="btn mb-3 btn-info rounded-pill"
                                                    onclick="">
                                                    <i class="ri-eye-line"></i>
                                                    Xem
                                                </button>
                                                <button type="button" onclick="openPopup('{{ route('admin.jobs.edit', [ 'id' => $job['id'] ]) }}')" class="btn mb-3 btn-secondary rounded-pill"
                                                    onclick="">
                                                    <i class="ri-edit-2-line"></i>
                                                    Sửa
                                                </button>
                                                <button type="button" class="btn mb-3 btn-danger rounded-pill"
                                                    onclick="alertModalShow('Cảnh báo', 'Bạn chắc chắn muốn xóa công việc này! Sẽ không khôi phục lại được dữ liệu sau khi xóa!', '{{ route('admin.jobs.delete', ['id' => $job['id']]) }}');">
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

            @if (!(strtotime($event['time_end']) < strtotime($timeNow)))
                <div class="col-sm-12">
                    <div class="iq-card">
                        <div class="iq-card-header d-flex justify-content-between">
                        <div class="iq-header-title">
                            <h4 class="card-title">Thêm công việc cho sự kiện</h4>
                        </div>
                        </div>
                        <div class="iq-card-body">
                        <form method="POST" action="{{ route('admin.jobs.store.event', [
                            'event' => $event['slug'],
                        ]) }}" enctype="multipart/form-data">
                                <div class="row">

                                    <div class="form-group col-sm-12">
                                        <label for="name">Tên công việc</label>
                                        <input type="text" name="name" value="{{ old('name') }}" class="form-control" id="name" placeholder="Nhập tên công việc" required>
                                    </div>

                                    <div class="form-group col-sm-12 col-lg-4">
                                        <label>Thời gian bắt đầu</label>
                                        <input type="datetime" class="form-control" id="timepicker1" placeholder="Giờ:phút ngày/tháng/năm" value="{{ date('H:i d/m/Y', strtotime($event['time_start'])) }}" name="time-start" required>
                                    </div>

                                    <div class="form-group col-sm-12 col-lg-4">
                                        <label>Thời gian kết thúc</label>
                                        <input type="datetime" class="form-control" id="timepicker2" placeholder="Giờ:phút ngày/tháng/năm" value="{{ date('H:i d/m/Y', strtotime($event['time_end'])) }}" name="time-end" required>
                                    </div>

                                    <div class="form-group col-sm-12 col-lg-4">
                                        <label>Số lượng</label>
                                        <input type="number" class="form-control" name="quantity" placeholder="Số lượng tham gia" id="exampleInputNumber1" value="100" required>
                                    </div>

                                    <div class="form-group col-sm-12">
                                        <label for="name">Địa chỉ</label>
                                        <input type="text" name="address" value="{{ old('address') ? old('address') : $event['address'] }}" class="form-control" placeholder="Nhập địa chỉ">
                                    </div>

                                    <div class="form-group col-sm-12">
                                        <label>Mô tả / Nội dung chi tiết</label>
                                        <textarea class="form-control" name="description" id="exampleFormControlTextarea1" required placeholder="Soạn nội dung" rows="5">{!! old('content') !!}</textarea>
                                    </div>

                                </div>
                                <button type="submit" class="btn btn-primary">Tạo</button>
                                @csrf
                        </form>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>

    @include('admin.alerts.modal')

@endsection

@section('script')
    <script>
        const openPopup = (url, w, h) => {

            if (!w & !h) {
                w = window.innerWidth * 90 / 100;
                h = window.innerHeight * 80 / 100;
            }

            const left = (window.innerWidth - w) / 2;
            const top = (window.innerHeight - h) / 2;

            window.open(url, 'popup', `width=${w}, height=${h}, top=${top}, left=${left}`);

            return false;
        }

        flatpickr("#timepicker1", {
            shorthandCurrentMonth: true,
            ariaDateFormat: "H:i d/m/Y",
            allowInput: true,
            altInput: true,
            altFormat: "H:i d/m/Y",
            enableTime: true,
            dateFormat: "H:i d/m/Y",
            time_24hr: true,
            defaultHour: 7,
            locale: 'vn',
            disableMobile: true,
        });

        flatpickr("#timepicker2", {
            shorthandCurrentMonth: true,
            ariaDateFormat: "H:i d/m/Y",
            allowInput: true,
            altInput: true,
            altFormat: "H:i d/m/Y",
            enableTime: true,
            dateFormat: "H:i d/m/Y",
            time_24hr: true,
            defaultHour: 7,
            locale: 'vn',
            disableMobile: true,
        });
    </script>
@endsection
