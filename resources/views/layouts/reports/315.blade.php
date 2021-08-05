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
                    <div class="col-md-12 align-center">
                        <!-- Si le titre est vide on utilise le lettrage (la première lettre de chaque cible avec la couleur en background) -->
                        <div class="synthetic-card-combination-box" style="background-color: #6BDCFB">I</div>
                        <div class="synthetic-card-combination-box" style="background-color: #FAFAAF">E</div>
                        <div class="synthetic-card-combination-box" style="background-color: #4D8AFD">A</div>
                        <div class="synthetic-card-targets-list col-md-12 align-left text-xs-left">
                            <!-- Cibles secondaires et scores -->
                            <div class="col-xs-12 font-large synthetic-card-target">
                                <div class="target-score align-right ">
                                    <!-- On veut un nombre d'étoiles sur 5 or les notes sont sur 10. Donc on divise par 2 -->
                                    <span class="star-rating" data-number="3.25" style="color: #6BDCFB"><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star-o"></i><i class="fa fa-star-o"></i></span>
                                    Investigative </div>

                            </div>
                            <div class="col-xs-12 font-large synthetic-card-target">
                                <div class="target-score align-right ">
                                    <!-- On veut un nombre d'étoiles sur 5 or les notes sont sur 10. Donc on divise par 2 -->
                                    <span class="star-rating" data-number="3.25" style="color: #FAFAAF"><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star-o"></i><i class="fa fa-star-o"></i></span>
                                    Enterprising</div>

                            </div>
                            <div class="col-xs-12 font-large synthetic-card-target">
                                <div class="target-score align-right ">
                                    <!-- On veut un nombre d'étoiles sur 5 or les notes sont sur 10. Donc on divise par 2 -->
                                    <span class="star-rating" data-number="3" style="color: #4D8AFD"><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star-o"></i><i class="fa fa-star-o"></i></span>
                                    Artistic</div>

                            </div>
                        </div>
                    </div>

                    <!-- Description 1 -->
                    <div class="col-xs-12 col-sm-6 desc">
                        <p><span style="font-size: medium;"><strong>Description: </strong><br></span></p>
                        <p><span style="font-size: medium;">Maralmaa Baasanjargal's main interest appears to be in investigative activities that require analysis, and where she is always learning new things. Tasks that centre around problem-solving and exploration into theories are likely to be of high importance to her in finding her ideal profession.<br></span></p>
                        <p><span style="font-size: medium;">Maralmaa Baasanjargal is also likely to have an inclination towards enterprising activities that involve risk-taking and influencing others. Tasks that require her to lead people or projects and to put ideas into action are therefore also likely to be of great interest to her.<br></span></p>
                        <p><span style="font-size: medium;">On top of this, Maralmaa Baasanjargal appears to enjoy artistic activities that permit her to put her creative flair to use. As a result, tasks that give her the freedom to express herself by conceiving and designing her ideas may also be of appeal to her in her occupation.<strong></strong><em></em><span style="text-decoration: underline;"></span><sub></sub><sup></sup><span style="text-decoration: line-through;"></span></span></p>
                    </div>

                    <!-- Description 2 -->
                    <div class="col-xs-12 col-sm-6 desc">
                        <p><span style="font-size: medium;"><strong>Appropriate trades include:</strong></span></p>
                        <span style="font-size: medium;"> </span>
                        <p><span style="font-size: medium;">- Marketing, communications, PR and advertising fields.</span></p>
                        <span style="font-size: medium;"> </span>
                        <p><span style="font-size: medium;">- Design / graphic design. </span></p>
                        <span style="font-size: medium;"> </span>
                        <p><span style="font-size: medium;">- Legal fields: barrister, solicitor, clerk, etc.</span></p>
                        <span style="font-size: medium;"> </span>
                        <p><span style="font-size: medium;">- Journalism and reporting.</span></p>
                        <span style="font-size: medium;"> </span>
                        <p><span style="font-size: medium;">- Management in fields of high complexity: engineering, mathematical fields, etc.</span></p>
                        <span style="font-size: medium;"> </span>
                        <p><span style="font-size: medium;">- Management of research projects.</span></p>
                        <span style="font-size: medium;"> </span>
                        <p><span style="font-size: medium;">- Sales, business development, sales engineers, business engineers, technical sales representatives, buyers, etc.</span></p>
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
                            <div id="barChart" style="height: 600px; width: 1308px; margin:0 auto"></div>
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
                            <hr style="border-color: {!!isset($item[$i]['params']["couleur"]) ? $item[$i]['params']["couleur"] : '' !!}">
                        </div>
                        <div class="score-bar-wrapper row">
                            <div class="col-xs-12 col-sm-3">

                                <div class="box-score" style="
                            color:#000000; background-color:{!!$item[$i]['params']["couleur"]!!}">
                                    <div class="header">
                                        {{ __('Score') }} <br>
                                        {{ $item[$i]["params"]["score"]}}
                                    </div>
                                </div>
                            </div>

                            <div class="col-xs-12 col-sm-9">
                                <div class="progress score-bar" style="width: 100%;">
                                    <label for="0" id="percent_start">0</label>
                                    <div class="progress-bar" style="width:{{$item[$i]["params"]["score"]}}%;
                                    color:#000000; background-color: #{!!$item[$i]['params']["couleur"]!!} "></div>
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
            , fillOpacity: 0.3
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
            else if (key == 1) data[key].pointStart = 75;
            else if (key == 2) data[key].pointStart = 165;
            else if (key == 3) data[key].pointStart = 255;
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
            // first value-g avna
            var first, second, third;
            value.data.map((el, index) => {
                console.log("index",index);
                if (index === 0) first = el;
                else if (index === 6) second = el;
                else if (index === 7) third = el
            });

            console.log(first, "| ", second, " | ", third);
            for (let i = 0; i <= 7; i++) {
                if (i == 0) {
                    if (key == 0) new_data[i] = findPoint(first, matrix[parseInt(3 - key)][2]);
                    else new_data[i] = previous[6];
                } else if (i == 1) new_data[i] = first;
                else if (i == 3) new_data[i] = second;
                else if (i == 5) new_data[i] = third;
                else if (i == 6) {
                    if (key == 0) new_data[i] = findPoint(matrix[1][0], third);
                    else if (key == 1) new_data[i] = findPoint(matrix[2][0], third);
                    else if (key == 2) new_data[i] = findPoint(matrix[3][0], third);
                    else if (key == 3) new_data[i] = findPoint(matrix[0][0], third);
                } else if (i == 7) new_data[i] = 0;
                else new_data.push(null);
                previous = new_data;
            }
            console.log("new_data - ", new_data);
            value.data = new_data;
            new_data = [];
        }

        console.log("data - ", data);
 
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
                    "distance": 15
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
                , "tickPositions": [0,30,60,90,120,150,180,210,240,270,300,330,360]
            }
            , "series": data
            // "series": [{
            //     "color": "#F781BE",
            //     "name": "Client Acquisition Skills",
            //     "type": "area",
            //     "pointStart": -15,
            //      "data": [2.2, 1.7, null, 1.4, null, 1.4, null, 0]   
            //  "data":[2.24, 1.7, null, 1.4, null, 1.4, 2.1, 0]                        

            // }, {
            //     "color": "#D0A9F5",
            //     "name": "Business Development Skills",
            //     "type": "area",
            //     "pointStart": 75,
            //     "data": [6, 5, null, 5.8, null, 1.7, 2, 0]
            // 2.42, 4.2, null, 5.8, null, 3.3, 3.98, 0]

            // }, {
            //     "color": "#A9F5A9",
            //     "name": "Negotiation Skills",
            //     "type": "area",
            //     "pointStart": 165,
            //     "data": [2, 3.3, null, 3.3, null, 4.3, 3.7, 0]
            // }, {
            //     "color": "#81BEF7",
            //     "name": "Selling Skills",
            //     "type": "area",
            //     "pointStart": 255,
            //     "data": [3.7, 3.3, null, 6.7, null, 3.3, 2.2, 0]
            // }], 

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
