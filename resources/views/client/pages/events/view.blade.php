@extends('client.master')

@section('head')

    <meta name="description" content="{{ $event['title'] }}">

    <meta property="og:type" content="article"/>
    <meta property="og:image" content="{{ $event['thumb'] }}"/>
    <meta property="og:title" content="{{ $event['title'] }} | Sự kiện"/>
    <meta property="og:description" content="{{ $event['title'] }}"/>
    <meta property="og:url" content="{{ route('client.events', [
                                            'slug' => $event['slug']
                                        ]) }}"/>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="/assets/css/style-content.css">
    <style>
        #wrap {
            width: 1100px;
            margin: 0 auto;
        }

        #external-events {
            float: left;
            width: 150px;
            padding: 0 10px;
            text-align: left;
        }

        #external-events h4 {
            font-size: 16px;
            margin-top: 0;
            padding-top: 1em;
        }

        .external-event {
            /* try to mimick the look of a real event */
            margin: 10px 0;
            padding: 2px 4px;
            background: #3366CC;
            color: #fff;
            font-size: .85em;
            cursor: pointer;
        }

        #external-events p {
            margin: 1.5em 0;
            font-size: 11px;
            color: #666;
        }

        #external-events p input {
            margin: 0;
            vertical-align: middle;
        }

        #calendar1,
        #calendar2 {
            /* 		float: right; */
            margin: 0 auto;
            width: 956px;
            background-color: #FFFFFF;
            border-radius: 6px;
            box-shadow: 0 1px 2px #C3C3C3;
        }

    </style>

@endsection

