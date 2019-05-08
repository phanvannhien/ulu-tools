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
                        <div class="mb-3 alert alert-warning">
                            <p>APY key: {{ $profile->jwt_token }}</p>
                        </div>

                        <form method="post" action="{{ route('affiliate.profile.save') }}" >
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Tên đăng nhập <span class="text-danger">*</span></label>
                                        <input class="form-control" type="text" name="username" readonly value="{{ old('username', $profile->username ) }} ">
                                    </div>

                                    <div class="form-group">
                                        <label for="">Họ tên <span class="text-danger">*</span></label>
                                        <input class="form-control" type="text" name="full_name" value="{{ old('full_name', $profile->full_name ) }} ">
                                    </div>

                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Website</label>
                                        <input class="form-control" type="text" name="website" value="{{ old('website', $profile->website ) }} ">
                                    </div>
                                    <div class="form-group">
                                        <label for="">Tên công ty</label>
                                        <input class="form-control" type="text" name="company" value="{{ old('company', $profile->company ) }} ">
                                    </div>
                                    <div class="form-group">
                                        <label for="">Địa chỉ</label>
                                        <input class="form-control" type="text" name="address" value="{{ old('address', $profile->address ) }} ">
                                    </div>

                                    <div class="form-group">
                                        <label for="">Số điện thoại<span class="text-danger">*</span></label>
                                        <input class="form-control" type="text" name="phone" value="{{ old('phone', $profile->phone ) }} ">
                                    </div>

                                </div>
                            </div>
                            <button type="submit" type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Lưu</button>

                        </form>
                        
                    </div>
                </div>
            </div>
        </div>


    </div>
@endsection

