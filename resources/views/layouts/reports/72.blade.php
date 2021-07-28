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
        <h2 class="card-title">{{ $item[0]["params"]["menuNumber"] }} -
            {{$item[0]["content"]["title"]}} </h2>
        @endif

        <div class="col-md-12" id="comments">
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
        {{-- 1 - THE GRAPH ENDS --}}

        {{--2 -  PERSONALISED ANALYSIS OF THE REPORT  --}}
        @if (str_contains($item[2]['type'], 'ancre'))
        <h2 class="card-title">{{ $item[2]["params"]["menuNumber"] }} -
            {{$item[2]["content"]["title"]}}
        </h2>
        @endif

        <div class="col-md-12" id="{{ $item[2]["content"]["title"]}}">
            <div class="card">
                <div class="card-header .bg-secondary">{{ $item[2]["content"]["sub_title"]}}
                </div>
                <div class="card-body">
                    <div class="group-header">
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
        <h2 class="card-title">{{ $item[4]["params"]["menuNumber"] }} -
            {{$item[4]["content"]["title"]}}
        </h2>
        @endif
        
        <div class="col-md-12">
            <div class="card">
                <div class="card-header .bg-secondary">
                    {{ $item[4]["content"]["sub_title"]}}
                </div>            
                <div class="card-body">
                    <div class="box mb-2">
                        Lorem ipsum, dolor sit amet consectetur adipisicing elit. Blanditiis temporibus at eos consectetur impedit dignissimos hic doloribus dicta, unde quis nulla numquam quasi deserunt. Reiciendis facilis in excepturi. Adipisci, a.
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
        <div class="col-md-12" id="{{ $item[6]["content"]["title"]}}">
            <div class="card">
                <div class="card-header .bg-secondary">
                    {{ $item[6]["content"]["sub_title"]}}
                </div>

                <div class="card-body">            
                    @foreach ($item as $comment)
                        
                        @if($comment['type']=='rapport_details_groupe')
                            <div class="group-header">
                                <h3><strong>{!! $comment["content"]["title"]!!}</strong></h3>
                                <hr style="border-color: {!!$item[7]['params']["couleur"]!!}">
                            </div>
                        @elseif($comment['type']=='rapport_details_facteur')
                            <div class="group-header">
                                <h3>{!! $comment["content"]["title"]!!}</h3>
                            </div>    
                            
                            <div class="score-bar-wrapper row">
                                <div class="col-xs-12 col-sm-3">

                                    <div class="box-score" style="
                                        color:#000000; background-color:{!!$comment['params']["couleur"]!!}">
                                        <div class="header">
                                            {{ __('Score') }} <br>
                                            {{ $comment["params"]["score"]}}
                                        </div>
                                    </div>
                                </div>

                                <div class="col-xs-12 col-sm-9">
                                    <div class="progress score-bar" style="width: 100%;">
                                        <label for="0" id="percent_start">0</label>
                                            <div class="progress-bar" style="width:{{$comment["params"]["score"]}}%;
                                                color:#000000; background-color: #{!!$comment['params']["couleur"]!!} ">
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
@endsection
