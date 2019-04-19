@extends('affiliate.layouts.auth')

@section('main')
    <div class="login-area">
        <div class="container">
            <div class="login-box ptb--100">
                    
                <form method="POST" action="{{ route('login') }}" class="login100-form validate-form">
                        @include('affiliate.partials.messages')
                    @csrf
                    <div class="login-form-head">
                        <h4>Đăng nhập</h4>
                    </div>
                    <div class="login-form-body">
                        <div class="form-gp">
                            <label for="username">Email</label>
                            <input type="email" id="username" name="username">
                            <i class="ti-email"></i>
                        </div>
                        <div class="form-gp">
                            <label for="password">Mật khẩu</label>
                            <input type="password" id="password" name="password">
                            <i class="ti-lock"></i>
                        </div>

                        <div class="submit-btn-area">
                            <button id="form_submit" type="submit">ĐĂNG NHẬP <i class="ti-arrow-right"></i></button>
                        </div>

                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- login area end -->

@endsection
