@extends('affiliate.layouts.app')

@section('main')
    <div class="container mt-3">
        <div class="breadcrumbs-area clearfix mb-3">
            <ul class="breadcrumbs">
                <li><a href="{{ route('affiliate.dashboard') }}"><i class="ti-dashboard"></i> Dashboard</a></li>
                <li><span>Ngân hàng của bạn</span></li>
            </ul>
        </div>

        <div class="row">
            <div class="col-md-3">
                @include('affiliate.user.partials.nav')
            </div>
            <div class="col-md-9">
                <div class="card">
                    <div class="card-body">

                        <div class="alert alert-info"><span class="text-danger">*</span>Lưu ý: Nhập chính xác thông tin ngân hàng của bạn. Ulu sẽ thanh toán cho bạn qua thông tin
                            tài khoản ngân hàng</div>
                        <form class="frm-add-bank" method="post" action="{{ route('bank.update', $bank->id) }}">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label for="">Tên Ngân hàng <span class="text-danger">*</span></label>
                                <input name="bank_name" type="text" class="form-control" id="" value="{{ old('bank_name', $bank->bank_name ) }}" required>
                            </div>
                            <div class="form-group">
                                <label for="">Tên tài khoản <span class="text-danger">*</span></label>
                                <input name="bank_full_name" type="text" class="form-control" id="" value="{{ old('bank_full_name', $bank->bank_full_name) }}" required>
                            </div>
                            <div class="form-group">
                                <label for="">Số tài khoản <span class="text-danger">*</span></label>
                                <input name="bank_acc_number" type="text" class="form-control" id="" value="{{ old('bank_acc_number', $bank->bank_acc_number) }}" required>
                            </div>
                            <div class="form-group">
                                <label for="">Chi nhánh <span class="text-danger">*</span></label>
                                <input name="bank_location" type="text" class="form-control" id="" value="{{ old('bank_location', $bank->bank_location) }}" required>
                            </div>

                            <button type="submit" class="btn btn-success mr-2"><i class="fa fa-save"></i> Lưu</button>

                        </form>

                    </div>
                </div>
            </div>
        </div>


    </div>
@endsection

