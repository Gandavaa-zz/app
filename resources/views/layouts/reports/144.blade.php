{{-- professional profile 2 test --}}
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


    {{-- 1 - THE GRAPH --}}
    @if (str_contains($item[2]['type'], 'ancre'))
        <h2 class="card-title">{{ $item[2]["params"]["menuNumber"] }} -
            @php 
            echo isset($item[2]["content"]["title"])? $item[2]["content"]["title"] : 'График';
            @endphp
        </h2>
    @endif
    <div class="col-md-12" id="{{ $item[2]["content"]["title"]}}">
        <div class="card">
            <div class="card-header .bg-secondary">{{ $item[2]["content"]["sub_title"]}}
            </div>
            <div class="card-body">
                <div class="group-header">
                    {{-- <h2 class="ec-title">THE GRAPH</h2> --}}
                    <figure class="highcharts-figure">
                        <div style="height: 600px; width: 1308px; margin:0 auto" id="chart"></div>
                    </figure>
                </div>
            </div>
        </div>
    </div>
    {{-- 1 - THE GRAPH ENDS --}}


    {{-- 2 - THE INVERTED GRAPH --}}
    @if (str_contains($item[4]['type'], 'ancre'))
    <h2 class="card-title mt-500">{{ $item[4]["params"]["menuNumber"] }} - {{$item[4]["content"]["title"]}} </h2>
    @endif
    <div class="col-md-12" id="{{ $item[4]["content"]["title"]}}">
        <div class="card">
            <div class="card-header .bg-secondary">{{ $item[4]["content"]["sub_title"]}}
            </div>
            <div class="card-body">
                <div class="group-header">
                    {{-- <h2 class="ec-title">THE GRAPH</h2> --}}
                    <figure class="highcharts-figure">
                        <div style="height: 600px; width: 1308px; margin:0 auto" id="chart_second"></div>                        
                    </figure>
                </div>
            </div>
        </div>
    </div>
    {{-- 2 / THE INVERTED GRAPH ENDS --}}

    <!--  4 - PERSONALISED ANALYSIS -->
    @if (str_contains($item[6]['type'], 'ancre'))
    <h2 class="card-title">{{ $item[6]["params"]["menuNumber"] }} - {{$item[6]["content"]["title"]}} </h2>
    @endif

    <div class="col-md-12" id="{{ $item[6]["content"]["title"]}}">
        <div class="card">
            <div class="card-header .bg-secondary">{{ $item[6]["content"]["sub_title"]}}
            </div>
            <div class="card-body">
                <div class="intro">
                    {!! $item[7]["content"]["introduction"]!!}
                </div>
                @foreach($item[7]["content"]["domain"] as $detail)
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

    <!-- /endsection -->

    
    <!-- 4- Detailed table starts" -->
    {{-- {{dd($item)}} --}}
    <h2 class="card-title">{{ $item[8]["params"]["menuNumber"] }} - {!! $item[8]["content"]["title"] !!} </h2>
    <div class="col-md-12" id="{{ $item[8]["content"]["title"] }}">
        <div class="card">
            <div class="card-header .bg-secondary">{!! $item[8]["content"]["sub_title"] !!}</div>
            <div class="card-body">
                <div class="card-content">
                    {!! $item[9]["content"]["introduction"] !!}
                    <div class="responsive-table">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th class="title">Opposing factor</th>

                                    <th style="background-color:#EEEEEE">
                                        A </th>

                                    <th style="background-color:#EEEEEE">
                                        B </th>

                                    <th style="background-color:#EEEEEE">
                                        C </th>

                                    <th style="background-color:#EEEEEE">
                                        D </th>

                                    <th style="background-color:#D3D3D3">
                                        E </th>

                                    <th style="background-color:#D3D3D3">
                                        F </th>

                                    <th style="background-color:#D3D3D3">
                                        G </th>

                                    <th style="background-color:#EEEEEE">
                                        H </th>

                                    <th style="background-color:#EEEEEE">
                                        I </th>

                                    <th style="background-color:#EEEEEE">
                                        J </th>

                                    <th style="background-color:#EEEEEE">
                                        K </th>
                                    <th class="title">Main factor</th>
                                </tr>
                            </thead>

                            @foreach($group_factors as $key => $group_factor)
                            @if(!str_contains($group_factor['label'], "Indicateurs"))
                            {{-- {{dd($group_factor)}} --}}
                            <tbody class="">
                                <tr class="group">
                                    <td colspan="13" class="text-center left-label" style="background: #{{$group_factor['color']}};padding: 5px;">
                                        <h3 class="f-title">
                                            {{$group_factor['label']}}<br>
                                            <span style="font-size: 0.7em; font-weight: 100"></span>
                                        </h3>
                                    </td>
                                </tr>
                                @php $sub_factor = array(); $previous = null; $i = 1; @endphp

                                @foreach($group_factor['factors'] as $factor)
                                <tr class="factor">

                                    @if($i%2!==0)
                                    @php $previous = $factor; @endphp
                                    @else
                                    <td class="left-label">
                                        <h3>
                                            {{ $factor['label'] }}<br>
                                            {{-- {{dd($previous)}} --}}
                                            <span class="behaviour">{!! $previous['description_opposite'] !!}</span>
                                        </h3>
                                    </td>
                                    @for($n=0; $n<11; $n++) <td class="text-center" style="@if($n>3 && $n<7) background-color:#D3D3D3;  @else background-color:#EEEEEE; @endif; vertical-align: middle;width:3%">
                                        @if ($n<5 && (float)$n+0.1 <=(float)$previous["score"] && (float)$previous["score"]<=(float)$n+0.9) <img class="check-img img-responsive" src="/assets/img/checkbox.png" alt="OK">
                                            @elseif ($n>5 && (float)$n+0.1 <=(float)$previous["score"]+1 && (float)$previous["score"]+1 <=(float)$n+1) <img class="check-img img-responsive" src="/assets/img/checkbox.png" alt="OK">
                                                @endif
                                                </td>
                                                @endfor
                                                <!-- Factor scores -->
                                                <td style="text-align:right;">
                                                    <h3>
                                                        {{ $previous['label'] }}<br>
                                                        <span class="behaviour"><span>{!! $previous['description'] !!}</span></span>
                                                    </h3>
                                                </td>
                                                @endif
                                </tr>
                                @php $i++; @endphp
                                @endforeach
                            </tbody>
                            @endif
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- 4- Detailed table ends" -->

    {{-- 6- Comment starts --}}
    @if (str_contains($item[10]['type'], 'ancre'))
    <h2 class="card-title">{{ $item[10]["params"]["menuNumber"] }} - {{ __($item[10]["content"]["title"]) }} </h2>
    @endif
    <div class="col-md-12" id="{{$item[10]["content"]["title"]}}">
        <div class="card">
            <div class="card-header .bg-secondary">{{ $item[10]["content"]["sub_title"]}}</div>
            <div class="card-body">
                <h2>{{$item[10]["content"]["title"]}}</h2>
                {{-- {{dd($item)}} --}}
                @for($i = 10; $i < 25; $i++) @if(str_contains($item[$i]['type'], 'rapport_details_groupe' )) <div class="group-header">
                    <h3>{{ $item[$i]["content"]["title"] }}</h3>
            </div>
            @endif
            @if(str_contains($item[$i]['type'], 'rapport_details_facteur'))

            <div class="group-header clearfix">
                <h5>{{ $item[$i]["content"]["title"] }}
                    <h5>
            </div>
            <div class="score-bar-wrapper row">

                <div class="col-xs-12 col-sm-3">
                    <div class="factor-header">
                        <h5 class="c-title-text-color">
                            {{ $item[$i]["content"]["libelle_facteur_opposition"] }}
                        </h5>
                    </div>
                    <div class="box-score" style=" color:#000000; background-color: #{{$item[$i]['params']['couleur']}}">
                        <div class="header" style="color:#000;">
                            {{ __('Score') }} <br>
                            @if (isset($item[$i]["params"]["score_opposition"]))
                            {{ $item[$i]["params"]["score_opposition"] }}
                            @endif

                        </div>
                    </div>
                </div>

                <div class="col-xs-12 col-sm-6">
                    <div class="progress score-bar">
                        @if( isset($item[$i]["params"]["score_opposition"]))
                        <label for="0" id="percent_start">0</label>
                        <div class="progress-bar" style='width:{{ str_replace(".", "", $item[$i]["params"]["score_opposition"])}}%;
                                                        color:#000000;
                                                        background-color: #{{$item[$i]['params']['couleur']}}'>
                        </div>
                        <label for="10" id="percent_end">10</label>
                        @endif
                        @if( isset($item[$i]["adequacy"]["pourcentage_score"]))
                        <label for="0" id="percent_start">0</label>
                        <div class="progress-bar" style='width:{{ $item[$i]["adequacy"]["pourcentage_score"]}}%; color:#000000; background-color: #1C3664'>
                        </div>
                        <label for="10" id="percent_end">10</label>
                        @endif
                    </div>
                </div>

                <div class="col-xs-12 col-sm-3">
                    <div class="factor-header">
                        <h5 class="c-title-text-color">
                            {{ $item[$i]["content"]["libelle_facteur"] }}
                        </h5>
                    </div>
                    <div class="box-score" style=" color:#000000; background-color: #{{$item[$i]['params']['couleur']}}">
                        <div class="header" style="color:#000;">
                            {{ __('Score') }} <br>
                            @if (isset($item[$i]["params"]["moyenne_generale"]))
                            {{ $item[$i]["params"]["moyenne_generale"] }}
                            @endif
                            @if (isset($item[$i]["adequacy"]["pourcentage_score"]))
                            {{ $item[$i]["adequacy"]["pourcentage_score"] }}
                            @endif
                        </div>
                    </div>
                </div>


                <div class="box mb">
                    <div class="box-desc bg-grey">
                        <div>
                            {!! $item[$i]["content"]["commentaire_perso"] !!}
                        </div>
                    </div>
                </div>

                <div class="box mb-4">
                    <div class="box-header box-header-small">
                        <div class="title text-left"> <i class="fa fa-arrow-circle-o-right"></i>
                            {{ __('Definition') }}
                        </div>
                    </div>
                    <div class="box-desc">
                        <div>
                            {!! $item[$i]["content"]["description_long"] !!}
                        </div>
                    </div>
                </div>
            </div>
            @endif

            @endfor
        </div>
    </div>
    {{-- 6-Comment ends --}}

    {{-- 7 - POTENTIALS --}}
    @if (str_contains($item[27]['type'], 'ancre'))
    <h2 class="card-title">
        {{ $item[27]["params"]["menuNumber"] }} -
        {{ __($item[27]["content"]["title"]) }} </h2>
    @endif

    <div class="col-md-12" id="{{$item[27]["content"]["title"]}}">
        <div class="card">
            <div class="card-header .bg-secondary">{{ $item[27]["content"]["sub_title"]}}</div>
            <div class="card-body">
                {!! $item[28]["content"]["introduction"] !!}
                <div class="adoquetion">
                    @if (isset($item[28]['adequacy']))
                    {{-- {{dd($item[26])}} --}}
                    <div class="mt-3 mb-3">
                        <h5>{!! $item[28]['adequacy'][0]['adequation_profile'][0]['label'] !!}</h5>
                    </div>
                    @foreach ($item[28]['adequacy'] as $key => $adequacy)
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

                    @foreach ($item[28]['adequacy'] as $key => $adequacy)
                    @if(isset($adequacy))
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
                    @endif
                    @endforeach
                    @endif
                </div>
            </div>
        </div>
    </div>
    {{-- 7 - POTENTIALS ENDS --}}

    {{-- 8 - HOW DIFFERENT PROFESSIONS SUIT THE PROFILE STARTS --}}
    @if (str_contains($item[29]['type'], 'ancre'))
    <h2 class="card-title">
        {{ $item[29]["params"]["menuNumber"] }} -
        {{ __($item[29]["content"]["title"]) }} </h2>
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
                        @if(!empty($adequacy['adequation_profile']['label']))
                            <h5>{!! $adequacy['adequation_profile']['label'] !!}</h5>
                        @endif
                    </div>
                        @if(!empty($adequacy['adequation_profile']['test_ref_adequation']))
                            @foreach($adequacy['adequation_profile']['test_ref_adequation'] as $index=> $profile)
                            <div class="row">
                                <div class="col-xs-1 col-md-1 col-sm-1">{{$index+1}}</div>
                                <div class="col-xs-11 col-md-5 col-sm-5 word-break">
                                    @if(!empty($profile['label']) && isset($profile['label']))
                                        {{$profile['label']}}
                                    @endif
                                </div>
                                <div class="col-xs-7 col-md-3 col-sm-5 add-md-print">
                                    <div class="progress">
                                        <div class="progress-bar ec-first-bg-color ec-first-text-color" style="width: {{$profile['pourcentage_score']}}%;"></div>
                                    </div>
                                </div>
                                <div class="col-xs-2 col-md-1 col-sm-1 remove-md-print">
                                    {{$profile['pourcentage_score']}}%
                                </div>
                                {{-- <div class="col-xs-2 col-md-1 col-sm-1 remove-md-print" data-toggle="collapse" data-target="#{{$index}}" class="accordion-toggle">
                                    <p class="t-right">{{ __('Details') }}</p>
                                </div>

                                <div class="hiddenRow">
                                    <div class="accordian-body collapse hiddenRow" id="{{$index}}">
                                        @if($profile['description_long'])
                                        {!! $profile['description_long'] !!}
                                        @endif

                                    </div>
                                </div> --}}

                            </div>
                            @endforeach
                        @endif
                    @endif
                    @endforeach
                    @endif
                </div>
            </div>
        </div>
    </div>
    {{-- 8 - HOW DIFFERENT PROFESSIONS SUIT THE PROFILE ENDS --}}
