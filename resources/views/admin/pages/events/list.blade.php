@extends('admin.master')

@section('head')

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

		#calendar {
			/* 		float: right; */
			margin: 0 auto;
			width: 900px;
			background-color: #FFFFFF;
			border-radius: 6px;
			box-shadow: 0 1px 2px #C3C3C3;
		}
	</style>

@endsection

@section('content')

    @php

        $timeNow = \App\Helpers\Date::getNow();
                
    @endphp

    <div class="row">
        <div class="col-sm-12">
            <a href="{{ route('admin.events.create') }}" class="btn mb-3 btn-success text-white">
                <i class="ri-pen-nib-line"></i>
                Tạo mới
            </a>
        </div>


        <div class="col-sm-12">
            <div class="iq-card">
                <div class="iq-card-header d-flex justify-content-between">
                    <div class="iq-header-title">
                        <h4 class="card-title">
                            Sự kiện sắp tới
                        </h4>
                    </div>
                </div>
                <div class="iq-card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Sự kiện</th>
                                    <th scope="col">Người đăng</th>
                                    <th scope="col">Ngày bắt đầu</th>
                                    <th scope="col">Ngày kết thúc</th>
                                    <th scope="col">Địa điểm</th>
                                    <th scope="col">Ngày tạo</th>
                                    <th scope="col">Chức năng</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($eventsComing as $index => $event)
                                    @php
                                        $timeStart = date("H:i d/m/Y", strtotime($event['time_start']));
                                        $timeEnd = date("H:i d/m/Y", strtotime($event['time_end']));
                                    @endphp
                                    <tr>
                                        <th scope="row">{{ $index + 1 }}</th>
                                        <td>
                                            <div class="d-flex px-2 py-1">
                                                <img src="{{ $event['thumb'] }}" class="align-self-center mr-3" style="width: 70px" alt="#">
                                                <h5 class="mb-0 font-weight-bold" title="{{$event['name']}}">{{
                                                    str()->limit($event['name'], 60) }}</h5>
                                            </div>
                                        </td>
                                        <td>
                                            <p class="font-weight-bold mb-0">{{ str()->title($event['user_name']) }}</p>
                                            <p class="text-xs text-secondary mb-0">{{ str()->upper($event['user_class']) }}</p>
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
                                                    $event['address']
                                                }}
                                            </span>
                                        </td>
                                        <td>
                                            <span class="text-secondary text-xs font-weight-bold">
                                                {{
                                                    $event['created_at']->day . '/' . $event['created_at']->month . '/' . $event['created_at']->year
                                                }}
                                            </span>
                                        </td>
                                        <td>
                                            <a href="{{ route('admin.events.preview', [ 'slug' => $event['slug'] ]) }}" class="btn mb-3 btn-primary rounded-pill text-white">
                                                <i class="ri-eye-line"></i>
                                                Xem
                                            </a>
                                            <a class="btn mb-3 btn-light rounded-pill mx-1" href="{{ route('admin.events.edit', ['slug' => $event['slug']]) }}">
                                                <i class="ri-edit-2-line"></i>
                                                Sửa
                                            </a>
                                            <button type="button" class="btn mb-3 btn-danger rounded-pill"
                                                onclick="alertModalShow('Cảnh báo', 'Bạn chắc chắn muốn xóa sự kiện này! Sẽ không khôi phục lại được dữ liệu sau khi xóa!', '{{ route('admin.events.delete', ['slug' => $event['slug']]) }}');">
                                                <i class="ri-delete-bin-line"></i>
                                                Xóa
                                            </button>
                                            <button type="button" class="btn mb-3 btn-secondary rounded-pill mx-1" onclick="copyText('{{ route('client.events', ['slug' => $event['slug']]) }}')" title="Copy link">
                                                <i class="ri-file-copy-2-line"></i>
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
                            Sự kiện đang diễn ra
                        </h4>
                    </div>
                </div>
                <div class="iq-card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Sự kiện</th>
                                    <th scope="col">Người đăng</th>
                                    <th scope="col">Ngày bắt đầu</th>
                                    <th scope="col">Ngày kết thúc</th>
                                    <th scope="col">Địa điểm</th>
                                    <th scope="col">Ngày tạo</th>
                                    <th scope="col">Chức năng</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($eventsHappening as $index => $event)
                                    @php
                                        $timeStart = date("H:i d/m/Y", strtotime($event['time_start']));
                                        $timeEnd = date("H:i d/m/Y", strtotime($event['time_end']));
                                    @endphp
                                    <tr>
                                        <th scope="row">{{ $index + 1 }}</th>
                                        <td>
                                            <div class="d-flex px-2 py-1">
                                                <img src="{{ $event['thumb'] }}" class="align-self-center mr-3" style="width: 70px" alt="#">
                                                <h5 class="mb-0 font-weight-bold" title="{{$event['name']}}">{{
                                                    str()->limit($event['name'], 60) }}</h5>
                                            </div>
                                        </td>
                                        <td>
                                            <p class="font-weight-bold mb-0">{{ str()->title($event['user_name']) }}</p>
                                            <p class="text-xs text-secondary mb-0">{{ str()->upper($event['user_class']) }}</p>
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
                                                    $event['address']
                                                }}
                                            </span>
                                        </td>
                                        <td>
                                            <span class="text-secondary text-xs font-weight-bold">
                                                {{
                                                    $event['created_at']->day . '/' . $event['created_at']->month . '/' . $event['created_at']->year
                                                }}
                                            </span>
                                        </td>
                                        <td>
                                            <a href="{{ route('admin.events.preview', [ 'slug' => $event['slug'] ]) }}" class="btn mb-3 btn-primary rounded-pill text-white">
                                                <i class="ri-eye-line"></i>
                                                Xem
                                            </a>
                                            <a class="btn mb-3 btn-light rounded-pill mx-1" href="{{ route('admin.events.edit', ['slug' => $event['slug']]) }}">
                                                <i class="ri-edit-2-line"></i>
                                                Sửa
                                            </a>
                                            <button type="button" class="btn mb-3 btn-danger rounded-pill"
                                                onclick="alertModalShow('Cảnh báo', 'Bạn chắc chắn muốn xóa sự kiện này! Sẽ không khôi phục lại được dữ liệu sau khi xóa!', '{{ route('admin.events.delete', ['slug' => $event['slug']]) }}');">
                                                <i class="ri-delete-bin-line"></i>
                                                Xóa
                                            </button>
                                            <button type="button" class="btn mb-3 btn-secondary rounded-pill mx-1" onclick="copyText('{{ route('client.events', ['slug' => $event['slug']]) }}')" title="Copy link">
                                                <i class="ri-file-copy-2-line"></i>
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

        <div class="col-sm-12" id="su-kien-da-ket-thuc">
            <div class="iq-card">
                <div class="iq-card-header d-flex justify-content-between">
                    <div class="iq-header-title">
                        <h4 class="card-title">
                            Sự kiện đã kết thúc
                        </h4>
                    </div>
                </div>
                <div class="iq-card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Sự kiện</th>
                                    <th scope="col">Người đăng</th>
                                    <th scope="col">Ngày bắt đầu</th>
                                    <th scope="col">Ngày kết thúc</th>
                                    <th scope="col">Địa điểm</th>
                                    <th scope="col">Ngày tạo</th>
                                    <th scope="col">Chức năng</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($eventsOver as $index => $event)
                                    @php
                                        $timeStart = date("H:i d/m/Y", strtotime($event['time_start']));
                                        $timeEnd = date("H:i d/m/Y", strtotime($event['time_end']));
                                    @endphp
                                    <tr>
                                        <th scope="row">{{ $index + 1 }}</th>
                                        <td>
                                            <div class="d-flex px-2 py-1">
                                                <img src="{{ $event['thumb'] }}" class="align-self-center mr-3" style="width: 70px" alt="#">
                                                <h5 class="mb-0 font-weight-bold" title="{{$event['name']}}">{{
                                                    str()->limit($event['name'], 60) }}</h5>
                                            </div>
                                        </td>
                                        <td>
                                            <p class="font-weight-bold mb-0">{{ str()->title($event['user_name']) }}</p>
                                            <p class="text-xs text-secondary mb-0">{{ str()->upper($event['user_class']) }}</p>
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
                                                    $event['address']
                                                }}
                                            </span>
                                        </td>
                                        <td>
                                            <span class="text-secondary text-xs font-weight-bold">
                                                {{
                                                    $event['created_at']->day . '/' . $event['created_at']->month . '/' . $event['created_at']->year
                                                }}
                                            </span>
                                        </td>
                                        <td>
                                            <a href="{{ route('admin.events.preview', [ 'slug' => $event['slug'] ]) }}" class="btn mb-3 btn-primary rounded-pill text-white">
                                                <i class="ri-eye-line"></i>
                                                Xem
                                            </a>
                                            <a class="btn mb-3 btn-light rounded-pill mx-1" href="{{ route('admin.events.edit', ['slug' => $event['slug']]) }}">
                                                <i class="ri-edit-2-line"></i>
                                                Sửa
                                            </a>
                                            <button type="button" class="btn mb-3 btn-danger rounded-pill"
                                                onclick="alertModalShow('Cảnh báo', 'Bạn chắc chắn muốn xóa sự kiện này! Sẽ không khôi phục lại được dữ liệu sau khi xóa!', '{{ route('admin.events.delete', ['slug' => $event['slug']]) }}');">
                                                <i class="ri-delete-bin-line"></i>
                                                Xóa
                                            </button>
                                            <button type="button" class="btn mb-3 btn-secondary rounded-pill mx-1" onclick="copyText('{{ route('client.events', ['slug' => $event['slug']]) }}')" title="Copy link">
                                                <i class="ri-file-copy-2-line"></i>
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        
                    </div>
                    {{ view('admin.components.paginate', [
                                'items' => $eventsOver,
                            ]) }}
                </div>
            </div>
        </div>

        <div class="col-sm-12">
            <div class="iq-card">
                <div class="iq-card-header d-flex justify-content-between">
                    <div class="iq-header-title">
                        <h4 class="card-title">
                            Lịch sự kiện
                        </h4>
                    </div>
                </div>
                <div class="iq-card-body">
                    <span class="badge badge-info">Sắp diễn ra</span>
                    <span class="badge badge-success">Đang diễn ra</span>
                    <span class="badge badge-danger">Đã kết thúc</span>
                    <div class="table-responsive">
                        <table class="table">
                            <tbody>
                                <tr>
                                    <td>
                                        <div id='calendar'></div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                </div>
            </div>
        </div>

    @include('admin.alerts.modal')
@endsection

@section('script')

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
            fetch('/api/events/gets/admin')
                .then(function(response) {
                    if (!response.ok) {
                        throw Error(response.statusText);
                    }
                    return response.json();
                })
                .then(function(responseAsJson) {

                    var events = [];

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
                    console.log(events);

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

                    var calendar = $('#calendar').fullCalendar({
                        header: {
                            left: 'title',
                            center: 'prev agendaDay,agendaWeek,month,year next',
                            right: 'prevYear,nextYear today'
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
                            $('#calendar').fullCalendar('renderEvent', copiedEventObject, true);

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