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
                                <a href="#"><i class="ti-dashboard"></i><span>Data Feed</span></a>
                                <ul class="submenu">
                                    <li><a href="{{ route('shopee.datafeed') }}">Shopee</a></li>
                                </ul>
                            </li>
                            <li>
                                <a class="btn btn-danger" href="{{ route('affiliate.campaign') }}"><i class="ti-dashboard"></i><span>Chiến dịch</span></a>
                            </li>
                            <li>
                                <a href="{{ route('affiliate.report') }}"><i class="ti-bar-chart"></i><span>Báo cáo</span></a>
                                <ul class="submenu">
                                    <li><a href="{{ route('affiliate.report') }}">Đơn hàng</a></li>
                                    <li><a href="{{ route('affiliate.report.click') }}">Lượt click</a></li>
                                </ul>
                            </li>





                            {{--<li class="active">--}}
                                {{--<a href="javascript:void(0)"><i class="ti-layout-sidebar-left"></i><span>Sidebar--}}
                                                {{--Types</span></a>--}}
                                {{--<ul class="submenu">--}}
                                    {{--<li><a href="index.html">Left Sidebar</a></li>--}}
                                    {{--<li class="active"><a href="index3-horizontalmenu.html">Horizontal Sidebar</a></li>--}}
                                {{--</ul>--}}
                            {{--</li>--}}
                            {{--<li>--}}
                                {{--<a href="javascript:void(0)"><i class="ti-pie-chart"></i><span>Charts</span></a>--}}
                                {{--<ul class="submenu">--}}
                                    {{--<li><a href="barchart.html">bar chart</a></li>--}}
                                    {{--<li><a href="linechart.html">line Chart</a></li>--}}
                                    {{--<li><a href="piechart.html">pie chart</a></li>--}}
                                {{--</ul>--}}
                            {{--</li>--}}
                            {{--<li class="mega-menu">--}}
                                {{--<a href="javascript:void(0)"><i class="ti-palette"></i><span>UI Features</span></a>--}}
                                {{--<ul class="submenu">--}}
                                    {{--<li><a href="accordion.html">Accordion</a></li>--}}
                                    {{--<li><a href="alert.html">Alert</a></li>--}}
                                    {{--<li><a href="badge.html">Badge</a></li>--}}
                                    {{--<li><a href="button.html">Button</a></li>--}}
                                    {{--<li><a href="button-group.html">Button Group</a></li>--}}
                                    {{--<li><a href="cards.html">Cards</a></li>--}}
                                    {{--<li><a href="dropdown.html">Dropdown</a></li>--}}
                                    {{--<li><a href="list-group.html">List Group</a></li>--}}
                                    {{--<li><a href="media-object.html">Media Object</a></li>--}}
                                    {{--<li><a href="modal.html">Modal</a></li>--}}
                                    {{--<li><a href="pagination.html">Pagination</a></li>--}}
                                    {{--<li><a href="popovers.html">Popover</a></li>--}}
                                    {{--<li><a href="progressbar.html">Progressbar</a></li>--}}
                                    {{--<li><a href="tab.html">Tab</a></li>--}}
                                    {{--<li><a href="typography.html">Typography</a></li>--}}
                                    {{--<li><a href="form.html">Form</a></li>--}}
                                    {{--<li><a href="grid.html">grid system</a></li>--}}
                                {{--</ul>--}}
                            {{--</li>--}}
                            {{--<li class="mega-menu">--}}
                                {{--<a href="javascript:void(0)"><i class="ti-layers-alt"></i> <span>Pages</span></a>--}}
                                {{--<ul class="submenu">--}}
                                    {{--<li><a href="login.html">Login</a></li>--}}
                                    {{--<li><a href="login2.html">Login 2</a></li>--}}
                                    {{--<li><a href="login3.html">Login 3</a></li>--}}
                                    {{--<li><a href="register.html">Register</a></li>--}}
                                    {{--<li><a href="register2.html">Register 2</a></li>--}}
                                    {{--<li><a href="register3.html">Register 3</a></li>--}}
                                    {{--<li><a href="register4.html">Register 4</a></li>--}}
                                    {{--<li><a href="screenlock.html">Lock Screen</a></li>--}}
                                    {{--<li><a href="screenlock2.html">Lock Screen 2</a></li>--}}
                                    {{--<li><a href="reset-pass.html">reset password</a></li>--}}
                                    {{--<li><a href="pricing.html">Pricing</a></li>--}}
                                    {{--<li><a href="404.html">Error 404</a></li>--}}
                                    {{--<li><a href="500.html">Error 500</a></li>--}}
                                    {{--<li><a href="invoice.html"><i class="ti-receipt"></i> <span>Invoice Summary</span></a></li>--}}
                                {{--</ul>--}}
                            {{--</li>--}}
                            {{--<li>--}}
                                {{--<a href="javascript:void(0)"><i class="ti-slice"></i><span>icons</span></a>--}}
                                {{--<ul class="submenu">--}}
                                    {{--<li><a href="fontawesome.html">fontawesome icons</a></li>--}}
                                    {{--<li><a href="themify.html">themify icons</a></li>--}}
                                {{--</ul>--}}
                            {{--</li>--}}
                            {{--<li>--}}
                                {{--<a href="javascript:void(0)"><i class="fa fa-table"></i>--}}
                                    {{--<span>Tables</span></a>--}}
                                {{--<ul class="submenu">--}}
                                    {{--<li><a href="table-basic.html">basic table</a></li>--}}
                                    {{--<li><a href="table-layout.html">table layout</a></li>--}}
                                    {{--<li><a href="datatable.html">datatable</a></li>--}}
                                {{--</ul>--}}
                            {{--</li>--}}
                            {{--<li><a href="maps.html"><i class="ti-map-alt"></i> <span>maps</span></a></li>--}}
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