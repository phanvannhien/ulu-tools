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
                                <label for="campaign_id">Chiến dịch</label>
                                <select name="campaign_id" id="" class="form-control">
                                    <option value="">Tất cả</option>
                                    @foreach( $campaigns as $key => $value )
                                        <option {{ request()->get('campaign_id') == $key ? 'selected' : '' }} value="{{ $key }}">
                                            {{  $value }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <label for="">Loại</label>
                            <select name="type" id="" class="form-control">
                                <option value="">Tất cả</option>
                                @foreach( config('ulu.click_type') as $key => $text )
                                    <option {{ request()->get('type') == $key ? 'selected' : '' }} value="{{ $key  }}">{{  $text }}</option>
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
                    <p class="clearfix">
                    <button class="btn btn-primary btn-sm ml-3 float-right" type="submit" name="submit" value="filter"><i class="fa fa-filter"></i> Lọc</button>
                    </p>

                </form>
                <div class="table-responsive">
                    <table>
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Chiến dịch</th>
                            <th>IP</th>
                            <th width="300">Url</th>
                            <th width="300">Agent</th>
                            <th>Ngày</th>
                            <th>Loại</th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach( $data as $item )
                                <tr>
                                    <td>{{ $item->id  }}</td>
                                    <td>{{ $campaigns[$item->campaign_id]  }}</td>
                                    <td>{{ $item->ip  }}</td>
                                    <td width="300">
                                        <div style="overflow: auto;width: 300px">{{ $item->url  }}</div>
                                    </td>
                                    <td width="300">
                                        <div style="overflow: auto;width: 300px">{{ $item->user_agent  }}</div>
                                    </td>
                                    <td>{{ \Illuminate\Support\Carbon::parse($item->created_at)->timezone('Asia/Ho_Chi_Minh') }}</td>
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
