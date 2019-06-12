<!-- sidebar menu area start -->
<div class="sidebar-menu">
    <div class="sidebar-header">
        <div class="logo">
            <a href="{{ route('admin.dashboard') }}">
                <img src="{{ url('logo-white.png') }}" alt="logo" style="max-height: 40px">
            </a>
        </div>
    </div>
    <div class="main-menu">
        <div class="menu-inner">
            <nav>
                <ul class="metismenu" id="menu">
                    <li>
                        <a href="{{ route('affiliate.dashboard') }}">
                            <i class="ti-dashboard"></i>
                            <span>dashboard</span>
                        </a>
                    </li>
                    <li class="bg-danger">
                        <a href="{{ route('affiliate.campaign') }}">
                            <i class="ti-target"></i>
                            <span>Chiến dịch của bạn</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('affiliate.report') }}">
                            <i class="ti-bar-chart"></i>
                            <span>Báo cáo</span>
                        </a>
                        <ul class="collapse">
                            <li><a href="{{ route('affiliate.report') }}">Đơn hàng</a></li>
                            <li><a href="{{ route('affiliate.report.click') }}">Lượt click</a></li>
                        </ul>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
</div>
<!-- sidebar menu area end -->