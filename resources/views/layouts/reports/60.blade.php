@extends('layouts.report')
{{-- CTPI test --}}
@section('nav')
@include("layouts.reports.components.header", ['data'=> $data])
@endsection

@section('content')
<style>

    @media print{
        header {
            display:none;
        }
        
        .menu-toggle{
            display:none
        }

        footer{
            display:none
        }

        #show-sidebar{
            display:none
        }

        .page-content{
            top: 0;
            margin-top: -50px;
        }
       
        * {
            color-adjust: exact!important;  
            -webkit-print-color-adjust: exact!important; 
            print-color-adjust: exact!important;
        }

        /* table.table tr > td {
            background-color: rgb(238,238,238) !important;
        } */
    }


</style>

<!-- logo -->
@include("layouts.reports.components.logo", ['logo'=> $data['general']])
<!-- /logo -->
<!-- begin row -->
<div class="row">

    @php $item = $data["parties"]["party"]; @endphp
    @php $group_factors = $data["group_factors"]; @endphp
    @if (str_contains($item[0]['type'], 'ancre'))
    @php $before_type = 'ancre' @endphp
    <h2 class="card-title">{{ $item[0]["params"]["menuNumber"] }} -
        {{ __($item[0]["content"]["title"]) }}
    </h2>
    @endif

    <div class="col-md-12" id='{{ $item[0]["content"]["title"]}}'>
        <div class="card">
            <div class="card-header .bg-secondary">
                {{__($item[0]["content"]["sub_title"]) }}
            </div>

            <div class="card-body">

                <div class="score-bar-wrapper row">
                    <div class="col-xs-12 col-sm-3">
                        <h3 class="box-label">
                            {{ $item[2]["content"]["title"]}}
                        </h3>
                        <div class="box-score" style="
                                            color:#000000; background-color: #1C3664">
                            <div class="header" style="color: #fff;">
                                {{ __('Score') }} <br>
                                @if (isset($item[2]["adequacy"]["pourcentage_score"]))
                                {{ $item[2]["adequacy"]["pourcentage_score"] }}
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="col-xs-12 col-sm-9">
                        <div class="progress score-bar">

                            @if( isset($item[2]["adequacy"]["pourcentage_score"]))
                            <label for="0" id="percent_start">0</label>
                            <div class="progress-bar" style='width:{{ $item[2]["adequacy"]["pourcentage_score"]}}%; color:#000000; background-color: #1C3664'>
                            </div>
                            <label for="10" id="percent_end">100</label>
                            @endif
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
                                @if( isset($item[2]["adequacy"]['adequation_profile'][0]['test_ref_adequation']['description']))
                                {!!$item[2]["adequacy"]['adequation_profile'][0]['test_ref_adequation']['description']!!}
                                @endif
                            </div>
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </div>

    <!-- Graph -->
    @if (str_contains($item[3]['type'], 'ancre'))
    <h2 class="card-title mt-800">{{ $item[3]["params"]["menuNumber"] }} -
        {{ __($item[3]["content"]["title"]) }}
    </h2>
    @endif

    <div class="col-md-12" id="{{$item[3]["content"]["title"]}}">
        <div class="card">
            <div class="card-header .bg-secondary">
                {{ __($item[3]["content"]["sub_title"]) }}
            </div>
            <div class="card-body">
                <div class="group-header">
                    <h2 class="ec-title">{{__('THE GRAPH')}}</h2>
                    <figure class="highcharts-figure">
                       <div id="chart" style="height: 600px; width: 1308px; margin:0 auto"></div>
                    </figure>
                </div>
            </div>
        </div>
    </div>
    <!-- /end Graph -->

    <!-- 3- PERSONALISED ANALYSIS" -->
    @if (str_contains($item[5]['type'], 'ancre'))
    <h2 class="card-title mt-750">{{ $item[5]["params"]["menuNumber"] }} -
        {{ __($item[5]["content"]["title"]) }}
    </h2>
    @endif

    <div class="col-md-12" id="{{$item[5]["content"]["title"]}}">
        <div class="card">
            <div class="card-header .bg-secondary">
                {{ __($item[5]["content"]["sub_title"]) }}
            </div>
            <div class="card-body">
                <div>
                    {!! $item[6]["content"]["introduction"] !!}
                </div>

                @foreach($item[6]["content"]["domain"] as $detail)

                <div class="group-header mt-4">
                    <h4>{!! $detail['label']!!}</h4>
                </div>
                @foreach ($detail['contents'] as $content)
                <h5 class="p-1">{!! $content['title']!!}</h5>
                <div class="box gray mb-2">
                    <div class="box-content ec-first-border-color" style="background-color: #EEEEEE">
                        {!! $content['comment'] !!}
                    </div>
                </div>
                @endforeach

                @endforeach
            </div>
        </div>
    </div>
    <!-- /END PERSONALISED ANALYSIS" -->

    <!-- 4- Detailed table starts" -->
    @if (str_contains($item[7]['type'], 'ancre'))
    <h2 class="card-title mt-900">{{ $item[7]["params"]["menuNumber"] }} -
        {{ __($item[7]["content"]["title"]) }}
    </h2>
    @endif    
    <div class="col-md-12" id="{{ $item[7]["content"]["title"] }}">
        <div class="card">
            <div class="card-header .bg-secondary">
                {{ __($item[7]["content"]["sub_title"]) }}
            </div>
            <div class="card-body">
                <div class="card-content">
                    {!! $item[8]["content"]["introduction"] !!}
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
                                    <td colspan="13" class="text-center left-label" style="background-color:#{{$group_factor['color']}};padding: 5px; -webkit-print-color-adjust: exact !important;">
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
                                            <span class="behaviour">{{ $previous['description_opposite'] }}</span>
                                        </h3>
                                    </td>
                                    @for($n=0; $n<11; $n++) <td class="text-center" style="@if($n>3 && $n<7) 
                                    background-color:#D3D3D3;  @else background-color:#EEEEEE; @endif; 
                                    -webkit-print-color-adjust: exact !important;
                                    vertical-align: middle;width:3%">
                                        @if ($n<5 && (float)$n+0.1 <=(float)$previous["score"] && (float)$previous["score"]<=(float)$n+0.9) <img class="check-img img-responsive" src="/assets/img/checkbox.png" alt="OK">
                                            @elseif ($n>5 && (float)$n+0.1 <=(float)$previous["score"]+1 && (float)$previous["score"]+1 <=(float)$n+1) <img class="check-img img-responsive" src="/assets/img/checkbox.png" alt="OK">
                                                @endif
                                                </td>
                                                @endfor
                                                <!-- Factor scores -->
                                                <td style="text-align:right;">
                                                    <h3>
                                                        {{ $previous['label'] }}<br>
                                                        <span class="behaviour"><span>{{ $previous['description'] }}</span></span>
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

    <!-- 5- Comment here -->
    @if (str_contains($item[9]['type'], 'ancre'))
    <h2 class="card-title mt-1050">{{ $item[9]["params"]["menuNumber"] }} -
        {!! __($item[9]["content"]["title"]) !!}
    </h2>
    @endif 

    <div class="col-md-12" id="{{$item[9]["content"]["title"]}}">
        <div class="card">
            <div class="card-header .bg-secondary">
                {!! __($item[9]["content"]["sub_title"]) !!}
            </div>
            <div class="card-body">

                @for($i = 10; $i < 33; $i++) @if(str_contains($item[$i]['type'], 'rapport_details_groupe' )) <div class="group-header">
                    <h3>{!! $item[$i]["content"]["title"] !!}</h3>
            </div>
            @endif
            @if(str_contains($item[$i]['type'], 'rapport_details_facteur'))
            <div class="group-header clearfix">
                <h5>
                    {!! $item[$i]["content"]["title"] !!}
                    <h5>
            </div>
            <div class="score-bar-wrapper row">

                <div class="col-xs-12 col-sm-3">
                    <div class="box-score" style="color:#000000; background-color: #{{$item[$i]['params']['couleur']}}">
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

                <div class="col-xs-12 col-sm-9">
                    <div class="progress score-bar">
                        @if( isset($item[$i]["params"]["pourcentage_score"]))
                        <label for="0" id="percent_start">0</label>
                        <div class="progress-bar" style='width:{{ $item[$i]["params"]["pourcentage_score"]}}%;
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
</div>
<!-- /end Comment -->

    <!-- 6 - GENERAL PROFILE -->
    @if (str_contains($item[33]['type'], 'ancre'))
    <h2 class="card-title mt-400">{{ $item[33]["params"]["menuNumber"] }} -
        {!! __($item[33]["content"]["title"]) !!}
    </h2>
    @endif 
    
    <div class="col-md-12" id="{{$item[33]["content"]["title"]}}">
        <div class="card">
            <div class="card-header .bg-secondary">
                {{ __($item[33]["content"]["sub_title"]) }}</div>
            <div class="card-body">
                {!! $item[34]["content"]["introduction"] !!}
                <div class="adoquetion">

                    @if (isset($item[34]['adequacy']))
                    {{-- {{dd($item[34])}} --}}
                    @foreach ($item[34]['adequacy'] as $key => $adequacy)

                    <div class="mt-3 mb-3">
                        <h5>{!! $adequacy['adequation_profile']['label'] !!}</h5>
                        <div>
                            {!! $adequacy['adequation_profile']['description'] !!}
                        </div>
                    </div>
                    @if(isset($adequacy))
                    {{-- {{dd($adequacy)}} --}}
                    @foreach($adequacy['adequation_profile']['test_ref_adequation'] as $index=> $profile)
                    <div class="row">
                        <div class="col-xs-1 col-md-1 col-sm-1">{{$index+1}}</div>
                        <div class="col-xs-11 col-md-6 col-sm-5 word-break">
                            {!!$profile['label']!!}
                        </div>
                        <div class="col-xs-7 col-md-3 col-sm-5 add-md-print">
                            <div class="progress">
                                <div class="progress-bar ec-first-bg-color ec-first-text-color" style="width: {{$profile['pourcentage_score']}}%;"></div>
                            </div>
                        </div>
                        <div class="col-xs-2 col-md-1 col-sm-1 remove-md-print">
                            {!!$profile['pourcentage_score']!!}%
                        </div>
                    </div>
                    @endforeach

                    @foreach($adequacy['adequation_profile']['test_ref_adequation'] as $profile2)
                    <div class="page-breaker-inside" style="margin-top:20px;">
                        <div class="row">
                            <div class="col-xs-12">
                                <h3>
                                    {{$profile2['label']}}
                                    <span class="badge badge-pill badge-secondary">
                                        {{$profile2['pourcentage_score']}}%</span>
                                </h3>

                            </div>
                        </div>
                        <hr class="hr-normal">
                        <div class="row">
                            <div class="col-xs-12">
                                {!! $profile2['description_long'] !!}
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
    <!-- / end General -->
    
    @if (str_contains($item[35]['type'], 'ancre'))
    <h2 class="card-title">{{ $item[35]["params"]["menuNumber"] }} -
        {!! __($item[35]["content"]["title"]) !!}
    </h2>
    @endif 
    <div class="col-md-12" id="{{ $item[35]["content"]["title"]}}">
        <div class="card">
            <div class="card-header .bg-secondary">
                {{ __($item[35]["content"]["sub_title"]) }}</div>
            <div class="card-body">
                {!! $item[35]["content"]["introduction"] !!}
                <div class="adoquetion">

                @if (isset($item[36]['adequacy']))
                
                <div class="mt-3 mb-3">
                    <div style="margin-top: -20px;">
                        {!! $item[36]['content']['introduction'] !!}
                    </div>
                    <h4 style="color:#1C3664">{{isset($item[36]['adequacy'][0]['adequation_profile'][0]['label']) ? $item[36]['adequacy'][0]['adequation_profile'][0]['label'] : ""}}</h4>
                </div>

                    @foreach ($item[36]['adequacy'] as $index => $adequacy)
                        @foreach ($adequacy['adequation_profile'] as $key => $profile)
                            
                            <div class="row">
                                <div class="col-xs-1 col-md-1 col-sm-1">{{$index+1}}</div>
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
                                            {{-- <div class="col-xs-2 col-md-1 col-sm-1 remove-md-print" data-toggle="collapse" data-target="#{{$key}}" class="accordion-toggle">
                                            <p class="t-right">{{ __('Details') }}</p>
                                            </div>
                                            <div  class="hiddenRow">
                                            <div class="accordian-body collapse hiddenRow" id="{{$key}}">
                                            fdsfdsfs

                                            </div>
                                            </div> --}}

                            </div>
                        @endforeach

                        @endforeach
                        @foreach ($item[36]['adequacy'] as $index => $adequacy)
                        @foreach($adequacy['adequation_profile'] as $profile2)
                    <div class="page-breaker-inside" style="margin-top:20px;">
                        <div class="row">
                            <div class="col-xs-12">
                                <h3>
                                    {{$profile2['test_ref_adequation']['label']}}
                                    <span class="badge badge-pill badge-secondary">
                                        {{$adequacy['pourcentage_score']}}%</span>
                                </h3>

                            </div>
                        </div>
                        <hr class="hr-normal">
                        <div class="row">
                            <div class="col-xs-12">
                                {!! $profile2['test_ref_adequation']['description'] !!}
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
    {{-- END WORKPLACE COMPETENCIES --}}

    {{-- dd($group_factors) --}}
