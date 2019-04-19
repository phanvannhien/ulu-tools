@extends('affiliate.layouts.app')

@section('main')
    <div class="container mt-3">
        <div class="breadcrumbs-area clearfix mb-3">
            <ul class="breadcrumbs">
                <li><a href="{{ route('affiliate.dashboard') }}"><i class="ti-dashboard"></i> Dashboard</a></li>
                <li><span>Hồ sơ của bạn</span></li>
            </ul>
        </div>

        <div class="card">
            <div class="card-body">
                <form method="post" action="" >
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Tên đăng nhập <span class="text-danger">*</span></label>
                                <input class="form-control" type="text" name="userid" value="{{ old('userid', $profile->getFieldValue('userid') ) }} ">
                            </div>
                            <div class="form-group">
                                <label for="">Mật khẩu <span class="text-danger">*</span></label>
                                <input class="form-control"  type="password" name="rpassword" value="{{ old('rpassword', $profile->getFieldValue('rpassword') ) }} ">
                            </div>
                            <div class="form-group">
                                <label for="">Tên <span class="text-danger">*</span></label>
                                <input class="form-control" type="text" name="firstname" value="{{ old('firstname', $profile->getFieldValue('firstname') ) }} ">
                            </div>
                            <div class="form-group">
                                <label for="">Họ <span class="text-danger">*</span></label>
                                <input class="form-control" type="text" name="lastname" value="{{ old('lastname', $profile->getFieldValue('lastname') ) }} ">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Website</label>
                                <input class="form-control" type="text" name="data1" value="{{ old('data1', $profile->getFieldValue('data1') ) }} ">
                            </div>
                            <div class="form-group">
                                <label for="">Tên công ty</label>
                                <input class="form-control" type="text" name="data2" value="{{ old('data2', $profile->getFieldValue('data2') ) }} ">
                            </div>
                            <div class="form-group">
                                <label for="">Địa chỉ <span class="text-danger">*</span></label>
                                <input class="form-control" type="text" name="data3" value="{{ old('data3', $profile->getFieldValue('data3') ) }} ">
                            </div>
                            <div class="form-group">
                                <label for="">Thành phố <span class="text-danger">*</span></label>
                                <input class="form-control" type="text" name="data4" value="{{ old('data4', $profile->getFieldValue('data4') ) }} ">
                            </div>
                            <div class="form-group">
                                <label for="">Số điện thoại<span class="text-danger">*</span></label>
                                <input class="form-control" type="text" name="data8" value="{{ old('data8', $profile->getFieldValue('data8') ) }} ">
                            </div>
                            
                        </div>
                    </div>
                </form>
                
            </div>
        </div>


    </div>
@endsection

