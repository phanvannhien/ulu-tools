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
                        <a href="{{ route('admin.dashboard') }}"><i class="fa fa-home"></i> 
                            <span>Dashboard</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('affiliate.index') }}" aria-expanded="true">
                            <i class="ti-user"></i>
                            <span>Affiliate</span></a>
                            <ul class="collapse">
                                <li><a href="{{ route('affiliate.index') }}">All Affiliate</a></li>
                                <li><a href="{{ route('affiliate_level.index') }}">Affiliate level</a></li>
                            </ul>
                    </li>
                    <li>
                        <a href="{{ route('merchant.index') }}" aria-expanded="true">
                            <i class="ti-user"></i>
                            <span>Merchant</span></a>
                    </li>
                    <li>
                        <a href="{{ route('transaction') }}" aria-expanded="true">
                            <i class="ti-user"></i>
                            <span>Conversion</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.traffic') }}" aria-expanded="true">
                            <i class="fa fa-calendar-times-o"></i>
                            <span>Traffic</span>
                        </a>
                    </li>


                    <li>
                        <a href="{{ route('campaign.index') }}" aria-expanded="true">
                            <i class="ti-user"></i>
                            <span>Campaign</span>
                        </a>
                        <ul class="collapse">
                            <li>
                                <a href="{{ route('campaign.index') }}">
                                    All Campaigns
                                </a>
                            </li>
                            <li><a href="{{ route('campaign_link.index') }}">Campaign Banners</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="{{ route('configuration.index') }}" aria-expanded="true">
                            <i class="ti-settings"></i>
                            <span>Setting</span>
                        </a>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
</div>
<!-- sidebar menu area end -->