@extends('affiliate.layouts.auth')

@section('main')
    <div class="login-area login-s2">
        <div class="container">
            <div class="login-box ptb--100">
                    
                <form method="POST" action="{{ route('login') }}" class="login100-form validate-form">
                        @include('affiliate.partials.messages')
                    @csrf
                    <div class="login-form-head" style="padding: 0">
                        <p class="text-center mb-4">
                            <a href="{{ route('affiliate.dashboard') }}">
                                <img src="{{ url('logo-blue.png') }}" style="max-width: 50px" alt="">
                            </a>
                        </p>
                        <h4>Đăng nhập</h4>
                    </div>
                    <div class="login-form-body">
                        <div class="form-group">
                            <label for="username">Email</label>
                            <input class="form-control" type="email" id="username" name="username" placeholder="Email">
                        </div>
                        <div class="form-group">
                            <label for="password">Mật khẩu</label>
                            <input class="form-control" type="password" id="password" name="password" placeholder="Mật khẩu">
                        </div>

                        <div class="submit-btn-area">
                            <button id="form_submit" type="submit">ĐĂNG NHẬP <i class="ti-arrow-right"></i></button>
                            <p class="mt-3 text-right">
                                    <a href="{{ route('password.request') }} ">Quên mật khẩu?</a>
                            </p>
                           
                        </div>

                        <div class="form-footer text-center mt-5">
                            <p class="text-muted">Bạn chưa có tài khoản? <a href="{{ route('register') }}">Đăng ký</a></p>
                        </div>

                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- login area end -->

@endsection
