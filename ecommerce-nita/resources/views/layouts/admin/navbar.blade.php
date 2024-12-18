<body class="dashboard dashboard_1">
    <div class="full_container">
       <div class="inner_container">
          <!-- right content -->
          <div id="content">
             <!-- topbar -->
             <div class="topbar">
                <nav class="navbar navbar-expand-lg navbar-light">
                   <div class="full">
                      <button type="button" id="sidebarCollapse" class="sidebar_toggle"><i class="fa fa-bars"></i></button>
                   
                      <div class="right_topbar">
                         <div class="icon_info">
                            <ul>
                               <li><a href="#"><i class="fa fa-bell-o"></i><span class="badge">2</span></a></li>
                               <li><a href="#"><i class="fa fa-question-circle"></i></a></li>
                               <li><a href="#"><i class="fa fa-envelope-o"></i><span class="badge">3</span></a></li>
                            </ul>
                            <ul class="user_profile_dd">
                                <li>
                                    <a class="dropdown-toggle" data-toggle="dropdown">
                                        <img class="img-responsive rounded-circle" src="{{ asset('admin/images/layout_img/user_img.jpg') }}" alt="#" />
                                        <span class="name_user">{{ Auth::user()->name }}</span>
                                    </a>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="{{ url('profile') }}">My Profile</a>
                                        <a class="dropdown-item" href="{{ url('settings') }}">Settings</a>
                                        <a class="dropdown-item" href="{{ url('help') }}">Help</a>
                                        <a class="dropdown-item" href="{{ route('logout') }}" 
                                           onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                            <span>Log Out</span> <i class="fa fa-sign-out"></i>
                                        </a>
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            @csrf
                                        </form>
                                    </div>
                                </li>
                                
                            </ul>
                         </div>
                      </div>
                   </div>
                </nav>
             </div>
             <!-- end topbar -->
          </div>
       </div>
    </div>
   <!-- jQuery -->
<script src="{{ asset('admin/js/jquery.min.js') }}"></script>
<script src="{{ asset('admin/js/popper.min.js') }}"></script>
<script src="{{ asset('admin/js/bootstrap.min.js') }}"></script>
<!-- wow animation -->
<script src="{{ asset('admin/js/animate.js') }}"></script>
<!-- select country -->
<script src="{{ asset('admin/js/bootstrap-select.js') }}"></script>
<!-- owl carousel -->
<script src="{{ asset('admin/js/owl.carousel.js') }}"></script>
<!-- chart js -->
<script src="{{ asset('admin/js/Chart.min.js') }}"></script>
<script src="{{ asset('admin/js/Chart.bundle.min.js') }}"></script>
<script src="{{ asset('admin/js/utils.js') }}"></script>
<script src="{{ asset('admin/js/analyser.js') }}"></script>
<!-- nice scrollbar -->
<script src="{{ asset('admin/js/perfect-scrollbar.min.js') }}"></script>

    <script>
       var ps = new PerfectScrollbar('#sidebar');
    </script>
 <!-- custom js -->
<script src="{{ asset('admin/js/chart_custom_style1.js') }}"></script>
<script src="{{ asset('admin/js/custom.js') }}"></script>

 </body>