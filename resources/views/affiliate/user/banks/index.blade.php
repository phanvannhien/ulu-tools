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

                        @if( !Auth::user()->banks->count() )
                            <div class="alert alert-success">Bạn chưa có thông tin ngân hàng nào</div>
                        @endif

                        <p class="clearfix">
                            <a href="{{ route('bank.create') }}" class="btn btn-success pull-right"> <i class="fa fa-bank"></i> Thêm ngân hàng</a>
                        </p>
                        <hr>
                        <div class="row align-items-stretch">
                        @foreach( Auth::user()->banks as $bank )
                            <div class="col-md-6">
                                <div class="p-3 border border-primary">
                                    Tên ngân hàng: {{ $bank->bank_name }} <br>
                                    Tên tài khoản: {{ $bank->bank_full_name }} <br>
                                    Số tài khoản: {{ $bank->bank_acc_number }} <br>
                                    Chi nhánh: {{ $bank->bank_location }}
                                    <div class="clearfix">
                                        @if( !$bank->bank_default )
                                        <form method="post" action="{{ route('bank.destroy',$bank->id  ) }}">
                                            @csrf
                                            <input type="hidden" name="_method" value="DELETE">
                                            <input type="hidden" name="user_bank_id" value="{{ $bank->id }}">
                                            <a class="float-right btn btn-xs btn-danger" href="#" onclick=" if(confirm('Bạn chắc chắn xoá?')) $(this).closest('form').submit() ">
                                                <i class="fa fa-trash fa-fw"></i>Xoá</a>

                                        </form>
                                        @endif
                                        <a class="float-right mr-2 btn btn-xs btn-info" href="{{ route('bank.edit', $bank->id ) }}">
                                            <i class="fa fa-edit"></i>Sửa</a>

                                        @if( $bank->bank_default )
                                        <a class="float-right mr-2 btn btn-success btn-xs" href="#">
                                            <i class="fa fa-check"></i> Mặc định</a>
                                        @else
                                        <a class="float-right mr-2 btn btn-light btn-xs" href="{{ route('bank.default', $bank->id ) }}">
                                            <i class="fa fa-check"></i> Đặt làm mặc định</a>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </div>
@endsection

