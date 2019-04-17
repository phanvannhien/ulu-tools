@extends('affiliate.layouts.app')

@section('main')
    <div class="container  mt-3 ">
        <div class="card mb-3">
            <div class="card-header">
                Đơn hàng
            </div>
            <div class="card-body">
                <div id="user-statistics"></div>
            </div>
        </div>

        <div class="card statistic">
            <div class="card-header">
                30 ngày gần đây
            </div>
            <div class="card-body ">
                {!! $data[0][1][1] !!}
            </div>
            <div class="card-footer">
                {!! $dataReportAction[0][1][1] !!}
            </div>
        </div>
    </div>
@endsection

@section('footer')
    <?php

        $arr = array_combine( $dataChart[0][0],$dataChart[0][1] );
        $arrData = [];
        foreach ($arr as $key => $val ){
            $arrData[] = [
                'date' => $key,
                'value' => $val
            ];
        }



    ?>
    <!-- start amcharts -->
    <script src="https://www.amcharts.com/lib/3/amcharts.js"></script>
    <script src="https://www.amcharts.com/lib/3/ammap.js"></script>
    <script src="https://www.amcharts.com/lib/3/maps/js/worldLow.js"></script>
    <script src="https://www.amcharts.com/lib/3/serial.js"></script>
    <script src="https://www.amcharts.com/lib/3/plugins/export/export.min.js"></script>
    <script src="https://www.amcharts.com/lib/3/themes/light.js"></script>
    <script>
        var data = '@json($arrData)';
        /*-------------- 10 line chart amchart start ------------*/
        if ($('#user-statistics').length) {
            var chart = AmCharts.makeChart("user-statistics", {
                "type": "serial",
                "theme": "light",
                "marginRight": 0,
                "marginLeft": 40,
                "autoMarginOffset": 20,
                "dataDateFormat": "DD/MM/YYYY",
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
                    "hideBulletsCount": 50,
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
                "dataProvider": JSON.parse( data )
            });
        }

        /*-------------- 10 line chart amchart end ------------*/

    </script>
    @endsection