@section('header')
    <div id="fb-root"></div>
    <script async defer crossorigin="anonymous" src="https://connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v17.0&appId=248551038101480&autoLogAppEvents=1" nonce="p4pyyugH"></script>
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
            <small>
                <i>
                    @if (strtotime($event['time_start']) > strtotime($timeNow))
                        <span class="text-info">Sắp tới</span>
                    @endif
                    @if (strtotime($event['time_start']) <= strtotime($timeNow) && strtotime($timeNow) <= strtotime($event['time_end']))
                        <span class="text-success">Đang diễn ra</span>
                    @endif
                    @if (strtotime($event['time_end']) < strtotime($timeNow))
                        <span class="text-danger">Đã kết thúc</span>
                    @endif
                </i>
            </small>
            <h1 class="font-weight-bold mb-0">
                {{ $event['title'] }}
            </h1>
            <div class="text-dark mb-3 d-flex justify-content-between">
                <small>
                    <i class="ni ni-calendar-grid-58"></i>
                    {{
                        $event['created_at']->day . '/' . $event['created_at']->month . '/' . $event['created_at']->year
                    }}
                </small>
                <div
                    class="fb-share-button"
                    data-href="{{route('client.events', ['slug' => $event['slug']])}}"
                    data-layout="button_count"
                    data-size="small">
                        <a target="_blank"
                            href="https://www.facebook.com/sharer/sharer.php?u=https%3A%2F%2Fdevelopers.facebook.com%2Fdocs%2Fplugins%2F&amp;src=sdkpreparse"
                            class="fb-xfbml-parse-ignore">Chia sẻ</a>
                </div>
            </div>
            <hr class="mt-2">
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
            <div class="ck-content">
                {!! $event['content'] !!}
            </div>

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
                        <span>Công việc / hoạt động</span>
                    </h2>
                    <div class="row">
                        <div class="col-12">
                            <div class="respon">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th style="min-width: 120px">Đăng ký</th>
                                            <th style="min-width: 250px">Công việc</th>
                                            <th style="min-width: 350px">Mô tả</th>
                                            <th style="min-width: 200">Địa điểm</th>
                                            <th>Số lượng</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($jobs as $index => $job)

                                            <tr>
                                            <td style="min-width: 100px">
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
                                                            <button type="button" rel="tooltip" class="btn btn-success btn-icon btn-md " onclick="
                                                                jobModal(
                                                                    '{{ route('jobs.sub', ['id' => $job['id']]) }}',
                                                                    '{{ $job['name'] }} (Sự kiện {{ str()->of($event['title'])->limit(40) }})',
                                                                    '{{ date('H:i d/m/Y', strtotime($job['time_start'])) }} đến {{ date('H:i d/m/Y', strtotime($job['time_end'])) }}',
                                                                    '{{ $job['address'] }}',
                                                                    `{{ $job['description'] }}`
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
                                                
                                            </tr>

                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                @endif
            @endisset
            <hr class="mt-2">
            <h2 class="h5 text-success font-weight-bold mb-4">
                <span>Bình luận</span>
            </h2>
            <div class="fb-comments"
                data-href="{{route('client.events', ['slug' => $event['slug']])}}"
                data-width="100%" data-numposts="3">
            </div>
            <hr class="mt-2">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="h4 text-success font-weight-bold mb-4" id="blogs">
                        <span>Lịch sự kiện / công việc / hoạt động</span>
                    </h2>
                    <div class="row">
                        <div class="col-12">
                            <div class="nav-wrapper">
                                <ul class="nav nav-pills nav-fill flex-column flex-md-row" id="tabs-text" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link mb-sm-12 mb-md-0 active no-loader" id="tabs-text-1-tab" data-toggle="tab" href="#tabs-text-1" role="tab" aria-controls="tabs-text-1" aria-selected="true">Sự kiện</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link mb-sm-12 mb-md-0 no-loader" id="tabs-text-2-tab" data-toggle="tab" href="#tabs-text-2" role="tab" aria-controls="tabs-text-2" aria-selected="false">Công việc</a>
                                    </li>
                                </ul>
                            </div>
                            <div class="card shadow">
                                <div class="card-body">
                                    <div class="tab-content" id="myTabContent">
                                        <div class="tab-pane fade active show" id="tabs-text-1" role="tabpanel" aria-labelledby="tabs-text-1-tab">
                                            <div class="respon">
                                                <table class="table-responsive">
                                                    <tr>
                                                        <td>
                                                            <span class="badge badge-pill badge-info text-uppercase">
                                                                Sắp tới
                                                            </span>
                                                            <span class="badge badge-pill badge-success text-uppercase">
                                                                Đang diễn ra
                                                            </span>
                                                            <span class="badge badge-pill badge-danger text-uppercase">
                                                                Đã kết thúc
                                                            </span>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <div id='calendar1'></div>
                                                        </td>
                                                    </tr>
                                                </table>
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="tabs-text-2" role="tabpanel" aria-labelledby="tabs-text-2-tab">
                                            <div id='calendar2'></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

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

<link href='/assets/fullcalendar/css/fullcalendar.css' rel='stylesheet' />
<link href='/assets/fullcalendar/css/fullcalendar.print.css' rel='stylesheet' media='print' />
<script src='/assets/fullcalendar/js/jquery-1.10.2.js' type="text/javascript"></script>
<script src='/assets/fullcalendar/js/jquery-ui.custom.min.js' type="text/javascript"></script>
<script src='/assets/fullcalendar/js/fullcalendar.js' type="text/javascript"></script>
<script>

    $(document).ready(function () {
        var date = new Date();
        var d = date.getDate();
        var m = date.getMonth();
        var y = date.getFullYear();

        /*  className colors

        className: default(transparent), important(red), chill(pink), success(green), info(blue)

        */


        /* initialize the external events
        -----------------------------------------------------------------*/
        fetch('/api/events/gets/client')
            .then(function(response) {
                if (!response.ok) {
                    throw Error(response.statusText);
                }
                return response.json();
            })
            .then(function(responseAsJson) {

                let events = [];

                responseAsJson.forEach(data => {

                    events.push(
                        {
                        title: data.title,
                        start: new Date(data.start.y, data.start.m - 1, data.start.d, data.start.h, data.start.i),
                        end: new Date(data.end.y, data.end.m - 1, data.end.d, data.end.h, data.end.i),
                        allDay: data.allDay,
                        url: data.url,
                        className: data.status,
                    })

                });

                $('#external-events div.external-event').each(function () {

                // create an Event Object (http://arshaw.com/fullcalendar/docs/event_data/Event_Object/)
                // it doesn't need to have a start or end
                var eventObject = {
                    title: $.trim($(this).text()) // use the element's text as the event title
                };

                // store the Event Object in the DOM element so we can get to it later
                $(this).data('eventObject', eventObject);

                // make the event draggable using jQuery UI
                $(this).draggable({
                    zIndex: 999,
                    revert: true,      // will cause the event to go back to its
                    revertDuration: 0  //  original position after the drag
                });

                });


                /* initialize the calendar
                -----------------------------------------------------------------*/

                var calendar = $('#calendar1').fullCalendar({
                    header: {
                        left: 'title',
                        center: 'prev agendaDay,agendaWeek,month next',
                        right: 'today'
                    },
                    editable: false,
                    firstDay: 1, //  1(Monday) this can be changed to 0(Sunday) for the USA system
                    selectable: false,
                    defaultView: 'month',

                    axisFormat: 'H:mm',
                    columnFormat: {
                        month: 'ddd',    // Mon
                        week: 'ddd d/M', // Mon 7/9
                        day: 'dddd d/M',  // Monday 9/7
                        agendaDay: 'dddd d/M'
                    },
                    titleFormat: {
                        month: 'MM / yyyy', // September 2009
                        week: "MM / yyyy", // September 2009
                        day: 'dddd d/M/yyyy'                  // Tuesday, Sep 8, 2009
                    },
                    allDaySlot: false,
                    selectHelper: true,
                    droppable: false, // this allows things to be dropped onto the calendar !!!
                    drop: function (date, allDay) { // this function is called when something is dropped

                        // retrieve the dropped element's stored Event Object
                        var originalEventObject = $(this).data('eventObject');

                        // we need to copy it, so that multiple events don't have a reference to the same object
                        var copiedEventObject = $.extend({}, originalEventObject);

                        // assign it the date that was reported
                        copiedEventObject.start = date;
                        copiedEventObject.allDay = allDay;

                        // render the event on the calendar
                        // the last `true` argument determines if the event "sticks" (http://arshaw.com/fullcalendar/docs/event_rendering/renderEvent/)
                        $('#calendar1').fullCalendar('renderEvent', copiedEventObject, true);

                        // is the "remove after drop" checkbox checked?
                        if ($('#drop-remove').is(':checked')) {
                            // if so, remove the element from the "Draggable Events" list
                            $(this).remove();
                        }

                    },

                    events: events,
                });

            })
            .catch(function(error) {
                console.log('Looks like there was a problem: \n', error);
            })


    });

</script>

@endsection
