<!-- header area start -->
<div class="header-area bg-primary header-bottom">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-12 d-none d-lg-block">
                <div class="horizontal-menu">
                    <nav>
                        <ul id="nav_menu">
                            <li>
                                <a href="{{ route('affiliate.dashboard') }}"><i class="ti-dashboard"></i><span>dashboard</span></a>
                            </li>
                            <li>
                                <a class="btn btn-danger" href="{{ route('affiliate.campaign') }}"><i class="ti-dashboard"></i><span>Chiến dịch của bạn</span></a>
                            </li>
                            <li>
                                <a href="{{ route('affiliate.report') }}"><i class="ti-bar-chart"></i><span>Báo cáo</span></a>
                                <ul class="submenu">
                                    <li><a href="{{ route('affiliate.report') }}">Đơn hàng</a></li>
                                    <li><a href="{{ route('affiliate.report.click') }}">Lượt click</a></li>
                                </ul>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>

            <!-- mobile_menu -->
            <div class="col-12 d-block d-lg-none">
                <div id="mobile_menu"></div>
            </div>
        </div>
    </div>
</div>
<!-- header area end -->