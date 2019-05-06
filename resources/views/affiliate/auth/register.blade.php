@extends('affiliate.layouts.auth')

@section('main')
    <div class="login-area login-s2">
        <div class="container">
            <div class="login-box ptb--100">
                <form action="{{ route('register') }}" method="post">
                    @csrf
                    <div class="login-form-head" style="padding: 0">
                        <p class="text-center mb-4">
                            <a href="{{ route('affiliate.dashboard') }}">
                            <img src="{{ url('logo-blue.png') }}" style="max-width: 50px" alt="">
                            </a>
                        </p>
                        <h4>Đăng ký thành viên</h4>
                    </div>
                    <div class="login-form-body">
                        @include('affiliate.partials.messages')
                        <div class="form-gp">
                            <label for="full_name">Họ tên của bạn <span class="text-danger">*</span></label>
                            <input type="text" id="full_name" name="full_name" value="{{ old('full_name') }}" required>
                            <i class="ti-user"></i>
                        </div>
                        <div class="form-gp">
                            <label for="email">Email <span class="text-danger">*</span></label>
                            <input type="email" id="email" name="email" required value="{{ old('email') }}">
                            <i class="ti-email"></i>
                        </div>
                        <div class="form-gp">
                            <label for="password">Mật khẩu <span class="text-danger">*</span></label>
                            <input type="password" id="password" name="password" required value="{{ old('password') }}">
                            <i class="ti-lock"></i>
                        </div>
                        <div class="form-gp">
                            <label for="password_confirmation">Nhắc lại Mật khẩu <span class="text-danger">*</span></label>
                            <input type="password" id="password_confirmation" name="password_confirmation" value="{{ old('password_confirmation') }}" required>
                            <i class="ti-lock"></i>
                        </div>

                        <div class="form-gp">
                            <label for="phone">Số điện thoại <span class="text-danger">*</span></label>
                            <input type="phone" id="phone" name="phone" value="{{ old('phone') }}">
                            <i class="ti-mobile"></i>
                        </div>

                        <div class="form-gp">
                            <label for="website">Website ( Nếu có ) </label>
                            <input type="text" id="website" name="website" value="{{ old('website') }}">
                        </div>

                        <div class="form-gp">
                            <label for="company">Tên công ty ( Nếu có ) </label>
                            <input type="text" id="company" name="company" value="{{ old('company') }}">
                        </div>

                        <div class="submit-btn-area">
                            <button id="form_submit" type="submit">ĐĂNG KÝ <i class="ti-arrow-right"></i></button>
                        </div>
                        <div class="form-footer text-center mt-5">
                            <p class="text-muted">Bạn đã có tài khoản?<a href="/login">Đăng nhập</a></p>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- login area end -->

@endsection
