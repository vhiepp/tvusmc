@extends('client.master')

@section('head')

<meta name="description" content="Sự kiện TVU Social Media Club | Nắm bắt xu hướng – Phát triển đam mê">
    
    <meta property="og:type" content="article"/>
    <meta property="og:image" content="/assets/img/bg.jpg"/>
    <meta property="og:title" content="Sự kiện | TVU Social Media Club"/>
    <meta property="og:description" content="TVU Social Media Club | Nắm bắt xu hướng – Phát triển đam mê | Sự kiện"/>
    <meta property="og:url" content="{{ route('client.events.list') }}"/>

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
        <div class="container mt-3">
            @include('client.components.btn.previous')
        </div>
@endsection

@section('content')

    <div class="section section-typography pt-4">
            
        <div class="container">

            <h2 class="h4 text-success font-weight-bold mb-4">
                <span>
                    Sự kiện đang diễn ra
                </span>
            </h2>
            <div class="row">

                @foreach ($eventsHappening as $index => $event)
                    <div class="col-md-6 col-lg-4 col-12 mb-3">
                        <div class="item">
                            <div class="item-header">
                                <a href="{{ route('client.events', ['slug' => $event['slug']]) }}" title="{{ $event['name'] }}">
                                    <img src="{{ $event['thumb'] }}" class="item-header_img" alt="{{ $event['name'] }}">
                                </a>
                            </div>
                            <div class="item-body">
                                <a href="{{ route('client.events', ['slug' => $event['slug']]) }}" title="{{$event['name']}}">
                                    <h3 class="item-body_title">{{ str()->of($event['name'])->limit(60) }}</h3>
                                </a>
                                <small class="item-body_admin">
                                    <span>
                                        <small>
                                            <b>{{ $event['user_name'] }}</b>
                                            đăng ngày {{ date('d/m/y', strtotime($event['created_at'])) }}
                                        </small>
                                    </span> <br> <br>
                                    <span>
                                        <b>Bắt đầu: </b>
                                        {{ date('H:i', strtotime($event['time_start'])) }} ngày {{ date('d/m/Y', strtotime($event['time_start'])) }}
                                    </span> <br>
                                    <span>
                                        <b>Kết thúc: </b>
                                        {{ date('H:i', strtotime($event['time_end'])) }} ngày {{ date('d/m/Y', strtotime($event['time_end'])) }}
                                    </span> <br> <br>
                                    <span>
                                        {{ str()->of($event['description'])->limit(80) }}
                                    </span>
                                </small>
                            </div>
                        </div>
                    </div>
                @endforeach

            </div>
            @if (count($eventsHappening) == 0)
                <h6 class="h6 text-center font-weight-bold mb-4">
                    <span>
                        <small>
                            <i>
                                Không tồn tại sự kiện
                            </i>
                        </small>
                    </span>
                </h6>
            @endif

            <h2 class="h4 text-success font-weight-bold mb-4 mt-5">
                <span>
                    Sự kiện sắp tới
                </span>
            </h2>
            <div class="row">

                @foreach ($eventsComing as $index => $event)
                    <div class="col-md-6 col-lg-4 col-12 mb-3">
                        <div class="item">
                            <div class="item-header">
                                <a href="{{ route('client.events', ['slug' => $event['slug']]) }}" title="{{ $event['name'] }}">
                                    <img src="{{ $event['thumb'] }}" class="item-header_img" alt="{{ $event['name'] }}">
                                </a>
                            </div>
                            <div class="item-body">
                                <a href="{{ route('client.events', ['slug' => $event['slug']]) }}" title="{{$event['name']}}">
                                    <h3 class="item-body_title">{{ str()->of($event['name'])->limit(60) }}</h3>
                                </a>
                                <small class="item-body_admin">
                                    <span>
                                        <small>
                                            <b>{{ $event['user_name'] }}</b>
                                            đăng ngày {{ date('d/m/y', strtotime($event['created_at'])) }}
                                        </small>
                                    </span> <br> <br>
                                    <span>
                                        <b>Bắt đầu: </b>
                                        {{ date('H:i', strtotime($event['time_start'])) }} ngày {{ date('d/m/Y', strtotime($event['time_start'])) }}
                                    </span> <br>
                                    <span>
                                        <b>Kết thúc: </b>
                                        {{ date('H:i', strtotime($event['time_end'])) }} ngày {{ date('d/m/Y', strtotime($event['time_end'])) }}
                                    </span> <br> <br>
                                    <span>
                                        {{ str()->of($event['description'])->limit(80) }}
                                    </span>
                                </small>
                            </div>
                        </div>
                    </div>
                @endforeach

            </div>
            @if (count($eventsComing) == 0)
                <h6 class="h6 text-center font-weight-bold mb-4">
                    <span>
                        <small>
                            <i>
                                Không tồn tại sự kiện
                            </i>
                        </small>
                    </span>
                </h6>
            @endif

            <h2 class="h4 text-success font-weight-bold mb-4 mt-5" id="su-kien-da-ket-thuc">
                <span>
                    Sự kiện đã kết thúc
                </span>
            </h2>
            <div class="row">

                @foreach ($eventsOver as $index => $event)
                    <div class="col-md-6 col-lg-4 col-12 mb-3">
                        <div class="item">
                            <div class="item-header">
                                <a href="{{ route('client.events', ['slug' => $event['slug']]) }}" title="{{ $event['name'] }}">
                                    <img src="{{ $event['thumb'] }}" class="item-header_img" alt="{{ $event['name'] }}">
                                </a>
                            </div>
                            <div class="item-body">
                                <a href="{{ route('client.events', ['slug' => $event['slug']]) }}" title="{{$event['name']}}">
                                    <h3 class="item-body_title">{{ str()->of($event['name'])->limit(60) }}</h3>
                                </a>
                                <small class="item-body_admin">
                                    <span>
                                        <small>
                                            <b>{{ $event['user_name'] }}</b>
                                            đăng ngày {{ date('d/m/y', strtotime($event['created_at'])) }}
                                        </small>
                                    </span> <br> <br>
                                    <span>
                                        <b>Bắt đầu: </b>
                                        {{ date('H:i', strtotime($event['time_start'])) }} ngày {{ date('d/m/Y', strtotime($event['time_start'])) }}
                                    </span> <br>
                                    <span>
                                        <b>Kết thúc: </b>
                                        {{ date('H:i', strtotime($event['time_end'])) }} ngày {{ date('d/m/Y', strtotime($event['time_end'])) }}
                                    </span> <br> <br>
                                    <span>
                                        {{ str()->of($event['description'])->limit(80) }}
                                    </span>
                                </small>
                            </div>
                        </div>
                    </div>
                @endforeach

                @if (count($eventsOver) == 0)
                    <div class="col-12">
                        <h6 class="h6 text-center font-weight-bold mb-4">
                            <span>
                                <small>
                                    <i>
                                        Không tồn tại sự kiện
                                    </i>
                                </small>
                            </span>
                        </h6>
                    </div>
                @endif

                <div class="col-12">
                    {{ view('client.components.paginate', [
                        'items' => $eventsOver,
                    ]) }}
                </div>

            </div>
            

            <h2 class="h4 text-success font-weight-bold mb-4 mt-5" id="blogs">
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
                                            <tbody>
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
                                            </tbody>
                                        </table>
                                    </div>
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