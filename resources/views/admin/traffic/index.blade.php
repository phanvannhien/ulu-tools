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
    <div class="card mb-4">
        <div class="card-body">
            <div class="row">
                <div class="col-md-9">
                    <div id="traffic-statistics" style="height: 500px;"></div>
                </div>
                <div class="col-md-3">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Date</th>
                                <th>Count</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php( $totalTraffic = 0 )
                            @foreach( $chartData as $item )
                                @php(
                                    $totalTraffic += $item['value']
                                )
                                <tr>
                                    <td>{{ $item['date'] }}</td>
                                    <td class="text-right">{{ number_format($item['value']) }}</td>
                                </tr>
                                @endforeach
                        </tbody>
                        <tfooter>
                            <tr>
                                <td>Total</td>
                                <td colspan=""  class="text-right">{{ number_format($totalTraffic) }}</td>
                            </tr>
                        </tfooter>
                    </table>
                </div>
            </div>

        </div>
    </div>
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

@section('footer')
    <!-- start amcharts -->
    <script src="https://www.amcharts.com/lib/3/amcharts.js"></script>
    <script src="https://www.amcharts.com/lib/3/ammap.js"></script>
    <script src="https://www.amcharts.com/lib/3/maps/js/worldLow.js"></script>
    <script src="https://www.amcharts.com/lib/3/serial.js"></script>
    <script src="https://www.amcharts.com/lib/3/plugins/export/export.min.js"></script>
    <script src="https://www.amcharts.com/lib/3/themes/light.js"></script>
    <script>

        var data = @json($chartData)

        if ($('#traffic-statistics').length) {
            var chart = AmCharts.makeChart("traffic-statistics", {
                "type": "serial",
                "theme": "light",
                "marginRight": 60,
                "marginLeft": 60,
                "autoMarginOffset": 100,
                "dataDateFormat": "YYYY-MM-DD",
                "valueAxes": [{
                    "id": "v1",
                    "axisAlpha": 0,
                    "position": "left",
                    "ignoreAxisWidth": true
                }],
                "balloon": {
                    "borderThickness": 1,
                    "shadowAlpha": 0
                },
                "graphs": [{
                    "id": "g1",
                    "balloon": {
                        "drop": true,
                        "adjustBorderColor": false,
                        "color": "#ffffff",
                        "type": "smoothedLine"
                    },
                    "fillAlphas": 0.2,
                    "bullet": "round",
                    "bulletBorderAlpha": 1,
                    "bulletColor": "#FFFFFF",
                    "bulletSize": 5,
                    "hideBulletsCount": 1,
                    "lineThickness": 2,
                    "title": "red line",
                    "useLineColorForBulletBorder": true,
                    "valueField": "value",
                    "balloonText": "<span style='font-size:18px;'>[[value]]</span>"
                }],
                "chartCursor": {
                    "valueLineEnabled": true,
                    "valueLineBalloonEnabled": true,
                    "cursorAlpha": 0,
                    "zoomable": false,
                    "valueZoomable": true,
                    "valueLineAlpha": 0.5
                },
                "valueScrollbar": {
                    "autoGridCount": true,
                    "color": "#5E72F3",
                    "scrollbarHeight": 30
                },
                "categoryField": "date",
                "categoryAxis": {
                    "parseDates": true,
                    "dashLength": 1,
                    "minorGridEnabled": true
                },
                "export": {
                    "enabled": false
                },
                "dataProvider": data
            });
        }


    </script>
@endsection