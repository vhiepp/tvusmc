<!-- Navbar -->
<nav id="navbar-main" class="navbar navbar-main navbar-expand-lg bg-white navbar-light position-sticky top-0 shadow py-2">
    <div class="container">
      <a class="navbar-brand mr-lg-5 " href="/">
        <img src="/assets/img/logo_nav.png" style="width: 42px; height: 42px">
      </a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar_global" aria-controls="navbar_global" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="navbar-collapse collapse" id="navbar_global">
        <div class="navbar-collapse-header">
          <div class="row">
            <div class="col-6 collapse-brand">
              <a href="/">
                <img src="/assets/img/logo_nav.png" style="width: 52px; height: 52px">
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
          
          <li class="nav-item dropdown">
            <a class="nav-link" href="/" role="button">
              <span class="nav-link-inner--text">Trang chủ</span>
            </a>
          </li>

          <li class="nav-item dropdown">
            <a class="nav-link" href="{{ route('client.events.list') }}" role="button">
              <span class="nav-link-inner--text">Sự kiện</span>
            </a>
          </li>

        </ul>
        <ul class="navbar-nav navbar-nav-hover align-items-lg-center ml-lg-auto">
          @if (auth()->check())
            <li class="nav-item dropdown">
              <a class="nav-link nav-link-icon no-loader" data-toggle="dropdown" href="#" role="button">
                <i class="fa fa-user-circle"></i>
                <small class="ml-1">
                  <b>{{ auth()->user()['given_name'] }}</b>
                </small>
              </a>
              <div class="dropdown-menu">

                <a href="{{ route('profile.view') }}" class="dropdown-item d-flex flex-column align-items-center">
                  <span  class="avatar avatar-lg rounded-circle" data-toggle="tooltip" data-original-title="Romina Hadid">
                    <img alt="avatar" src="{{ auth()->user()['avatar'] }}">
                  </span>
                  <span class="mt-1 font-weight-bold">{{ auth()->user()['name'] }}</span>
                </a>
                @if (auth()->user()['role'] == 'leader')
                  <a href="{{ route('admin.dashboard') }}" class="dropdown-item">
                    Quản trị
                  </a>
                @endif

                <a href="{{ route('auth.logout') }}" class="dropdown-item">
                  Đăng xuất
                </a>
              </div>
            </li>
          @else 
            <li class="nav-item dropdown">
              <a class="nav-link nav-link-icon no-loader" data-toggle="dropdown" href="#" role="button">
                <i class="fa fa-user-circle"></i>
                <small class="ml-1"><b>Tài khoản</b></small>
              </a>
              <div class="dropdown-menu">
                <a href="{{ route('auth.login') }}" class="dropdown-item">
                  Đăng nhập
                </a>
              </div>
            </li>
          @endif
        </ul>
      </div>
    </div>
  </nav>
  <!-- End Navbar -->