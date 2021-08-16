{{-- Vocation test --}}
@extends('layouts.report')

@section('nav')
@include("layouts.reports.components.header", ['data'=> $data])
@endsection

@section('content')
<!-- logo -->
@include("layouts.reports.components.logo", ['logo'=> $data['general']])
<!-- /logo -->

<div class="row">

    @php $item = $data["parties"]["party"]; @endphp
    @php $group_factors = $data["group_factors"]; @endphp
    @if (str_contains($item[0]['type'], 'ancre'))
    @php $before_type = 'ancre' @endphp
    <h2 class="card-title">{{ $item[0]["params"]["menuNumber"] }} -
        {{$item[0]["content"]["title"]}}
    </h2>
    @endif

    <div class="col-md-12" id='{{ $item[0]["content"]["title"]}}'>
        <div class="card">
            <div class="card-header .bg-secondary">
                {{ $item[0]["content"]["sub_title"]}}
            </div>

            <div class="card-body">

                <div class="box-desc">
                    <div>
                        @if( isset($item[2]["content"]['introduction']))
                        {!!$item[2]["content"]['introduction']!!}
                        @endif
                    </div>
                </div>


            </div>
        </div>
    </div>

    {{--2 RIASEC PROFILE starts --}}
    @if (str_contains($item[8]['type'], 'ancre'))
    <h2 class="card-title">{{ $item[3]["params"]["menuNumber"] }} - {{$item[3]["content"]["title"]}} </h2>
    @endif
    <div class="col-md-12" id="{{$item[3]["content"]["title"]}}">
        <div class="card">
            <div class="card-header .bg-secondary">{{ $item[3]["content"]["sub_title"]}}</div>
            <div class="card-body">
                <div class="row synthetic-card-part">
                    {{-- {{dd($item[4])}} --}}
                    <div class="col-md-12 align-center">
                        @foreach($item[4]["content"]["cibles"]['cible'] as $target)
                        <div class="synthetic-card-combination-box" style="background-color: {{$target['couleur']}}">{{$target['libelle'][0]}}</div>
                        @endforeach
                        <div class="synthetic-card-targets-list col-md-12 align-left text-xs-left">
                            @foreach($item[4]["content"]["cibles"]['cible'] as $target)
                            {{-- {{dd($target['score'])}} --}}
                            <!-- Cibles secondaires et scores -->
                            <div class="col-xs-12 font-large synthetic-card-target">
                                <div class="target-score align-right ">
                                    <span class="star-rating" style="color: {{$target['couleur']}}">
                                        <?php $score = $target['score'] / 2;?>
                                        {{-- {{print_r(round($score, 2))}} --}}
                                        @foreach(range(0,4) as $i)
                                        <span class="fa-stack" style="width:1em">
                                            <i class="far fa-star fa-stack-1x"></i>
                                            @if($score >0)
                                            @if($score >0.5)
                                            <i class="fas fa-star fa-stack-1x"></i>
                                            @else
                                            <i class="fas fa-star-half fa-stack-1x"></i>
                                            @endif
                                            @endif
                                            @php $score--; @endphp
                                        </span>
                                        @endforeach
                                    </span>

                                    {{$target['libelle']}} </div>
                            </div>
                            @endforeach
                        </div>

                    </div>

                    <!-- Description 1 -->
                    <div class="col-xs-12 col-sm-6 desc">
                        {!!$item[4]["content"]["description_1"]!!}
                    </div>

                    <!-- Description 2 -->
                    <div class="col-xs-12 col-sm-6 desc">
                        {!!$item[4]["content"]["description_2"]!!}
                    </div>
                </div>
            </div>
        </div>
        {{-- 2-RIASEC PROFILE ends --}}

        <!-- Graph -->
        @if (str_contains($item[5]['type'], 'ancre'))
        <h2 class="card-title">{{ $item[5]["params"]["menuNumber"] }} -
            {{$item[5]["content"]["title"]}}
        </h2>
        @endif

        <div class="col-md-12" id="{{$item[5]["content"]["title"]}}">
            <div class="card">
                <div class="card-header .bg-secondary">{{ $item[5]["content"]["sub_title"]}}
                </div>
                <div class="card-body">
                    <div class="group-header">
                        <h2 class="ec-title">{{$item[5]["content"]["title"]}}</h2>
                        <p>{!!$item[6]["content"]["introduction"]!!}</p>
                        <figure class="highcharts-figure">
                            <div id="barChart" style="height: 600px; width: 1608px;margin:0 auto; margin-top:10px"></div>
                        </figure>
                        <h2 class="ec-title">{{$item[7]["content"]["title"]}}</h2>
                        <p>{!!$item[7]["content"]["introduction"]!!}</p>
                        <figure class="highcharts-figure">
                            <div id="chart" style="height: 600px; width: 1308px; margin:0 auto"></div>
                        </figure>
                    </div>
                </div>
            </div>
        </div>
        <!-- /end Graph -->



        <!--  4 - PERSONALISED ANALYSIS -->
        @if (str_contains($item[8]['type'], 'ancre'))
        <h2 class="card-title">{{ $item[8]["params"]["menuNumber"] }} - {{$item[8]["content"]["title"]}} </h2>
        @endif

        <div class="col-md-12" id="{{ $item[8]["content"]["title"]}}">
            <div class="card">
                <div class="card-header .bg-secondary">{{ $item[8]["content"]["sub_title"]}}
                </div>
                <div class="card-body">
                    <div class="intro">
                        {!! $item[9]["content"]["introduction"]!!}
                    </div>
                      {{-- {{dd($item[9])}} --}}
                    @foreach($item[9]["content"]["domain"] as $detail)
 
                    <div class="group-header mt-4">
                        <h4>{{ $detail['label']}}</h4>
                    </div>
                    @foreach ($detail['contents'] as $content)
                    <h5 style="padding-top:20px">{!! $content["title"]!!}</h5>
                    <div class="box mb-2">
                        <div class="bg-grey box-content">
                            {!! $content['comment'] !!}
                        </div>
                    </div>
                    @endforeach

                    @endforeach
                </div>
            </div>
        </div>
        <!-- /endsection -->

        {{-- 5 - FACTOR DEFINITIONS starts--}}


        <!-- 5 - the Comments  -->
        @if (str_contains($item[10]['type'], 'ancre'))
        <h2 class="card-title">{{ $item[10]["params"]["menuNumber"] }} -
            {{ __($item[10]["content"]["title"]) }} </h2>
        @endif

        <div class="col-md-12" id="{{ $item[10]["content"]["title"]}}">
            <div class="card">
                <div class="card-header .bg-secondary">
                    {{ __($item[10]["content"]["sub_title"]) }}
                </div>
                <div class="card-body">
                    {{-- {{dd($item)}} --}}
                    <!-- /endees  -->
                    @for ($i=11; $i < 29; $i++) <!-- start -->
                        <div class="group-header">
                            <h3>{!! $item[$i]["content"]["title"]!!}</h3>
                            <hr style="border-color: {!!isset($item[$i]['params']['couleur']) ? $item[$i]['params']['couleur'] : '' !!}">
                        </div>
                        <div class="score-bar-wrapper row">
                            <div class="col-xs-12 col-sm-3">

                                <div class="box-score" style="
                            color:#000000; background-color:{!!$item[$i]['params']['couleur']!!}">
                                    <div class="header">
                                        {{ __('Score') }} <br>
                                        {{ $item[$i]["params"]["score"]}}
                                    </div>
                                </div>
                            </div>

                            <div class="col-xs-12 col-sm-9">
                                <div class="progress score-bar" style="width: 100%;">
                                    <label for="0" id="percent_start">0</label>
                                    <?php $score = str_replace(".", "", $item[$i]["params"]["score"]) ?>
                                    @if(strlen($score) == 1)
                                    <?php $score .= 0;?>
                                    @endif

                                    <div class="progress-bar" style="width:{{$score}}%;
                                    color:#000000; background-color: #{!!$item[$i]['params']['couleur']!!} "></div>
                                    <label for=" 10" id="percent_end">10</label>
                                </div>
                            </div>
                        </div>

                        <div class="box mb-5">
                            @if(isset($item[$i]['content']['commentaire_perso']))
                            <div class="box-content bg-grey">
                                {!! $item[$i]["content"]["commentaire_perso"] !!}
                            </div>
                            @endif
                            @if(isset($item[$i]["content"]["description_long"]))
                            <div class="box-header box-header-small">
                                <div class="title text-left"> <i class="fa fa-arrow-circle-o-right" aria-hidden="true"></i>
                                    {{ __('Definition') }}</div>
                            </div>

                            <div class="box-content ec-first-border-color">
                                {!! $item[$i]["content"]["description_long"] !!}
                            </div>
                            @endif
                        </div>
                        <!-- /end  -->
                        @endfor
                </div>
            </div>
        </div>
    </div>
    <!-- /end Comment -->

    {{-- 5 - FACTOR DEFINITIONS ends --}}

    {{-- 6 - HOW DIFFERENT PROFESSIONS SUIT THE PROFILE STARTS --}}
    @if (str_contains($item[29]['type'], 'ancre'))
    <h2 class="card-title">{{ $item[29]["params"]["menuNumber"] }} - {{$item[29]["content"]["title"]}} </h2>
    @endif

    <div class="col-md-12" id="{{$item[29]["content"]["title"]}}">
        <div class="card">
            <div class="card-header .bg-secondary">{{ $item[29]["content"]["sub_title"]}}</div>
            <div class="card-body">
                {!! $item[30]["content"]["introduction"] !!}
                <div class="adoquetion">

                    @if (isset($item[30]['adequacy']))
                    {{-- {{dd($item[26])}} --}}

                    @foreach ($item[30]['adequacy'] as $key => $adequacy)
                    @if(isset($adequacy))
                    <div class="mt-3 mb-3">
                        <h5>{!! $adequacy['adequation_profile']['label'] !!}</h5>
                        {{-- <div>
                        {!! $adequacy['adequation_profile']['description'] !!}
                    </div> --}}
                    </div>
                    @foreach($adequacy['adequation_profile']['test_ref_adequation'] as $index=> $profile)
                    <div class="row">
                        <div class="col-xs-1 col-md-1 col-sm-1">{{$index+1}}</div>
                        <div class="col-xs-11 col-md-5 col-sm-5 word-break">
                            {{$profile['label']}}
                        </div>
                        <div class="col-xs-7 col-md-3 col-sm-5 add-md-print">
                            <div class="progress">
                                <div class="progress-bar ec-first-bg-color ec-first-text-color" style="width: {{$profile['pourcentage_score']}}%;"></div>
                            </div>
                        </div>
                        <div class="col-xs-2 col-md-1 col-sm-1 remove-md-print">
                            {{$profile['pourcentage_score']}}%
                        </div>
                        <div class="col-xs-2 col-md-1 col-sm-1 remove-md-print" data-toggle="collapse" data-target="#{{$index}}" class="accordion-toggle">
                            <p class="t-right">{{ __('Details') }}</p>
                        </div>

                        <div class="hiddenRow">
                            <div class="accordian-body collapse hiddenRow" id="{{$index}}">
                                @if($profile['description_long'])
                                {!! $profile['description_long'] !!}
                                @endif

                            </div>
                        </div>

                    </div>
                    @endforeach
                    @endif
                    @endforeach
                    @endif

                </div>
            </div>
        </div>
    </div>
    {{-- 8 - HOW DIFFERENT PROFESSIONS SUIT THE PROFILE ENDS --}}
