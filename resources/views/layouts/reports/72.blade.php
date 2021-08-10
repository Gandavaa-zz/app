{{-- Entrepreneur test --}}
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

    {{-- 1 - THE SCORE --}}
    @if (str_contains($item[0]['type'], 'ancre'))
    <h2 class="card-title">{{$item[0]["params"]["menuNumber"] }} -
        {{$item[0]["content"]["title"]}} </h2>
    @endif

    <div class="col-md-12" id="{{$item[0]["content"]["title"]}}">
        <div class="card">
            <div class="card-header .bg-secondary">
                {{ $item[0]["content"]["sub_title"]}}
            </div>
            <div class="card-body">
                <div class="score-bar-wrapper row">
                    <div class="col-xs-12 col-sm-3">
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

                    <div class="box mb-4">
                        <div class="bg-grey box-content">
                            <div class="">
                                {!! $item[1]["content"]["commentaire_perso"] !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- 1 - THE GRAPH ENDS --}}

    {{--2 -  PERSONALISED ANALYSIS OF THE REPORT  --}}
    @if (str_contains($item[2]['type'], 'ancre'))
    <h2 class="card-title">{{ $item[2]["params"]["menuNumber"] }} -
        {{$item[2]["content"]["title"]}}
    </h2>
    @endif

    <div class="col-md-12" id="{{$item[2]["content"]["title"]}}">
        <div class="card">
            <div class="card-header .bg-secondary">{{ $item[2]["content"]["sub_title"]}}
            </div>
            <div class="card-body">
                <div class="intro">
                    {!! $item[3]["content"]["introduction"]!!}
                </div>
                @foreach($item[3]["content"]["domain"] as $detail)
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

    {{--3 - THE GRAPH  --}}
    @if (str_contains($item[4]['type'], 'ancre'))
    <h2 class="card-title">{{$item[4]["params"]["menuNumber"] }} -
        {{$item[4]["content"]["title"]}}
    </h2>
    @endif

    <div class="col-md-12" id="{{$item[4]["content"]["title"]}}"> 
        <div class="card">
            <div class="card-header .bg-secondary">
                {{ $item[4]["content"]["sub_title"]}}
            </div>
            <div class="card-body">
                <div class="group-header">
                    <figure class="highcharts-figure">
                        <div id="chart" style="height: 600px; width: 1308px; margin:0 auto"></div>
                    </figure>
                </div>
            </div>
        </div>
    </div>

    {{--4 - The Comment --}}
    @if (str_contains($item[6]['type'], 'ancre'))
    <h2 class="card-title">{{ $item[6]["params"]["menuNumber"] }} -
        {{$item[6]["content"]["title"]}}
    </h2>
    @endif

    <!-- 5- the Comments  -->
    <div class="col-md-12" id="{{$item[6]["content"]["title"]}}">
        <div class="card">
            <div class="card-header .bg-secondary">
                {{ $item[6]["content"]["sub_title"]}}
            </div>

            <div class="card-body">
                @foreach ($item as $comment)

                @if($comment['type']=='rapport_details_groupe')
                <div class="group-header">
                    <h2>{!! $comment["content"]["title"]!!}</h2>
                    <hr style="border-color: {!!$item[7]['params']['couleur']!!}">
                </div>
                @elseif($comment['type']=='rapport_details_facteur')
                <div class="group-header">
                    <p style="padding-bottom:10px">{!! $comment["content"]["title"]!!} </p>
                </div>

                <div class="score-bar-wrapper row">
                    <div class="col-xs-12 col-sm-3">

                        <div class="box-score" style="
                                        color:#000000; background-color:{!!$comment['params']['couleur']!!}">
                            <div class="header">
                                {{ __('Score') }} <br>
                                {{ $comment["params"]["score"]}}
                            </div>
                        </div>
                    </div>

                    <div class="col-xs-12 col-sm-9">
                        <div class="progress score-bar" style="width: 100%;">
                            <label for="0" id="percent_start">0</label>
                            <div class="progress-bar" style="width:{{str_replace(".", "", $comment["params"]["score"])}}%;
                                                color:#000000; background-color: #{!!$comment['params']['couleur']!!} ">
                            </div>
                            <label for=" 10" id="percent_end">10</label>
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
                            {!! $comment["content"]["description_long"] !!}
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
    {{-- end The Comment --}}



    <!-- GENERAL PROFILE -->
    @if (str_contains($item[23]['type'], 'ancre'))
    <h2 class="card-title">{{ $item[23]["params"]["menuNumber"] }} -
        {{$item[23]["content"]["title"]}}
    </h2>
    @endif



    <div class="col-md-12" id="{{$item[23]["content"]["title"]}}">
        <div class="card">
            <div class="card-header .bg-secondary">{{ $item[23]["content"]["sub_title"]}}</div>
            <div class="card-body">
                {!! $item[24]["content"]["introduction"] !!}
                <div class="adoquetion">

                    @if (isset($item[24]['adequacy']))

                    @php $i = 1;
                    $adeq = $item[24]['adequacy'];
                    @endphp

                    @foreach ($item[24]['adequacy'] as $key => $adequacy)

                    @if(isset($adequacy['adequation_profile'][0]['label']) && $i==1)
                    <div class="mt-3 mb-3">
                        <h5>{!! $adequacy['adequation_profile'][0]['label'] !!}</h5>
                        @if(isset($adequacy['adequation_profile'][0]['description']))
                        <div>
                            {!! $adequacy['adequation_profile'][0]['description'] !!}
                        </div>
                        @endif
                    </div>
                    @endif

                    @php
                    $percentatage = $adequacy['pourcentage_score'];
                    @endphp

                    @if(isset($adequacy))

                    @foreach($adequacy['adequation_profile'] as $index=> $profile)

                    <div class="row">
                        <div class="col-xs-1 col-md-1 col-sm-1">{{$i++}}</div>
                        <div class="col-xs-11 col-md-6 col-sm-5 word-break">
                            {{$profile['test_ref_adequation']['label']}}
                        </div>
                        <div class="col-xs-7 col-md-3 col-sm-5 add-md-print">
                            <div class="progress">
                                <div class="progress-bar ec-first-bg-color ec-first-text-color" style="width: {{$percentatage}}%;"></div>
                            </div>
                        </div>
                        <div class="col-xs-2 col-md-1 col-sm-1 remove-md-print">
                            {{$percentatage}}%
                        </div>
                    </div>
                    @endforeach

                    @endif
                    @endforeach

                    @foreach ($item[24]['adequacy'] as $key => $adequacy)
                    @php
                    $percentatage = $adequacy['pourcentage_score'];
                    @endphp
                    @foreach($adequacy['adequation_profile'] as $profile2)

                    <div class="page-breaker-inside" style="margin-top:20px;">
                        <div class="row">
                            <div class="col-xs-12">
                                <h3>
                                    {{$profile2['test_ref_adequation']['label']}}
                                    <span class="badge badge-pill badge-secondary">
                                        {{$percentatage}}%</span>
                                </h3>
                            </div>
                        </div>
                        <hr class="hr-normal">
                        <div class="row">
                            <div class="col-xs-12">
                                {!! $profile2['test_ref_adequation']['description_long'] !!}
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
    <!-- /GENERAL PROFILE -->


