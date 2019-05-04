@extends('affiliate.layouts.app')

@section('main')
    <div class="container mt-3">
        <div class="breadcrumbs-area clearfix mb-3">
            <ul class="breadcrumbs">
                <li><a href="{{ route('affiliate.dashboard') }}"><i class="ti-dashboard"></i> Dashboard</a></li>
                <li><span>Hồ sơ của bạn</span></li>
            </ul>
        </div>

        <div class="row">
            <div class="col-md-3">
                @include('affiliate.user.partials.nav')
            </div>
            <div class="col-md-9">
                <div class="card">
                    <div class="card-body">
                        <form class="forms-sample" method="POST" action="{{ route('affiliate.change.password.save') }}">
                            @csrf
                            <div class="form-group required">
                                <label for="InputPasswordCurrent">Mật khẩu cũ <sup class="text-danger"> * </sup> </label>
                                <input type="password" value="{{ old('old_pass') }}" name="old_pass" class="form-control"
                                       id="InputPasswordCurrent" placeholder="******">
                            </div>
                            <div class="form-group">
                                <label for="">Mật khẩu mới <span class="text-danger">*</span></label>
                                <input name="password"  value="{{ old('password') }}"  type="password" class="form-control"
                                       placeholder="******">
                            </div>
                            <div class="form-group">
                                <label for="">Nhắc lại Mật khẩu <span class="text-danger">*</span></label>
                                <input  value="{{ old('password_confirmation') }}"  name="password_confirmation" type="password"
                                        class="form-control" placeholder="******">
                            </div>

                            <button type="submit" class="btn btn-success mr-2"><i class="fa fa-save"></i> Lưu</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>


    </div>
@endsection

