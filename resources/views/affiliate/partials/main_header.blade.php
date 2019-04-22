<!-- main header area start -->
<div class="mainheader-area">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-3">
                <div class="logo">
                    <a href="/"><img src="{{ url('logo-blue.png') }}" alt="logo" style="max-height: 40px"></a>
                </div>
            </div>
            <!-- profile info & task notification -->
            <div class="col-9 clearfix text-right">
                <div class="clearfix d-md-inline-block d-block">
                    <div class="user-profile m-0 float-right">
                        <img class="avatar user-thumb" src="{{ url('srtdash/assets/images/author/avatar.png') }}" alt="avatar">
                        <h4 class="user-name dropdown-toggle" data-toggle="dropdown">{{ auth()->user()->full_name }}
                            <i class="fa fa-angle-down"></i></h4>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="{{ route('affiliate.profile') }}"><i class="ti-user"></i>  Tài khoản</a>
                            <a class="dropdown-item" href="{{ route('bank.index') }}"><i class="fa fa-bank"></i> Ngân hàng</a>

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
</div>
<!-- main header area end -->