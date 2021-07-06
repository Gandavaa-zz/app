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

                <!-- begin row -->
                <div class="row">

                    @php $item = $data["parties"]["party"]; @endphp

                    @if (str_contains($item[0]['type'], 'ancre'))
                    @php $before_type = 'ancre' @endphp
                    <h2 class="card-title">{{ $item[0]["params"]["menuNumber"] }} -
                        {{$item[0]["content"]["title"]}}
                    </h2>
                    @endif

                    <div class="col-md-12" id="comments">
                        <div class="card">
                            <div class="card-header .bg-secondary">
                                {{ $item[0]["content"]["sub_title"]}}
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
                                            <div class="title text-left"> <i class="fa fa-arrow-alt-circle-right"></i>
                                                {{ __('Definition') }}
                                            </div>
                                        </div>
                                        <div class="box-desc">
                                            <div>
                                                @if( isset($item[2]["adequacy"]['test_ref_adequation']["description"]))
                                                {!! $item[2]["adequacy"]['test_ref_adequation']["description"] !!}
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
                    <h2 class="card-title">{{ $item[3]["params"]["menuNumber"] }} -
                        {{$item[3]["content"]["title"]}}
                    </h2>
                    @endif

                    <div class="col-md-12" id="comments">
                        <div class="card">
                            <div class="card-header .bg-secondary">{{ $item[3]["content"]["sub_title"]}}
                            </div>
                            <div class="card-body">
                                <div class="group-header">
                                    <h2 class="ec-title">THE GRAPH</h2>
                                    <figure class="highcharts-figure">
                                        <div id="chart"></div>
                                    </figure>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /end Graph -->

                    <!-- PERSONALISED ANALYSIS" -->
                    @if (str_contains($item[5]['type'], 'ancre'))
                    <h2 class="card-title">{{ $item[5]["params"]["menuNumber"] }} -
                        {{$item[5]["content"]["title"]}}
                    </h2>
                    @endif

                    <div class="col-md-12" id="comments">
                        <div class="card">
                            <div class="card-header .bg-secondary">{{ $item[5]["content"]["sub_title"]}}
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

                    <!-- Comment" -->
                    @if (str_contains($item[9]['type'], 'ancre'))
                    <h2 class="card-title">4 - {{$item[9]["content"]["title"]}} </h2>
                    @endif

                    <div class="col-md-12" id="comments">
                        <div class="card">
                            <div class="card-header .bg-secondary">{{ $item[9]["content"]["sub_title"]}}</div>
                            <div class="card-body">

                                @for($i = 10; $i < 33; $i++) @if(str_contains($item[$i]['type'], 'rapport_details_groupe' )) <div class="group-header">
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
                                    <div class="box-score" style="
                                                color:#000000; background-color: #{{$item[$i]['params']['couleur']}}">
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
                                        <div class="title text-left"> <i class="fa fa-arrow-alt-circle-right"></i>
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
                <h2 class="card-title">6 - {{$item[33]["content"]["title"]}} </h2>
                @endif

                <div class="col-md-12" id="comments">
                    <div class="card">
                        <div class="card-header .bg-secondary">{{ $item[33]["content"]["sub_title"]}}</div>
                        <div class="card-body">
                            {!! $item[34]["content"]["introduction"] !!}
                            <div class="adoquetion">

                                @php $references = $data['references'] @endphp
                                @php $classes = $data['classes'] @endphp

                                @if (isset($item[34]['adequacy']))

                                @php $i = 1; @endphp

                                @foreach ($item[36]['adequacy'] as $key => $adequacy)
                    
                                {{-- <div class="mt-3 mb-3">
                                    <h5>{{ $classes[$key]['label'] }}</h5>
                                    <div>
                                        {{ $classes[$key]['description'] }}
                                    </div>
                                </div> --}}
                                @if(isset($adequacy))
                                {{dd($item)}}
                                @foreach($adequacy as $value)
                                <div class="row">
                                    <div class="col-xs-1 col-md-1 col-sm-1">{{$i++}}</div>
                                    <div class="col-xs-11 col-md-6 col-sm-5 word-break">
                                        {{$references[$value['id']]['label']}}
                                    </div>
                                    <div class="col-xs-7 col-md-3 col-sm-5 add-md-print">
                                        <div class="progress">
                                            <div class="progress-bar ec-first-bg-color ec-first-text-color" style="width: {{$value['pourcentage_score']}}%;"></div>
                                        </div>
                                    </div>
                                    <div class="col-xs-2 col-md-1 col-sm-1 remove-md-print">
                                        {{$value['pourcentage_score']}}%
                                    </div>
                                </div>
                                @endforeach

                                @foreach($adequacy as $value)
                                <div class="page-breaker-inside" style="margin-top:20px;">
                                    <div class="row">
                                        <div class="col-xs-12">
                                            <h3>
                                                {{$references[$value['id']]['label']}}
                                                <span class="badge badge-pill badge-secondary">
                                                    {{$value['pourcentage_score']}}%</span>
                                            </h3>

                                        </div>
                                    </div>
                                    <hr class="hr-normal">
                                    <div class="row">
                                        <div class="col-xs-12">
                                            {!! $references[$value['id']]['description'] !!}
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

                <!-- end row-->
            </div>

    </div>
    </main>

    <footer class="text-center footer">
        <div class="mb-2">
            CDC Copyright
        </div>
    </footer>
    </div>


</body>
<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/highcharts-more.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script>
<script src="https://code.highcharts.com/modules/accessibility.js"></script>
<script>
    var categories = [];
    var data = [];
    var scores = [{}];
    var cats;
    var obj = {};
    var t = [];
    var index = 0;

    @foreach($item as $key => $graph)
    @if(str_contains($graph['type'], 'rapport_details_facteur'))
    @switch($graph["id"])
    @case(172)
    scores = (@json($graph["params"]["score"]));
    @case(173)
    scores = (@json($graph["params"]["score"]));
    @case(174)
    scores = (@json($graph["params"]["score"]));
    @endswitch

    console.log("Scores 0", scores);

    @if(str_contains($graph["content"]["label"], 'Anchor'))
    cats = @json($graph["content"]["title"]);
    cats = cats + ' (' + @json($graph["params"]["score"]) + ')';
    categories.push(cats);
    // console.log(cats);
    @endif
    @endif
    @if(str_contains($graph['type'], 'rapport_details_groupe'))
    @if(str_contains($graph["content"]["label"], 'Anchor'))
    obj["name"] = @json($graph["content"]["title"]);
    obj["data"] = [5, 5, 4.3, 7.1];
    obj["type"] = 'column';
    data.push(obj);
    obj = {};
    console.log("data - ", data);
    @endif
    @endif;
    @endforeach

    Highcharts.chart('chart', {
        chart: {
            renderTo: 'container'
            , polar: true
        },

        credits: {
            enabled: false
        }
        , tooltip: {
            enabled: false
        }
        , title: {
            text: 'Test'
        }
        , plotOptions: {
            series: {
                states: {
                    inactive: {
                        opacity: 1
                    }
                }
            }
        }
        , xAxis: {
            categories: categories,
            // tickmarkPlacement: 'on',
            gridLineWidth: 1
            , lineWidth: 0
        }
        , yAxis: {
            // gridLineInterpolation: 'polygon',
            lineWidth: 0
            , gridLineWidth: 1
            , min: 0
        },

        series: data
    });

</script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/esm/popper.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.1/js/bootstrap.js">
</script>
<script type="text/javascript" src="{{ asset('js/custom.js') }}"></script>


</html>
