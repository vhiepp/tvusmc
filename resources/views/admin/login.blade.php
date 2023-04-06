<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="/assets/admin/img/apple-icon.png">
  <link rel="icon" type="image/png" href="/assets/admin/img/favicon.png">

  <title>
    Login Admin | TVU Social Media Club
  </title>
  <!--     Fonts and icons     -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
  <!-- Nucleo Icons -->
  <link href="/assets/admin/css/nucleo-icons.css" rel="stylesheet" />
  <link href="/assets/admin/css/nucleo-svg.css" rel="stylesheet" />
  <!-- Font Awesome Icons -->
  <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
  <link href="/assets/admin/css/nucleo-svg.css" rel="stylesheet" />
  <!-- CSS Files -->
  <link id="pagestyle" href="/assets/admin/css/soft-ui-dashboard.css?v=1.0.7" rel="stylesheet" />
</head>

<body class="">
  
  <main class="main-content  mt-0">
    <section>
      <div class="page-header min-vh-75">
        <div class="container">
          <div class="row">
            <div class="col-xl-4 col-lg-5 col-md-6 d-flex flex-column mx-auto">
              <div class="card card-plain mt-8">
                <div class="card-header pb-0 text-center bg-transparent">
                  <h3 class="font-weight-bolder text-info text-gradient">
                    Đăng nhập
                  </h3>
                  <p class="mb-0">Nhập email và mật khẩu người quản trị để đăng nhập</p>
                </div>
                <div class="card-body">
                  <form method="POST">
                    <label>Email</label>
                    <div class="mb-3">
                      <input type="email" name="email" class="form-control" placeholder="Email" aria-label="Email" aria-describedby="email-addon" required>
                    </div>
                    <label>Password</label>
                    <div class="mb-3">
                      <input type="password" name="password" class="form-control" placeholder="Password" aria-label="Password" aria-describedby="password-addon" required>
                    </div>
                    <div class="form-check form-switch">
                      <input class="form-check-input" name="remember" type="checkbox" id="rememberMe" checked="">
                      <label class="form-check-label" for="rememberMe">Remember me</label>
                    </div>
                    @csrf
                    <div class="text-center">
                      <button type="submit" class="btn bg-gradient-info w-100 mt-4 mb-0">Đăng nhập</button>
                    </div>

                  </form>
                </div>
                {{-- <div class="card-footer text-center pt-0 px-lg-2 px-1">
                  <p class="mb-4 text-sm mx-auto">
                    Bạn chưa có tài khoản?
                    <a href="javascript:;" class="text-info text-gradient font-weight-bold">Đăng kí</a>
                  </p>
                </div> --}}
              </div>
            </div>
            <div class="col-md-6">
              <div class="oblique position-absolute top-0 h-100 d-md-block d-none me-n8">
                <div class="oblique-image bg-cover position-absolute fixed-top ms-auto h-100 z-index-0 ms-n6" style="background-image:url('/assets/admin/img/thumb.jpg')"></div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </main>
  <!-- -------- START FOOTER 3 w/ COMPANY DESCRIPTION WITH LINKS & SOCIAL ICONS & COPYRIGHT ------- -->
  <footer class="footer py-5">
    <div class="container">
      <div class="row">
        <div class="col-lg-8 mb-4 mx-auto text-center">
          <a href="javascript:;" target="_blank" class="text-secondary me-xl-5 me-3 mb-sm-0 mb-2">
            Company
          </a>
          <a href="javascript:;" target="_blank" class="text-secondary me-xl-5 me-3 mb-sm-0 mb-2">
            About Us
          </a>
          <a href="javascript:;" target="_blank" class="text-secondary me-xl-5 me-3 mb-sm-0 mb-2">
            Team
          </a>
          <a href="javascript:;" target="_blank" class="text-secondary me-xl-5 me-3 mb-sm-0 mb-2">
            Products
          </a>
          <a href="javascript:;" target="_blank" class="text-secondary me-xl-5 me-3 mb-sm-0 mb-2">
            Blog
          </a>
          <a href="javascript:;" target="_blank" class="text-secondary me-xl-5 me-3 mb-sm-0 mb-2">
            Pricing
          </a>
        </div>
        <div class="col-lg-8 mx-auto text-center mb-4 mt-2">
          <a href="javascript:;" target="_blank" class="text-secondary me-xl-4 me-4">
            <span class="text-lg fab fa-dribbble"></span>
          </a>
          <a href="javascript:;" target="_blank" class="text-secondary me-xl-4 me-4">
            <span class="text-lg fab fa-twitter"></span>
          </a>
          <a href="javascript:;" target="_blank" class="text-secondary me-xl-4 me-4">
            <span class="text-lg fab fa-instagram"></span>
          </a>
          <a href="javascript:;" target="_blank" class="text-secondary me-xl-4 me-4">
            <span class="text-lg fab fa-pinterest"></span>
          </a>
          <a href="javascript:;" target="_blank" class="text-secondary me-xl-4 me-4">
            <span class="text-lg fab fa-github"></span>
          </a>
        </div>
      </div>
      <div class="row">
        <div class="col-8 mx-auto text-center mt-1">
          <p class="mb-0 text-secondary">
            Copyright © <script>
              document.write(new Date().getFullYear())
            </script> Soft by TVU Social Media Club
          </p>
        </div>
      </div>
    </div>
  </footer>
  <!-- -------- END FOOTER 3 w/ COMPANY DESCRIPTION WITH LINKS & SOCIAL ICONS & COPYRIGHT ------- -->
  <!--   Core JS Files   -->
  <script src="/assets/admin/js/core/popper.min.js"></script>
  <script src="/assets/admin/js/core/bootstrap.min.js"></script>
  <script src="/assets/admin/js/plugins/perfect-scrollbar.min.js"></script>
  <script src="/assets/admin/js/plugins/smooth-scrollbar.min.js"></script>
  <script>
    var win = navigator.platform.indexOf('Win') > -1;
    if (win && document.querySelector('#sidenav-scrollbar')) {
      var options = {
        damping: '0.5'
      }
      Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
    }
  </script>
  <!-- Github buttons -->
  <script async defer src="https://buttons.github.io/buttons.js"></script>
  <!-- Control Center for Soft Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="/assets/admin/js/soft-ui-dashboard.min.js?v=1.0.7"></script>
</body>

</html>