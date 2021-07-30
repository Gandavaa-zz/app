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
                                    <div style="height: 600px; width: 1308px; margin:0 auto" 
                                    id="chart"></div>
                                </figure>
                            </div>
                        </div>
                    </div>
            </div>
{{-- 1 - THE GRAPH ENDS --}}


        {{ dd($item) }} 
      <!--  4 - PERSONALISED ANALYSIS -->
        @if (str_contains($item[3]['type'], 'ancre'))
        <h2 class="card-title">{{ $item[3]["params"]["menuNumber"] }} - {{$item[3]["content"]["title"]}} </h2>
        @endif
    
        <div class="col-md-12" id="{{ $item[3]["content"]["title"]}}">
            <div class="card">
                <div class="card-header .bg-secondary">{{ $item[3]["content"]["sub_title"]}}
                </div>
                <div class="card-body">
                    <div class="intro">
                        {!! $item[4]["content"]["introduction"]!!}
                    </div>
                    @foreach($item[4]["content"]["domain"] as $detail)
                    <div class="group-header mt-4">
                        <h4>{{ $detail['label']}}</h4>
                    </div>
                        @foreach ($detail['contents'] as $content)
                        <div class="box mb-2">
                            <div class="bg-grey box-content" >
                                {!! $content['comment'] !!}
                            </div>
                        </div>
                        @endforeach

                    @endforeach
                </div>
            </div>
        </div>        
    <!-- 4- Detailed table starts" -->
   
    <!-- 4- Detailed table ends" -->
 {{-- 5- Comment starts --}}
   @if (str_contains($item[8]['type'], 'ancre'))
    <h2 class="card-title">5 - {{$item[8]["content"]["title"]}} </h2>
    @endif
    <div class="col-md-12" id="{{$item[8]["content"]["title"]}}">
        <div class="card">
            <div class="card-header .bg-secondary">{{ $item[8]["content"]["sub_title"]}}</div>
            <div class="card-body">
            <h2>{{$item[9]["content"]["title"]}}</h2>
               {{-- {{dd($item)}}     --}}
                @for($i = 10; $i < 25; $i++) @if(str_contains($item[$i]['type'], 'rapport_details_groupe' )) <div class="group-header">
                    <h3>{{ $item[$i]["content"]["title"] }}</h3>
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
 {{-- 5-Comment ends --}}



 {{-- 6 - GENERAL PROFILE starts--}}
@if (str_contains($item[25]['type'], 'ancre'))
<h2 class="card-title">{{ $item[25]["params"]["menuNumber"] }} - {{$item[25]["content"]["title"]}} </h2>
@endif

<div class="col-md-12" id="{{$item[25]["content"]["title"]}}">
    <div class="card">
        <div class="card-header .bg-secondary">{{ $item[25]["content"]["sub_title"]}}</div>
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
    
  {{-- {{dd($adequacy)}} --}}
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



 {{-- 7 - POTENTIALS ENDS --}}

{{-- 8 - HOW DIFFERENT PROFESSIONS SUIT THE PROFILE STARTS --}}

{{-- 8 - HOW DIFFERENT PROFESSIONS SUIT THE PROFILE ENDS --}}
</div>
@endsection
@section('script')
<script>
  var barChart = [];
  var obj = {};
  @foreach($item as $idx => $row)
    @if($row['type'] == 'rapport_details_facteur')
    {
        obj.name = @json($row['content']['libelle_facteur']) + " (" + @json($row['params']['score']) + ")";
        obj.y = parseFloat(@json($row['params']['score']));
        obj.color = '#' + @json($row['params']['couleur']);
        barChart.push(obj);
        obj = {};
    }
@endif
@endforeach

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
