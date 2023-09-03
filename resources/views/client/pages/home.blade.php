@extends('client.master')


@section('header')

    @include('client.layouts.header')

@endsection

@section('head')

    <meta name="description" content="Nắm bắt xu hướng – Phát triển đam mê, TVU Social Media Club">

    <meta property="og:type" content="article" />
    <meta property="og:image" content="/assets/img/bg.jpg" />

    <meta property="og:title" content="TVU Social Media Club" />
    <meta property="og:description" content="Nắm bắt xu hướng – Phát triển đam mê, TVU Social Media Club" />
    <meta property="og:url" content="https://tvusmc.com" />

    <link rel="stylesheet" href="/assets/css/files.css">
    <link rel="stylesheet" href="/assets/css/loading.css">
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

    .spinnerIconWrapper.file {
        position: absolute;
        height: 304px;
        min-height: 304px;
        top: 0;
        left: 0;
        right: 0;
        background-color: #0016346b;
        border-radius: .3rem;
        display: inline-block;
        margin: 0 0 20px 0;
    }

    .pagination.file {
        position: absolute;
        bottom: -36px;
        left: 0;
        right: 0;
    }

    .pagination.ul {
        bottom: -12px;
    }

    .btn-file-all {
        position: absolute;
        right: 3px;
        bottom: 0;
    }
</style>
@endsection

@section('content')

    <div class="section section-typography">

        <div class="container">

            <div class="row">

                <div class="col-md-7">
                    {!! view('client.components.events.list', [
                        'header' => 'Sự kiện mới nhất',
                        'events' => $events,
                    ]) !!}
                    <div class="row">
                        <div class="col-12" style="display: flex; justify-content: right">
                            <a href="{{ route('client.events.list') }}" type="button" class="btn btn-link text-info">
                                tất cả
                                <i class='bx bx-right-arrow-alt'></i>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-md-5" style="position: relative; min-height: 543px" id="blogs">
                    <h2 class="h4 text-success font-weight-bold mb-4">
                        <span>Bài viết</span>
                    </h2>
                </div>
                <div class="col-12 my-5" style="position: relative;" >
                    <h2 class="h4 text-success font-weight-bold mb-4">
                        <span>Văn bản / Danh sách</span>
                    </h2>

                    <div class="row" style="position: relative; min-height: 316px" id="file-danhsach">

                        <div class="col-12 text-center">
                            <small >
                                Chưa có văn bản / danh sách
                            </small>
                        </div>

                    </div>
                </div>
                <div class="col-md-12 ">
                    <h2 class="h4 text-success font-weight-bold my-4" >
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

        </div>

    </div>

@endsection

@section('script')

<style>
    .text-clip {
        display: block;
        max-width: calc(100% - 20px);
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }
    .cursor-pointer {
        cursor: pointer;
    }
