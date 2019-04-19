@extends('affiliate.layouts.app')

@section('main')
    <div class="container mt-3">
        <div class="breadcrumbs-area clearfix mb-3">
            <ul class="breadcrumbs">
                <li><a href="{{ route('affiliate.dashboard') }}"><i class="ti-dashboard"></i> Dashboard</a></li>
                <li><span>Hoa hồng</span></li>
            </ul>
        </div>

        <div class="card">
            <div class="card-body">
                <form class=" mb-3" action="{{ route('affiliate.report') }}" method="get">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="">Mã đơn hàng</label>
                                <input type="text" name="t_orderid" value="{{ request()->get('t_orderid') }}" class="form-control" placeholder="Mã đơn hàng">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="">Ngày tạo</label>
                                <select name="dateinserted" id="" class="form-control">
                                    <option value="">Tất cả</option>
                                    @foreach( config('ulu.commission_date') as $key => $text )
                                    <option {{ request()->get('dateinserted') == $key ? 'selected' : '' }} value="{{ $key  }}">{{  $text }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                                <label for="">Trạng thái</label>
                                <select name="payoutstatus" id="" class="form-control">
                                    <option value="">Tất cả</option>
                                    @foreach( config('ulu.payout_status') as $key => $text )
                                    <option {{ request()->get('payoutstatus') == $key ? 'selected' : '' }} value="{{ $key  }}">{{  $text }}</option>
                                    @endforeach
                                </select>
                        </div>
                        <div class="col-md-3">
                                <button class="btn btn-primary btn-sm ml-3 float-right" type="submit" name="submit" value="filter"><i class="fa fa-filter"></i> Lọc</button>
                        </div>
                    </div>
                   
                    

                    
                </form>
                <div class="table-responsive">

                    <table>
                        <thead>
                            <tr>
                                <th>Hoa hồng</th>
                                <th>Tổng giá trị</th>
                                <th>ID Đơn hàng</th>
                                <th>ID Sản phẩm</th>
                                <th>Ngày tạo</th>
                                <th>Tên chiến dịch</th>
                                <th>Trạng thái</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php $arrKey = [] ?>
                        @foreach ($data as $item)

                            @if( $loop->index == 0 )
                                <?php $arrKey = $item; ?>
                            @else
                                <?php $arrData = array_combine( $arrKey, $item  ); ?>
                                <tr>
                                    <td>{{ number_format($arrData['commission']) }}</td>
                                    <td>{{ number_format($arrData['totalcost']) }}</td>
                                    <td>{{ $arrData['t_orderid'] }}</td>
                                    <td>{{ $arrData['productid'] }}</td>
                                    <td>{{ $arrData['dateinserted'] }}</td>
                                    <td>{{ $arrData['name'] }}</td>
                                    <td><span class="badge badge-info">{{ config('ulu.commission_status')[$arrData['rstatus']] }}</span></td>
                                </tr>
                            @endif


                        @endforeach
                        </tbody>

                    </table>
                </div>
                <div class="d-flex justify-content-center">
                    {!! $data->appends(request()->input())->links() !!}
                </div>
            </div>
            <div class="card-footer">
                @if( $data && count($data))
                    <p class="text-right">Hiển thị {{$data->firstItem()}}-{{$data->lastItem()}} đến  {{$data->total()}} kết quả</p>
                @endif
            </div>

        </div>


    </div>
@endsection
