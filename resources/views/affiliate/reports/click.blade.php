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
                                <label for="">Chiến dịch</label>
                                <select name="campaign_id" id="" class="form-control">
                                    <option value="">Tất cả</option>
                                    @foreach( auth()->user()->campaigns()->get() as $campaign )
                                        <option {{ request()->get('dateinserted') == $campaign->campaign_id ? 'selected' : '' }} value="{{ $campaign->campaign_id }}">
                                            {{  $campaign->campaign_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
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
                            <th>Chiến dịch</th>
                            <th>IP</th>
                            <th>Url</th>
                            <th>Ngày</th>
                            <th>Loại</th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach( $data as $item )
                                <tr>
                                    <td>{{ $item->id  }}</td>
                                    <td>{{ $item->campaign_id  }}</td>
                                    <td>{{ $item->ip  }}</td>
                                    <td>{{ $item->url  }}</td>
                                    <td>{{ $item->created_at  }}</td>
                                    <td>{{ $item->type }}</td>
                                </tr>
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
