  <!-- Sidebar  -->
  <nav id="sidebar">
    <div class="sidebar_blog_1">
       <div class="sidebar-header">
          <div class="logo_section">
             <a href="index.html"><img class="logo_icon img-responsive" src="images/logo/logo_icon.png" alt="#" /></a>
          </div>
       </div>
       <div class="sidebar_user_info">
          <div class="icon_setting"></div>
          <div class="user_profle_side">
             <div class="user_img"><img class="img-responsive" src="images/layout_img/user_img.jpg" alt="#" /></div>
             <div class="user_info">
                <h6>{{ Auth::user()->name }}</h6>
                <p><span class="online_animation"></span> Online</p>
             </div>
          </div>
       </div>
    </div>
    <div class="sidebar_blog_2">
       <h4>General</h4>
       <ul class="list-unstyled components">
          <li>
            <a href="#products" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                <i class="fa fa-box purple_color"></i> <span>Products</span>
            </a>
            <ul class="collapse list-unstyled" id="products">
                <li><a href="{{ route('admin.products.index') }}"> <span>All Products</span></a></li>
                <li><a href="{{ route('admin.products.create') }}"> <span>Create Product</span></a></li>
            </ul>
        </li>
       </ul>
    </div>
 </nav>
 <!-- end sidebar -->