@extends('admin.layouts.app')

@section('main')
    <div class="clearfix mb-3">
        <p class="float-left">
            Affiliate: {{ $affiliate->full_name }}
        </p>

    </div>
    @include('admin.partials.messages')
    @include('admin.affiliate.nav')
    <!-- Default box -->
    <div class="card">
        <div class="card-body">
            <form class="forms-sample" method="POST" action="{{ route('admin.affiliate.change.password.save',$affiliate->id ) }}">
                @csrf
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
@endsection

