<!-- TOP Nav Bar -->
<div class="iq-top-navbar">
   <div class="iq-navbar-custom">
      <div class="iq-sidebar-logo">
         <div class="top-logo">
            <a href="/" class="logo">
               <img src="/assets/img/logo_nav.png" class="img-fluid" alt="">
               <span>TVU SMC</span>
            </a>
         </div>
      </div>
      <nav class="navbar navbar-expand-lg navbar-light p-0">
         <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <i class="ri-menu-3-line"></i>
         </button>
         <div class="iq-menu-bt align-self-center">
            <div class="wrapper-menu">
               <div class="line-menu half start"></div>
               <div class="line-menu"></div>
               <div class="line-menu half end"></div>
            </div>
         </div>
         <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ml-auto navbar-list">
               <li class="nav-item">
                  <a class="search-toggle iq-waves-effect" href="#"><i class="ri-search-line"></i></a>
                  <form action="#" class="search-box">
                     <input type="text" class="text search-input" placeholder="Type here to search..." />
                  </form>
               </li>
               <li class="nav-item">
                  <a href="#" class="iq-waves-effect"><i class="ri-shopping-cart-2-line"></i></a>
               </li>
               <li class="nav-item iq-full-screen"><a href="#" class="iq-waves-effect" id="btnFullscreen"><i
                        class="ri-fullscreen-line"></i></a></li>
            </ul>
         </div>
         <ul class="navbar-list">
            <li>
               <a href="#" class="search-toggle iq-waves-effect bg-primary text-white"><img
                     src="{{ auth()->user()['avatar'] }}" class="img-fluid rounded" alt="user"></a>
               <div class="iq-sub-dropdown iq-user-dropdown">
                  <div class="iq-card iq-card-block iq-card-stretch iq-card-height shadow-none m-0">
                     <div class="iq-card-body p-0 ">
                        <div class="bg-primary p-3">
                           <h5 class="mb-0 text-white line-height">Hello {{ auth()->user()['name'] }}</h5>
                           <span class="text-white font-size-12">Available</span>
                        </div>
                        <div class="d-inline-block w-100 text-center p-3">
                           <a class="iq-bg-danger iq-sign-btn" href="{{ route('admin.auth.logout') }}" role="button">Sign out<i
                                 class="ri-login-box-line ml-2"></i></a>
                        </div>
                     </div>
                  </div>
               </div>
            </li>
         </ul>
      </nav>
   </div>
</div>
<!-- TOP Nav Bar END -->
