{{-- Occupational Interest Inventory --}}
@extends('layouts.report')

@section('nav')
    @include("layouts.reports.components.header", ['data'=> $data])
@endsection

@section('content')
<!-- logo -->
@include("layouts.reports.components.logo", ['logo'=> $data['general']])
<!-- /logo -->

<div class="row">
    {{-- 1 - THE GRAPH start --}}
    @php $item = $data["parties"]["party"]; @endphp
    
    @php $group_factors = $data["group_factors"]; @endphp

        {{-- 1 - THE GRAPH --}}
        @if (str_contains($item[0]['type'], 'ancre'))
        <h2 class="card-title">{{ $item[0]["params"]["menuNumber"] }} -
            {{$item[0]["content"]["title"]}} </h2>
        @endif

            <div class="col-md-12" id="{{ $item[0]["content"]["title"]}}">
                <div class="card">
                    <div class="card-header .bg-secondary">{{ $item[0]["content"]["sub_title"]}}
                    </div>
                    <div class="card-body">
                        <div class="group-header">
                            {{-- <h2 class="ec-title">THE GRAPH</h2> --}}
                            
                            <figure class="highcharts-figure">

                                <div class="mb-3" id="barChart"></div>

                                <div style="height: 600px; width: 1288px; margin:0 auto" 
                                    id="chart">
                                </div>
                            </figure>

                        </div>
                    </div>
                </div>
        </div>
        
        {{-- 1 - THE GRAPH ENDS --}}
        

      <!--  4 - PERSONALISED ANALYSIS -->
        @if (str_contains($item[3]['type'], 'ancre'))
        <h2 class="card-title">
            {{ $item[3]["params"]["menuNumber"] }} - {{ __($item[3]["content"]["title"]) }} </h2>
        @endif
    
        <div class="col-md-12" id="{{ $item[3]["content"]["title"]}}">
            <div class="card">
                <div class="card-header .bg-secondary">
                    {{ __($item[3]["content"]["sub_title"]) }}
                </div>
                <div class="card-body">
                    @if (isset($item[4]['content']['domain']) && is_array($item[4]['content']['domain']))
                        {{-- {{ dd($item[4]['content']['domain']) }} --}}
                        <div class="intro">
                            {!! $item[4]["content"]["introduction"]!!}
                        </div>                    
                        @php $i = 1; @endphp
                        @foreach($item[4]["content"]["domain"] as $detail)
                            @if($i==1)
                                <div class="group-header mt-4">
                                    <h4>{{ $detail['label']}}</h4>
                                </div>
                                @php $i = 0; @endphp
                            @endif
                            @foreach ($detail['contents'] as $content)
                            <div class="box mb-2">
                                <div class="bg-grey box-content" >
                                    {!! $content['comment'] !!}
                                </div>
                            </div>
                            @endforeach

                        @endforeach
              
                    @endif
                </div>
            </div>
        </div>        
    <!-- 4- Detailed table starts" -->
   
    <!-- 4- THE COMMENTS" -->
 {{-- 5- Comment starts --}}

   @if (str_contains($item[5]['type'], 'ancre'))
    <h2 class="card-title">{{ $item[5]["params"]["menuNumber"] }}  - {{$item[5]["content"]["title"]}} </h2>
    @endif

    <div class="col-md-12" id="{{$item[5]["content"]["title"]}}">
        <div class="card">
            <div class="card-header .bg-secondary">{{ $item[5]["content"]["sub_title"]}}</div>
            <div class="card-body">
                <div class="intro">
                    {!! $item[6]["content"]["introduction"] !!}
                </div>
                         
                @for($i = 7; $i < 25; $i++) 
                    @if(str_contains($item[$i]['type'], 'rapport_details_groupe' )) 
                    
                    <div class="mt-4">
                        <div class="group-header border-bottom">
                            <h3 style="border-bottom: 3px solid #C0C0C0">{{ $item[$i]["content"]["title"] }}</h3>
                        </div>
                        
                        <div class="score-bar-wrapper row">
                            <div class="col-xs-12 col-sm-3 ">
                                <div class="box-score ec-first-bg-color ec-first-text-color " style="color:#000;background-color:#C0C0C0">
                                    <div class="header">
                                        {{ __('Score') }}<br>
                                        {{ $item[$i]["params"]["score_opposition"] }}
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-9">
                                
                                <div class="progress score-bar">
                                    @if( isset($item[$i]["params"]["score_opposition"]))
                                    <label for="0" id="percent_start">0</label>
                                    <div class="progress-bar" style='width:{{ str_replace(".", "", $item[$i]["params"]["score_opposition"])}}%;
                                                                    color:#000000;
                                                                    background-color: #{{$item[$i]['params']['couleur']}}'>
                                    </div>
                                    <label for="10" id="percent_end">10</label>
                                    @endif                                            
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


            @if(str_contains($item[$i]['type'], 'rapport_details_facteur'))
            <div class="group-header clearfix">
                <h5>{{ $item[$i]["content"]["title"] }}<h5>
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

                <div class="col-xs-12 col-sm-9">
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

              
            </div>
            <div class="box mb">
                <div class="box-desc bg-grey">
                    <div>
                        {!! $item[$i]["content"]["commentaire_perso"] !!}
                    </div>
                </div>
            </div>
            @endif

            @endfor
        </div>
    </div>
 {{-- 5-Comment ends --}}


 {{-- 6 - GENERAL PROFILE starts--}}