</div>

@endsection
@section('script')
<script>
    function findPoint(a, b) {
        let d = ((a * b) * 1 / 2) / ((a + b) * 0.25);
        return parseFloat(d.toFixed(2));
    }

    var categories = [];
    var data = [];
    var items = {
        data: []
        , name: ""
        , type: "area"
        , color: ""
    };
    var barChart = [];
    var obj = {};
    var point_start = -15;
    @foreach($group_factors as $idx => $group)
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
    , };
    @endforeach

    console.log("data - ", data);

    // эхний утгийг нь 
    var new_data = []
        , previous = [];
    var matrix = []
        , n = 0
        , m = 0;

    for (const [key, value] of Object.entries(data)) {
        if (key == 0) data[key].pointStart = -15;
        else if (key == 1) data[key].pointStart = 45;
        else if (key == 2) data[key].pointStart = 105;
        else if (key == 3) data[key].pointStart = 165;
        else if (key == 4) data[key].pointStart = 225;
        else if (key == 5) data[key].pointStart = 285;
        matrix[n] = [];
        value.data.map((el, index) => {
            if (el !== null) {
                matrix[n][m] = el;
                m++;
            }
        });


        n++;
        m = 0;
    }

    for (const [key, value] of Object.entries(data)) {
        var first, second;
        value.data.map((el, index) => {
            if (index == 0) first = el;
            else if (index == 1) second = el;
        });
        //console.log("previous: ", previous)
        for (let i = 0; i < 6; i++) {
            if (i == 0) {
                // hamgiin ehnii muriin tseguudiig tootsoh
                // data : {calc 4 null 6 calc 0 }
                // findpoint(matrix[0][0], matrix[5][1])
                if (key == 0) new_data[0] = findPoint(first, matrix[parseInt(5 - key)][1]);
                else
                    new_data[i] = previous[4]
            } else if (i == 1) new_data[i] = first;
            else if (i == 3) new_data[i] = second;
            else if (i == 4) {
                if (key == 0) new_data[i] = findPoint(matrix[1][0], second);
                else if (key == 1) new_data[i] = findPoint(matrix[2][0], second);
                else if (key == 2) new_data[i] = findPoint(matrix[3][0], second);
                else if (key == 3) new_data[i] = findPoint(matrix[4][0], second);
                else if (key == 4) new_data[i] = findPoint(matrix[5][0], second);
                else if (key == 5) new_data[i] = findPoint(matrix[0][0], second);
            } else if (i == 5) new_data[i] = 0;
            else new_data.push(null);
            previous = new_data;

        }
        value.data = new_data;
        console.log("new_data - ", new_data);
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

        xAxis: {
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
                        , iIndex = this.value / 30
                        , oCategories = categories;

                    if (oCategories[iIndex] !=
                        undefined) {
                        sReturn += oCategories[iIndex];
                    }
                    return sReturn;
                }
            }
            , "tickPositions": [0, 30, 60, 90, 120, 150, 180, 210, 240, 270, 300, 330, 360]
        }
        , "series": data

    });

</script>


<script>
    // Create the bar chart
    Highcharts.chart('barChart', {
        chart: {
            renderTo: 'container'
            , type: 'column'
        },

        accessibility: {
            announceNewData: {
                enabled: true
            }
        }
        , yAxis: {
            title: {
                text: ''
            }
            , labels: {
                style: {
                    fontSize: '15px'
                }
            }
        }
        , xAxis: {
            type: 'category'
            , labels: {
                style: {
                    fontSize: '15px'
                }
            }
        },

        title: {
            text: ''
        }
        , legend: {
            enabled: false
        , }
        , plotOptions: {
            series: {
                borderWidth: 0
            , }
            , stacking: 'normal'
            , dataLabels: {
                enabled: true
            }
        },

        tooltip: {
            headerFormat: '<span style="font-size:14px">{series.name}: {point.y}</span><br>'
            , pointFormat: '<span style="font-size:16px;color:{point.color}">{point.name}</span>'
        },

        series: [{
            colorByPoint: true
            , data: barChart
        }]
    , });

</script>
@endsection
