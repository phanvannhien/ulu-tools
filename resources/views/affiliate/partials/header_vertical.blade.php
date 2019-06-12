<!-- header area start -->
<div class="header-area">
   <div class="row align-items-center">
       <!-- nav and search button -->
       <div class="col-md-4 col-sm-8 clearfix">
           <div class="nav-btn pull-left">
               <span></span>
               <span></span>
               <span></span>
           </div>
       </div>
       <!-- profile info & task notification -->
       <div class="col-md-8 col-sm-4 clearfix text-right">
           <div class="d-flex justify-content-end align-items-center">
               
                <div class="user-profile m-0 ">
                    <img class="avatar user-thumb" src="{{ url('srtdash/assets/images/author/avatar.png') }}" alt="avatar">
                    <h4 class="user-name dropdown-toggle" data-toggle="dropdown">{{ auth()->user()->full_name }}
                        <i class="fa fa-angle-down"></i></h4>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="{{ route('affiliate.profile') }}"><i class="ti-user"></i>  Tài khoản</a>
                        <a class="dropdown-item" href="{{ route('bank.index') }}"><i class="fa fa-bank"></i> Ngân hàng</a>

                        <a class="dropdown-item" target="_blank" href="http://ulu.vn/document"><i class="fa fa-file"></i> API Document</a>
                        <form class="d-inline" action="{{ route('logout') }}" method="post">
                            @csrf
                            <a class="dropdown-item" href="#" onclick="$(this).parent('form').submit()"><i class="ti-lock"></i> Đăng xuất</a>
                        </form>
                    </div>
                </div>

           </div>
       </div>
   </div>
</div>
<!-- header area end -->