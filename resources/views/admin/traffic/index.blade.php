@extends('admin.layouts.app')
@section('main')
    <!-- Default box -->
    <div class="card mb-4">
        <div class="card-body">
            <form action="" method="get" class="mb-3">
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="affiliate_id">Affiliate</label>
                            <select name="affiliate_id" id="" class="form-control">
                                <option value="">All</option>
                                @foreach( $affiliates as $key => $value )
                                    <option {{ request()->get('affiliate_id') == $key ? 'selected' : '' }} value="{{ $key }}">
                                        {{  $value }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="">Campaign</label>
                            <select name="campaign_id" id="" class="form-control">
                                <option value="">All</option>
                                @foreach( $campaigns as $key => $value )
                                    <option {{ request()->get('campaign_id') == $key ? 'selected' : '' }} value="{{ $key }}">
                                        {{  $value }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="created_at">Datetime</label>
                            <div class="input-group">
                                <div class="input-group-addon">
                                    <div class="btn">
                                        <i class="fa fa-calendar"></i>
                                    </div>
                                </div>
                                <input id="reportrange" name="created_at" class="form-control"
                                       value="{{ request()->get('created_at') }}" type="text">
                            </div>
                        </div>
                    </div>

                </div>
                <hr>
                <button class="btn btn-primary" type="submit" name="action" value="filter"><i
                            class="fa fa-filter"></i> Lọc
                </button>
                <button class="btn btn-success" type="submit" name="action" value="download"><i
                            class="fa fa-download"></i> Tải về (xlsx)
                </button>
            </form>
        </div>
    </div>
    <!-- Statistics Chart Component -->
    @statistics
        @slot('id','click-statistics')
        @slot('chartData',$chartData)
        @slot('class','mb-4')
    @endstatistics
     <!-- End Statistics Chart Component -->
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                    <head>
                        <th width="20">No.</th>
                        <th>Traffic ID</th>
                        <th>Campaign</th>
                        <th>Affiliate</th>
                        <th>Url</th>
                        <th>Created at</th>
                    </head>
                    </thead>
                    <tbody>
                    @foreach( $data as $item )
                        <tr>
                            <td>{{ $loop->index + 1 }}</td>
                            <td>{{ $item->id }}</td>
                            <td>{{ isset($campaigns[$item->campaign_id])? $campaigns[$item->campaign_id] : '' }}</td>
                            <td>
                                {{ isset($affiliates[ $item->affiliate_id ]) ? $affiliates[ $item->affiliate_id ]: '' }}
                            </td>
                            <td class="text-left"><div class="" style="width: 300px">{{ $item->url }}</div></td>
                            <td>{{ \Illuminate\Support\Carbon::parse($item->created_at)->setTimezone('Asia/Ho_Chi_Minh') }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card-footer text-center">
            <div class="clearfix">
                @if( $data && count($data))
                    <p class="text-right">Showing {{$data->firstItem()}}-{{$data->lastItem()}} of {{$data->total()}}
                        results</p>
                @endif
            </div>
        </div>
    </div>
    <!-- /.box -->
    <div class="d-flex justify-content-center">
        {!! $data->appends(request()->input())->links() !!}
    </div>

@stop
