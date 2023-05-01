<!-- Navbar -->
<nav id="navbar-main" class="navbar navbar-main navbar-expand-lg bg-white navbar-light position-sticky top-0 shadow py-2">
    <div class="container">
      <a class="navbar-brand mr-lg-5 " href="/">
        <img src="/assets/client/img/icons/logo_nav.png">
      </a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar_global" aria-controls="navbar_global" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="navbar-collapse collapse" id="navbar_global">
        <div class="navbar-collapse-header">
          <div class="row">
            <div class="col-6 collapse-brand">
              <a href="./index.html">
                <img src="/assets/client/img/icons/logo_nav.png">
              </a>
            </div>
            <div class="col-6 collapse-close">
              <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbar_global" aria-controls="navbar_global" aria-expanded="false" aria-label="Toggle navigation">
                <span></span>
                <span></span>
              </button>
            </div>
          </div>
        </div>
        <ul class="navbar-nav navbar-nav-hover align-items-lg-center">
          
          {{-- <li class="nav-item dropdown">
            <a href="#" class="nav-link" data-toggle="dropdown" href="#" role="button">
              <i class="ni ni-collection d-lg-none"></i>
              <span class="nav-link-inner--text">Danh mục</span>
            </a>
          </li> --}}
        </ul>
        <ul class="navbar-nav navbar-nav-hover align-items-lg-center ml-lg-auto">
          {{-- <li class="nav-item">
            <a class="nav-link nav-link-icon" href="https://www.facebook.com/tvusmc" target="_blank" data-toggle="tooltip" title="Facebook TVU Social Media Club">
              <i class="fa fa-facebook-square"></i>
              <span class="nav-link-inner--text d-lg-none">Facebook</span>
            </a>
            
          </li>
          {{-- <li class="nav-item">
            <a class="nav-link nav-link-icon" href="https://www.instagram.com/creativetimofficial" target="_blank" data-toggle="tooltip" title="Follow us on Instagram">
              <i class="fa fa-instagram"></i>
              <span class="nav-link-inner--text d-lg-none">Instagram</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link nav-link-icon" href="https://twitter.com/creativetim" target="_blank" data-toggle="tooltip" title="Follow us on Twitter">
              <i class="fa fa-twitter-square"></i>
              <span class="nav-link-inner--text d-lg-none">Twitter</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link nav-link-icon" href="https://github.com/creativetimofficial/argon-design-system" target="_blank" data-toggle="tooltip" title="Star us on Github">
              <i class="fa fa-github"></i>
              <span class="nav-link-inner--text d-lg-none">Github</span>
            </a>
          </li> --}}

          @if (auth()->check())
            <li class="nav-item dropdown">
              <a class="nav-link nav-link-icon" data-toggle="dropdown" href="#" role="button">
                <i class="fa fa-user-circle"></i>
                <small class="ml-1">
                  <b>{{ auth()->user()['name'] }}</b>
                </small>
              </a>
              <div class="dropdown-menu">
                <a href="{{ route('auth.logout') }}" class="dropdown-item">
                  Đăng xuất
                </a>
              </div>
            </li>
          @else 
            <li class="nav-item dropdown">
              <a class="nav-link nav-link-icon" data-toggle="dropdown" href="#" role="button">
                <i class="fa fa-user-circle"></i>
                <small class="ml-1"><b>Tài khoản</b></small>
              </a>
              <div class="dropdown-menu">
                <a href="{{ route('auth.login') }}" class="dropdown-item">
                  Đăng nhập
                </a>
                <a href="#" class="dropdown-item">
                  Đăng ký
                </a>
              </div>
            </li>
          @endif
        </ul>
      </div>
    </div>
  </nav>
  <!-- End Navbar -->