<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $title }} | TVU Social Media Club</title>

    @include('admin.layouts.head')

</head>
@php

    $timeStart = date("H:i - d/m/Y", strtotime($job['time_start']));
    $time = date("H:i", strtotime($job['time_start']));
    $date = date("d/m/Y", strtotime($job['time_start']));
    $timeEnd = date("H:i - d/m/Y", strtotime($job['time_end']));

@endphp
<body>
    <div class="container-fluid">
        
        <div class="row">
            <div class="col-sm-12 mt-3">
                <a type="button" href="{{ route('admin.jobs.edit', [ 'id' => $job['id'] ]) }}" class="btn mb-3 btn-secondary rounded-pill">
                    <i class="ri-edit-2-line"></i>
                    Sửa
                </a>
            </div>
            <div class="col-sm-12">
                <div class="iq-card">
                    <div class="iq-card-header d-flex justify-content-between">
                       <div class="iq-header-title">
                          <h3 class="card-title">{{ $job['name'] }} <small>( Sự kiện: {{ str()->of($job['event_name'])->limit(100) }} )</small></h3>
                       </div>
                    </div>
                    <div class="iq-card-body">
                        <p class="h4">Thời gian bắt đầu: <span class="text-dark">{{ $timeStart }}</span></p>
                        <p class="h4">Thời gian kết thúc: <span class="text-dark">{{ $timeEnd }}</span></p>
                        <p class="h4">Địa điểm: <span class="text-dark">{{ $job['address'] }}</span></p>
                        <p class="h4">Mô tả / Nội dung chi tiết:</p>
                        <p class="h5"><span class="text-dark">{{ $job['description'] }}</span></p>
                    </div>
                </div>
            </div>

            <div class="col-sm-12">
                <div class="iq-card">
                    <div class="iq-card-header d-flex justify-content-between">
                       <div class="iq-header-title">
                          <h4 class="card-title">
                            Danh sách đăng ký
                            <span class="badge badge-success">
                                {{count($users)}} /{{ $job['quantity'] }}
                            </span>
                        </h4>
                       </div>
                    </div>
                    <div class="iq-card-body">
                        <a class="btn mb-3 btn-light rounded-pill mx-1" 
                        href="
                            {{ route('files.downoad.jobuser', [
                                'job_id' => $job['id'],
                                'c' => 'all',
                                'file' => 'word',
                                'title' => $job['name'],
                                'date_time' => $time . ' ngày ' . $date,
                                'address' => $job['address'],
                            ]) }}
                        ">
                            <i class="ri-download-line"></i>
                            Word (Tất cả)
                        </a>
                        <a class="btn mb-3 btn-light rounded-pill mx-1" 
                        href="
                            {{ route('files.downoad.jobuser', [
                                'job_id' => $job['id'],
                                'c' => 'all',
                                'file' => 'pdf',
                                'title' => $job['name'],
                                'date_time' => $time . ' ngày ' . $date,
                                'address' => $job['address'],
                            ]) }}
                        ">
                            <i class="ri-download-line"></i>
                            PDF (Tất cả)
                        </a>
                        <a class="btn mb-3 btn-info rounded-pill mx-1" 
                        href="
                            {{ route('files.downoad.jobuser', [
                                'job_id' => $job['id'],
                                'c' => 'all',
                                'file' => 'word',
                                'title' => $job['name'],
                                'date_time' => $time . ' ngày ' . $date,
                                'address' => $job['address'],
                                'proof' => 1,
                            ]) }}
                        ">
                            <i class="ri-download-line"></i>
                            <b>Word (Có minh chứng)</b>
                        </a>
                        <a class="btn mb-3 btn-danger rounded-pill mx-1" 
                        href="
                            {{ route('files.downoad.jobuser', [
                                'job_id' => $job['id'],
                                'c' => 'all',
                                'file' => 'pdf',
                                'title' => $job['name'],
                                'date_time' => $time . ' ngày ' . $date,
                                'address' => $job['address'],
                                'proof' => 1,
                            ]) }}
                        ">
                            <i class="ri-download-line"></i>
                            <b>PDF (Có minh chứng)</b>
                        </a>

                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Họ tên</th>
                                        <th scope="col">Lớp</th>
                                        <th scope="col">MSSV</th>
                                        <th scope="col">Email</th>
                                        <th scope="col">Số ĐT</th>
                                        <th scope="col">Năm sinh</th>
                                        <th scope="col">Giới tính</th>
                                        <th scope="col">Đăng ký lúc</th>
                                        <th scope="col">Minh chứng</th>
                                        <th scope="col">Chức năng</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($users as $index => $user)
                                        <tr>
                                            <th scope="row">{{ $index + 1 }}</th>
                                            <td>
                                                <div class="d-flex px-2 py-1">
                                                    <h5 class="mb-0 font-weight-bold" title="{{$user['name']}}">{{
                                                        str()->title($user['name']) }}</h5>
                                                </div>
                                            </td>
                                            <td>
                                                <span class="text-secondary text-xs font-weight-bold">
                                                    {{
                                                        str()->upper($user['class'])
                                                    }}
                                                </span>
                                            </td>
                                            <td>
                                                <span class="text-secondary text-xs font-weight-bold">
                                                    {{
                                                        $user['mssv']
                                                    }}
                                                </span>
                                            </td>
                                            <td>
                                                <span class="text-secondary text-xs font-weight-bold">
                                                    {{
                                                        $user['email']
                                                    }}
                                                </span>
                                            </td>
                                            <td>
                                                <span class="text-secondary text-xs font-weight-bold">
                                                    {{
                                                        $user['phone']
                                                    }}
                                                </span>
                                            </td>
                                            <td>
                                                <span class="text-secondary text-xs font-weight-bold">
                                                    {{
                                                        date('Y', strtotime($user['birthday']))
                                                    }}
                                                </span>
                                            </td>
                                            <td>
                                                <span class="text-secondary text-xs font-weight-bold">
                                                    @if ($user['sex'] == 1)
                                                        Nam
                                                    @else
                                                        @if ($user['sex'] == 2)
                                                            Nữ
                                                        @else
                                                            Khác
                                                        @endif
                                                    @endif
                                                </span>
                                            </td>
                                            <td>
                                                <span class="text-secondary text-xs font-weight-bold">
                                                    {{
                                                        date("H:i d/m/Y", strtotime($user['time_register']))
                                                    }}
                                                </span>
                                            </td>
                                            <td>
                                                @if ($user['proof'])
                                                    <button type="button" class="btn btn-primary" data-toggle="modal" onclick="openProofModal('{{ $user['name'] }}', '{{$user['proof']}}')" data-target="#jobModalCenter">
                                                        Xem
                                                    </button>
                                                @else
                                                    <span class="text-danger text-xs font-weight-bold">
                                                        Chưa có minh chứng
                                                    </span>
                                                @endif
                                            </td>
                                            <td>
                                                <button type="button" class="btn mb-3 btn-danger rounded-pill"
                                                    onclick="alertModalShow('Cảnh báo', 'Bạn có chắc chắn muốn xóa user khỏi công việc này! Sẽ không khôi phục lại được dữ liệu sau khi xóa!', '{{ route('admin.jobs.delete.user', ['job_id' => $job['id'], 'user_id' => $user['id']]) }}');">
                                                    <i class="ri-delete-bin-line"></i>
                                                    Xóa
                                                </button>
                                            </td>
                                        </tr>
                                    @endforeach
                                    @if (count($users) == 0)
                                        <tr>
                                            <td colspan="9" class="text-center">
                                                <i>Chưa có người đăng ký</i>
                                            </td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        

    </div>

    <div class="modal fade" id="jobModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
           <div class="modal-content">
              <div class="modal-header">
                 <h5 class="modal-title" id="jobModalCenterTitle"></h5>
                 <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                 <span aria-hidden="true">&times;</span>
                 </button>
              </div>
              <div class="modal-body">
                 <img src="" id="proofImg" style="width: 100%" alt="">
              </div>
              <div class="modal-footer">
                 <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              </div>
           </div>
        </div>
     </div>


    @include('admin.layouts.js')

    @include('admin.alerts.modal')
    
    @include('admin.alerts.notifications')

    <script>
        const openProofModal = (title, img) => {
            $('#jobModalCenterTitle').html(title);
            $('#proofImg').attr('src', img);
        }
    </script>

</body>
</html>