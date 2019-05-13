@extends('affiliate.layouts.auth')

@section('main')

    <div class="login-area login-s2">
        <div class="container">
            <div class="login-box ptb--100">
                <form method="POST" action="{{ route('password.email') }}">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    @csrf
                    <div class="login-form-head">
                        <h4>Quên mật khẩu</h4>
                        <p>Nhập email của bạn để nhận link thay đổi mật khẩu mới</p>
                    </div>
                    <div class="login-form-body">

                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" id="email" name="email" class="form-control">
                            <i class="ti-lock"></i>
                            @if ($errors->has('email'))
                                <span class="invalid-feedback {{ $errors->has('email') ? ' d-block' : '' }}" role="alert">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="submit-btn-area mt-5">
                            <button id="form_submit" type="submit">Gửi <i class="ti-arrow-right"></i></button>
                        </div>
                        <p class="text-right mt-3">
                            <a href="{{ route('login') }}">Quay lại</a>
                        </p>

                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- login area end -->


@endsection