</div>

{{-- dd($group_factors) --}}
@endsection

@section('script')

<script>
        function calcPoint(a, b) {
            let d = Math.abs((a * b) * 0.58) / Math.abs((a + b) * -0.3);            
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
        var point_start = 0;

        @foreach($group_factors as $idx => $group)
           
        @if(isset($group['label']))
          
          items.name = @json($group['label']);

            @foreach($group['factors'] as $idx => $factor)

                var index = parseInt(@json($idx));

                if(index%2 ==0 ){               
                    categories.push(@json($factor['label']) + " (" + @json($factor['score']) + ")");
                    if (@json($group['id']) === @json($factor['group_id'])) {
                        items.data.push(parseFloat(@json($factor['score'])));
                        if (items.data.length < 17) {
                            console.log("length: ", categories.length);
                            for (let i = 1; i < 17; i++) {
                                items.data.push(null);
                            }
                        }
                        items.color = '#' + @json($factor['color']);
                    }
                }         
            
            @endforeach
                data.push(items);
                items = {
                    data: []
                    , name: ""
                    , type: "area"
                    , color: ""            
                };
        @endif
        @endforeach

        // эхний утгийг нь 
        var new_data = Array(15).fill(null), matrix = [], n = 0, m = 0;

        for (const [key, value] of Object.entries(data)) {
            if (key == 0) data[key].pointStart = -12.5;                 
            else if (key == 1) data[key].pointStart = 162.5;
            matrix[n] = [];
            value.data.map((el, index) => {
                if (el !== null){
                    matrix[n][m] = el;
                    m++;
                }                
            });
            n++; m = 0;  
        }
        console.log("matrix", matrix);

        var j = 1;
        for (const [key, value] of Object.entries(data)) {
            // first value-g avna
            var val, index = 0;
            for (let i = 0; i < 16; i++) {                    
                if (key == 0 && i == 0) new_data[i] = calcPoint(matrix[key][0], matrix[1][6]);
                if (key == 1 && i == 14) {
                    new_data[i] = calcPoint(matrix[0][0], matrix[1][6]);                        
                }
                if (key == 0 && i== 14) new_data[i] = calcPoint(matrix[key][6], matrix[1][key]);
                if (key == 1 && i == 0){
                    new_data[i] = calcPoint(matrix[key][0], matrix[0][6]);
                    // console.log('key10', matrix[key][0]);                        
                } 
                else{
                    switch (i) {
                        case 1: new_data[i] = matrix[key][0]; break;
                        case 3: new_data[i] = matrix[key][1]; break;
                        case 5: new_data[i] = matrix[key][2]; break;
                        case 7: new_data[i] = matrix[key][3]; break;
                        case 9: new_data[i] = matrix[key][4]; break;
                        case 11: new_data[i] = matrix[key][5]; break;                        
                        case 13: new_data[i] = matrix[key][6]; break;                                            
                        case 15: new_data[i] = 0; break;                                
                    }
                }
            }                
            value.data = new_data;   
            console.log('new', new_data);                     
            new_data = Array(15).fill(null);
        }
        console.log("data2", data);
        
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
                    , "pointInterval": 12.5
                }
                , "area": {
                    "lineWidth": 1
                }
            },

            "xAxis": {
                "max": 10
                , "startOnTick": true
                , "endOnTick": true
                , "lineWidth": 0
                , "gridLineWidth": 1
                , "labels": {
                    "distance": 30
                    , "style": {
                        "width": "140px"
                        , "color": "#000000"
                        , "fontSize": "14px"
                        , "fontWeight": "normal"
                        , "fontFamily": "\"roboto\", \"Arial\", sans-serif"
                    }
                    , "formatter": function() {
                        console.log('this value');
                        var sReturn = ''
                            , iIndex = this.value / 25
                            , oCategories = categories;

                        if (oCategories[iIndex] !=
                            undefined) {
                            sReturn += oCategories[iIndex];
                        }
                        return sReturn;
                    }
                }
                , "tickPositions": [0, 25, 50, 75, 100, 125, 150, 175, 200, 225, 250, 275, 300, 325, 350]
            },
         
            "series": data
        });