<!-- end row-->
</div>
@endsection

@section('script')
<script>

    function findPoint(a, b){                    
        let d = ((a*b) * 1/2 ) / ((a+b) * 0.25);
        return parseFloat(d.toFixed(2));
    }
    
    var categories = [];
    var data = [];
    var items = {
        data: [],
        name: "",
        type: "area",
        color: ""
    };

    // console.log("data:", items.data);

    @foreach($group_factors as $idx => $group)
        @if(!str_contains($group['label'], "divers"))
            items.name = @json($group['label']);

            @foreach($group['factors'] as $idx => $factor)
            @if(!str_contains($factor['label'], "(-)") && !str_contains($factor['label'], "Sensitive") && !str_contains($factor['label'], "Vigilance"))
                categories.push(@json($factor['label']) + " (" + @json($factor['score']) + ")");                             
                if (@json($group['id']) === @json($factor['group_id'])) {                    
                    items.data.push(parseFloat(@json($factor['score'])));
                    items.color = '#' + @json($factor['color']);
                }
            @endif
            
            @endforeach 

            data.push(items);
            items = {
                data: [],
                name: "",
                type: "area",
                color: ""
            };
           
        @endif       
    @endforeach

    // эхний утгийг нь 
    var new_data =Array(12).fill(null), odd =Array(8).fill(null), even=Array(6).fill(null), matrix = [],n =0, m = 0;

    for (const [key, value] of Object.entries(data)) {  
        if(key == 0) data[key].pointStart= -9.5;
        else if(key == 1) data[key].pointStart= 104.5;
        else if(key == 2) data[key].pointStart= 161.5;
        else if(key == 3) data[key].pointStart= 275.5;
        matrix[n] = [];
        value.data.forEach(el => {                                    
            if(el !==null ){ 
                matrix[n][m] = el;
                m ++;
            }                         
        });
        n++; m = 0;                                                            
    }
                                     
    for (const [key, value] of Object.entries(data)) {
        // first value-g avna
        if( key == 0 || key == 2){
            for (let i = 0; i < 14; i++) {                    
                if (key == 0 && i == 0) new_data[i] = findPoint(matrix[key][0], matrix[3][3]);                            
                else if (key == 0 && i == 12) new_data[i] = findPoint(matrix[key][5], matrix[1][0]);                                          
                else if (key == 2  && i==0) new_data[i] = findPoint(matrix[key][i], matrix[1][2]);                        
                else if (key == 2 && i==12) new_data[i] = findPoint(matrix[key][5], matrix[3][0]);                        
                else{
                    switch (i) {                    
                        case 1: new_data[i] = matrix[key][0]; break;
                        case 3: new_data[i] = matrix[key][1]; break;
                        case 5: new_data[i] = matrix[key][2]; break;
                        case 7: new_data[i] = matrix[key][3]; break;
                        case 9: new_data[i] = matrix[key][4]; break;
                        case 11: new_data[i] = matrix[key][5]; break;
                        case 13: new_data[i] = 0; break;                                
                    }
                }
            }    
            value.data = new_data; 
        }else if( key == 1){
            for (let i = 0; i < 8; i++) {                      
                switch (i) {                    
                    case 1: even[i] = matrix[key][0];                         
                    break;
                    case 3: even[i] = matrix[key][1];                                 
                    break;
                    case 5: even[i] = matrix[key][2]; break;
                    case 7: even[i] = 0; break;                                
                }
                if (i == 0) even[i] = findPoint(matrix[key][i], matrix[0][5]);                            
                else if (i == 6) even[i] = findPoint(matrix[key][2], matrix[2][0]);                                                 
            }    
            value.data = even;            
        }
        else if( key == 3){
            for (let i = 0; i < 10; i++) {                                    
                if (i==0) odd[i] = findPoint(matrix[key][i], matrix[2][5]);                                        
                else if (i==8){
                    odd[i] = findPoint(matrix[key][3], matrix[0][0]);                                                           
                } 
                else{
                    switch (i) {                    
                        case 1: odd[i] = matrix[key][0]; break;
                        case 3: odd[i] = matrix[key][1]; break;
                        case 5: odd[i] = matrix[key][2]; break;                                            
                        case 7: odd[i] = matrix[key][3]; break;                                            
                        case 9: odd[i] = 0; break;                                
                    }
                }
            }             
            value.data = odd;   
        }
        new_data = Array(12).fill(null);                
        odd = Array(8).fill(null);                        
        even = Array(6).fill(null);                        
    }
    
    Highcharts.chart('chart', {
        chart: {
            marginTop: 30,
            polar: true,
            type: '',
        },
        "title": {
            "text": ""
        },
        "credits": {
            "enabled": false
        },
        "tooltip": {
            "enabled": false
        },
        "yAxis": {
            "max": 10,
            "lineColor": "#FFFFFF",
            "tickInterval": 2,
            "gridLineWidth": 1,
            "gridLineColor": "#EEEEEE",
            "plotLines": [{
                "color": "#AAAAAA",
                "dashStyle": "LongDash",
                "value": 5,
                "width": 1
            }, {
                "color": "#EEEEEE",
                "dashStyle": "Dash",
                "value": 1,
                "width": 1
            }, {
                "color": "#EEEEEE",
                "dashStyle": "Dash",
                "value": 3,
                "width": 1
            }, {
                "color": "#EEEEEE",
                "dashStyle": "Dash",
                "value": 7,
                "width": 1
            }, {
                "color": "#EEEEEE",
                "dashStyle": "Dash",
                "value": 9,
                "width": 1
            }],
            "labels": {
                "enabled": false
            }
        },
        "plotOptions": {
            "series": {
                "animation": false,
                "showInLegend": true,
                "marker": {
                    "enabled": false,
                    "states": {
                        "hover": {
                            "enabled": false
                        }
                    }
                },
                "connectNulls": true,
                "pointPlacement": "on",
                "pointInterval": 9.5
            },
            "area": {
                "lineWidth": 1
            }
        },

        "xAxis": {
            "max": 19,
            "startOnTick": true,
            "endOnTick": true,
            "lineWidth": 0,
            "gridLineWidth": 1,
            "labels": {
                "distance": 20,
                "style": {
                    "width": "140px",
                    "color": "#000000",
                    "fontSize": "14px",
                    "fontWeight": "normal",
                    "fontFamily": "\"roboto\", \"Arial\", sans-serif"
                },
                formatter: function () {
                    var sReturn = '',
                        iIndex = this.value /19,
                        oCategories = categories;

                    if (oCategories[iIndex] !=
                        undefined) {
                        sReturn += oCategories[iIndex];
                    }
                    return sReturn;
                }
            },
               "tickPositions": [0,19,38,57,76,95,114,133,152,171,190,209,228,247,266,285,304,323,342, 361]
        },
        
        "series":  data
  


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
