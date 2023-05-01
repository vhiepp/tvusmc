@extends('client.master')

@section('head')

    <meta name="description" content="{{ $event['content'] }}">
    
    <meta property="og:type" content="article"/>
    <meta property="og:image" content="{{ $event['thumb'] }}"/>
    <meta property="og:title" content="Sự kiện {{ $event['title'] }}"/>
    <meta property="og:description" content="{{ $event['content'] }}"/>
    <meta property="og:url" content="{{ route('client.events', [
                                            'slug' => $event['slug']
                                        ]) }}"/>
    <meta name="csrf-token" content="{{ csrf_token() }}">

@endsection

@section('header')
        <div class="container mt-3">
            @include('client.components.btn.previous')
        </div>
@endsection

@section('content')

    @php
        $timeStart['time'] = date('H:i', strtotime($event['time_start']));
        $timeStart['date'] = date('d/m/Y', strtotime($event['time_start']));
        $timeEnd['time'] = date('H:i', strtotime($event['time_end']));
        $timeEnd['date'] = date('d/m/Y', strtotime($event['time_end']));

        $timeNow = \App\Helpers\Date::getNow();
    @endphp

    <div class="section section-typography pt-4">

        
        <div class="container">

            <h1 class="font-weight-bold mb-0">
                {{ $event['title'] }}
            </h1>
            <div class="text-dark mb-3">
                <small>
                    <i class="ni ni-calendar-grid-58"></i>
                    {{ 
                        $event['created_at']->day . '/' . $event['created_at']->month . '/' . $event['created_at']->year
                    }}
                </small>
            </div>
            <h4 class="font-weight-bold mb-0">
                Thời gian bắt đầu: {{ $timeStart['time'] }} ngày {{ $timeStart['date'] }}.
            </h4>
            <h4 class="font-weight-bold mb-0">
                Thời gian kết thúc: {{ $timeEnd['time'] }} ngày {{ $timeEnd['date'] }}.
            </h4>
            @if ($event['address'])
            <h4 class="font-weight-bold mb-0">
                Địa điểm: {{ $event['address'] }}.
            </h4>
            @endif

            {!! $event['content'] !!}

            <div class="text-dark mt-3 ">
                <small>
                    (Danh mục: {{ $event['category_name'] }})
                </small>
            </div>

            <div class="mt-4">
                <a class="d-flex align-items-center ">
                    <span class="avatar avatar-xs mr-2">
                        <img alt="avatar" class="rounded" src="{{ $event['user_avatar'] }}">
                    </span>
                    <span class="text-dark font-weight-bold">
                        {{ $event['user_name'] }}
                    </span>
                    
                </a>
            </div>

            <hr class="mt-2">

            @isset($jobs)
                @if ($jobs)
                    <h2 class="h4 text-success font-weight-bold mb-4" id="blogs">
                        <span>Công việc</span>
                    </h2>
                    <div class="row">
                        <div class="col-12">
                            <div class="respon">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Công việc</th>
                                            <th>Mô tả</th>
                                            <th>Địa điểm</th>
                                            <th>Số lượng</th>
                                            <th class="text-right">Đăng ký</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($jobs as $index => $job)

                                            <tr>
                                                <td>{{ $job['name'] }}</td>
                                                <td>{{ $job['description'] }}</td>
                                                <td>
                                                    {{ $job['address'] }}
                                                    <p>
                                                        <small>
                                                            <i>
                                                                {{ date('H:i d/m', strtotime($job['time_start'])) }} đến
                                                                {{ date('H:i d/m/Y', strtotime($job['time_end'])) }}
                                                            </i>
                                                        </small>
                                                    </p>
                                                </td>
                                                <td>{{ $job['user_count'] }}/{{ $job['quantity'] }}</td>
                                                <td class="text-right" style="min-width: 100px">
                                                    @if ($job['user_sub'])
                                                        @if (strtotime($job['time_start']) <= strtotime($timeNow))
                                                            <span class="text-info">
                                                                <small>
                                                                    <label for="proofFile-{{ $job['id'] }}" class="">
                                                                        Minh chứng
                                                                    </label>
                                                                    <br>
                                                                    @if (!$job['proof'])
                                                                        <span class="text-danger" data-toggle="modal" data-target="#proofModal" id="proofStatus-{{ $job['id'] }}">
                                                                            Chưa nộp
                                                                        </span>
                                                                    @else
                                                                        <span class="text-success" style="cursor: pointer" data-toggle="modal" data-target="#proofModal" onclick="proofModal('{{ $job['proof'] }}')" id="proofStatus-{{ $job['id'] }}">
                                                                            Xem
                                                                        </span>
                                                                    @endif
                                                                    <input type="file" name="proofFile" onchange="uploadProof('proofFile-{{ $job['id'] }}' , '{{$job['id']}}')" style="display: none" id="proofFile-{{ $job['id'] }}">
                                                                </small>
                                                            </span>
                                                        @else
                                                            @if (strtotime($job['time_end']) >= strtotime($timeNow))
                                                                <span class="text-success">
                                                                    <small>
                                                                        <i>Đã đăng ký</i>
                                                                    </small>
                                                                </span>
                                                            @endif
                                                        @endif
                                                    @else
                                                        @if ($job['user_count'] < $job['quantity'] && strtotime($job['time_end']) >= strtotime($timeNow))
                                                            <button type="button" rel="tooltip" class="btn btn-success btn-icon btn-sm " onclick="
                                                                jobModal(
                                                                    '{{ route('jobs.sub', ['id' => $job['id']]) }}',
                                                                    '{{ $job['name'] }} (Sự kiện {{ str()->of($event['title'])->limit(40) }})',
                                                                    '{{ date('H:i d/m/Y', strtotime($job['time_start'])) }} đến {{ date('H:i d/m/Y', strtotime($job['time_end'])) }}',
                                                                    '{{ $job['address'] }}',
                                                                    '{{ $job['description'] }}'
                                                                )"
                                                                data-toggle="modal" data-target="#jobModal" title="">
                                                                <i class="ni ni-active-40 pt-1"></i>
                                                            </button>
                                                        @endif
                                                        @if (strtotime($job['time_end']) < strtotime($timeNow))
                                                            <span class="text-danger">
                                                                <small>
                                                                    <i>Đã kết thúc</i>
                                                                </small>
                                                            </span>
                                                        @else
                                                            @if ($job['user_count'] == $job['quantity'])
                                                                <span>
                                                                    <small>
                                                                        <i>Đã đủ số lượng</i>
                                                                    </small>
                                                                </span>
                                                            @endif
                                                        @endif
                                                    @endif                                                    
                                                </td>
                                            </tr>
                                            
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                @endif
            @endisset

        </div>

    </div>

    <!-- Modal -->
    <div class="modal fade" id="jobModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="jobModalLabel"></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="jobModelBody">
                    Thời gian: <b><span id="jobModelBodyTime"></span></b> <br>
                    Địa điểm: <b><span id="jobModelBodyAddress"></span></b> <br>
                    <b><i><span id="jobModelBodyContent"></span></i></b> <br>

                    <span>
                        <small>
                            <i>
                                <b>
                                    Lưu ý:
                                </b>
                                Bạn chắc chắn tham gia sau khi đăng ký, đó là trách nhiệm của bạn, nếu bạn đăng ký mà không tham gia sẽ mất đi slot của rất nhiều người thật sự cần!
                            </i>
                        </small>
                    </span>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <a type="button" href="" class="btn btn-success text-white" id="jobModelBtnSuccess">Đăng ký</a>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="proofModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="jobModalLabel">Minh chứng</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <img src="" id="proofModalImg" style="width: 100%" alt="">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('script')
    
    <script>
        
        const jobModal = (url, title, time, address, content) => {

            $('#jobModalLabel').html(title);
            $('#jobModelBodyTime').html(time);
            $('#jobModelBodyAddress').html(address);
            $('#jobModelBodyContent').html(content);

            $('#jobModelBtnSuccess').attr('href', url)

        }

        const proofModal = (img) => {
            $('#proofModalImg').attr('src', img);
        }

        const uploadProof = (fileId, jobId) => {

            var file_data = $('#' + fileId).prop('files')[0];

            //khởi tạo đối tượng form data
            var form_data = new FormData();
            //thêm files vào trong form data
            form_data.append('file', file_data);
            form_data.append('job_id', jobId);
            form_data.append('_token', $('meta[name="csrf-token"]').attr('content'));
            form_data.enctype = "multipart/form-data";

            $('#proofStatus-' + jobId).html('...');
            
            $.ajax({
                url: '/jobs/proof',
                dataType: 'text',
                cache: false,
                contentType: false,
                processData: false,
                data: form_data,
                type: 'post',
                success: function (res) {

                    const data = JSON.parse(res);

                    document.getElementById('proofStatus-' + jobId).onclick = "";

                    $('#proofStatus-' + jobId).on('click', () => {
                        proofModal(data.img);
                    })

                    document.getElementById('proofStatus-' + jobId).style = 'cursor: pointer';
                    $('#proofStatus-' + jobId).html('Xem');
                    $('#proofStatus-' + jobId).removeClass('text-danger');
                    $('#proofStatus-' + jobId).addClass('text-success');
                }
            });

        }

    </script>

@endsection