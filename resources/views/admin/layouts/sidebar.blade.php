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
                @if ($page == 'blogs') active @endif 
             ">
                <a href="{{ route('admin.blogs') }}" class="iq-waves-effect collapsed">
                    <i class="ri-profile-line"></i><span>Bài viết</span>
                </a>
             </li>
    
             <li class="iq-menu-title"><i class="ri-separator"></i><span>Components</span></li>
             <li>
                <a href="#ui-elements" class="iq-waves-effect collapsed" data-toggle="collapse"
                   aria-expanded="false"><i class="ri-pencil-ruler-line"></i><span>UI Elements</span><i
                      class="ri-arrow-right-s-line iq-arrow-right"></i></a>
                <ul id="ui-elements" class="iq-submenu collapse" data-parent="#iq-sidebar-toggle">
                   <li><a href="ui-colors.html">colors</a></li>
                   <li><a href="ui-typography.html">Typography</a></li>
                   <li><a href="ui-alerts.html">Alerts</a></li>
                   <li><a href="ui-badges.html">Badges</a></li>
                   <li><a href="ui-breadcrumb.html">Breadcrumb</a></li>
                   <li><a href="ui-buttons.html">Buttons</a></li>
                   <li><a href="ui-cards.html">Cards</a></li>
                   <li><a href="ui-carousel.html">Carousel</a></li>
                   <li><a href="ui-embed-video.html">Video</a></li>
                   <li><a href="ui-grid.html">Grid</a></li>
                   <li><a href="ui-images.html">Images</a></li>
                   <li><a href="ui-list-group.html">list Group</a></li>
                   <li><a href="ui-media-object.html">Media</a></li>
                   <li><a href="ui-modal.html">Modal</a></li>
                   <li><a href="ui-notifications.html">Notifications</a></li>
                   <li><a href="ui-pagination.html">Pagination</a></li>
                   <li><a href="ui-popovers.html">Popovers</a></li>
                   <li><a href="ui-progressbars.html">Progressbars</a></li>
                   <li><a href="ui-tabs.html">Tabs</a></li>
                   <li><a href="ui-tooltips.html">Tooltips</a></li>
                </ul>
             </li>
             
             <li class="iq-menu-title"><i class="ri-separator"></i><span>Pages</span></li>
             <li>
                <a href="#authentication" class="iq-waves-effect collapsed" data-toggle="collapse"
                   aria-expanded="false"><i class="ri-pages-line"></i><span>Authentication</span><i
                      class="ri-arrow-right-s-line iq-arrow-right"></i></a>
                <ul id="authentication" class="iq-submenu collapse" data-parent="#iq-sidebar-toggle">
                   <li><a href="sign-in.html">Login</a></li>
                   <li><a href="sign-up.html">Register</a></li>
                   <li><a href="pages-recoverpw.html">Recover Password</a></li>
                   <li><a href="pages-confirm-mail.html">Confirm Mail</a></li>
                   <li><a href="pages-lock-screen.html">Lock Screen</a></li>
                </ul>
             </li>
             <li>
                <a href="#menu-level" class="iq-waves-effect collapsed" data-toggle="collapse"
                   aria-expanded="false"><i class="ri-record-circle-line"></i><span>Menu Level</span><i
                      class="ri-arrow-right-s-line iq-arrow-right"></i></a>
                <ul id="menu-level" class="iq-submenu collapse" data-parent="#iq-sidebar-toggle">
                   <li><a href="#"><i class="ri-record-circle-line"></i>Menu 1</a></li>
  
                </ul>
             </li>
          </ul>
       </nav>
       <div class="p-3"></div>
    </div>
  </div>