@if (str_contains($item[25]['type'], 'ancre'))
<h2 class="card-title">{{ $item[25]["params"]["menuNumber"] }} - {{$item[25]["content"]["title"]}} </h2>
@endif

<div class="col-md-12" id="{{$item[25]["content"]["title"]}}">
    <div class="card">
        <div class="card-header .bg-secondary">
            {{ $item[25]["content"]["sub_title"]}}
        </div>
        <div class="card-body">
            {!! $item[26]["content"]["introduction"] !!}
            <div class="adoquetion">

                @if (isset($item[26]['adequacy']))
                {{-- {{dd($item[26])}} --}}
            
                <div class="mt-3 mb-3">
                    <h5>{!! $item[26]['adequacy'][0]['adequation_profile'][0]['label'] !!}</h5>
                    {{-- <div>
                        {!! $adequacy['adequation_profile']['description'] !!}
                    </div> --}}
                </div>
                @if(isset($item[26]["adequacy"]))
                <table class="b-table table table-hovered">
                    <tbody>
                        {{-- {{dd($item[27])}} --}}
                        @for ($i=0; $i < count($item[26]["adequacy"]); $i++) <tr>
                            <td class="left-p">{{$i+1}}</td>
                            <td style="width: 40%">
                                {{$item[26]["adequacy"][$i]['adequation_profile'][0]['test_ref_adequation']['label']}}
                            </td>
                            <td style="width: 25%">
                                <div class="progress">
                                    <div class="progress-bar" role="progressbar" aria-valuenow="70"
                                        aria-valuemin="0" aria-valuemax="100"
                                        style="width:{{$item[26]["adequacy"][$i]['pourcentage_score']}}%">
                                    </div>
                                </div>
                                <span class="percentage">{{$item[26]["adequacy"][$i]['pourcentage_score']}}%</span>
                            </td>
                            <td style="width: 8%;" data-toggle="collapse" data-target="#{{$i}}"
                                class="accordion-toggle">
                                <p class="t-right">{{ __('Details') }}</p>
                            </td>
                            </tr>
                            <td colspan="12" class="hiddenRow">
                                <div class="accordian-body collapse hiddenRow" id="{{$i}}">
                                    @if($item[26]["adequacy"][$i]['adequation_profile'][0]['test_ref_adequation']['description'])
                                    {!!$item[26]["adequacy"][$i]['adequation_profile'][0]['test_ref_adequation']['description']!!}
                                    @endif
                                </div>
                            </td>
                            @endfor
                    </tbody>
                </table>
                @endif

                @foreach ($item[26]['adequacy'] as $key => $adequacy)
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

 {{-- 6 - GENERAL PROFILE ends --}}

{{-- 8 - HOW DIFFERENT PROFESSIONS SUIT THE PROFILE STARTS --}}
@if (str_contains($item[27]['type'], 'ancre'))
<h2 class="card-title">{{ $item[27]["params"]["menuNumber"] }} - 
    {{ __($item[27]["content"]["title"]) }} 
</h2>
@endif

<div class="col-md-12" id="{{$item[27]["content"]["title"]}}">
    <div class="card">
        <div class="card-header .bg-secondary">
            {{ __($item[27]["content"]["sub_title"]) }}
        </div>
        <div class="card-body">
        {{-- {{dd($item[27])}} --}}
        @if (isset($item[28]['adequacy']))
                
                    @foreach ($item[28]['adequacy'] as $key => $adequacy)
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
{{-- 8 - HOW DIFFERENT PROFESSIONS SUIT THE PROFILE ENDS --}}

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
    color: "",
    fillOpacity: 0.3, 
    pointStart: -15
};

var barChart = [];
var obj = {};
var point_start = -15;
    
@foreach($group_factors as $idx => $group)
    @if( $group_factors !==null)
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
            console.log(items.data.length);

            if (items.data.length < 7) {                
                for (let i = 0; i < 6; i++) {
                    items.data.push(0);
                }
            }
            items.color = '#' + @json($factor['color']);
        }
        @endforeach

    data.push(items);
    items = {
        data: [],
        name: "",
        type: "area",
        color: "",
        fillOpacity: 0.3
    };
    @endif
@endforeach

// console.log("data1: ", data);

// эхний утгийг нь 
var new_data = [], previous = [];
var matrix = [],n =0, m = 0;

for (const [key, value] of Object.entries(data)) {  
    
    if(key == 0) data[key].pointStart= -15;
    else if(key == 1) data[key].pointStart= 45;
    else if(key == 2) data[key].pointStart= 105;
    else if(key == 3) data[key].pointStart= 165;
    else if(key == 4) data[key].pointStart= 225;
    else if(key == 5) data[key].pointStart= 285;
   
    matrix[n] = [];
    value.data.map((el, index) => {                        
        if(el !==null ){  
            matrix[n][m] = el;
            m ++;
        }                         
    });
    n++;
    m = 0;                                                            
}

