<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $title }} | TVU Social Media Club</title>

    @include('admin.layouts.head')

</head>
<body>
    <div class="container-fluid">
        
        <div class="row">
            <div class="col-sm-12">
                <div class="iq-card">
                    <div class="iq-card-header d-flex mt-3 justify-content-between">
                       <div class="iq-header-title">
                          <h3 class="card-title">
                            Sửa công việc <small title="{{ $job['event_name'] }}">( Sự kiện: {{ str()->of($job['event_name'])->limit(100) }} )</small>
                          </h3>
                       </div>
                    </div>
                    <div class="iq-card-body">

                        <form method="POST">

                                <div class="row">
                                    <div class="form-group col-sm-12">
                                        <label for="name">Tên công việc</label>
                                        <input type="text" name="name" value="{{ $job['name'] }}" class="form-control" id="name" placeholder="Nhập tên công việc" required>
                                    </div>
                                    
                                    <div class="form-group col-sm-12 col-lg-4">
                                        <label>Thời gian bắt đầu</label>
                                        <input type="datetime" class="form-control" id="timepicker1" placeholder="Giờ:phút ngày/tháng/năm" value="{{ date('H:i d/m/Y', strtotime($job['time_start'])) }}" name="time-start" required>
                                    </div>

                                    <div class="form-group col-sm-12 col-lg-4">
                                        <label>Thời gian kết thúc</label>
                                        <input type="datetime" class="form-control" id="timepicker2" placeholder="Giờ:phút ngày/tháng/năm" value="{{ date('H:i d/m/Y', strtotime($job['time_end'])) }}" name="time-end" required>
                                    </div>

                                    <div class="form-group col-sm-12 col-lg-4">
                                        <label>Số lượng</label>
                                        <input type="number" class="form-control" name="quantity" placeholder="Số lượng tham gia" id="exampleInputNumber1" value="{{ $job['quantity'] }}" required>
                                    </div>

                                    <div class="form-group col-sm-12">
                                        <label for="name">Địa chỉ</label>
                                        <input type="text" name="address" value="{{ $job['address'] }}" class="form-control" placeholder="Nhập địa chỉ">
                                    </div>
        
                                    <div class="form-group col-sm-12">
                                        <label>Mô tả / Nội dung chi tiết</label>
                                        <textarea class="form-control" name="description" id="exampleFormControlTextarea1" required placeholder="Soạn nội dung" rows="5">{{ $job['description'] }}</textarea>
                                    </div>

                                </div>
                                <button type="submit" class="btn btn-primary">Lưu</button>
                                @csrf
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>



    @include('admin.layouts.js')

    <script>
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
</body>
</html>