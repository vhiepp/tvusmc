<!-- Sidebar  -->
<div class="iq-sidebar">
    <div class="iq-sidebar-logo d-flex justify-content-between">
       <a href="/">
          <img src="/assets/img/logo_nav.png" class="img-fluid" alt="">
       </a>
       <div class="iq-menu-bt align-self-center">
          <div class="wrapper-menu">
             <div class="line-menu half start"></div>
             <div class="line-menu"></div>
             <div class="line-menu half end"></div>
          </div>
       </div>
    </div>
    <div id="sidebar-scrollbar">
       <nav class="iq-sidebar-menu">
          <ul id="iq-sidebar-toggle" class="iq-menu">
             <li class="iq-menu-title"><i class="ri-separator"></i><span>Main</span></li>
             <li class="
                @if ($page == 'dashboard') active @endif
             ">
                <a href="{{ route('admin.dashboard') }}" class="iq-waves-effect collapsed">
                   <i class="ri-home-4-line"></i><span>Dashboard</span>
                </a>
             </li>
             <li class="
                @if ($page == 'categories') active @endif
             ">
                <a href="{{ route('admin.categories') }}" class="iq-waves-effect collapsed">
                    <i class="ri-profile-line"></i><span>Danh mục</span>
                </a>
             </li>
            <li class="
                @if ($page == 'events') active @endif
             ">
                <a href="{{ route('admin.events') }}" class="iq-waves-effect collapsed">
                  <i class="ri-calendar-event-line"></i><span>Sự kiện</span>
                </a>
            </li>

            <li class="
                @if ($page == 'blogs') active @endif
             ">
                <a href="{{ route('admin.blogs') }}" class="iq-waves-effect collapsed">
                    <i class="ri-profile-line"></i><span>Bài viết</span>
                </a>
             </li>

             <li class="
                @if ($page == 'documents') active @endif
             ">
                <a href="{{ route('admin.documents') }}" class="iq-waves-effect collapsed">
                    <i class="ri-article-line"></i><span>Văn bản</span>
                </a>
             </li>

             
             <li class="
             @if ($page == 'users') active @endif
             ">
             <a class="iq-waves-effect collapsed" href="{{ route('admin.users') }}">
                <i class="ri-user-line"></i><span>Thành viên</span>
               </a>
            </li>
            
            <li class="
               @if ($page == 'introduces') active @endif
            ">
               <a href="{{ route('admin.introduces') }}" class="iq-waves-effect collapsed">
                   <i class="ri-git-repository-line"></i><span>Giới thiệu</span>
               </a>
            </li>
             {{-- <li class="
                @if ($page == 'file') active @endif
             ">
                <a class="iq-waves-effect collapsed" href="{{ route('admin.files') }}">
                    <i class="ri-file-line"></i><span>Chia sẻ file</span>
                </a>
             </li> --}}
          </ul>
       </nav>
       <div class="p-3"></div>
    </div>
  </div>
