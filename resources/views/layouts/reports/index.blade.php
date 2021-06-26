<html>

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
                <a href="#">United Management Consulting</a>
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
                    <span class="user-name">{{$data['general']['participant_name']}}
                        <strong>E</strong>
                    </span>
                    <span class="user-role">Administrator</span>
                </div>
            </div>
            <div class="sidebar-content">
                <!-- sidebar-search  -->
                <div class="sidebar-menu">
                    <ul>
                        <div class="header-menu">
                            <span>Reports</span>
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
                    <h6>Test taken on the 13th of September 2019 in 14 min 24 sec</h6>
                    <hr />
                </div>
                <div class="row">

                    @if (str_contains($data["parties"]["party"][0]['type'], 'ancre'))
                    <h2 class="card-title">{{ $data["parties"]["party"][0]["params"]["menuNumber"] }} -
                        {{$data["parties"]["party"][0]["content"]["title"]}} </h2>
                    @endif
                    <div class="col-md-12" id="comments">
                        <div class="card">
                            <div class="card-header .bg-secondary">
                                {{ $data["parties"]["party"][0]["content"]["sub_title"]}}</div>
                            <div class="card-body">

                                <div class="group-header">
                                    <h2 class="ec-title"> </h2>
                                </div>
                                @for ($i=1; $i < 3; $i++) <div class="score-bar-wrapper row">
                                    <div class="col-xs-12 col-sm-3">
                                        <h3 class="box-label"> {{ $data["parties"]["party"][$i]["content"]["title"]}}
                                        </h3>
                                        <div class="box-score" style="
                                        color:#000000; background-color: #1C3664">
                                            <div class="header" style="color: #fff;">
                                                {{ __('Score') }} <br>
                                                @if (isset($data["parties"]["party"][$i]["params"]["moyenne_generale"]))
                                                {{ $data["parties"]["party"][$i]["params"]["moyenne_generale"] }}
                                                @endif
                                                @if (isset($data["parties"]["party"][$i]["adequacy"]["pourcentage_score"]))
                                                    {{ $data["parties"]["party"][$i]["adequacy"]["pourcentage_score"] }}
                                                @endif
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-xs-12 col-sm-9">
                                        <div class="progress score-bar">
                                            @if( isset($data["parties"]["party"][$i]["params"]["pourcentage_score"]))
                                            <label for="0">0</label>
                                            <div class="progress-bar"
                                                style='width:{{ $data["parties"]["party"][$i]["params"]["pourcentage_score"]}}%; color:#000000; background-color: #1C3664'>
                                            </div>
                                            <label for="10">10</label>
                                            @endif
                                            @if( isset($data["parties"]["party"][$i]["adequacy"]["pourcentage_score"]))
                                            <label for="0">0</label>
                                            <div class="progress-bar"
                                                style='width:{{ $data["parties"]["party"][$i]["adequacy"]["pourcentage_score"]}}%; color:#000000; background-color: #1C3664'>
                                            </div>
                                            <label for="10">10</label>
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
                                                {{ $data["parties"]["party"][$i]["content"]["description_courte"] }}
                                            </div>
                                        </div>
                                    </div>
                            </div>

                            @endfor


                        </div>
                    </div>
                </div>

                <!-- section 3 here -->
                @if (str_contains($data["parties"]["party"][3]['type'], 'ancre'))
                <h2 class="card-title">{{ $data["parties"]["party"][3]["params"]["menuNumber"] }} -
                    {{$data["parties"]["party"][3]["content"]["title"]}} </h2>
                @endif
                <div class="col-md-12" id="comments">
                    <div class="card">
                        <div class="card-header .bg-secondary">{{ $data["parties"]["party"][3]["content"]["sub_title"]}}
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
                <!-- /end section -->
                <!-- section 4 here -->
                @if (str_contains($data["parties"]["party"][4]['type'], 'ancre'))
                <h2 class="card-title">{{ $data["parties"]["party"][4]["params"]["menuNumber"] }} -
                    {{$data["parties"]["party"][4]["content"]["title"]}} </h2>
                @endif
                <div class="col-md-12" id="comments">
                    <div class="card">
                        <div class="card-header .bg-secondary">{{ $data["parties"]["party"][4]["content"]["sub_title"]}}
                        </div>
                        <div class="card-body">
                            <div class="group-header">

                            </div>
                        </div>
                    </div>
                </div>
                <!-- /endsection 4 -->
                <!-- section 5 -->
                @if (str_contains($data["parties"]["party"][5]['type'], 'ancre'))
                <h2 class="card-title">{{ $data["parties"]["party"][5]["params"]["menuNumber"] }} -
                    {{$data["parties"]["party"][5]["content"]["title"]}} </h2>
                @endif
                <div class="col-md-12" id="comments">
                    <div class="card">
                        <div class="card-header .bg-secondary">{{ $data["parties"]["party"][5]["content"]["sub_title"]}}
                        </div>
                        <div class="card-body">
                            <div class="group-header">

                            </div>
                        </div>
                    </div>
                </div>
                <!-- /endsection 5 -->

                <!--  Personalised Analysis of the Report -->
                @if (str_contains($data["parties"]["party"][7]['type'], 'ancre'))
                <h2 class="card-title">{{ $data["parties"]["party"][7]["params"]["menuNumber"] }} -
                    {{$data["parties"]["party"][7]["content"]["title"]}} </h2>
                @endif
                <div class="col-md-12" id="comments">
                    <div class="card">
                        <div class="card-header .bg-secondary">{{ $data["parties"]["party"][7]["content"]["sub_title"]}}
                        </div>
                        <div class="card-body">
                            <div class="group-header">
                                {!! $data["parties"]["party"][8]["content"]["introduction"]!!}
                            </div>

                            @foreach($data["parties"]["party"][8]["content"]["domain"] as $item)
                            <div class="group-header mt-4">
                                {{ $item['label']}}
                            </div>
                            @foreach ($item['contents'] as $content)
                            <div class="box gray mb-2">
                                <div class="box-content ec-first-border-color" style="background-color: #EEEEEE">
                                    {{ $content['comment'] }}
                                </div>
                            </div>
                            @endforeach
                            @endforeach
                        </div>
                    </div>
                </div>
                <!-- /endsection -->

                <!-- the Comments  -->
                @if (str_contains($data["parties"]["party"][9]['type'], 'ancre'))
                <h2 class="card-title">{{ $data["parties"]["party"][9]["params"]["menuNumber"] }} -
                    {{$data["parties"]["party"][9]["content"]["title"]}} </h2>
                @endif
                <!-- /the Comments  -->
                <div class="col-md-12" id="comments">
                    <div class="card">
                        <div class="card-header .bg-secondary">
                            {{ $data["parties"]["party"][9]["content"]["sub_title"]}}</div>
                        <div class="card-body">
                            <div class="group-header">
                                <h3>{!! $data["parties"]["party"][10]["content"]["title"]!!}</h3>
                                <hr>
                            </div>
                            <div class="score-bar-wrapper row">
                                <div class="col-xs-12 col-sm-3">
                                    <div class="box-score" style="
                                     color:#000000; background-color:{!!$data["parties"]["party"][10]["params"]["couleur"]!!}">
                                        <div class="header">
                                        {{ __('Score') }} <br>
                                        {{ $data["parties"]["party"][10]["params"]["pourcentage_score"]}}
                                        </div>
                                    </div>
                                </div>

                                <div class="col-xs-12 col-sm-9">
                                    <div class="progress score-bar" style="width: 100%;">
                                        <div class="progress-bar" style="width:{{$data["parties"]["party"][10]["params"]["pourcentage_score"]}}%;
                                                             color:#000000; background-color: #{!!$data["parties"]["party"][10]["params"]["couleur"]!!} "></div>
                                        <div class="progress-bar" style="width:38%;
                                                             color:#000000; background-color: #EEEEEE"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="box">
                                <div class="box-header box-header-small">
                                    <div class="title text-left"> <i class="fa fa-arrow-alt-circle-right"></i>
                                    {{ __('Definition') }}</div>
                                </div>
                                <div class="box-content ec-first-border-color" style="background-color: #EEEEEE">
                                {{$data["parties"]["party"][10]["content"]["description_long"]}}
                                     </div>
                            </div>

                            <!-- facteur -->
                            <div class="group-header">
                                <h3>{!! $data["parties"]["party"][11]["content"]["title"]!!}</h3>
                                <hr>
                            </div>
                            <div class="score-bar-wrapper row">
                                <div class="col-xs-12 col-sm-3">
                                    <div class="box-score" style="
                                     color:#000000; background-color:{!!$data["parties"]["party"][10]["params"]["couleur"]!!}">
                                        <div class="header">
                                        {{ __('Score') }} <br>
                                        {{ $data["parties"]["party"][11]["params"]["pourcentage_score"]}}
                                        </div>
                                    </div>
                                </div>

                                <div class="col-xs-12 col-sm-9">
                                    <div class="progress score-bar" style="width: 100%;">
                                        <div class="progress-bar" style="width:{{$data["parties"]["party"][11]["params"]["pourcentage_score"]}}%;
                                                             color:#000000; background-color: #{!!$data["parties"]["party"][11]["params"]["couleur"]!!} "></div>
                                        <div class="progress-bar" style="width:38%;
                                                             color:#000000; background-color: #EEEEEE"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="box">
                                <div class="box-header box-header-small">
                                    <div class="title text-left"> <i class="fa fa-arrow-alt-circle-right"></i>
                                    {{ __('Definition') }}</div>
                                </div>
                                <div class="box-content ec-first-border-color" style="background-color: #EEEEEE">
                                    {{$data["parties"]["party"][11]["content"]["description_long"]}}
                                </div>
                            </div>
                            <!-- /endees ehelne -->
                        </div>
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
var scores = [{}];
var cats;
var obj = {};
var t = [];
var index = 0;

