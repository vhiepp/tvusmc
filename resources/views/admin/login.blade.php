<!DOCTYPE html>
<html lang="en">
   <head>
      <!-- Required meta tags -->
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <title>Login Admin | TVU Social Media Club</title>
      <!-- Favicon -->
      <link rel="shortcut icon" href="/assets/admin/images/favicon.ico" />
      <!-- Bootstrap CSS -->
      <link rel="stylesheet" href="/assets/admin/css/bootstrap.min.css">
      <!-- Typography CSS -->
      <link rel="stylesheet" href="/assets/admin/css/typography.css">
      <!-- Style CSS -->
      <link rel="stylesheet" href="/assets/admin/css/style.css">
      <!-- Responsive CSS -->
      <link rel="stylesheet" href="/assets/admin/css/responsive.css">
   </head>
   <body>
      <!-- loader Start -->
      <div id="loading">
         <div id="loading-center">
            <div class="loader">
               <div class="cube">
                  <div class="sides">
                     <div class="top"></div>
                     <div class="right"></div>
                     <div class="bottom"></div>
                     <div class="left"></div>
                     <div class="front"></div>
                     <div class="back"></div>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <!-- loader END -->
        <!-- Sign in Start -->
        <section class="sign-in-page bg-white">
            <div class="container-fluid p-0">
                <div class="row no-gutters">
                    <div class="col-sm-6 align-self-center">
                        <div class="sign-in-from">
                            <h1 class="mb-0">Sign in with Admin</h1>
                            <p>Enter your email address and password to access admin panel.</p>
                            <form class="mt-4" method="POST">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Email address</label>
                                    <input type="email" name="email" class="form-control mb-0" id="exampleInputEmail1" placeholder="Enter email" required>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Password</label>
                                    <a href="#" class="float-right">Forgot password?</a>
                                    <input type="password" name="password" class="form-control mb-0" id="exampleInputPassword1" placeholder="Password" required>
                                </div>
                                <div class="d-inline-block w-100">
                                    <div class="custom-control custom-checkbox d-inline-block mt-2 pt-1">
                                        <input type="checkbox" class="custom-control-input" name="remember" id="customCheck1">
                                        <label class="custom-control-label" for="customCheck1">Remember Me</label>
                                    </div>
                                    <button type="submit" class="btn btn-primary float-right">Sign in</button>
                                </div>
                                <div class="sign-info">
                                    <span class="dark-color d-inline-block line-height-2">Don't have an account? <a href="#">Sign up</a></span>
                                    <ul class="iq-social-media">
                                        <li><a href="#"><i class="ri-facebook-box-line"></i></a></li>
                                        <li><a href="#"><i class="ri-twitter-line"></i></a></li>
                                        <li><a href="#"><i class="ri-instagram-line"></i></a></li>
                                    </ul>
                                </div>
                                @csrf
                            </form>
                        </div>
                    </div>
                    <div class="col-sm-6 text-center">
                        <div class="sign-in-detail text-white" style="background: url(/assets/admin/images/login/2.jpg) no-repeat 0 0; background-size: cover;">
                            <a class="sign-in-logo mb-5" href="#"><img src="/assets/client/img/icons/logo.png" class="img-fluid" alt="logo"></a>
                            <div class="owl-carousel" data-autoplay="true" data-loop="true" data-nav="false" data-dots="true" data-items="1" data-items-laptop="1" data-items-tab="1" data-items-mobile="1" data-items-mobile-sm="1" data-margin="0">
                                <div class="item">
                                    <img src="/assets/img/Bia SMC.png" class="img-fluid mb-4" alt="logo">
                                    <h4 class="mb-1 text-white">
                                      TVU Social Media Club
                                    </h4>
                                    {{-- <p>It is a long established fact that a reader will be distracted by the readable content.</p> --}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Sign in END -->
      <!-- Optional JavaScript -->
      <!-- jQuery first, then Popper.js, then Bootstrap JS -->
      <script src="/assets/admin/js/jquery.min.js"></script>
      <script src="/assets/admin/js/popper.min.js"></script>
      <script src="/assets/admin/js/bootstrap.min.js"></script>
      <!-- Appear JavaScript -->
      <script src="/assets/admin/js/jquery.appear.js"></script>
      <!-- Countdown JavaScript -->
      <script src="/assets/admin/js/countdown.min.js"></script>
      <!-- Counterup JavaScript -->
      <script src="/assets/admin/js/waypoints.min.js"></script>
      <script src="/assets/admin/js/jquery.counterup.min.js"></script>
      <!-- Wow JavaScript -->
      <script src="/assets/admin/js/wow.min.js"></script>
      <!-- Apexcharts JavaScript -->
      <script src="/assets/admin/js/apexcharts.js"></script>
      <!-- Slick JavaScript -->
      <script src="/assets/admin/js/slick.min.js"></script>
      <!-- Select2 JavaScript -->
      <script src="/assets/admin/js/select2.min.js"></script>
      <!-- Owl Carousel JavaScript -->
      <script src="/assets/admin/js/owl.carousel.min.js"></script>
      <!-- Magnific Popup JavaScript -->
      <script src="/assets/admin/js/jquery.magnific-popup.min.js"></script>
      <!-- Smooth Scrollbar JavaScript -->
      <script src="/assets/admin/js/smooth-scrollbar.js"></script>
      <!-- Chart Custom JavaScript -->
      <script src="/assets/admin/js/chart-custom.js"></script>
      <!-- Custom JavaScript -->
      <script src="/assets/admin/js/custom.js"></script>
   </body>
</html>