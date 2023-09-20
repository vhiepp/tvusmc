<style>
  #navbar-main {
    background-color: #001634 !important;
  }

</style>



<div class="section section-hero section-shaped" style="padding-top: 0px">
    <div class="shape shape-style-1" style="background-color: #001634">
      <span class="span-150"></span>
      <span class="span-50"></span>
      <span class="span-50"></span>
      <span class="span-75"></span>
      <span class="span-100"></span>
      <span class="span-75"></span>
      <span class="span-50"></span>
      <span class="span-100"></span>
      <span class="span-50"></span>
      <span class="span-100"></span>
    </div>
    <div class="page-header">
      <div class="container shape-container d-flex align-items-center" style="padding-top: 4rem; padding-bottom: 0">
        <div class="col px-0">
          <div class="row align-items-center justify-content-center">
            <div class="col-lg-6 text-center">
              <img src="/assets/client/img/icons/logo.png" style="width: 250px;" class="img-fluid">
              <p class="lead text-white font-weight-bold">
                Nắm bắt xu thế – Phát triển đam mê <br> TVU <span class="text-warning">Social Media</span> Club <br>
                <a href="{{ route('client.introduces') }}">
                    <small style="font-size: .9rem; color:#fedc45">
                        <i><u>
                            <i class="fas fa-long-arrow-alt-right"></i> Giới thiệu <i class="fas fa-long-arrow-alt-left"></i>
                        </u></i>
                    </small>
                </a>
              </p>
              <div class="btn-wrapper mt-5">
                <a href="https://zalo.me/g/ormrkg739"
                  class="btn btn-lg btn-white btn-icon mb-3 mb-sm-0 no-loader" target="_blank">
                  {{-- <span class="btn-inner--icon"><i class="ni ni-cloud-download-95"></i></span> --}}
                    <img src="/assets/client/img/icons/zalo.png" class="img-fluid rounded shadow" style="width: 32px" alt="">
                  <span class="btn-inner--text">Zalo group</span>
                </a>
                <a href="https://www.facebook.com/tvusmc"
                  class="btn btn-lg btn-github btn-icon mb-3 mb-sm-0 no-loader" target="_blank">
                  {{-- <span class="btn-inner--icon"><i class="fa fa-github"></i></span> --}}
                  <img src="/assets/client/img/icons/facebook.png" class="img-fluid rounded shadow" style="width: 32px" alt="">

                  <span class="btn-inner--text">Facebook<span class="text-warning"> page</span></span>
                </a>
              </div>
              <div class="mt-5">
                <small class="font-weight-bold mb-0 mr-2 text-white">Chủ nhiệm CLB:</small>
                <a href="https://zalo.me/0911259459" class="no-loader" target="_blank">
                  <img src="/assets/client/img/faces/tindi.jpg" class="rounded-circle" style="height: 28px">
                  <small class="font-weight-bold mb-0 mr-2 text-white">Tín Di</small>
                </a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="separator separator-bottom separator-skew zindex-100">
      <svg x="0" y="0" viewBox="0 0 2560 100" preserveAspectRatio="none" version="1.1"
        xmlns="http://www.w3.org/2000/svg">
        <polygon class="fill-white" points="2560 0 2560 100 0 100"></polygon>
      </svg>
    </div>
  </div>


  <script>

    // window.onload = () => {
      if (document.body.scrollTop > 82 || document.documentElement.scrollTop > 82) {
        document.getElementById('navbar-main').classList.add('navbar-light');
        document.getElementById('navbar-main').classList.remove('navbar-dark');
        document.getElementById('navbar-main').classList.add('change');
        document.getElementById('navbar-main').classList.add('shadow');
        document.getElementById('navbar-main').style = "background-color: #fff !important;";
      } else {
        document.getElementById('navbar-main').classList.remove('change');
        document.getElementById('navbar-main').classList.remove('shadow');
        document.getElementById('navbar-main').style = "";
        document.getElementById('navbar-main').classList.add('navbar-dark');
        document.getElementById('navbar-main').classList.remove('navbar-light');
        console.log(2);
      }
    // }

    window.addEventListener('scroll', () => {
        if (document.body.scrollTop > 82 || document.documentElement.scrollTop > 82) {
          document.getElementById('navbar-main').classList.add('navbar-light');
          document.getElementById('navbar-main').classList.remove('navbar-dark');
        } else {
          document.getElementById('navbar-main').classList.add('navbar-dark');
          document.getElementById('navbar-main').classList.remove('navbar-light');

        }
    })
  </script>
