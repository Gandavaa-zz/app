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
                    </span>
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
                    <hr />
                </div>
                <div class="row">
                    @php $item = $data["parties"]["party"]; @endphp

                    <!-- start -->
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

                                <div class="group-header">
                                    <h2 class="ec-title"> </h2>
                                </div>

                                <div class="score-bar-wrapper row">
                                    <div class="col-xs-12 col-sm-3">
                                        <h3 class="box-label">
                                            {{ $item[1]["content"]["title"]}}
                                        </h3>
                                    </div>
                                    <div class="box gray mb-2">
                                        <div class="box-content ec-first-border-color" style="background-color: #EEEEEE">
                                            @if(isset($item[1]["content"]["domain"][1]["contents"][0]["comment"]))
                                                {{ $item[1]["content"]["domain"][1]["contents"][0]["comment"]}}
                                            @endif
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <!-- /End -->

                    <!-- Graphic -->
                    @if (str_contains($item[2]['type'], 'ancre'))
                    <h2 class="card-title">{{ $item[2]["params"]["menuNumber"] }} -
                        {{$item[2]["content"]["title"]}} </h2>
                    @endif

                    <div class="col-md-12" id="comments">
                        <div class="card">
                            <div class="card-header .bg-secondary">
                                {{ $item["2"]["content"]["sub_title"]}}
                            </div>

                            <div class="card-body">

                                <div class="group-header">
                                    <h2 class="ec-title"> </h2>
                                </div>

                                <div class="score-bar-wrapper row">
                                    <div class="col-xs-12 col-sm-3">
                                        <h3 class="box-label">
                                            {{ $item[2]["content"]["title"]}}
                                        </h3>
                                    </div>
                                    <div class="box gray mb-2">

                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <!-- /end Graphic -->

                    <!-- Graphic -->
                    @if (str_contains($item[6]['type'], 'ancre'))
                    <h2 class="card-title">3 - {{$item[6]["content"]["title"]}} </h2>
                    @endif

                    <div class="col-md-12" id="comments">
                        <div class="card">
                            <div class="card-header .bg-secondary">
                                {{ $item[6]["content"]["sub_title"]}}
                            </div>

                            <div class="card-body">

                            @foreach ($item as $val)
                                    @if($val['type']=='rapport_details_facteur')
                                    <div class="group-header">
                                        <h2 class="c-title-text-color">
                                            {{ $val["content"]["title"] }}
                                        </h2>
                                    </div>

                                    <div class="score-bar-wrapper row">
                                        <div class="col-xs-12 col-sm-3">
                                            <div class="box-score ec-first-bg-color ec-first-text-color"
                                                style="background-color:#{{$val["params"]["couleur"]}}; color:#000">
                                                <div class="header">
                                                    Score<br>
                                                    {{ $val["params"]["score_calculated"]}}
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-xs-12 col-sm-9">
                                            <div class="progress score-bar" style="width: 100%;">
                                                <div class="label-left">0</div>
                                                <div class="label-right">10</div>
                                                <div class="progress-bar" style="width:{{$val["params"]["pourcentage_score"]}}%;
                                                    color:#000000; background-color: #{!!$val["params"]["couleur"]!!} ">
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="img-calibration">
                                        <div class="gausse ec-first-bg-color" style="background-color:#DDA0DD;position: relative">
                                            <div class="pointer-gausse hidden-xs " style="left:{{4.83*$val["params"]["pourcentage_score"]}}px; z-index: 3"></div>
                                        </div>

                                        <div class="content text-center">
                                                <em>    About 33% of the population has a score lower than or equal to yours.						</em>

                                        </div>
		                            </div>

                                    <div class="box mb-4">
                                            <div class="box-content ec-first-border-color" style="background-color: #EEEEEE">
                                                {!!$val["content"]["commentaire_perso"]!!}
                                            </div>
                                    </div>

                                    <div class="box mb-5 bg-white">
                                        <div class="box-header box-header-small">
                                            <div class="title text-left"> <i class="fa fa-arrow-alt-circle-right"></i>
                                                {{ __('Definition') }}</div>
                                        </div>
                                        <div class="box-content ec-first-border-color">
                                            {!! $val["content"]["description_long"] !!}
                                        </div>
                                    </div>

                                    @endif
                                @endforeach

                            </div>
                        </div>
                    </div>
                    <!-- /end Graphic -->

                </div>
                <footer class="text-center footer">
                    <div class="mb-2">
                        CDC Copyright
                    </div>
                </footer>
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


</script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/esm/popper.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.1/js/bootstrap.js">
</script>
<script type="text/javascript" src="{{ asset('js/custom.js') }}"></script>


</html>
