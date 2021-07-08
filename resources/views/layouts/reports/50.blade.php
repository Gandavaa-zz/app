<html>
<!-- SALES PROFILE View -->
<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.1/css/bootstrap.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css">
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet">

<body>
    <div class="page-wrapper chiller-theme toggled">
        <a id="show-sidebar" class="btn btn-sm btn-dark" href="#">
            <i class="fas fa-bars"></i>
        </a>
        <nav id="sidebar" class="sidebar-wrapper">
            <div class="sidebar-brand">
                <a href="#">{{$data['general']['client']}}</a>
                <div id="close-sidebar">
                    <i class="fas fa-times"></i>
                </div>
            </div>

            <div class="sidebar-header">
                <div class="user-pic">
                    <img class="img-responsive img-rounded"
                        src="https://raw.githubusercontent.com/azouaoui-med/pro-sidebar-template/gh-pages/src/img/user.jpg"
                        alt="User picture">
                </div>
                <div class="user-info">
                    <span class="user-name">
                        <strong>{{$data['general']['participant_name']}}</strong>
                    </span>
                    {{-- <a href="#"><span class="user-role"> </span></a> --}}
                </div>
            </div>
            <div class="sidebar-content">
                <!-- sidebar-search  -->
                <div class="sidebar-menu">
                    <ul>
                        <div class="header-menu">
                            <span>Тайлан</span>
                        </div>
                        @foreach($data["parties"]["party"] as $menu)
                        @if (str_contains($menu['type'], 'ancre'))
                        <li>
                            <a href="#{{$menu['content']['title']}}">
                                <span> {{$menu["content"]["title"]}} </span>
                            </a>
                        </li>
                        @endif
                        @endforeach
                    </ul>
                </div>
                <!-- sidebar-menu  -->
            </div>
        
        </nav>
        <!-- sidebar-wrapper  -->
        <main class="page-content">
            <div class="main">
                <div class="text-center">
                    <img src="{{$data['general']['logo']}}" alt="{{$data['general']['label']}} " class="img-responsive">
                    <h6>{{$data['general']['completed_at']}}</h6>
                    <hr  />
                    <div>
                    <a href="#" id="pdf_export"><img class="img-responsive img-rounded"
                        src="../../assets/img/pdf_icon.png" width="50px
                        alt="pdf download"></a>
                    </div>
                </div>
                <div class="row">

                    @php $item = $data["parties"]["party"]; @endphp
                    @php $group_factors = $data["group_factors"]; @endphp
                    @if (str_contains($item[0]['type'], 'ancre'))
                    <h2 class="card-title">{{ $item[0]["params"]["menuNumber"] }} - {{$item[0]["content"]["title"]}} </h2>
                    @endif

                    <div class="col-md-12" id='{{ $item[0]["content"]["title"]}}'>
                        <div class="card">
                            <div class="card-header .bg-secondary">
                                {{ $item[0]["content"]["sub_title"]}}</div>
                            <div class="card-body">

                                <div class="group-header">
                                    <h2 class="ec-title"> </h2>
                                </div>
                                @for ($i=1; $i < 3; $i++)
                                <div class="score-bar-wrapper row">
                                    <div class="col-xs-12 col-sm-3">
                                        <h3 class="box-label">
                                            {{ $item[$i]["content"]["title"]}}
                                        </h3>
                                        <div class="box-score" style="
                                        color:#000000; background-color: #1C3664">
                                            <div class="header" style="color: #fff;">
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
                                            <label for="0"  id="percent_start">0</label>
                                            <div class="progress-bar"
                                                style='width:{{ $item[$i]["params"]["pourcentage_score"]}}%;'>
                                            </div>
                                            <label for="10" id="percent_end">10</label>
                                            @endif
                                            @if( isset($item[$i]["adequacy"]["pourcentage_score"]))
                                            <label for="0" id="percent_start">0</label>
                                            <div class="progress-bar"
                                                style='width:{{ $item[$i]["adequacy"]["pourcentage_score"]}}%;'>
                                            </div>
                                            <label for="10" id="percent_end">100</label>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="box mb-4">
                                        <div class="box-header box-header-small">
                                            <div class="title text-left"> <i class="fa fa-arrow-alt-circle-right"></i>
                                                {{ __('Definition') }}</div>
                                        </div>
                                        <div class="box-desc">
                                            <div>
                                  
                                                   {{ $item[$i]["content"]["description_courte"] }}
                                                    @if(isset($item[$i]["adequacy"]['adequation_profile'][0]["test_ref_adequation"]))
                                                     {{$item[$i]["adequacy"]['adequation_profile'][0]["test_ref_adequation"]['description']}}
                                                    @endif
                                        
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            @endfor


                        </div>
                    </div>
                </div>

                <!-- section 3 here -->
                @if (str_contains($item[3]['type'], 'ancre'))
                <h2 class="card-title">{{ $item[3]["params"]["menuNumber"] }} -
                    {{$item[3]["content"]["title"]}} </h2>
                @endif
                <div class="col-md-12" id="{{ $item[3]["content"]["title"]}}">
                    <div class="card">
                        <div class="card-header .bg-secondary">{{ $item[3]["content"]["sub_title"]}}
                        </div>
                        <div class="card-body">
                            <div class="group-header">
                                {{-- <h2 class="ec-title">THE GRAPH</h2> --}}
                                <figure class="highcharts-figure">
                                    <div style="height: 600px; width: 700px; margin:0 auto" 
                                    id="chart"></div>
                                </figure>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /end section -->


                <!-- section 5 -->
                @if (str_contains($item[5]['type'], 'ancre'))
                <h2 class="card-title">{{ $item[5]["params"]["menuNumber"] }} -
                    {{$item[5]["content"]["title"]}} </h2>
                @endif
                <div class="col-md-12" id="{{ $item[5]["content"]["title"]}}">
                    <div class="card">
                        <div class="card-header .bg-secondary">{{ $item[5]["content"]["sub_title"]}}
                        </div>
                        <div class="card-body">
                            <div class="group-header">
                            <figure class="highcharts-figure">
                            <div id="barChart"></div>
                            </figure>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /endsection 5 -->

                <!--  PERSONALISED ANALYSIS -->
                @if (str_contains($item[7]['type'], 'ancre'))
                <h2 class="card-title">{{ $item[7]["params"]["menuNumber"] }} -
                    {{$item[7]["content"]["title"]}} </h2>
                @endif
                {{-- {{dd($item[8])}} --}}
                <div class="col-md-12" id="{{ $item[7]["content"]["title"]}}">
                    <div class="card">
                        <div class="card-header .bg-secondary">{{ $item[7]["content"]["sub_title"]}}
                        </div>
                        <div class="card-body">
                            <div class="group-header">
                                {!! $item[8]["content"]["introduction"]!!}
                            </div>
                            @foreach($item[8]["content"]["domain"] as $detail)
                            <div class="group-header mt-4">
                                <h4>{{ $detail['label']}}</h4>
                            </div>
                                @foreach ($detail['contents'] as $content)
                                <div class="box gray mb-2">
                                    <div class="box-content ec-first-border-color" >
                                        {{ $content['comment'] }}
                                    </div>
                                </div>
                                @endforeach

                            @endforeach
                        </div>
                    </div>
                </div>
                <!-- /endsection -->

                <!-- 5 - the Comments  -->
                @if (str_contains($item[9]['type'], 'ancre'))
                <h2 class="card-title">{{ $item[9]["params"]["menuNumber"] }} -
                    {{$item[9]["content"]["title"]}} </h2>
                @endif

                <!-- 5- the Comments  --> 
                <div class="col-md-12" id="{{ $item[9]["content"]["title"]}}">
                    <div class="card">
                        <div class="card-header .bg-secondary">
                            {{ $item[9]["content"]["sub_title"]}}</div>
                        <div class="card-body">
                            <div class="group-header">
                                <h3>{!! $item[10]["content"]["title"]!!}</h3>
                             <hr style="border-color: {!!$item[10]["params"]["couleur"]!!}">
                            </div>
                            <div class="score-bar-wrapper row">
                                <div class="col-xs-12 col-sm-3">
                                    <div class="box-score" style="
                                     color:#000000; background-color:{!!$item[10]["params"]["couleur"]!!}">
                                        <div class="header">
                                            {{ __('Score') }} <br>
                                            {{ $item[10]["params"]["score"]}}
                                        </div>
                                    </div>
                                </div>

                                <div class="col-xs-12 col-sm-9">
                                    <div class="progress score-bar" style="width: 100%;">
                                      <label for="0" id="percent_start">0</label>
                                        <div class="progress-bar" style="width:{{$item[10]["params"]["score"]}}%;
                                            color:#000000; background-color: #{!!$item[10]["params"]["couleur"]!!} "></div>
                                      <label for="10" id="percent_end">10</label>
                                    </div>
                                </div>
                            </div>

                            <div class="box mb-5">
                                <div class="box-header box-header-small">
                                    <div class="title text-left"> <i class="fa fa-arrow-alt-circle-right"></i>
                                        {{ __('Definition') }}</div>
                                </div>
                                <div class="box-content ec-first-border-color" >
                                    {!!$item[10]["content"]["description_long"]!!}
                                </div>
                            </div>

                            <!-- facteur -->
                            <div class="group-header">
                                <h3>{!! $item[11]["content"]["title"]!!}</h3>
                              <hr style="border-color: {!!$item[11]["params"]["couleur"]!!}">
                            </div>

                            <div class="score-bar-wrapper row">
                                <div class="col-xs-12 col-sm-3">

                                    <div class="box-score" style="
                                     color:#000000; background-color:{!!$item[10]["params"]["couleur"]!!}">
                                        <div class="header">
                                            {{ __('Score') }} <br>
                                            {{ $item[11]["params"]["score"]}}
                                        </div>
                                    </div>
                                </div>

                                <div class="col-xs-12 col-sm-9">
                                    <div class="progress score-bar" style="width: 100%;">
                                        <label for="0" id="percent_start">0</label>
                                        <div class="progress-bar" style="width:{{$item[11]["params"]["score"]}}%;
                                            color:#000000; background-color: #{!!$item[11]["params"]["couleur"]!!} "></div>
                                            <label for="10" id="percent_end">10</label>
                                    </div>
                                </div>
                            </div>

                            <div class="box mb-5">
                                <div class="box-header box-header-small">
                                    <div class="title text-left"> <i class="fa fa-arrow-alt-circle-right"></i>
                                        {{ __('Definition') }}</div>
                                </div>
                                <div class="box-content ec-first-border-color" >
                                    {!! $item[11]["content"]["description_long"] !!}
                                </div>
                            </div>
                            <!-- /endees  -->
                            @for ($i=12; $i < 26; $i++)
                                <!-- start -->
                                <div class="group-header">
                                    <h3>{!! $item[$i]["content"]["title"]!!}</h3>
                               <hr style="border-color: {!!$item[$i]["params"]["couleur"]!!}">
                                </div>
    
                                <div class="score-bar-wrapper row">
                                    <div class="col-xs-12 col-sm-3">

                                        <div class="box-score" style="
                                        color:#000000; background-color:{!!$item[$i]["params"]["couleur"]!!}">
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
                                                color:#000000; background-color: #{!!$item[$i]["params"]["couleur"]!!} "></div>
                                                <label for="10" id="percent_end">10</label>
                                        </div>
                                    </div>
                                </div>

                                <div class="box mb-5">
                                    @if(isset($item[$i]['content']['commentaire_perso']))
                                    <div class="box-content bg-grey">
                                        {!! $item[$i]["content"]["commentaire_perso"] !!}
                                    </div>
                                    @endif

                                    <div class="box-header box-header-small">
                                        <div class="title text-left"> <i class="fa fa-arrow-alt-circle-right"></i>
                                            {{ __('Definition') }}</div>
                                    </div>

                                    <div class="box-content ec-first-border-color" >
                                        {!! $item[$i]["content"]["description_long"] !!}
                                    </div>
                                </div>
                                <!-- /end  -->
                            @endfor

                            </div>
                    </div>
                </div>

                @if (str_contains($item[26]['type'], 'ancre'))
                <h2 class="card-title">{{ $item[26]["params"]["menuNumber"] }} -
                    {{$item[26]["content"]["title"]}} </h2>
                @endif
                <div class="col-md-12" id="{{ $item[26]["content"]["title"]}}">
                    <div class="card">
                        <div class="card-header .bg-secondary">
                            {{ $item[26]["content"]["sub_title"]}}
                        </div>
                        <div id="table_header">
                            @if($item[27]['content']["introduction"])
                            {!! $item[27]['content']["introduction"] !!}
                            @endif
                            <h3>{!! $item[27]['content']["label"]!!}</h3>
                        </div>
                        @if(isset($item[27]["adequacy"]))
                        <table class="b-table table table-hovered">
                            <tbody>
                            {{-- {{dd($item[27])}} --}}
                                       @for ($i=0; $i < count($item[27]["adequacy"]); $i++)
                                <tr>
                                    <td style="width: 6%">{{$i+1}}</td>
                                    <td style="width: 40%">{{$item[27]["adequacy"][$i]['adequation_profile'][0]['test_ref_adequation']['label']}}</td>
                                    <td style="width: 25%">
                                        <div class="progress">
                                            <div class="progress-bar" role="progressbar" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100" style="width:{{$item[27]["adequacy"][$i]['pourcentage_score']}}">
                                            </div>
                                        </div>
                                        <span class="percentage">{{$item[27]["adequacy"][$i]['pourcentage_score']}}%</span>
                                    </td>
                                    <td style="width: 8%;" data-toggle="collapse" data-target="#{{$i}}" class="accordion-toggle">
                                        <p class="t-right">{{ __('Details') }}</p>
                                    </td>
                                </tr>
                                <td colspan="12" class="hiddenRow">
                                    <div class="accordian-body collapse hiddenRow" id="{{$i}}">
                                     @if($item[27]["adequacy"][$i]['adequation_profile'][0]['test_ref_adequation']['description'])
                                       {{$item[27]["adequacy"][$i]['adequation_profile'][0]['test_ref_adequation']['description']}}
                                    @endif
                                    </div>
                                </td>
                                @endfor
                            </tbody>
                        </table>
                        @endif
                    </div>
                <br>
                <br>
                <br>
                </div>

                </div>
                </div>
                </div>


    <footer class="text-center footer">
        <div class="mb-2">
            CDC Copyright
        </div>
    </footer>
    </div>
    </main>
    <!-- page-content" -->
    </div>
    <!-- page-wrapper -->

