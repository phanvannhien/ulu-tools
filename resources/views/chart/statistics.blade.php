<?php
    $id = isset($id) ? $id : '';
    $class = isset($class) ? $class : ''; 
?>
<div class="card {{$class}}">
    <div class="card-body">
        <div class="row">
            <div class="col-md-9">
                <div id="{{$id}}" style="height: 500px;"></div>
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

    <!-- start amcharts -->
    <script src="https://www.amcharts.com/lib/3/amcharts.js"></script>
    <script src="https://www.amcharts.com/lib/3/ammap.js"></script>
    <script src="https://www.amcharts.com/lib/3/maps/js/worldLow.js"></script>
    <script src="https://www.amcharts.com/lib/3/serial.js"></script>
    <script src="https://www.amcharts.com/lib/3/plugins/export/export.min.js"></script>
    <script src="https://www.amcharts.com/lib/3/themes/light.js"></script>
    <script>
        var data = @json($chartData)

        var idChart = '{{$id}}';

        if (document.getElementById(idChart)) {
            var chart = AmCharts.makeChart(idChart, {
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
