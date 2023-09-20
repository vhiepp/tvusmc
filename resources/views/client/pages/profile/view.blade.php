@extends('client.master')


@section('content')

<section class="section-profile-cover section-shaped my-0" style="height: 356px">
    <!-- Circles background -->
    <img class="bg-image" src="/assets/img/anh-4k.png" style="width: 100%;">
</section>

<section class="section">
    <div class="container">
      <div class="card card-profile shadow" style="margin-top: -350px !important;">
        <div class="px-4">
          <div class="row justify-content-center">
            <div class="col-lg-3 order-lg-2">
              <div class="card-profile-image">
                <span >
                  <img src="{{ auth()->user()['avatar'] }}" style="width: 100%" class="rounded-circle">
                </span>
              </div>
            </div>
            <div class="col-lg-4 order-lg-3 text-lg-right align-self-lg-center">
              <div class="card-profile-actions py-4 mt-lg-0">
                <a href="{{ route('profile.edit') }}" class="btn btn-sm btn-info float-right" title="chỉnh sửa / cập nhật">
                    <i class='bx bx-edit'></i>
                </a>
              </div>
            </div>
            <div class="col-lg-4 order-lg-1">
              <div class="card-profile-stats d-flex justify-content-center">
                <div>
                  <span class="heading">0</span>
                  <span class="description">Sự kiện</span>
                </div>
                <div>
                  <span class="heading">0</span>
                  <span class="description">Công việc </span>
                </div>
                <div>
                  <span class="heading">0</span>
                  <span class="description">Bài viết</span>
                </div>
              </div>
            </div>
          </div>
          <div class="text-center mt-5">
            <h3>
                {{ auth()->user()['name'] }}
                @if (auth()->user()['birthday'])
                    <span class="font-weight-light">
                        , {{ date('Y', strtotime(auth()->user()['birthday'])) }}
                    </span>
                @endif
            </h3>
            <div class="h6 font-weight-300">
                <i class="ni location_pin mr-2"></i>
                {{ auth()->user()['mssv'] ? str()->upper(auth()->user()['mssv']) : "Mã số: .........."}} ,
                {{ auth()->user()['class'] ? str()->upper(auth()->user()['class']) : "Lớp: .........."}}
            </div>
            <div>
                <i class="ni education_hat mr-2"></i>
                <i class='bx bxl-gmail' ></i> {{ auth()->user()['email'] ? auth()->user()['email'] : '..........' }}
            </div>
            <div>
                <i class="ni education_hat mr-2"></i>
                <i class='bx bxs-phone-call' ></i> {{ auth()->user()['phone'] ? auth()->user()['phone'] : '..........' }}
            </div>
            <div class="h6 mt-4">
                <i class="ni business_briefcase-24 mr-2"></i>
                <i class='bx bx-map' ></i> {{ auth()->user()['address'] ? auth()->user()['address'] : '..........' }}
            </div>
          </div>
          <div class="mt-5 py-5 border-top text-center">
            <div class="row justify-content-center">
              <div class="col-lg-9">
                <p>
                    Nắm bắt xu hướng – Phát triển đam mê
                </p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
@endsection

@section('script')
    
  <script>
    document.body.classList = "profile-page";
  </script>

@endsection