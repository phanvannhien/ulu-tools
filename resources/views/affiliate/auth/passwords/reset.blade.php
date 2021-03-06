@extends('affiliate.layouts.auth')

@section('main')
<div class="login-area login-s2">
    <div class="container">
        <div class="login-box ptb--100">
            <form method="POST" action="{{ route('password.update') }}">
                @csrf
                <input type="hidden" name="token" value="{{ $token }}">
                @include('affiliate.partials.messages')
                <div class="login-form-head">
                    <h4>Thay đổi mật khẩu</h4>
                </div>
                <div class="login-form-body">

                    <div class="form-group">
                        <label for="email">Email</label>
                        <input class="form-control" type="email" id="email" name="email" value="{{ $email ?? old('email') }}" required autofocus>
                        <i class="ti-lock"></i>
                        @if ($errors->has('email'))
                            <span class="invalid-feedback {{ $errors->has('email') ? ' d-block' : '' }}" role="alert">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="password">Mật khẩu mới</label>
                        <input class="form-control" type="password" id="password" name="password" required>
                        <i class="ti-lock"></i>
                        @if ($errors->has('password'))
                            <span class="invalid-feedback {{ $errors->has('password') ? ' d-block' : '' }}" role="alert">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="form-gp">
                        <label for="password_confirmation">Nhắc lại mật khẩu mới</label>
                        <input type="password" id="password_confirmation" name="password_confirmation" required>
                        <i class="ti-lock"></i>
                    </div>

                    <div class="submit-btn-area mt-5">
                        <button id="form_submit" type="submit">Gửi <i class="ti-arrow-right"></i></button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- login area end -->
@endsection