</style>

    <script src="https://unpkg.com/react@18/umd/react.production.min.js" crossorigin></script>
    <script src="https://unpkg.com/react-dom@18/umd/react-dom.production.min.js" crossorigin></script>
    <script src="https://unpkg.com/babel-standalone@6/babel.min.js"></script>
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>

    <script type="text/babel">

        const { useState, useMemo} = React;

        const Blog = (props) => {
            return (
                <a className="col-md-12 mb-2 list-item" href={props.url}>
                    <div className="thumb">
                        <img src={ props.thumb } alt="Raised image" className="rounded shadow-lg" />
                    </div>
                    <div className="content">
                        <div className="col-12 title" title={ props.title }>
                            <span className="text-dark">
                                { props.shortTitle }
                            </span>
                        </div>
                        <div className="col-12">
                            <span className="text-muted">
                                <small>
                                    { props.date }
                                </small>
                            </span>
                        </div>
                    </div>
                </a>
            );
        }

        const Blogs = (props) => {
            const [blogs, setBlogs] = useState([]);
            const [loading, setLoading] = useState(true);
            const [pageUrl, setPageUrl] = useState({pre: '#', next: '#'});
            const [url, setUrl] = useState('/api/blogs/gets');

            useMemo(() => {
                axios({
                        method: 'post',
                        url: url,
                    })
                    .then(function (response) {
                        setBlogs(response.data.data);
                        setPageUrl({
                            pre: response.data.prev_page_url,
                            next: response.data.next_page_url
                        });
                        setLoading(false);
                    })
                    .catch(e => {
                        setLoading(false);
                    })
            }, [url])

            const handlePageUrl = (url) => {
                setUrl(url);
                if (url) {
                    setLoading(true);
                }
            }

            return (
                <span >
                    <h2 className="h4 text-success font-weight-bold mb-4">
                        <span>Bài viết</span>
                    </h2>
                    <div className="row blogs-list">
                        {
                            blogs.map(blog => (
                                <Blog
                                    url={blog.url}
                                    thumb={blog.thumb}
                                    title={blog.title}
                                    shortTitle={blog.short_title}
                                    date={blog.post_at}
                                />
                            ))
                        }
                        {
                            loading && (<div className="spinnerIconWrapper ">
                                            <div className="spinnerIcon"></div>
                                        </div>)
                        }


                    </div>
                    <div className="row mt-2 pagination">
                        <div className="col-12">
                            <nav aria-label="Page navigation example">
                                <ul className="pagination justify-content-center">

                                    {pageUrl.pre && <li className="page-item" title="trước" onClick={() => handlePageUrl(pageUrl.pre)}>
                                        <span className="page-link no-loader" >
                                            <i className="fa fa-angle-left"></i>
                                            <span className="sr-only">Previous</span>
                                        </span>
                                    </li>}

                                    {pageUrl.next && <li className="page-item" title="sau" onClick={() => handlePageUrl(pageUrl.next)}>
                                        <span className="page-link no-loader" >
                                            <i className="fa fa-angle-right"></i>
                                            <span className="sr-only">Next</span>
                                        </span>
                                    </li>}
                                </ul>
                            </nav>
                        </div>
                    </div>
                </span>
            );
        }

        ReactDOM.createRoot(document.getElementById('blogs')).render(<Blogs/>);
    </script>

    <script type="text/babel">
        const { useState, useMemo } = React;

        const FileItem = (props) => {
            const handleRedirectToDetail = () => {
                window.location.href = '/van-ban/' + props.slug;
            }

            return (
                <div className="col-md-6 p-2 col-12 file-item cursor-pointer" onClick={handleRedirectToDetail} title={props.title}>

                    <div className="file-item_content">

                        <div className="file-item_thumb">
                            <img src={props.thumb} alt={props.title} />
                        </div>

                        <div className="file-item_name px-2">
                            <span className="text-xs font-weight-bold text-clip">
                                { props.title }
                            </span>
                            <small>
                                { props.date }, có {props.fileCount} file đính kèm.
                            </small>
                        </div>
                    </div>
                </div>
            );
        }

        const FileList = (props) => {
            const [files, setFiles] = useState([]);
            const [loading, setLoading] = useState(true);
            const [pageUrl, setPageUrl] = useState({pre: '#', next: '#'});
            const [url, setUrl] = useState(props.url);

            useMemo(() => {
                axios({
                        method: 'get',
                        url,
                        params: {
                            paginate: 6
                        },
                        headers: {
                            "Content-Type": "application/json"
                        }
                    })
                    .then(function (response) {
                        if (response.data.data.length > 0) {
                            setFiles(response.data.data);
                            console.log(response.data);
                        }

                        setPageUrl({
                            pre: response.data.prev_page_url,
                            next: response.data.next_page_url
                        });
                        setLoading(false);
                    })
                    .catch(e => {
                        setLoading(false);
                    })
            }, [url])

            const handlePageUrl = (url) => {
                setUrl(url);
                if (url) {
                    setLoading(true);
                }
            }

            const handleFileAllUrl = () => {
                window.location.href = "/van-ban";
            }

            return (
                <React.Fragment>
                    {
                        files.map(file => (
                            <FileItem
                                key={file.id}
                                title={file.title}
                                date={file.post_at}
                                thumb={file.thumb}
                                slug={file.slug}
                                fileCount={file.files_count}
                            />
                        ))
                    }
                    {
                        files.length == 0 && (
                            <div class="col-12 text-center">
                                <small >
                                    Chưa có văn bản / danh sách nào
                                </small>
                            </div>
                        )
                    }
                    {
                        loading && (<div className="spinnerIconWrapper file">
                                        <div className="spinnerIcon"></div>
                                    </div>)
                    }

                    <div className="col-12 pagination file">

                        <nav aria-label="Page navigation example">
                            <ul className="pagination ul justify-content-center">

                                {pageUrl.pre && <li className="page-item" title="trước" onClick={() => handlePageUrl(pageUrl.pre)}>
                                    <span className="page-link no-loader" >
                                        <i className="fa fa-angle-left"></i>
                                        <span className="sr-only">Previous</span>
                                    </span>
                                </li>}

                                {pageUrl.next && <li className="page-item" title="sau" onClick={() => handlePageUrl(pageUrl.next)}>
                                    <span className="page-link no-loader" >
                                        <i className="fa fa-angle-right"></i>
                                        <span className="sr-only">Next</span>
                                    </span>
                                </li>}
                            </ul>
                        </nav>

                        <button class="btn btn-link text-info btn-file-all" onClick={handleFileAllUrl}>
                            tất cả
                            <i class='bx bx-right-arrow-alt'></i>
                        </button>
                    </div>


                </React.Fragment>
            );
        }

        ReactDOM.createRoot(document.getElementById('file-danhsach')).render(<FileList url="/api/documents" />);
    </script>

    <style>
        .pagination {
            position: absolute;
            bottom: -6px;
            left: 15px;
            right: 15px;
        }
    </style>

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
