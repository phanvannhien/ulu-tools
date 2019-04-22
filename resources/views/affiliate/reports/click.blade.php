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
                <form class=" mb-3" action="{{ route('affiliate.report.click') }}" method="get">
                    <div class="row">

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
                            <label for="">Loại</label>
                            <select name="rtype" id="" class="form-control">
                                <option value="">Tất cả</option>
                                @foreach( config('ulu.click_type') as $key => $text )
                                    <option {{ request()->get('rtype') == $key ? 'selected' : '' }} value="{{ $key  }}">{{  $text }}</option>
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
                            <th>ID</th>
                            <th>Banner</th>
                            <th>Chiến dịch</th>
                            <th>Loại</th>
                            <th>Ngày</th>
                            <th>IP</th>
                            <th>Kênh</th>
                            <th>Url giới thiệu</th>
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
                                    <td>{{ $arrData['clickid'] }}</td>
                                    <td>{{ $arrData['banner'] }}</td>
                                    <td>{{ $arrData['campaign'] }}</td>
                                    <td><span class="badge badge-info">{{ config('ulu.click_type')[$arrData['rtype']] }}</span></td>
                                    <td>{{ $arrData['datetime'] }}</td>
                                    <td>{{ $arrData['ip'] }}</td>
                                    <td>{{ $arrData['channelname'] }}</td>
                                    <td>{{ $arrData['referrerurl'] }}</td>
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