console.log( matrix );
// // data[0].data.shift();
// //  data[0].data.splice(0, 1);
//  console.log("data-new: ", data);
                                
for (const [key, value] of Object.entries(data)) { 
    //  value.data.splice(6, 2);     
    // first value-g avna   
    // console.log("value:"+value.data);    
    // value.data.filter(x => !Number.isNaN(x));
    // if (isNaN(value.data[0])) {
    //     console.log('Not a Number!');
    // }
    // console.log("data1:"+value.data[0]);
    // console.log("data2:"+value.data[5]);
    // console.log("key:"+key);
       
    for(let i=0; i<6; i++){                                
        if( i==0){ 
            if(key==0) new_data[i] = findPoint(matrix[0][0], matrix[5][7]);                                
            else new_data[i] = previous[5];                                                                         
        }else if(i==1) new_data[i] = matrix[key][0];
        else if(i==3) new_data[i] = matrix[key][7];        
        else if(i==4){                            
            if(key==7) new_data[i] = findPoint(matrix[0][0], matrix[5][7]);                                                    
            else new_data[i] = findPoint(matrix[i+1][0], matrix[i][7]);
        }
        else if(i==5) new_data[i] = 0;   
        else new_data[i] = null;   
        console.log(new_data)
        previous = new_data; 
    }     
    // console.log('new'+new_data);
    value.data = new_data;
    new_data = [];                    
}


console.log("data - ", data);

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
            "value": 10,
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
            "pointInterval": 15
        },
        "area": {
            "lineWidth": 1
        }
    },

    "xAxis": {
        "max": 12,
        "startOnTick": true,
        "endOnTick": true,
        "lineWidth": 0,
        "gridLineWidth": 1,
        "labels": {
            "distance": 15,
            "style": {
                "width": "140px",
                "color": "#000000",
                "fontSize": "14px",
                "fontWeight": "normal",
                "fontFamily": "\"roboto\", \"Arial\", sans-serif"
            },
            "formatter": function () {
                var sReturn = '',
                    iIndex = this.value / 30,
                    oCategories = categories;

                if (oCategories[iIndex] !=
                    undefined) {
                    sReturn += oCategories[iIndex];
                }
                return sReturn;
            }
        },
        "tickPositions": [0, 30, 60, 90, 120, 150, 180,
            210, 240, 270, 300, 330, 360
        ]
    },
    "series": data
    // "series": [{
    //     "color": "#F781BE",
    //     "name": "Client Acquisition Skills",
    //     "type": "area",
    //     "pointStart": -15,    
    //     "data": [2, 5, null, 4.6, 4, 0]            
    // }, {
    //     "color": "#D0A9F5",
    //     "name": "Business Development Skills",
    //     "type": "area",
    //     "pointStart": 45,    
    //     "data": [5, 5.4, null, 5, 3, 0]
    // }, {
    //     "color": "#A9F5A9",
    //     "name": "Negotiation Skills",
    //     "type": "area",
    //     "pointStart": 105,
    //     "data": [2, 5.8, null, 6.2, 4, 0]        
    // }, {
    //     "color": "#81BEF7",
    //     "name": "Selling Skills",
    //     "type": "area",
    //     "pointStart": 165,    
    //     "data" : [3.7, 1.5, null, 5, 4, 0]            
    // }, 
    // {
    //     "color": "#F5EF87",
    //     "fillOpacity": 0.3,
    //     "name": "Enterprising",
    //     "pointStart": 225,   
    //     "type": "area",
    //     "data":  [3, 1.5, 5, null, 4,  0]
    // },
    // {
    //     "color": "#FFE5CC",        
    //     "name": "Enterprising",
    //     "pointStart": 285,   
    //     "type": "area",
    //     "data":  [3, 1.5, 5, null, 4, 0]
    // }
    // ], 

});

</script>

<script>
// Create the bar chart
Highcharts.chart('barChart', {
    chart: {
        renderTo: 'container',
        type: 'column'
    },

    accessibility: {
        announceNewData: {
            enabled: true
        }
    },
    yAxis: {
        title: {
            text: ''
        },
        labels: {
            style: {
                fontSize: '15px'
            }
        }
    },
    xAxis: {
        type: 'category',
        labels: {
            style: {
                fontSize: '15px'
            }
        }
    },

    title: {
        text: ''
    },
    legend: {
        enabled: false,
    },
    plotOptions: {
        series: {
            borderWidth: 0,
        },
        stacking: 'normal',
        dataLabels: {
            enabled: true
        }
    },

    tooltip: {
        headerFormat: '<span style="font-size:14px">{series.name}: {point.y}</span><br>',
        pointFormat: '<span style="font-size:16px;color:{point.color}">{point.name}</span>'
    },

    series: [{
        colorByPoint: true,
        data: barChart
    }],
});


</script>
@endsection
