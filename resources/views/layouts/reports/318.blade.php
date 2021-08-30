{{-- Emotion --}}
@extends('layouts.report')

@section('nav')
@include("layouts.reports.components.header", ['data'=> $data])

@endsection

@section('content')
<!-- logo -->
@include("layouts.reports.components.logo", ['logo'=> $data['general']])
<!-- /logo -->

<div class="row" id="printable">
    @php $item = $data["parties"]["party"]; @endphp
    @php $group_factors = $data["group_factors"]; @endphp
    @if (str_contains($item[0]['type'], 'ancre'))
    @php $before_type = 'ancre' @endphp

    {{-- Indicator --}}
    <h2 class="card-title">{{ $item[0]["params"]["menuNumber"] }} - {{$item[0]["content"]["title"]}}
    </h2>
    @endif

    <div class="col-md-12" id='{{ $item[0]["content"]["title"]}}'>
        <div class="card">
            <div class="card-header .bg-secondary">
                {{ $item[0]["content"]["sub_title"]}}
            </div>
            <div class="card-body">
                <div class="col-xs-12 col-sm-3">
                    <h3 class="box-label">
                        {{ $item[2]["content"]["title"]}}
                    </h3>
                    <div class="box-score" style="color:#000000; background-color: #1C3664">
                        <div class="header" style="color: #fff;">
                            {{ __('Quotient') }} <br>
                            @if (isset($item[2]["params"]["quotient"]))
                            {{ $item[2]["params"]["quotient"] }}
                            @endif
                        </div>
                    </div>
                </div>
                <br>
                <hr>
                <div class="box-desc">
                    <div class="box-content ec-first-border-color" style="background-color: #EEEEEE">
                        {!!$item[2]["content"]['commentaire_perso']!!}

                    </div>
                </div>
                <br>
                <img src="/assets/img/emotion/us.clocheQE01.jpg" alt="" height="425" width="519" />
                {{-- {!!$item[3]['content']['introduction']!!} --}}
            </div>
        </div>
    </div>
    {{-- Indicator ends --}}


    <!-- 2 Graph -->
    @if (str_contains($item[4]['type'], 'ancre'))
    <h2 class="card-title">{{ $item[4]["params"]["menuNumber"] }} -
        {{$item[4]["content"]["title"]}}
    </h2>
    @endif

    <div class="col-md-12" id="{{$item[4]["content"]["title"]}}">
        <div class="card">
            <div class="card-header .bg-secondary">{{ $item[4]["content"]["sub_title"]}}
            </div>
            <div class="card-body">
                <div class="group-header">
                    <h2 class="ec-title">{{$item[5]["content"]["title"]}}</h2>
                    <figure class="highcharts-figure">
                        <div id="chart" style="height: 600px; width: 1308px; margin:0 auto"></div>
                    </figure>
                </div>
                <h3>{{ $item[6]["content"]["title"]}}</h3>
                <div class="col-md-12">
                    {!! __($item[6]["content"]["sub_title"]) !!}

                    <div class="intro">
                        {!! $item[6]["content"]["introduction"]!!}
                    </div>
                    @foreach($item[6]["content"]["domain"] as $detail)
                    <div class="group-header mt-4">
                        <h4>{{ $detail['label']}}</h4>
                    </div>
                    @foreach ($detail['contents'] as $content)
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
    </div>
    <!-- /2 end Graph -->

    {{-- 3 Comments --}}
    {{--4 - The Comment --}}
    @if (str_contains($item[7]['type'], 'ancre'))
    <h2 class="card-title">{{ $item[7]["params"]["menuNumber"] }} -
        {{$item[6]["content"]["title"]}}
    </h2>
    @endif

    <!-- 5- the Comments  -->
    <div class="col-md-12" id="{{ $item[7]["content"]["title"]}}">
        <div class="card">
            <div class="card-header .bg-secondary">
                {{ $item[7]["content"]["sub_title"]}}
            </div>

            <div class="card-body">
                @foreach ($item as $comment)

                @if($comment['type']=='rapport_details_groupe')
                <div class="group-header">
                    <h3><strong>{!! $comment["content"]["title"]!!}</strong></h3>
                </div>
                @elseif($comment['type']=='rapport_details_facteur' && !str_contains($comment["content"]["title"], "Social"))
                <div class="group-header">
                    <h3>{!! $comment["content"]["title"]!!}</h3>
                </div>

                <div class="score-bar-wrapper row">
                    <div class="col-xs-12 col-sm-3">

                        <div class="box-score" style="color:#000000; background-color:{!!$comment['params']['couleur']!!}">
                            <div class="header">
                                {{ __('Score') }} <br>
                                {{ $comment["params"]["score"]}}
                            </div>
                        </div>
                    </div>

                    <div class="col-xs-12 col-sm-9">
                        <div class="progress score-bar" style="width: 100%;">
                            <label for="0" id="percent_start">0</label>
                            <?php $score = str_replace(".", "", $comment["params"]["score"]) ?>
                            @if(strlen($score) == 1)
                            <?php $score .= 0;?>
                            @endif
                            <div class="progress-bar" style='width:{{$score}}%;color:#000000; background-color: #{!!$comment["params"]["couleur"]!!} '>
                            </div>
                            <label for="10" id="percent_end">10</label>
                        </div>
                    </div>

                    <div class="box mb-2">
                        <div class="bg-grey box-content">
                            {!! $comment["content"]["commentaire_perso"] !!}
                        </div>
                    </div>

                    <div class="box mb-5">
                        <div class="box-header box-header-small">
                            <div class="title text-left"> <i class="fa fa-arrow-circle-o-right" aria-hidden="true"></i>
                                {{ __('Definition') }}
                            </div>
                        </div>
                        <div class="box-content ec-first-border-color">
                            {!! $comment["content"]["description_courte"] !!}
                        </div>
                    </div>
                    <!-- /endees  -->
                </div>
                @endif
                @endforeach
            </div>
            <!-- card body -->
        </div>
        <!--card  -->
    </div>
    <!-- comment -->

    {{-- 4 - General Profile --}}

    @if (str_contains($item[25]["type"], "ancre" )) <h2 class="card-title">{{ $item[25]["params"]["menuNumber"] }} - {{$item[25]["content"]["title"]}} </h2>
    @endif

    <div class="col-md-12" id="{{$item[25]["content"]["title"]}}">
        <div class="card">
            <div class="card-header .bg-secondary">{{ $item[25]["content"]["sub_title"]}}</div>
            <div class="card-body">
                {!! $item[26]["content"]["introduction"] !!}
                <div class="adoquetion">
                    @if (isset($item[26]['adequacy']))
                    <div class="mt-3 mb-3">
                        <h5>{!! $item[26]['adequacy'][0]['adequation_profile'][0]['label'] !!}</h5>
                    </div>
                    @foreach ($item[26]['adequacy'] as $key => $adequacy)
                    @if(isset($adequacy))

                    @foreach($adequacy['adequation_profile'] as $index=> $profile)
                    <div class="row">
                        <div class="col-xs-1 col-md-1 col-sm-1">{{$key+1}}</div>
                        <div class="col-xs-11 col-md-6 col-sm-5 word-break">
                            {{$profile['test_ref_adequation']['label']}}
                        </div>
                        <div class="col-xs-7 col-md-3 col-sm-5 add-md-print">
                            <div class="progress">
                                <div class="progress-bar ec-first-bg-color ec-first-text-color" style="width: {{$adequacy['pourcentage_score']}}%;"></div>
                            </div>
                        </div>
                        <div class="col-xs-2 col-md-1 col-sm-1 remove-md-print">
                            {{$adequacy['pourcentage_score']}}%
                        </div>
                    </div>
                    @endforeach
                    @endif
                    @endforeach

                    @foreach ($item[26]['adequacy'] as $key => $adequacy)
                    @foreach($adequacy['adequation_profile'] as $profile2)
                    <div class="page-breaker-inside" style="margin-top:20px;">
                        <div class="row">
                            <div class="col-xs-12">
                                <h3>
                                    {{$profile2['test_ref_adequation']['label']}}
                                    <span class="badge badge-pill badge-secondary"> {{$adequacy['pourcentage_score']}}%</span>
                                </h3>
                            </div>
                        </div>
                        <hr class="hr-normal">
                        <div class="row">
                            <div class="col-xs-12">
                                @if (isset($profile2['test_ref_adequation']['description']))
                                {!!$profile2['test_ref_adequation']['description']!!}
                                @elseif (isset($profile2['test_ref_adequation']['description_long']))
                                {!! $profile2['description_long']!!}
                                @else {{""}}
                                @endif
                            </div>
                        </div>
                    </div>
                    @endforeach
                    @endforeach

                    @endif

                </div>
            </div>
        </div>
    </div>

    {{-- 4 - General Profile ends --}}
    <!-- /endsection -->
    @endsection
    @section('script')

    <script>
        var doc = new jsPDF();
        var elementHandler = {
            '#ignorePDF': function(element, renderer) {
                return true;
            }
        };
        var source = window.document.getElementsByTagName("body")[0];
        doc.fromHTML(
            source
            , 15
            , 15, {
                'width': 180
                , 'elementHandlers': elementHandler
            });

        doc.output("dataurlnewwindow");

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

        @foreach($group_factors as $idx => $group)
        @if(str_contains($group['label'], 'Personal'))
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
                if (index === 0) first = el;
                else if (index === 7) second = el;
                else if (index === 8) third = el
            });

            for (let i = 0; i < 8; i++) {
                if (i == 0) {
                    console.log(key);
                    console.log(matrix[parseInt(3 - key)]);
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
                , "tickPositions": [0, 30, 60, 90, 120, 150, 180
                    , 210, 240, 270, 300, 330, 360, 390, 420, 450
                ]
            }
            , "series": data
        });

    </script>
    @endsection
