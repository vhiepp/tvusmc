@extends('admin.master')

@php
    $year = date('Y');
    $month = date('m');
@endphp

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6 col-lg-3">
                <div class="iq-card iq-card-block iq-card-stretch iq-card-height overflow-hidden">
                    <div class="iq-card-body pb-0">
                    <div class="rounded-circle iq-card-icon iq-bg-success"><i class="ri-group-line"></i></div>
                    <span class="float-right line-height-6">Tổng thành viên</span>
                    <div class="clearfix"></div>
                    <div class="text-center">
                        <h2 class="mb-0"><span class="counter">{{$totalUser}}</span></h2>
                        {{-- <p class="mb-0 text-secondary line-height"><i
                                class="ri-arrow-up-line text-success mr-1"></i><span class="text-success">30%</span>
                            Increased</p> --}}
                    </div>
                    </div>
                    <div id="chart-3"></div>
                </div>
            </div>
            <div class="col-md-6 col-lg-3">
                <div class="iq-card iq-card-block iq-card-stretch iq-card-height overflow-hidden">
                    <div class="iq-card-body pb-0">
                    <div class="rounded-circle iq-card-icon iq-bg-primary"><i class="ri-calendar-event-line"></i>
                    </div>
                    <span class="float-right line-height-6">Tổng sự kiện</span>
                    <div class="clearfix"></div>
                    <div class="text-center">
                        <h2 class="mb-0"><span class="counter">{{$totalEvent}}</span></h2>
                        {{-- <p class="mb-0 text-secondary line-height"><i
                                class="ri-arrow-up-line text-success mr-1"></i><span class="text-success">10%</span>
                            Increased</p> --}}
                    </div>
                    </div>
                    <div id="chart-1"></div>
                </div>
            </div>
            <div class="col-md-6 col-lg-3">
                <div class="iq-card iq-card-block iq-card-stretch iq-card-height overflow-hidden">
                    <div class="iq-card-body pb-0">
                    <div class="rounded-circle iq-card-icon iq-bg-info"><i class="ri-vidicon-2-line"></i>
                    </div>
                    <span class="float-right line-height-6">Việc trong tháng</span>
                    <div class="clearfix"></div>
                    <div class="text-center">
                        <h2 class="mb-0"><span class="counter">{{$jobInMonth}}</span></h2>
                        <p class="mb-0 text-secondary line-height" title="{{$userJoinJobInMonth}} thành viên tham gia trên tổng cộng {{$jobInMonth}} công việc">
                            <span class="font-weight-bold">{{$userJoinJobInMonth}}</span> <i class="ri-group-line text-success mx-1"></i> tham gia
                        </p>
                    </div>
                    </div>
                    <div id="chart-4"></div>
                </div>
            </div>
            <div class="col-md-6 col-lg-3">
                <div class="iq-card iq-card-block iq-card-stretch iq-card-height overflow-hidden">
                    <div class="iq-card-body pb-0">
                    <div class="rounded-circle iq-card-icon iq-bg-warning"><i class="ri-profile-line"></i>
                    </div>
                    <span class="float-right line-height-6">Tổng bài viết</span>
                    <div class="clearfix"></div>
                    <div class="text-center">
                        <h2 class="mb-0"><span class="counter">{{$totalBlog}}</span></h2>
                        {{-- <p class="mb-0 text-secondary line-height"><i
                                class="ri-arrow-up-line text-success mr-1"></i><span class="text-success">20%</span>
                            Increased</p> --}}
                    </div>
                    </div>
                    <div id="chart-2"></div>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="iq-card">
                    <div class="iq-card-header d-flex justify-content-between">
                    <div class="iq-header-title">
                        <h4 class="card-title">Thành viên tham gia công việc tháng này</h4>
                    </div>
                    <div class="iq-card-header-toolbar d-flex align-items-center">
                        <div class="dropdown">
                            <span class="dropdown-toggle text-primary" id="dropdownMenuButton5"
                                data-toggle="dropdown">
                                <i class="ri-more-2-fill"></i>
                            </span>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
                                <a class="dropdown-item" href="#"><i class="ri-eye-fill mr-2"></i>View</a>
                                <a class="dropdown-item" href="#"><i class="ri-delete-bin-6-fill mr-2"></i>Delete</a>
                                <a class="dropdown-item" href="#"><i class="ri-pencil-fill mr-2"></i>Edit</a>
                                <a class="dropdown-item" href="#"><i class="ri-printer-fill mr-2"></i>Print</a>
                                <a class="dropdown-item" href="#"><i
                                    class="ri-file-download-fill mr-2"></i>Download</a>
                            </div>
                        </div>
                    </div>
                    </div>
                    <div class="iq-card-body">
                    <div class="table-responsive">
                        <table class="table mb-0 table-borderless">
                            <thead>
                                <tr>
                                    <th scope="col">Mssv</th>
                                    <th scope="col">Họ Tên</th>
                                    <th scope="col">Lớp</th>
                                    <th scope="col">Số ĐT</th>
                                    <th scope="col">Tham gia</th>
                                    <th scope="col">Tỉ lệ tham gia</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($listUserJoinJobInMonth as $index => $userJoinJob)
                                    @php
                                        $user = $userJoinJob['user'];
                                    @endphp
                                    <tr>
                                        <td>
                                            <b>{{$user['mssv']}}</b>
                                        </td>
                                        <td>
                                            <img class="rounded-circle img-fluid avatar-40 mr-1" src="{{$user['avatar']}}" alt="Avatar">
                                            {{$user['name']}}
                                        </td>
                                        <td>{{$user['class']}}</td>
                                        <td>{{$user['phone']}}</td>
                                        <td>
                                            <b class="mr-1">{{$userJoinJob['count']}}</b>
                                            <small><i>công việc</i></small>
                                        </td>
                                        <td title="Tham gia {{$userJoinJob['count']}} công việc trên tổng số {{$jobInMonth}} công việc trong tháng">
                                            @php
                                                $ratioJoinJobForUser = ($userJoinJob['count'] / $jobInMonth) * 100;
                                                $statusRatioJoinJobForUser = 'bg-warning';
                                                if ($ratioJoinJobForUser >= 60) {
                                                    $statusRatioJoinJobForUser = 'bg-success';
                                                }
                                            @endphp
                                            <div class="iq-progress-bar">
                                                <span class="{{$statusRatioJoinJobForUser}}" data-percent="{{$ratioJoinJobForUser}}"></span>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    </div>
                </div>
            </div>

            {{-- <div class="col-lg-8">
                <div class="iq-card iq-card-block iq-card-stretch iq-card-height overflow-hidden">
                    <div class="iq-card-header d-flex justify-content-between">
                    <div class="iq-header-title">
                        <h4 class="card-title">Monthly sales trend </h4>
                    </div>
                    <div class="iq-card-header-toolbar d-flex align-items-center">
                        <ul class="nav nav-pills">
                            <li class="nav-item">
                                <a href="#" class="nav-link active">Latest</a>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link">Month</a>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link">All Time</a>
                            </li>
                        </ul>
                    </div>
                    </div>
                    <div class="iq-card-body">
                    <div class="d-flex justify-content-around">
                        <div class="price-week-box mr-5">
                            <span>Current Week</span>
                            <h2>$<span class="counter">180</span> <i
                                class="ri-funds-line text-success font-size-18"></i></h2>
                        </div>
                        <div class="price-week-box">
                            <span>Previous Week</span>
                            <h2>$<span class="counter">52.55</span><i
                                class="ri-funds-line text-danger font-size-18"></i></h2>
                        </div>
                    </div>
                    </div>
                    <div id="chart-5"></div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="iq-card iq-card-block iq-card-stretch iq-card-height animation-card">
                    <div class="iq-card-body p-0">
                    <div class="an-text">
                        <span>Quarterly Target </span>
                        <h2 class="display-4 font-weight-bold">$<span>2M</span></h2>
                    </div>
                    <div class="an-img">
                        <div class="bodymovin" data-bm-path="images/small/data.json" data-bm-renderer="svg"
                            data-bm-loop="true"></div>
                    </div>
                    </div>
                </div>
            </div> --}}
        </div>
        Đang làm tới đây, còn tiếp...
        {{-- <div class="row">
            <div class="col-lg-8">
                <div class="iq-card">
                    <div class="iq-card-header d-flex justify-content-between">
                    <div class="iq-header-title">
                        <h4 class="card-title">Top Grossing</h4>
                    </div>
                    <div class="iq-card-header-toolbar d-flex align-items-center">
                        <div class="dropdown">
                            <span class="dropdown-toggle" id="dropdownMenuButton1" data-toggle="dropdown">
                                <i class="ri-more-2-fill"></i>
                            </span>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
                                <a class="dropdown-item" href="#"><i class="ri-eye-fill mr-2"></i>View</a>
                                <a class="dropdown-item" href="#"><i class="ri-delete-bin-6-fill mr-2"></i>Delete</a>
                                <a class="dropdown-item" href="#"><i class="ri-pencil-fill mr-2"></i>Edit</a>
                                <a class="dropdown-item" href="#"><i class="ri-printer-fill mr-2"></i>Print</a>
                                <a class="dropdown-item" href="#"><i
                                    class="ri-file-download-fill mr-2"></i>Download</a>
                            </div>
                        </div>
                    </div>
                    </div>
                    <div class="iq-card-body">
                    <div class="row">
                        <div class="col-sm-8">
                            <div class="media-sellers">
                                <div class="media-sellers-img">
                                <img src="images/page-img/01.jpg" class="mr-3 rounded" alt="">
                                </div>
                                <div class="media-sellers-media-info">
                                <h5 class="mb-0"><a class="text-dark" href="#">Android Tablet</a></h5>
                                <p class="mb-1">Android 10 supported tablet with best features.</p>
                                <div class="sellers-dt">
                                    <span class="font-size-12">Vendor: <a href="#"> iqonicdesign</a></span>
                                </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-2 text-center mt-3">
                            <h5 class="mb-0">20,019</h5>
                            <span>Sales</span>
                        </div>
                        <div class="col-sm-2 text-center mt-3">
                            <ul class="list-inline mb-0 list-star">
                                <li class="list-inline-item text-warning"><i class="ri-star-fill"></i></li>
                                <li class="list-inline-item text-warning"><i class="ri-star-fill"></i></li>
                                <li class="list-inline-item text-warning"><i class="ri-star-fill"></i></li>
                                <li class="list-inline-item text-warning"><i class="ri-star-fill"></i></li>
                                <li class="list-inline-item text-warning"><i class="ri-star-fill"></i></li>
                            </ul>
                            <span>Rating</span>
                        </div>
                    </div>
                    <div class="row mt-4">
                        <div class="col-sm-8">
                            <div class="media-sellers">
                                <div class="media-sellers-img">
                                <img src="images/page-img/02.jpg" class="mr-3 rounded" alt="">
                                </div>
                                <div class="media-sellers-media-info">
                                <h5 class="mb-0"><a class="text-dark" href="#">Apple Watch</a></h5>
                                <p class="mb-1">Latest model of apple watch for productivity.</p>
                                <div class="sellers-dt">
                                    <span class="font-size-12">Vendor: <a href="#">Apple</a></span>
                                </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-2 text-center mt-3">
                            <h5 class="mb-0">56,112</h5>
                            <span>Sales</span>
                        </div>
                        <div class="col-sm-2 text-center mt-3">
                            <ul class="list-inline mb-0 list-star">
                                <li class="list-inline-item text-warning"><i class="ri-star-fill"></i></li>
                                <li class="list-inline-item text-warning"><i class="ri-star-fill"></i></li>
                                <li class="list-inline-item text-warning"><i class="ri-star-fill"></i></li>
                                <li class="list-inline-item text-warning"><i class="ri-star-fill"></i></li>
                                <li class="list-inline-item text-warning"><i class="ri-star-fill"></i></li>
                            </ul>
                            <span>Rating</span>
                        </div>
                    </div>
                    <div class="row mt-4">
                        <div class="col-sm-8">
                            <div class="media-sellers">
                                <div class="media-sellers-img">
                                <img src="images/page-img/03.jpg" class="mr-3 rounded" alt="">
                                </div>
                                <div class="media-sellers-media-info">
                                <h5 class="mb-0"><a class="text-dark" href="#">I-Phone & I-Mac</a></h5>
                                <p class="mb-1">Best ever combo package for work and personal use.</p>
                                <div class="sellers-dt">
                                    <span class="font-size-12">Vendor: <a href="#"> Iqonic devices</a></span>
                                </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-2 text-center mt-3">
                            <h5 class="mb-0">9,895</h5>
                            <span>Sales</span>
                        </div>
                        <div class="col-sm-2 text-center mt-3">
                            <ul class="list-inline mb-0 list-star">
                                <li class="list-inline-item text-warning"><i class="ri-star-fill"></i></li>
                                <li class="list-inline-item text-warning"><i class="ri-star-fill"></i></li>
                                <li class="list-inline-item text-warning"><i class="ri-star-fill"></i></li>
                                <li class="list-inline-item text-warning"><i class="ri-star-fill"></i></li>
                                <li class="list-inline-item text-warning"><i class="ri-star-fill"></i></li>
                            </ul>
                            <span>Rating</span>
                        </div>
                    </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6">
                    <div class="iq-card iq-card-block iq-card-stretch iq-card-height">
                        <div class="iq-card-header d-flex justify-content-between">
                            <div class="iq-header-title">
                                <h4 class="card-title">Support Tickets</h4>
                            </div>
                            <div class="iq-card-header-toolbar d-flex align-items-center">
                                <div class="dropdown">
                                <span class="dropdown-toggle dropdown-bg" id="dropdownMenuButton2"
                                    data-toggle="dropdown">View all</span>
                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
                                    <a class="dropdown-item" href="#"><i class="ri-eye-fill mr-2"></i>View</a>
                                    <a class="dropdown-item" href="#"><i
                                            class="ri-delete-bin-6-fill mr-2"></i>Delete</a>
                                    <a class="dropdown-item" href="#"><i class="ri-pencil-fill mr-2"></i>Edit</a>
                                    <a class="dropdown-item" href="#"><i class="ri-printer-fill mr-2"></i>Print</a>
                                    <a class="dropdown-item" href="#"><i
                                            class="ri-file-download-fill mr-2"></i>Download</a>
                                </div>
                                </div>
                            </div>
                        </div>
                        <div class="iq-card-body">
                            <div class="media-support">
                                <div class="media-support-header mb-2">
                                <div class="media-support-user-img mr-3">
                                    <img class="rounded-circle" src="images/user/1.jpg" alt="">
                                </div>
                                <div class="media-support-info mt-2">
                                    <h6 class="mb-0"><a href="#" class="">Nik Jordan</a></h6>
                                    <small>2 day ago</small>
                                </div>
                                <div class="mt-3">
                                    <span class="badge badge-success">Pending</span>
                                </div>
                                </div>
                                <div class="media-support-body">
                                <p class="mb-0">Lorem Ipsum is simply dummy text of the printing and typesetting
                                    industry.</p>
                                </div>
                            </div>
                            <hr class="mt-4 mb-4">
                            <div class="media-support">
                                <div class="media-support-header mb-2">
                                <div class="media-support-user-img mr-3">
                                    <img class="rounded-circle" src="images/user/02.jpg" alt="">
                                </div>
                                <div class="media-support-info mt-2">
                                    <h6 class="mb-0"><a href="#" class="">Lily Wozniak</a></h6>
                                    <small>2 day ago</small>
                                </div>
                                <div class="mt-3">
                                    <span class="badge badge-warning text-white">Working</span>
                                </div>
                                </div>
                                <div class="media-support-body">
                                <p class="mb-0">It is a long established fact that a reader will be distracted by
                                    the readable layout.</p>
                                </div>
                            </div>
                            <hr class="mt-4 mb-4">
                            <div class="media-support">
                                <div class="media-support-header mb-2">
                                <div class="media-support-user-img mr-3">
                                    <img class="rounded-circle" src="images/user/03.jpg" alt="">
                                </div>
                                <div class="media-support-info mt-2">
                                    <h6 class="mb-0"><a href="#" class="">Samuel Path</a></h6>
                                    <small>2 day ago</small>
                                </div>
                                <div class="mt-3">
                                    <span class="badge badge-primary">Open</span>
                                </div>
                                </div>
                                <div class="media-support-body">
                                <p class="mb-0">Lorem Ipsum is simply dummy text of the printing and typesetting
                                    industry.</p>
                                </div>
                            </div>
                            <hr class="mt-4 mb-4">
                            <div class="media-support">
                                <div class="media-support-header mb-2">
                                <div class="media-support-user-img mr-3">
                                    <img class="rounded-circle" src="images/user/04.jpg" alt="">
                                </div>
                                <div class="media-support-info mt-2">
                                    <h6 class="mb-0"><a href="#" class="">Mia Mai</a></h6>
                                    <small>2 day ago</small>
                                </div>
                                <div class="mt-3">
                                    <span class="badge badge-danger">Closed</span>
                                </div>
                                </div>
                                <div class="media-support-body">
                                <p class="mb-0">It is a long established fact that a reader will be distracted by
                                    the readable content of a page when looking at its layout.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    </div>
                    <div class="col-lg-6">
                    <div class="iq-card">
                        <div class="iq-card-header d-flex justify-content-between">
                            <div class="iq-header-title">
                                <h4 class="card-title">Cash flow</h4>
                            </div>
                            <div class="iq-card-header-toolbar d-flex align-items-center">
                                <div class="dropdown">
                                <span class="dropdown-toggle text-primary" id="dropdownMenuButton3"
                                    data-toggle="dropdown">
                                    <i class="ri-more-2-fill"></i>
                                </span>
                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
                                    <a class="dropdown-item" href="#"><i class="ri-eye-fill mr-2"></i>View</a>
                                    <a class="dropdown-item" href="#"><i
                                            class="ri-delete-bin-6-fill mr-2"></i>Delete</a>
                                    <a class="dropdown-item" href="#"><i class="ri-pencil-fill mr-2"></i>Edit</a>
                                    <a class="dropdown-item" href="#"><i class="ri-printer-fill mr-2"></i>Print</a>
                                    <a class="dropdown-item" href="#"><i
                                            class="ri-file-download-fill mr-2"></i>Download</a>
                                </div>
                                </div>
                            </div>
                        </div>
                        <div id="bar-chart-6"></div>
                    </div>
                    <div class="iq-card">
                        <div class="iq-card-body p-0">
                            <div class="row align-items-center no-gutters">
                                <div class="col-lg-6">
                                <div class="p-4">
                                    <div class=" d-flex align-items-center">
                                        <a href="#" class="iq-icon-box rounded-circle iq-bg-primary">
                                            <i class="ri-facebook-fill"></i>
                                        </a>
                                        <h4 class="mb-0"><span class="counter">200</span>k<small
                                            class="d-block font-size-14">Posts</small></h4>
                                    </div>
                                </div>
                                </div>
                                <div class="col-lg-6">
                                <div id="wave-chart-7"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="iq-card">
                        <div class="iq-card-body p-0">
                            <div class="row align-items-center no-gutters">
                                <div class="col-lg-6">
                                <div class="p-4">
                                    <div class=" d-flex align-items-center">
                                        <a href="#" class="iq-icon-box rounded-circle iq-bg-success">
                                            <i class="ri-twitter-fill"></i>
                                        </a>
                                        <h4 class="mb-0"><span class="counter">400</span>k<small
                                            class="d-block font-size-14">Tweets</small></h4>
                                    </div>
                                </div>
                                </div>
                                <div class="col-lg-6">
                                <div id="wave-chart-8"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="iq-card">
                    <div class="iq-card-header d-flex justify-content-between">
                    <div class="iq-header-title">
                        <h4 class="card-title">Activity timeline</h4>
                    </div>
                    <div class="iq-card-header-toolbar d-flex align-items-center">
                        <div class="dropdown">
                            <span class="dropdown-toggle text-primary" id="dropdownMenuButton4"
                                data-toggle="dropdown">
                                View All
                            </span>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
                                <a class="dropdown-item" href="#"><i class="ri-eye-fill mr-2"></i>View</a>
                                <a class="dropdown-item" href="#"><i class="ri-delete-bin-6-fill mr-2"></i>Delete</a>
                                <a class="dropdown-item" href="#"><i class="ri-pencil-fill mr-2"></i>Edit</a>
                                <a class="dropdown-item" href="#"><i class="ri-printer-fill mr-2"></i>Print</a>
                                <a class="dropdown-item" href="#"><i
                                    class="ri-file-download-fill mr-2"></i>Download</a>
                            </div>
                        </div>
                    </div>
                    </div>
                    <div class="iq-card-body">
                    <ul class="iq-timeline">
                        <li>
                            <div class="timeline-dots"></div>
                            <h6 class="float-left mb-1">Client Login</h6>
                            <small class="float-right mt-1">24 November 2019</small>
                            <div class="d-inline-block w-100">
                                <p>Bonbon macaroon jelly beans gummi bears jelly lollipop apple</p>
                            </div>
                        </li>
                        <li>
                            <div class="timeline-dots border-success"></div>
                            <h6 class="float-left mb-1">Scheduled Maintenance</h6>
                            <small class="float-right mt-1">23 November 2019</small>
                            <div class="d-inline-block w-100">
                                <p>Bonbon macaroon jelly beans gummi bears jelly lollipop apple</p>
                            </div>
                        </li>
                        <li>
                            <div class="timeline-dots border-danger"></div>
                            <h6 class="float-left mb-1">Dev Meetup</h6>
                            <small class="float-right mt-1">20 November 2019</small>
                            <div class="d-inline-block w-100">
                                <p>Bonbon macaroon jelly beans <a href="#">gummi bears</a>gummi bears jelly lollipop
                                apple</p>
                                <div class="iq-media-group">
                                <a href="#" class="iq-media">
                                    <img class="img-fluid avatar-40 rounded-circle" src="images/user/05.jpg" alt="">
                                </a>
                                <a href="#" class="iq-media">
                                    <img class="img-fluid avatar-40 rounded-circle" src="images/user/06.jpg" alt="">
                                </a>
                                <a href="#" class="iq-media">
                                    <img class="img-fluid avatar-40 rounded-circle" src="images/user/07.jpg" alt="">
                                </a>
                                <a href="#" class="iq-media">
                                    <img class="img-fluid avatar-40 rounded-circle" src="images/user/08.jpg" alt="">
                                </a>
                                <a href="#" class="iq-media">
                                    <img class="img-fluid avatar-40 rounded-circle" src="images/user/09.jpg" alt="">
                                </a>
                                <a href="#" class="iq-media">
                                    <img class="img-fluid avatar-40 rounded-circle" src="images/user/10.jpg" alt="">
                                </a>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="timeline-dots border-primary"></div>
                            <h6 class="float-left mb-1">Client Call</h6>
                            <small class="float-right mt-1">19 November 2019</small>
                            <div class="d-inline-block w-100">
                                <p>Bonbon macaroon jelly beans gummi bears jelly lollipop apple</p>
                            </div>
                        </li>
                        <li>
                            <div class="timeline-dots border-warning"></div>
                            <h6 class="float-left mb-1">Mega event</h6>
                            <small class="float-right mt-1">15 November 2019</small>
                            <div class="d-inline-block w-100">
                                <p>Bonbon macaroon jelly beans gummi bears jelly lollipop apple</p>
                            </div>
                        </li>
                    </ul>
                    </div>
                </div>
                <div class="iq-card">
                    <img src="images/small/img-1.jpg" class="img-fluid w-100 rounded" alt="#">
                    <div class="iq-card-header d-flex justify-content-between">
                    <div class="iq-header-title">
                        <h4 class="card-title">How to setup E-store</h4>
                    </div>
                    <div class="iq-card-header-toolbar d-flex align-items-center">
                        <div class="dropdown">
                            <span class="dropdown-toggle" id="dropdownMenuButton" data-toggle="dropdown">
                                <i class="ri-settings-5-fill"></i>
                            </span>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
                                <a class="dropdown-item" href="#"><i class="ri-eye-fill mr-2"></i>View</a>
                                <a class="dropdown-item" href="#"><i class="ri-delete-bin-6-fill mr-2"></i>Delete</a>
                                <a class="dropdown-item" href="#"><i class="ri-pencil-fill mr-2"></i>Edit</a>
                            </div>
                        </div>
                    </div>
                    </div>
                    <div class="iq-card-body">
                    <span class="font-size-16">Lorem Ipsum is simply dummy text of the printing and typesetting
                        industry.</span>
                    <small class="text-muted mt-3 d-inline-block w-100">Saturday, 7 December 2019</small>
                    </div>
                </div>
            </div>
        </div> --}}
    </div>
@endsection