@foreach($data["parties"]["party"] as $key => $graph)
    @if (str_contains($graph['type'], 'rapport_details_facteur'))
            console.log("Scores 0" , scores);   
        
        @if (str_contains($graph["content"]["label"], 'Anchor'))
            cats= @json($graph["content"]["title"]);i   
            cats = cats + ' (' +  @json($graph["params "]["score"]) + ')';
            categories.push(cats);
            // console.log(cats);
        @endif
    @endif
    @if (str_contains($graph['type'], 'rapport_details_groupe'))
        @if (str_contains($graph["content"]["label"], 'Anchor'))
            obj["name"] = @json($graph["content"]["title"]);
            obj["data"] = [5, 5, 4.3, 7.1];
            obj["type"] = 'column';
            data.push(obj);
            obj = {};
            // console.log("data - " , data);
        @endif
    @endif;
@endforeach

    Highcharts.chart('chart', {
        chart: {
            renderTo: 'container',
            polar: true
        },
        credits: { enabled: false },
       tooltip: { enabled: false },
        title: {
            text: ''
        },plotOptions: {
    series: {
        states: {
            inactive: {
                opacity: 1
            }
        }
    }
},
        xAxis: {
                categories: categories,
                // tickmarkPlacement: 'on',
                gridLineWidth: 1,
                lineWidth: 0
            },
        yAxis: {
                // gridLineInterpolation: 'polygon',
                lineWidth: 0,
                gridLineWidth: 1,
                min: 0
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
