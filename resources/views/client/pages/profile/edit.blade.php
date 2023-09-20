@extends('client.master')

@section('head')
    
    <style>
        .lable-avt {
            position: relative;
        }

        .lable-avt::before {
            position: absolute;
            content: "+";
            font-weight: bold;
            font-size: 30px;
            top: calc(50% - 15px);
            left: calc(50% - 10px);
        }
    </style>

@endsection

@section('content')

@php
    $mailStudent = false;

    // if (auth()->user()['provider'] == 'microsoft') {
    //     $email = explode("@", auth()->user()['email']);
    
    //     if ($email[1] == 'st.tvu.edu.vn') {
    //         $mailStudent = true;
    //     }
    // }

@endphp

<section class="section-profile-cover section-shaped my-0" style="height: 356px">
    <!-- Circles background -->
    <img class="bg-image" src="/assets/img/anh-4k.png" style="width: 100%;">
</section>

<section class="section">
    <div class="container">
      <div class="card card-profile shadow" style="margin-top: -350px !important;">
        <form method="POST" enctype="multipart/form-data">
            <div class="px-4">
            
                <div class="row justify-content-center">
                    
                </div>
                <div class="mt-5">
                    <h3 class="text-center">
                        Cập nhật thông tin
                    </h3>

                    <div class="row">

                        <div class="col-md-12 d-flex flex-row">
                            <label for="avatar" class="lable-avt" style="display: block">
                                <div style="width: 180px; height: 180px;">
                                    <span >
                                        <img src="{{ auth()->user()['avatar'] }}" id="avt-img" style="width: 100%; height: 100%;" class="rounded-circle">
                                    </span>
                                </div>
                            </label>
                            
                            <div>
                                <input type="file" accept="image/*" onchange="previewImg(this)" class="form-control" hidden name="avatar" id="avatar" placeholder="Chọn ảnh">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="sur_name">Họ </label>
                                <input type="text" class="form-control" value="{{ auth()->user()['sur_name'] }}" name="sur_name" id="sur_name" placeholder="Họ của bạn">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="given_name">Tên <span class="text-danger">(*)</span> </label>
                                <input type="text" class="form-control" value="{{ auth()->user()['given_name'] }}" name="given_name" id="given_name" placeholder="Tên của bạn" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="mssv">Mssv</label>
                                <input type="text" 
                                @if ($mailStudent)
                                    disabled
                                @endif
                                class="form-control" name="mssv" value="{{ auth()->user()['mssv'] }}" id="mssv" placeholder="Mã số sinh viên">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="class">Lớp</label>
                                <input type="text" class="form-control" name="class" value="{{ auth()->user()['class'] }}" id="class" placeholder="Mã lớp">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" class="form-control" value="{{ auth()->user()['email'] }}" disabled id="email" placeholder="Email"> 
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="phone">SĐT</label>
                                <input type="number" class="form-control" name="phone" value="{{ auth()->user()['phone'] }}" id="phone" placeholder="Số điện thoại">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="address">Địa chỉ</label>
                                <input type="text" class="form-control" value="{{ auth()->user()['address'] }}" name="address" id="address" placeholder="Địa chỉ">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="timepicker">Ngày sinh</label>
                                <input type="datetime" id="timepicker" class="form-control" value="{{ date('d/m/Y', strtotime(auth()->user()['birthday'])) }}" name="birthday" placeholder="Ngày sinh">
                            </div>
                        </div>

                        <div id="radios-component" class="col-md-6 tab-pane d-flex flex-row tab-example-result fade show active" role="tabpanel" aria-labelledby="radios-component-tab">
                            <label for="" class="mr-4">Giới tính:</label>
                            <div class="custom-control custom-radio mx-2">
                                <input name="sex" class="custom-control-input" value="1" id="nam" @checked(true) type="radio">
                                <label class="custom-control-label" for="nam">Nam</label>
                            </div>
                            <div class="custom-control custom-radio mx-2">
                                <input name="sex" class="custom-control-input" value="2" id="nu" 
                                @if (auth()->user()['sex'] == 2)
                                    @checked(true)
                                @endif
                                type="radio">
                                <label class="custom-control-label" for="nu">Nữ</label>
                            </div>
                            <div class="custom-control custom-radio mx-2">
                                <input name="sex" class="custom-control-input" value="3" id="khac" 
                                @if (auth()->user()['sex'] == 3)
                                    @checked(true)
                                @endif
                                type="radio">
                                <label class="custom-control-label" for="khac">Khác</label>
                            </div>
                        </div>

                        @csrf
                    </div>
                    
                </div>
                <div class="mt-5 py-5 border-top text-right">
                    <button type="submit" class="btn btn-primary btn-round">Cập nhật</button>
                </div>
            </div>
        </form>
      </div>
    </div>
  </section>
@endsection

@section('script')

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">

    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script src="https://npmcdn.com/flatpickr/dist/flatpickr.min.js"></script>
    <script src="/assets/js/datepicker.vn.js"></script>
    
  <script>

    const avt = document.getElementById("avatar");

    const previewImage = document.getElementById("avt-img");

    avt.addEventListener("change", function(){

        const file = this.files[0];

        const reader = new FileReader();

        reader.addEventListener("load",function(){
            previewImage.setAttribute("src",this.result);
        });

        reader.readAsDataURL(file);
    });

    document.body.classList = "profile-page";

    flatpickr("#timepicker", {
        shorthandCurrentMonth: true,
        ariaDateFormat: "d/m/Y",
        allowInput: true,
        altInput: true,
        altFormat: "d/m/Y",
        dateFormat: "d/m/Y",
        locale: 'vn',
        disableMobile: true,
    });
  </script>

@endsection