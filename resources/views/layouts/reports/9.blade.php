@extends('layouts.report')

@section('nav')
@include("layouts.reports.components.header", ['data'=> $data])
@endsection
{{-- Reasoning test --}}
@section('content')
<!-- logo -->
@include("layouts.reports.components.logo", ['logo'=> $data['general']])
<!-- /logo -->

<div class="row">
    @php $item = $data["parties"]["party"]; @endphp
    @php $group_factors = $data["group_factors"]; @endphp

    @if (str_contains($item[0]['type'], 'ancre'))

    <h2 class="card-title">{{$item[0]["params"]["menuNumber"] }} -
        {{ __($item[0]["content"]["title"]) }} </h2>
    @endif

    <div class="col-md-12" id="{{($item[0]["content"]["title"]) }}">
        <div class="card">
            <div class="card-header .bg-secondary">
                {{ __($item[0]["content"]["sub_title"]) }}
            </div>

            <div class="card-body">
                <div class="score-bar-wrapper row">
                    <div class="col-xs-12 col-sm-3">
                        <h3 class="box-label">
                            {{ $item[1]["content"]["title"]}}
                        </h3>
                        <div class="box-score" style="
                            color:#000000; background-color: #1C3664">
                            <div class="header" style="color: #fff;">
                                {{ __('Score') }} <br>
                                @if (isset($item[1]["params"]["quotient"]))
                                {{ $item[1]["params"]["quotient"] }}
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="col-xs-12 col-sm-9">
                        <div class="progress score-bar">
                            @if( isset($item[1]["params"]["quotient"]))
                            <div class="progress-bar" style='width:{{ $item[1]["params"]["quotient"]}}%; color:#000000; background-color: #1C3664'>
                            </div>
                            @endif
                        </div>
                    </div>

                    <div class="col-xs-12 col-md-12 clearfix">
                        <strong>
                            {{ $item[1]["params"]["nb_br"] }} right answers out of
                            {{ $item[1]["params"]["nb_question"] }} questions
                            Average score is {{ $item[1]["params"]["score"] }}/10
                        </strong>
                    </div>

                    <div class="box mb-4">
                        <div class="box-desc bg-light">
                            <div>
                                {!! $item[1]["content"]["commentaire_perso"] !!}
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <!-- GENERAL DESCRIPTION -->
    @if (str_contains($item[2]['type'], 'ancre'))
    <h2 class="card-title">{{ $item[2]["params"]["menuNumber"] }} -
        {{ __($item[2]["content"]["title"]) }}
    </h2>
    @endif

    <div class="col-md-12" id="{{$item[2]["content"]["title"]}}">
        <div class="card">
            <div class="card-header .bg-secondary">
                {{ __($item[2]["content"]["sub_title"]) }}
            </div>
            <div class="card-body">
                <div class="intro">
                    {!! $item[3]["content"]["introduction"] !!}
                </div>
            </div>
        </div>
    </div>
    <!-- end GENERAL DESCRIPTION -->

    <!-- Graph  -->
    @if (str_contains($item[4]['type'], 'ancre'))
    <h2 class="card-title">{{ $item[4]["params"]["menuNumber"] }} -
        {{ __($item[4]["content"]["title"]) }}
    </h2>
    @endif

    <div class="col-md-12" id="{{$item[4]["content"]["title"]}}">
        <div class="card">

            <div class="card-header .bg-secondary">
                {{ __($item[4]["content"]["sub_title"]) }}
            </div>
            <div class="card-body">
                <div class="group-header">
                    <!-- Graphic here -->
                    <figure class="highcharts-figure">
                        <div style="height: 600px; width: 1308px; margin:0 auto" id="chart"></div>
                    </figure>
                </div>
            </div>
        </div>
    </div>
    <!-- end Graph -->

    <!-- Detailed  -->
    @if (str_contains($item[6]['type'], 'ancre'))
    <h2 class="card-title">{{ $item[6]["params"]["menuNumber"] }} -
        {{ __($item[6]["content"]["title"]) }} </h2>
    @endif

    <div class="col-md-12" id="{{$item[6]["content"]["title"]}}">
        <div class="card">
            <div class="card-header .bg-secondary">
                {{ __($item[6]["content"]["sub_title"]) }}
            </div>
            <div class="card-body">
                <!-- loop here -->
                @foreach ($item as $val)

                @if($val['type']=='rapport_details_facteur')
                <div class="score-bar-wrapper row">
                    <div class="col-xs-12 col-sm-3">
                        <div class="box-score ec-first-bg-color ec-first-text-color" style="background-color:#{{$val["params"]["couleur"]}}; color:#000">
                            <div class="header">
                                Score<br>
                                @if(isset($val["params"]))
                                {{ $val["params"]["score_calculated"]}}
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="col-xs-12 col-sm-9">
                        <div class="progress score-bar" style="width: 100%;">
                            <label for="0" id="percent_start">0</label>
                            <div class="progress-bar" style="width:{{$val["params"]["pourcentage_score"]}}%;
                                            color:#000000; background-color: #{!!$val["params"]["couleur"]!!} "></div>
                            <label for="10" id="percent_end">10</label>
                                    </div>
                                </div>
                            </div>

                            <div class=" img-calibration">
                                <div class="gausse ec-first-bg-color" style="background-color:#DDA0DD;position: relative">
                                    @if(isset($val["params"]))
                                    <div class="pointer-gausse hidden-xs " style="left:{{4.83*$val["params"]["pourcentage_score"]}}px; z-index:3"></div>
                                    @endif
                                </div>

                                <div class="content text-center">
                                    <em> About 33% of the population has a score lower than or equal to yours. </em>

                                </div>
                            </div>

                            <div class="box mb-4">
                                <div class="box-content ec-first-border-color" style="background-color: #EEEEEE">
                                    {!!$val["content"]["commentaire_perso"]!!}
                                </div>
                            </div>

                            <div class="box mb-5 bg-white">
                                <div class="box-header box-header-small">
                                    <div class="title text-left"> <i class="fa fa-arrow-circle-o-right"></i>
                                        {{ __('Definition') }}</div>
                                </div>
                                <div class="box-content ec-first-border-color">
                                    {!! $val["content"]["description_long"] !!}
                                </div>
                            </div>

                            @endif
                            @endforeach
                            <!-- /end loop here -->
                        </div>
                    </div>
                </div>
            </div>
        @endsection

        @section('script')

        <script>
            function calcPoint(a, b) {
                let d = Math.abs((a * b) * 0.58) / Math.abs((a + b) * -0.3);
                c = d.toFixed(2) / 1.4
                return parseFloat(c.toFixed(2));
            }

            var categories = [];
            var data = [];
            var items = {
                data: []
                , name: ""
                , type: "area"
                , color: ""
                , fillOpacity: 0.3
            };
            var barChart = [];

            var obj = {};
            var point_start = -15;
            @foreach($group_factors as $idx => $group)

            @if(str_contains($group['label'], "Intelligence"))
            obj.name = @json($group['label']) + " (" + @json($group['score']) + ")";
            obj.y = parseFloat(@json($group['score']));
            obj.color = '#' + @json($group['color']);

            barChart.push(obj);
            obj = {};
            items.name = @json($group['label']);

            @foreach($group['factors'] as $idx => $factor)
            categories.push(@json($factor['label']) + " (" + @json($factor['score']) + ")");

            if (@json($group['id']) === @json($factor['group_id'])) {
                items.data.push(parseFloat(@json($factor['score'])));
                if (items.data.length < 7) {
                    console.log("length: ", categories.length);
                    for (let i = 1; i < 7; i++) {
                        items.data.push(null);
                    }
                }
                items.color = '#' + @json($factor['color']);
            }
            @endforeach
            data.push(items);

            // console.log("data", data);
            items = {
                data: []
                , name: ""
                , type: "area"
                , color: ""
                , fillOpacity: 0.3
            };
            @endif
            @endforeach

            console.log("data1 - ", data);
            console.log("categories - ", categories);

            // // эхний утгийг нь 
            var new_data = []
                , previous, matrix = []
                , n = 0
                , m = 0;

            for (const [key, value] of Object.entries(data)) {
                if (key == 0) data[key].pointStart = 300;
                else if (key == 1) data[key].pointStart = 60;
                else if (key == 2) data[key].pointStart = 180;

                value.data.map((el, index) => {
                    if (el !== null) matrix[n++] = el;
                });
            }
      
            for (const [key, value] of Object.entries(data)) {
                // first value-g avna
                var first;
                value.data.map((el, index) => {
                    if (index === 0) first = el;
                });

                for (let i = 0; i < 10; i++) {
                    if (i == 0) {
                        if (key == 0) new_data[i] = calcPoint(first, matrix[2]);
                        else if (key == 2) new_data[i] = calcPoint(first, matrix[1]);
                        else if (key == 1) new_data[i] = calcPoint(first, matrix[0]);
                    } else if (i == 4) new_data[i] = first;
                    else if (i == 8) {
                        if (key == 0) new_data[i] = calcPoint(first, matrix[1]);
                        else if (key == 1) new_data[i] = calcPoint(first, matrix[2]);
                        else if (key == 2) new_data[i] = calcPoint(first, matrix[0]);
                    } else if (i == 9) new_data[i] = 0;
                    else new_data.push(null);
                    previous = new_data[i];
                }
                value.data = new_data;
                new_data = [];
            }
            
            Highcharts.chart('chart', {
                chart: {
                    marginTop: 30
                    , polar: true
                    , type: ''
                , }
                , "title": {
                    "text": ""
                }
                , "credits": {
                    "enabled": false
                }
                , "tooltip": {
                    "enabled": false
                }
                , "yAxis": {
                    "max": 10
                    , "lineColor": "#FFFFFF"
                    , "tickInterval": 2
                    , "gridLineWidth": 1
                    , "gridLineColor": "#EEEEEE"
                    , "plotLines": [{
                        "color": "#AAAAAA"
                        , "dashStyle": "LongDash"
                        , "value": 10
                        , "width": 1
                    }, {
                        "color": "#EEEEEE"
                        , "dashStyle": "Dash"
                        , "value": 1
                        , "width": 1
                    }, {
                        "color": "#EEEEEE"
                        , "dashStyle": "Dash"
                        , "value": 3
                        , "width": 1
                    }, {
                        "color": "#EEEEEE"
                        , "dashStyle": "Dash"
                        , "value": 7
                        , "width": 1
                    }, {
                        "color": "#EEEEEE"
                        , "dashStyle": "Dash"
                        , "value": 9
                        , "width": 1
                    }]
                    , "labels": {
                        "enabled": false
                    }
                }
                , "plotOptions": {
                    "series": {
                        "animation": false
                        , "showInLegend": true
                        , "marker": {
                            "enabled": false
                            , "states": {
                                "hover": {
                                    "enabled": false
                                }
                            }
                        }
                        , "connectNulls": true
                        , "pointPlacement": "on"
                        , "pointInterval": 15
                    }
                    , "area": {
                        "lineWidth": 1
                    }
                },

                "xAxis": {
                    "max": 12
                    , "startOnTick": true
                    , "endOnTick": true
                    , "lineWidth": 0
                    , "gridLineWidth": 1
                    , "labels": {
                        "distance": 20
                        , "style": {
                            "width": "140px"
                            , "color": "#000000"
                            , "fontSize": "14px"
                            , "fontWeight": "normal"
                            , "fontFamily": "\"roboto\", \"Arial\", sans-serif"
                        }
                        , "formatter": function() {
                            var sReturn = ''
                                , iIndex = this.value / 120
                                , oCategories = categories;

                            if (oCategories[iIndex] !=
                                undefined) {
                                sReturn += oCategories[iIndex];
                            }
                            return sReturn;
                        }
                    }
                    , "tickPositions": [0, 120, 240, 360]
                },
                // "series": data
                // [0, 30, 60, 90, 120, 150, 180, 210, 240, 270, 300, 330, 360
                // [-45 -30 -15  0, 15, 30, 45]
                // [calc -75 -60 -45 -30 -15 [set 0], 15, 30, 45 60 [c75] 0 ]
                // 4.73, null, null, null, null, null, 4, null, null, null, null, null, 4.73
                // [4, null, null, null, null, null, 5.8, null, null, null, null, null, 5.54]
                // [5.8, null, null, null, null, null, 5.3, null, null, null, null, null, 5.54

                "series": data
                // [{
                //     "color": "#F781BE",
                //     "name": "fdsfdsfd",
                //     "type": "area",
                //     "pointStart": 300,            
                //      "data": [4.73, null, null, null, 4, null, null, null, 3, 0]               
                // }, {
                //     "color": "#D0A9F5",
                //     "name": "Business Development Skills",
                //     "type": "area",
                //     "pointStart": 60,                
                //     "data": [3, null, null, null, 5.8, null, null, null, 5.54, 0]                 

                // }, {
                //     "color": "#A9F5A9",
                //     "name": "Negotiation Skills",
                //     "type": "area",
                //     "pointStart": 180,
                //     "data": [5.07, null, null, null, 5.8, null, null, null, 5.54, 0]                       
                // }], 

            });

            console.log(calcPoint(5.8, 5, 3));

        </script>

        @endsection