</div>


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
    @foreach($group_factors as $idx => $group)
    @if(!str_contains($group['label'], "Indica"))
    items.name = @json($group['label']);

    @foreach($group['factors'] as $idx => $factor)
    @if(!str_contains($factor['label'], "(-)") && !str_contains($factor['label'], "Etalonnage"))
    categories.push(@json($factor['label']) + " (" + @json($factor['score']) + ")");
    @endif
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
    };
    @endif
    @endforeach

    console.log("categories - ", categories);

    // эхний утгийг нь 
    var new_data = []
        , previous = [];
    var matrix = []
        , n = 0
        , m = 0;


    for (const [key, value] of Object.entries(data)) {
        if (key == 0) data[key].pointStart = -13;
        else if (key == 1) data[key].pointStart = 169;
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
  console.log("matrix: ", matrix);
    for (const [key, value] of Object.entries(data)) {
        var first, second;
        value.data.map((el, index) => {
            if (index == 0) first = el;
            else if (index == 1) second = el;
        });
        console.log("previous: ", findPoint(first, matrix[parseInt(1 - key)][6]))
        for (let i = 0; i < 14; i++) {
            if (i == 0) {
                // hamgiin ehnii muriin tseguudiig tootsoh
                // data : {calc 4 null 6 calc 0 }
                // findpoint(matrix[0][0], matrix[5][1])
                if (key == 0) new_data[0] = findPoint(first, matrix[parseInt(13 - key)][0]);
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
                , "value": 5
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
                , "pointInterval": 9.5
            }
            , "area": {
                "lineWidth": 1
            }
        },

        "xAxis": {
            "max": 14
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
                , formatter: function() {
                    var sReturn = ''
                        , iIndex = this.value / 26
                        , oCategories = categories;

                    if (oCategories[iIndex] !=
                        undefined) {
                        sReturn += oCategories[iIndex];
                    }
                    return sReturn;
                }
            }
            , "tickPositions": [0, 26, 52, 78, 104, 130, 156, 182, 208, 234, 260, 286, 312, 338, 364]
        },

        "series": data

    });

</script>
@endsection
@endsection