</body>
<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/highcharts-more.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script>
<script src="https://code.highcharts.com/modules/accessibility.js"></script>
<script>
  var categories = [];
  var data = [];
  var items = {
  	data: [],
  	name: "",
    type: "area",
    pointStart: 0,
  	color: "",
  	fillOpacity: 0.3
  };
  var barChart = [];
  var obj = {};
  var point_start = -15;
  @foreach($group_factors as $idx => $group)
  point_start = point_start + 80;
  //console.log("group - ", @json($group));
  obj.name = @json($group['label']) + " (" + @json($group['score']) + ")";
  obj.y = parseFloat(@json($group['score']));
  obj.color = '#' + @json($group['color']);
  barChart.push(obj);
  obj = {};
  items.name = @json($group['label']);
  items.data.pointStart = point_start;
  @foreach($group['factors']['factor'] as $idx => $factor)
  categories.push(@json($factor['label']) + " (" + @json($factor['score']) + ")");
  if (@json($group['id']) === @json($factor['group_id'])) {
  	items.data.push(parseFloat(@json($factor['score'])));
  	if (items.data.length < categories.length) {
          console.log("length: " , categories.length);
     for (let i = 1; i < categories.length; i++) {
  		items.data.push(null);
      }
    }
  	items.color = '#' + @json($factor['color']);
  }
  @endforeach
  data.push(items);

  console.log("data", data);
  items = {
  	data: [],
  	name: "",
    type: "area",
    pointStart: point_start,
  	color: "",
  	fillOpacity: 0.3
  };
  @endforeach
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
            "series": [{
                "color": "#F781BE",
                "name": "Client Acquisition Skills",
                "type": "area",
                "pointStart": -15,
                "data": [4, 5, null, 4.3, null, 7.1, 6, 0]
            }, {
                "color": "#D0A9F5",
                "name": "Business Development Skills",
                "type": "area",
                "pointStart": 75,
                "data": [6, 5, null, 5.8, null, 1.7, 2, 0]
            }, {
                "color": "#A9F5A9",
                "name": "Negotiation Skills",
                "type": "area",
                "pointStart": 165,
                "data": [2, 3.3, null, 5, null, 2.9, 3, 0]
            }, {
                "color": "#81BEF7",
                "name": "Selling Skills",
                "type": "area",
                "pointStart": 255,
                "data": [3, 4.2, null, 1.7, null, 3.3, 4,0
                ]
            }],

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
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/esm/popper.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.1/js/bootstrap.js">
</script>
<script type="text/javascript" src="{{ asset('js/custom.js') }}"></script>


</html>