</script>


<script>
        function calcPoint(a, b) {
            let d = Math.abs((a * b) * 0.58) / Math.abs((a + b) * -0.3);            
            return parseFloat(d.toFixed(2));
        }
       
        var categories = [];
        var data2 = [];
        var items2 = {
            data: []
            , name: ""
            , type: "area"
            , color: ""            
        };

        var barChart = [];
        var obj = {};
        var point_start = 0;

        @foreach($group_factors as $idx => $group)
           
        @if(isset($group['label']))
          
          items2.name = @json($group['label']);

            @foreach($group['factors'] as $idx => $factor)

                var index = parseInt(@json($idx));

                if(index%2 ==1 ){               
                    categories.push(@json($factor['label']) + " (" + @json($factor['score']) + ")");
                    if (@json($group['id']) === @json($factor['group_id'])) {
                        items2.data.push(parseFloat(@json($factor['score'])));
                        if (items2.data.length < 17) {
                            console.log("length: ", categories.length);
                            for (let i = 1; i < 17; i++) {
                                items2.data.push(null);
                            }
                        }
                        items2.color = '#' + @json($factor['color']);
                    }
                }         
            
            @endforeach
                data2.push(items2);
                items2 = {
                    data: []
                    , name: ""
                    , type: "area"
                    , color: ""            
                };
        @endif
        @endforeach

        // эхний утгийг нь 
        var new_data = Array(15).fill(null), matrix = [], n = 0, m = 0;

        for (const [key, value] of Object.entries(data2)) {
            if (key == 0) data2[key].pointStart = -12.5;                 
            else if (key == 1) data2[key].pointStart = 162.5;
            matrix[n] = [];
            value.data.map((el, index) => {
                if (el !== null){
                    matrix[n][m] = el;
                    m++;
                }                
            });
            n++; m = 0;  
        }
        console.log("matrix2", matrix);

        var j = 1;
        for (const [key, value] of Object.entries(data2)) {
            // first value-g avna
            var val, index = 0;
                for (let i = 0; i < 16; i++) {                    
                    if (key == 0 && i == 0) new_data[i] = calcPoint(matrix[key][0], matrix[1][6]);
                    if (key == 1 && i == 14) {
                        new_data[i] = calcPoint(matrix[0][0], matrix[1][6]);                        
                    }
                    if (key == 0 && i== 14) new_data[i] = calcPoint(matrix[key][6], matrix[1][key]);
                    if (key == 1 && i == 0){
                        new_data[i] = calcPoint(matrix[key][0], matrix[0][6]);
                        // console.log('key10', matrix[key][0]);                        
                    } 
                    else{
                        switch (i) {
                            case 1: new_data[i] = matrix[key][0]; break;
                            case 3: new_data[i] = matrix[key][1]; break;
                            case 5: new_data[i] = matrix[key][2]; break;
                            case 7: new_data[i] = matrix[key][3]; break;
                            case 9: new_data[i] = matrix[key][4]; break;
                            case 11: new_data[i] = matrix[key][5]; break;                        
                            case 13: new_data[i] = matrix[key][6]; break;                                            
                            case 15: new_data[i] = 0; break;                                
                        }
                    }
                }                
            value.data = new_data;            
            new_data = Array(15).fill(null);
        }
        
        Highcharts.chart('chart_second', {
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
                    , "pointInterval": 12.5
                }
                , "area": {
                    "lineWidth": 1
                }
            },

            "xAxis": {
                "max": 10
                , "startOnTick": true
                , "endOnTick": true
                , "lineWidth": 0
                , "gridLineWidth": 1
                , "labels": {
                    "distance": 30
                    , "style": {
                        "width": "140px"
                        , "color": "#000000"
                        , "fontSize": "14px"
                        , "fontWeight": "normal"
                        , "fontFamily": "\"roboto\", \"Arial\", sans-serif"
                    }
                    , "formatter": function() {
                        console.log('this value');
                        var sReturn = ''
                            , iIndex = this.value / 25
                            , oCategories = categories;

                        if (oCategories[iIndex] !=
                            undefined) {
                            sReturn += oCategories[iIndex];
                        }
                        return sReturn;
                    }
                }
                , "tickPositions": [0, 25, 50, 75, 100, 125, 150, 175, 200, 225, 250, 275, 300, 325, 350]
            },
         
            "series": data2
            // [{
            //     "color": "#F781BE",
            //     "name": "fdsfdsfd",
            //     "type": "area",
            //     "pointStart": -12.5,            
            //      "data": [5, 4.73, null, 6.9, null, 3.1, null, 6.3, null, 1.9, null, 8.1, null, 6.3, 5.3, 0]               
            // }, {
            //     "color": "#D0A9F5",
            //     "name": "Business Development Skills",
            //     "type": "area",
            //     "pointStart": 162.5,                
            //     "data": [5.3, 5, null, 0.6, 2, 3.1, null, 6.9, null, 4.4, null, 5, null, 5, 5, 0]                  
            // }], 

        });

        $(document).ready(function(){
            $('#pdfExport').on('click', function(){                
                $('.page-wrapper').removeClass("toggled");            
                $('figure').css("margin-left", "-200px");                       
                window.print();
            });
        });


    </script>


@endsection