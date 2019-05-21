@extends('admin.layouts.app')
@section('main')

    <div class="card mb-3">
        <div class="card-body">
            <form action="" method="get" class="mb-3">
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="order_id">Mã đơn hàng</label>
                            <input type="text" class="form-control" name="order_id" placeholder="Mã đơn hàng" value="{{ request()->get('order_id') }}">
                        </div>
                    </div>
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
                            <label for="">Chiến dịch</label>
                            <select name="campaign_id" id="" class="form-control">
                                <option value="">Tất cả</option>
                                @foreach( $campaigns as $key => $value )
                                    <option {{ request()->get('campaign_id') == $key ? 'selected' : '' }} value="{{ $key }}">
                                        {{  $value }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
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
                </div>
                <hr>
                <button class="btn btn-primary" type="submit" name="action" value="filter"><i class="fa fa-filter"></i> Lọc</button>
                <button class="btn btn-success" type="submit" name="action" value="download"><i class="fa fa-download"></i> Tải về (xlsx)</button>

            </form>
        </div>
    </div>

    <div class="card mb-3">
        <div class="card-body">
            <div class="row">
                <div class="col-md-9"><div style="height: 500px;" id="sales-analytic"></div></div>
                <div class="col-md-3">
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th>Date</th>
                            <th>Total orders</th>
                            <th>Total revenue</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $totalRevenue = 0 ; $totalOrder = 0?>
                        @foreach( $dataChart as $item )
                            <?php
                                $totalOrder += $item['total_order'];
                                $totalRevenue += $item['total_revenue'];
                            ?>
                            <tr>
                                <td>{{ $item['date'] }}</td>
                                <td class="text-right">{{ number_format($item['total_order']) }}</td>
                                <td class="text-right">{{ number_format($item['total_revenue']) }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                        <tfooter>
                            <tr>
                                <td>Total</td>
                                <td colspan=""  class="text-right">{{ number_format($totalOrder) }}</td>
                                <td colspan=""  class="text-right">{{ number_format($totalRevenue) }}</td>
                            </tr>
                        </tfooter>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Default box -->
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                    <head>
                        <th width="20">No.</th>
                        <th>Mã đơn hàng</th>
                        <th>Chiến dịch</th>
                        <th>Publisher</th>
                        <th>Hoa hồng</th>
                        <th>Giá trị đơn hàng</th>
                        <th>Trạng thái</th>
                    </head>
                    </thead>
                    <tbody>
                    @foreach( $data as $item )

                        <tr>
                            <td>{{ $loop->index + 1 }}</td>

                            <td>
                                {{ $item->order_id }} <br>
                                <span class="text-primary">
                                    {{ \Illuminate\Support\Carbon::parse($item->created_at)->setTimezone('Asia/Ho_Chi_Minh') }}
                                </span>
                            </td>
                            <td>{{ isset($campaigns[$item->campaign_id])? $campaigns[$item->campaign_id] : '' }}</td>
                            <td>
                                {{ isset($affiliates[ $item->affiliate_id ]) ? $affiliates[ $item->affiliate_id ]: '' }}
                            </td>
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

        var dataChart = @json($dataChart)

        if ($('#sales-analytic').length) {

            var chart = AmCharts.makeChart("sales-analytic", {
                "type": "serial",
                "theme": "light",
                "dataDateFormat": "YYYY-MM-DD",
                "precision": 2,
                "valueAxes": [{
                    "id": "v1",
                    "title": "Sales Amount",
                    "position": "left",
                    "autoGridCount": false,
                    "labelFunction": function(value) {
                        return Number(value.toFixed(1)).toLocaleString()+' đ'
                    }
                }, {
                    "id": "v2",
                    "title": "Total orders",
                    "gridAlpha": 0,
                    "position": "right",
                    "autoGridCount": false
                }],
                "graphs": [{
                    "id": "g1",
                    "valueAxis": "v1",
                    "lineColor": "#5C6DF4",
                    "fillColors": "#5C6DF4",
                    "fillAlphas": 1,
                    "type": "column",
                    "title": "Total revenue",
                    "valueField": "total_revenue",
                    "clustered": false,
                    "columnWidth": 0.3,
                    "legendValueText": "[[value]] đ",
                    "balloonText": "[[title]]<br /><small style='font-size: 130%'>[[value]] đ</small>"
                }, {
                    "id": "g2",
                    "valueAxis": "v2",
                    "bullet": "round",
                    "bulletBorderAlpha": 1,
                    "bulletColor": "#FFFFFF",
                    "bulletSize": 5,
                    "hideBulletsCount": 50,
                    "lineThickness": 2,
                    "lineColor": "#815FF6",
                    "type": "smoothedLine",
                    "title": "Total orders",
                    "useLineColorForBulletBorder": true,
                    "valueField": "total_order",
                    "balloonText": "[[title]]<br /><small style='font-size: 130%'>[[value]]</small>"
                }],

                "chartScrollbar": {
                    "graph": "g1",
                    "oppositeAxis": false,
                    "offset": 50,
                    "scrollbarHeight": 45,
                    "backgroundAlpha": 0,
                    "selectedBackgroundAlpha": 0.5,
                    "selectedBackgroundColor": "#f9f9f9",
                    "graphFillAlpha": 0.1,
                    "graphLineAlpha": 0.4,
                    "selectedGraphFillAlpha": 0,
                    "selectedGraphLineAlpha": 1,
                    "autoGridCount": true,
                    "color": "#95a1f9"
                },
                "chartCursor": {
                    "pan": true,
                    "valueLineEnabled": true,
                    "valueLineBalloonEnabled": true,
                    "cursorAlpha": 0,
                    "valueLineAlpha": 0.2
                },
                "categoryField": "date",
                "categoryAxis": {
                    "parseDates": true,
                    "dashLength": 1,
                    "minorGridEnabled": true,
                    "color": "#5C6DF4"
                },
                "legend": {
                    "useGraphSettings": true,
                    "position": "top"
                },
                "balloon": {
                    "borderThickness": 1,
                    "shadowAlpha": 0
                },
                "export": {
                    "enabled": false
                },
                "dataProvider": dataChart
            });
        }

    </script>
@endsection