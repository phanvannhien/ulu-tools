@extends('affiliate.layouts.app')
@section('main')
    @include('admin.partials.messages')
    <div class="container">
        <div class="row mb-3">
            <div class="col-md-4">
                <div class="card bg-info">
                    <div class="p-4 d-flex justify-content-between align-items-center">
                        <div class="seofct-icon text-center">Đã duyệt: {{ number_format( $conversions->payloads->commission->total_approved ).config('ulu.price_suffix')  }}</div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card bg-success">
                    <div class="p-4 d-flex justify-content-between align-items-center">
                        <div class="seofct-icon text-center">Đang đợi: {{ number_format($conversions->payloads->commission->total_pending).config('ulu.price_suffix')  }}</div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card bg-danger">
                    <div class="p-4 d-flex justify-content-between align-items-center">
                        <div class="seofct-icon text-center">Tổng số đơn hàng: {{ $data->total()  }}</div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Default box -->
        <div class="card">
            <div class="card-body">
                <form action="" method="get" class="mb-3">
                    <div class="row">
                        <div class="col-md-3">
                            <label for="">Mã đơn hàng</label>
                            <input type="text" class="form-control" name="order_id" placeholder="Mã đơn hàng" value="{{ request()->get('order_id') }}">
                        </div>
                        <div class="col-md-3">
                            <label for="">Chiến dịch</label>
                            <select name="campaign_id" id="" class="form-control">
                                <option value="">Tất cả</option>
                                @foreach( $campaigns as $key => $value )
                                    <option {{ request()->get('campaign_id') == $key ? 'selected' : '' }} value="{{ $key }}">
                                        {{  $value }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-6">
                            <label for="">Ngày tháng</label>
                            <div class="input-group">
                                <div class="input-group-addon">
                                    <div class="btn">
                                        <i class="fa fa-calendar"></i>
                                    </div>

                                </div>
                                <input id="reportrange" name="created_at" class="form-control" value="{{ request()->get('created_at') }}" type="text">
                            </div>
                        </div>

                    </div>
                    <hr>
                    <button class="btn btn-primary" type="submit" name="action" value="filter"><i class="fa fa-filter"></i> Lọc</button>
                    <button class="btn btn-success" type="submit" name="action" value="download"><i class="fa fa-download"></i> Tải về (xlsx)</button>

                </form>
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                        <head>
                            <th>Mã đơn hàng</th>
                            <th>Chiến dịch</th>
                            <th>Hoa hồng</th>
                            <th>Giá trị đơn hàng</th>
                            <th>Trạng thái</th>
                        </head>
                        </thead>
                        <tbody>
                        @foreach( $data as $item )
                            <tr>
                                <td>
                                    {{ $item->order_id }} <br>
                                    <span class="text-primary">{{ \Illuminate\Support\Carbon::parse($item->created_at )->subHour() }}</span>
                                </td>
                                <td>{{ $campaigns[$item->campaign_id] }}</td>
                                <td class="text-center"><span class="text-danger">{{ number_format($item->commission).config('ulu.price_suffix')  }}</span></td>
                                <td class="text-center"><span class="text-danger">{{ number_format($item->total_cost).config('ulu.price_suffix') }}</span></td>
                                <td><span class="badge-info badge">{{ $item->status }}</span></td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>

            </div>
            <div class="card-footer text-center">
                <div class="clearfix">
                    @if( $data && count($data))
                        <p class="text-right">Showing {{$data->firstItem()}}-{{$data->lastItem()}} of {{$data->total()}} results</p>
                    @endif
                </div>
            </div>
        </div>
        <!-- /.box -->
        <div class="d-flex justify-content-center">
            {!! $data->appends(request()->input())->links() !!}
        </div>

    </div>
@stop