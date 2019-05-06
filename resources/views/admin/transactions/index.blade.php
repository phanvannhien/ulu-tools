@extends('admin.layouts.app')
@section('main')
    @include('admin.partials.messages')
    <div class="row mb-3">
        <div class="col-md-3">
            <div class="card bg-info">
                <div class="p-4 d-flex justify-content-between align-items-center">
                    <div class="seofct-icon">Total cost: {{ number_format($total) }}</div>
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
                        <select name="account_id" id="" class="form-control">
                            <option value="">All Advertiser</option>
                            @foreach( \App\Models\Merchant::orderBy('account')->select('account_id', 'account')->get() as $mechant  )
                                <option {{ request()->get('account_id') == $mechant->account_id ? 'selected': '' }} value="{{ $mechant->account_id }}">{{ $mechant->account }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3">
                        <select name="campaign_id" id="" class="form-control">
                            <option value="">All campaigns</option>
                            @foreach( \App\Models\Campaign::orderBy('campaign_name')->get() as $campaign  )
                                <option {{ request()->get('campaign_id') == $campaign->campaign_id ? 'selected': '' }} value="{{ $campaign->campaign_id }}">
                                    {{ $campaign->campaign_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3">
                        <select name="userid" id="" class="form-control">
                            <option value="">All Affiliate</option>
                            @foreach( \App\Models\Affiliate::orderBy('full_name')->select('refid', 'full_name')->get() as $mechant  )
                                <option {{ request()->get('userid') == $mechant->refid ? 'selected': '' }} value="{{ $mechant->refid }}">{{ $mechant->full_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3">
                        <div class="input-group">
                            <div class="input-group-addon">
                                <div class="btn">
                                    <i class="fa fa-calendar"></i>
                                </div>

                            </div>
                            <input id="reportrange" name="conversion_date" class="form-control" value="{{ request()->get('conversion_date') }}" type="text">
                        </div>
                    </div>

                </div>
                <hr>
                <button class="btn btn-primary" type="submit" name="action" value="filter"><i class="fa fa-filter"></i> Filter</button>
                <button class="btn btn-success" type="submit" name="action" value="download"><i class="fa fa-download"></i> Download xlsx</button>

            </form>
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                    <head>
                        <th>Order ID</th>
                        <th>Affiliate</th>
                        <th>Campaign</th>
                        <th>Advertiser</th>
                        <th>Commission</th>
                        <th>Total cost</th>
                        <th>Status</th>
                        <th>Visitor ID</th>
                        <th>Offer type</th>
                    </head>
                    </thead>
                    <tbody>
                    @foreach( $data as $item )
                        <tr>
                            <td>
                                {{ $item->t_orderid }} <br>
                                <span class="text-primary">{{ $item->conversion_date }}</span>
                            </td>
                            <td>{{ ($item->affiliate) ? $item->affiliate->full_name : '' }}</td>
                            <td>{{ $item->campaign ? $item->campaign->campaign_name: '' }}</td>
                            <td>{{ ($item->advertiser ) ? $item->advertiser->account : ''  }}</td>
                            <td class="text-right"><span class="text-danger">{{ number_format($item->commission) }}</span></td>
                            <td class="text-right"><span class="text-danger">{{ number_format($item->totalcost) }}</span></td>
                            <td><span class="badge-info badge">{{ config('ulu.commission_status')[$item->rstatus] }}</span></td>
                            <td>{{ $item->visitorid }}</td>
                            <td>{{ $item->data2 }}</td>
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
@stop