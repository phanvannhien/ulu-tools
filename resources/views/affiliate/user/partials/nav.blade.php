

<ul class="list-group">
    <li class="list-group-item">
        <a href="{{ route('affiliate.profile') }}"><i class="ti-user"></i> Thông tin cá nhân</a></li>

    <li class="list-group-item">
        <a href="{{ route('affiliate.change.password') }}"><i class="ti-lock"></i> Đổi mật khẩu</a></li>
    <li class="list-group-item">
        <a  href="{{ route('bank.index') }}"><i class="fa fa-bank"></i> Ngân hàng</a>
    </li>
    <li class="list-group-item">
        <form class="d-inline" action="{{ route('logout') }}" method="post">
            @csrf
            <a href="#" onclick="$(this).parent('form').submit()">
                <i class="ti-lock"></i> Đăng xuất</a>
        </form>
    </li>
</ul>