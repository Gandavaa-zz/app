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
                    <img class="img-responsive img-rounded" src="https://raw.githubusercontent.com/azouaoui-med/pro-sidebar-template/gh-pages/src/img/user.jpg" alt="User picture">
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
                        {{$item[0]["content"]["title"]}}
                    </h2>
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
                        {{$item[2]["content"]["title"]}}
                    </h2>
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

                    <!-- Table -->
                    @if (str_contains($item[4]['type'], 'ancre'))
                    <h2 class="card-title">{{ $item[4]["params"]["menuNumber"] }} -
                        {{$item[4]["content"]["title"]}}
                    </h2>
                    @endif

                    <div class="col-md-12" id="comments">
                        <div class="card">
                            <div class="card-header .bg-secondary">
                                {{ $item["4"]["content"]["sub_title"]}}
                            </div>

                            <div class="card-body">

                                <div class="group-header">
                                    {{ $item["5"]["content"]["introduction"]}}
                                </div>

                                <div class="score-bar-wrapper row">

                                    <div class="box gray mb-2">

                                        <div class="page-breaker-inside">
                                            <div class="responsive-table" data-swipe-message="Swipe to display other columns">
                                                <div class="report-table">
                                                    <div class="scrollable-area">
                                                        <table class="table table-bordered table-color" style="border-collapse:separate;">
                                                            <!-- No header for overview and miror -->
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
                                                            <tbody class="">

                                                                @foreach ($item as $val)

                                                                @if($val['type']=='rapport_details_facteur')

                                                                <tr class="factor">

                                                                    <td class="left-label" style="border-left:10px solid #{{$val['params']['couleur']}};">
                                                                        <h3 style="">{{ $val["content"]["label"]}}<br>
                                                                            <span class="hidden-xs show-on-pdf" style="font-size: 0.7em; font-weight: 100">
                                                                                {{ $val["content"]["description_courte"] }}</span>
                                                                        </h3>
                                                                    </td>
                                                                    @for($n=0; $n<11; $n++) <td class="text-center" style="@if($n>3 && $n<7) background-color:#D3D3D3;  @else background-color:#EEEEEE; @endif; vertical-align: middle;width:3%">
                                                                        @if ($n<5 && (float)$n+0.1 <=(float)$val["params"]["score_calculated"] && (float)$val["params"]["score_calculated"] <=(float)$n+0.9) <img class="check-img img-responsive" src="/assets/img/checkbox.png" alt="OK">
                                                                            @endif
                                                                            @if ($n>=5 && (float)$n+0.1 <=(float)$val["params"]["score_calculated"]+1 && (float)$val["params"]["score_calculated"]+1 <=(float)$n+0.9) <img class="check-img img-responsive" src="/assets/img/checkbox.png" alt="OK">
                                                                                @endif
                                                                                </td>
                                                                                @endfor
                                                                                <!-- Factor scores -->

                                                                                <!-- Right label of group -->
                                                                                <!-- <td class="text-center disabled" style="text-align:right;border-right:10px solid #F781BE;">-->
                                                                                <td style="text-align:right;border-right:10px solid #{{$val['params']['couleur']}};">
                                                                                    <h3 style="">{{ $val["content"]["label"]}}<br>
                                                                                        <span class="hidden-xs show-on-pdf" style="font-size: 0.7em; font-weight: 100">
                                                                                            {{ $val["content"]["description_courte"] }}</span>
                                                                                    </h3>
                                                                                </td>
                                                                </tr>
                                                                @endif
                                                                @endforeach
                                                                <!-- Group description -->

                                                                <tr class="factor">
                                                                    <!-- <td class="text-center " style="border-left:10px solid #A9F5A9;"> -->
                                                                    <td class="left-label" style="border-left:10px solid #A9F5A9;">
                                                                        <h3 style="">Competitiveness- REAL<br>
                                                                            <span class="hidden-xs show-on-pdf" style="font-size: 0.7em; font-weight: 100">Demanding, Fighting spirit, Uncompromising, Cynical, Sometimes lacking in sensitivity</span>
                                                                        </h3>
                                                                    </td>
                                                                    <!-- Factor scores -->
                                                                    <td class="text-center" style="background-color:#EEEEEE; vertical-align: middle;width:3%"></td>
                                                                    <td class="text-center" style="background-color:#EEEEEE; vertical-align: middle;width:3%">
                                                                        <img class="check-img img-responsive" src="/assets/img/checkbox.png" alt="OK">
                                                                    </td>
                                                                    <td class="text-center" style="background-color:#EEEEEE; vertical-align: middle;width:3%"></td>
                                                                    <td class="text-center" style="background-color:#EEEEEE; vertical-align: middle;width:3%"></td>
                                                                    <td class="text-center" style="background-color:#D3D3D3; vertical-align: middle;width:3%"></td>
                                                                    <td class="text-center" style="background-color:#D3D3D3; vertical-align: middle;width:3%"></td>
                                                                    <td class="text-center" style="background-color:#D3D3D3; vertical-align: middle;width:3%"></td>
                                                                    <td class="text-center" style="background-color:#EEEEEE; vertical-align: middle;width:3%"></td>
                                                                    <td class="text-center" style="background-color:#EEEEEE; vertical-align: middle;width:3%"></td>
                                                                    <td class="text-center" style="background-color:#EEEEEE; vertical-align: middle;width:3%"></td>
                                                                    <td class="text-center" style="background-color:#EEEEEE; vertical-align: middle;width:3%"></td> <!-- Right label of group -->
                                                                    <!-- <td class="text-center disabled" style="text-align:right;border-right:10px solid #A9F5A9;">-->
                                                                    <td style="text-align:right;border-right:10px solid #A9F5A9;">
                                                                        <h3 style="">
                                                                            Consciousness of others<br>
                                                                            <span class="hidden-xs show-on-pdf" style="font-size: 0.7em; font-weight: 100">Sensitive, Empathic, Altruistic, Cooperative, Agreeable, Sentimental, Consensual</span>
                                                                        </h3>
                                                                    </td>
                                                                </tr>


                                                                <!-- Group description -->
                                                                <!-- Factors display -->
                                                                <tr class="factor">
                                                                    <!-- <td class="text-center disabled" style="border-left:10px solid #81BEF7;"> -->
                                                                    <td class="left-label" style="border-left:10px solid #81BEF7;">
                                                                        <h3 style="">
                                                                            Emotional sensitivity<br>
                                                                            <span class="hidden-xs show-on-pdf" style="font-size: 0.7em; font-weight: 100">Inconsistent, Reactive, Sensitive to criticism, Tends to be anxious or even depressed, Neurotic</span>
                                                                        </h3>
                                                                    </td>
                                                                    <!-- Factor scores -->
                                                                    <td class="text-center" style="background-color:#EEEEEE; vertical-align: middle;width:3%"></td>
                                                                    <td class="text-center" style="background-color:#EEEEEE; vertical-align: middle;width:3%"></td>
                                                                    <td class="text-center" style="background-color:#EEEEEE; vertical-align: middle;width:3%"></td>
                                                                    <td class="text-center" style="background-color:#EEEEEE; vertical-align: middle;width:3%"></td>
                                                                    <td class="text-center" style="background-color:#D3D3D3; vertical-align: middle;width:3%"></td>
                                                                    <td class="text-center" style="background-color:#D3D3D3; vertical-align: middle;width:3%"></td>
                                                                    <td class="text-center" style="background-color:#D3D3D3; vertical-align: middle;width:3%"></td>
                                                                    <td class="text-center" style="background-color:#EEEEEE; vertical-align: middle;width:3%"></td>
                                                                    <td class="text-center" style="background-color:#EEEEEE; vertical-align: middle;width:3%"></td>
                                                                    <td class="text-center" style="background-color:#EEEEEE; vertical-align: middle;width:3%"><img class="check-img img-responsive" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAA4AAAAOCAYAAAAfSC3RAAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAAyFpVFh0WE1MOmNvbS5hZG9iZS54bXAAAAAAADw/eHBhY2tldCBiZWdpbj0i77u/IiBpZD0iVzVNME1wQ2VoaUh6cmVTek5UY3prYzlkIj8+IDx4OnhtcG1ldGEgeG1sbnM6eD0iYWRvYmU6bnM6bWV0YS8iIHg6eG1wdGs9IkFkb2JlIFhNUCBDb3JlIDUuNi1jMTQyIDc5LjE2MDkyNCwgMjAxNy8wNy8xMy0wMTowNjozOSAgICAgICAgIj4gPHJkZjpSREYgeG1sbnM6cmRmPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5LzAyLzIyLXJkZi1zeW50YXgtbnMjIj4gPHJkZjpEZXNjcmlwdGlvbiByZGY6YWJvdXQ9IiIgeG1sbnM6eG1wPSJodHRwOi8vbnMuYWRvYmUuY29tL3hhcC8xLjAvIiB4bWxuczp4bXBNTT0iaHR0cDovL25zLmFkb2JlLmNvbS94YXAvMS4wL21tLyIgeG1sbnM6c3RSZWY9Imh0dHA6Ly9ucy5hZG9iZS5jb20veGFwLzEuMC9zVHlwZS9SZXNvdXJjZVJlZiMiIHhtcDpDcmVhdG9yVG9vbD0iQWRvYmUgUGhvdG9zaG9wIENDIChXaW5kb3dzKSIgeG1wTU06SW5zdGFuY2VJRD0ieG1wLmlpZDpFMENDNTMxM0UxNzkxMUU3ODY3Q0Y0RjExMThDNERGRCIgeG1wTU06RG9jdW1lbnRJRD0ieG1wLmRpZDpFMENDNTMxNEUxNzkxMUU3ODY3Q0Y0RjExMThDNERGRCI+IDx4bXBNTTpEZXJpdmVkRnJvbSBzdFJlZjppbnN0YW5jZUlEPSJ4bXAuaWlkOkUwQ0M1MzExRTE3OTExRTc4NjdDRjRGMTExOEM0REZEIiBzdFJlZjpkb2N1bWVudElEPSJ4bXAuZGlkOkUwQ0M1MzEyRTE3OTExRTc4NjdDRjRGMTExOEM0REZEIi8+IDwvcmRmOkRlc2NyaXB0aW9uPiA8L3JkZjpSREY+IDwveDp4bXBtZXRhPiA8P3hwYWNrZXQgZW5kPSJyIj8+wtOBHwAAAaxJREFUeNpi/P//PwM5gImBTMDS1tbG8OzZM4afP38ycHNzM/z584fBxcWFwcTEhOHbt28MzMzMDBwcHAxnz57l6+jomH/9+vXvfn5+6Sz4TGVlZWVgZ2dn2Lt3r1R5efma58+fW4LET5w4IcLCyMgIVvD3718GJiaIy0FiIL9//PiR4dChQ0r19fUbPnz4oAszEOg6XiagIsajR4/27dmzZ8P379/FWFhYGNjY2MCaKysrtYF4J7ImGRmZ3QEBAb7M7969WwJ0fxqQ1nj8+LG7srLy7vdAsG3bNtvNQAD0pxxMk4qKynoHB4dwHh6eTyy/f/+WgEm8fPlSb+PGjVtkZWUnnzlzphUoJACT09bWnm9jY5MODLzfIG8xrwWCmzdvagJt0wQp+Pr1qwgwlL2BTA6YJiMjox6gphygv/+BQh0UykzCwsJfp0yZEuHo6LgIW8iam5s3WFhYlII0/Pv3D5EAoPH3q7+/PwHo6UlwCSamf3Z2dgXA+GwEaUJPYcwZGRlgQVCUuLq67gCG4N8HDx5IA51WAPTXnF+/fqFoANkKcioj3dMqQIABAK8HyVwimG3bAAAAAElFTkSuQmCC" alt="OK"></td>
                                                                    <td class="text-center" style="background-color:#EEEEEE; vertical-align: middle;width:3%"></td> <!-- Right label of group -->
                                                                    <!-- <td class="text-center " style="text-align:right;border-right:10px solid #81BEF7;">-->
                                                                    <td style="text-align:right;border-right:10px solid #81BEF7;">
                                                                        <h3 style="">
                                                                            Emotional balance<br>
                                                                            <span class="hidden-xs show-on-pdf" style="font-size: 0.7em; font-weight: 100">Lethargic, Even-tempered, Faces situations with confidence, Thoughtful</span>
                                                                        </h3>
                                                                    </td>
                                                                </tr>


                                                                <!-- Group description -->
                                                                <!-- Factors display -->
                                                                <tr class="factor">
                                                                    <!-- <td class="text-center disabled" style="border-left:10px solid #F0E68C;"> -->
                                                                    <td class="left-label" style="border-left:10px solid #F0E68C;">
                                                                        <h3 style="">
                                                                            Intuition<br>
                                                                            <span class="hidden-xs show-on-pdf" style="font-size: 0.7em; font-weight: 100">Impulsive, Follows instincts, Improvises, A little messy</span>
                                                                        </h3>
                                                                    </td>
                                                                    <!-- Factor scores -->
                                                                    <td class="text-center" style="background-color:#EEEEEE; vertical-align: middle;width:3%"></td>
                                                                    <td class="text-center" style="background-color:#EEEEEE; vertical-align: middle;width:3%"></td>
                                                                    <td class="text-center" style="background-color:#EEEEEE; vertical-align: middle;width:3%"></td>
                                                                    <td class="text-center" style="background-color:#EEEEEE; vertical-align: middle;width:3%"></td>
                                                                    <td class="text-center" style="background-color:#D3D3D3; vertical-align: middle;width:3%"></td>
                                                                    <td class="text-center" style="background-color:#D3D3D3; vertical-align: middle;width:3%"></td>
                                                                    <td class="text-center" style="background-color:#D3D3D3; vertical-align: middle;width:3%"></td>
                                                                    <td class="text-center" style="background-color:#EEEEEE; vertical-align: middle;width:3%"></td>
                                                                    <td class="text-center" style="background-color:#EEEEEE; vertical-align: middle;width:3%"></td>
                                                                    <td class="text-center" style="background-color:#EEEEEE; vertical-align: middle;width:3%"></td>
                                                                    <td class="text-center" style="background-color:#EEEEEE; vertical-align: middle;width:3%"><img class="check-img img-responsive" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAA4AAAAOCAYAAAAfSC3RAAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAAyFpVFh0WE1MOmNvbS5hZG9iZS54bXAAAAAAADw/eHBhY2tldCBiZWdpbj0i77u/IiBpZD0iVzVNME1wQ2VoaUh6cmVTek5UY3prYzlkIj8+IDx4OnhtcG1ldGEgeG1sbnM6eD0iYWRvYmU6bnM6bWV0YS8iIHg6eG1wdGs9IkFkb2JlIFhNUCBDb3JlIDUuNi1jMTQyIDc5LjE2MDkyNCwgMjAxNy8wNy8xMy0wMTowNjozOSAgICAgICAgIj4gPHJkZjpSREYgeG1sbnM6cmRmPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5LzAyLzIyLXJkZi1zeW50YXgtbnMjIj4gPHJkZjpEZXNjcmlwdGlvbiByZGY6YWJvdXQ9IiIgeG1sbnM6eG1wPSJodHRwOi8vbnMuYWRvYmUuY29tL3hhcC8xLjAvIiB4bWxuczp4bXBNTT0iaHR0cDovL25zLmFkb2JlLmNvbS94YXAvMS4wL21tLyIgeG1sbnM6c3RSZWY9Imh0dHA6Ly9ucy5hZG9iZS5jb20veGFwLzEuMC9zVHlwZS9SZXNvdXJjZVJlZiMiIHhtcDpDcmVhdG9yVG9vbD0iQWRvYmUgUGhvdG9zaG9wIENDIChXaW5kb3dzKSIgeG1wTU06SW5zdGFuY2VJRD0ieG1wLmlpZDpFMENDNTMxM0UxNzkxMUU3ODY3Q0Y0RjExMThDNERGRCIgeG1wTU06RG9jdW1lbnRJRD0ieG1wLmRpZDpFMENDNTMxNEUxNzkxMUU3ODY3Q0Y0RjExMThDNERGRCI+IDx4bXBNTTpEZXJpdmVkRnJvbSBzdFJlZjppbnN0YW5jZUlEPSJ4bXAuaWlkOkUwQ0M1MzExRTE3OTExRTc4NjdDRjRGMTExOEM0REZEIiBzdFJlZjpkb2N1bWVudElEPSJ4bXAuZGlkOkUwQ0M1MzEyRTE3OTExRTc4NjdDRjRGMTExOEM0REZEIi8+IDwvcmRmOkRlc2NyaXB0aW9uPiA8L3JkZjpSREY+IDwveDp4bXBtZXRhPiA8P3hwYWNrZXQgZW5kPSJyIj8+wtOBHwAAAaxJREFUeNpi/P//PwM5gImBTMDS1tbG8OzZM4afP38ycHNzM/z584fBxcWFwcTEhOHbt28MzMzMDBwcHAxnz57l6+jomH/9+vXvfn5+6Sz4TGVlZWVgZ2dn2Lt3r1R5efma58+fW4LET5w4IcLCyMgIVvD3718GJiaIy0FiIL9//PiR4dChQ0r19fUbPnz4oAszEOg6XiagIsajR4/27dmzZ8P379/FWFhYGNjY2MCaKysrtYF4J7ImGRmZ3QEBAb7M7969WwJ0fxqQ1nj8+LG7srLy7vdAsG3bNtvNQAD0pxxMk4qKynoHB4dwHh6eTyy/f/+WgEm8fPlSb+PGjVtkZWUnnzlzphUoJACT09bWnm9jY5MODLzfIG8xrwWCmzdvagJt0wQp+Pr1qwgwlL2BTA6YJiMjox6gphygv/+BQh0UykzCwsJfp0yZEuHo6LgIW8iam5s3WFhYlII0/Pv3D5EAoPH3q7+/PwHo6UlwCSamf3Z2dgXA+GwEaUJPYcwZGRlgQVCUuLq67gCG4N8HDx5IA51WAPTXnF+/fqFoANkKcioj3dMqQIABAK8HyVwimG3bAAAAAElFTkSuQmCC" alt="OK"></td> <!-- Right label of group -->
                                                                    <!-- <td class="text-center " style="text-align:right;border-right:10px solid #F0E68C;">-->
                                                                    <td style="text-align:right;border-right:10px solid #F0E68C;">
                                                                        <h3 style="">
                                                                            Meticulousness<br>
                                                                            <span class="hidden-xs show-on-pdf" style="font-size: 0.7em; font-weight: 100">Rigorous, Reliable, Avoids the unexpected, Methodical, Persevering, Critical, Self-disciplined, Will to succeed</span>
                                                                        </h3>
                                                                    </td>
                                                                </tr>


                                                                <!-- Group description -->
                                                                <!-- Factors display -->
                                                                <tr class="factor">
                                                                    <!-- <td class="text-center disabled" style="border-left:10px solid #D0A9F5;"> -->
                                                                    <td class="left-label" style="border-left:10px solid #D0A9F5;">
                                                                        <h3 style="">
                                                                            Conservatism-Realism<br>
                                                                            <span class="hidden-xs show-on-pdf" style="font-size: 0.7em; font-weight: 100">Likes what is established and familiar, Needs stability, Keeps one's feet firmly on the ground</span>
                                                                        </h3>
                                                                    </td>
                                                                    <!-- Factor scores -->
                                                                    <td class="text-center" style="background-color:#EEEEEE; vertical-align: middle;width:3%"></td>
                                                                    <td class="text-center" style="background-color:#EEEEEE; vertical-align: middle;width:3%"></td>
                                                                    <td class="text-center" style="background-color:#EEEEEE; vertical-align: middle;width:3%"></td>
                                                                    <td class="text-center" style="background-color:#EEEEEE; vertical-align: middle;width:3%"></td>
                                                                    <td class="text-center" style="background-color:#D3D3D3; vertical-align: middle;width:3%"></td>
                                                                    <td class="text-center" style="background-color:#D3D3D3; vertical-align: middle;width:3%"></td>
                                                                    <td class="text-center" style="background-color:#D3D3D3; vertical-align: middle;width:3%"><img class="check-img img-responsive" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAA4AAAAOCAYAAAAfSC3RAAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAAyFpVFh0WE1MOmNvbS5hZG9iZS54bXAAAAAAADw/eHBhY2tldCBiZWdpbj0i77u/IiBpZD0iVzVNME1wQ2VoaUh6cmVTek5UY3prYzlkIj8+IDx4OnhtcG1ldGEgeG1sbnM6eD0iYWRvYmU6bnM6bWV0YS8iIHg6eG1wdGs9IkFkb2JlIFhNUCBDb3JlIDUuNi1jMTQyIDc5LjE2MDkyNCwgMjAxNy8wNy8xMy0wMTowNjozOSAgICAgICAgIj4gPHJkZjpSREYgeG1sbnM6cmRmPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5LzAyLzIyLXJkZi1zeW50YXgtbnMjIj4gPHJkZjpEZXNjcmlwdGlvbiByZGY6YWJvdXQ9IiIgeG1sbnM6eG1wPSJodHRwOi8vbnMuYWRvYmUuY29tL3hhcC8xLjAvIiB4bWxuczp4bXBNTT0iaHR0cDovL25zLmFkb2JlLmNvbS94YXAvMS4wL21tLyIgeG1sbnM6c3RSZWY9Imh0dHA6Ly9ucy5hZG9iZS5jb20veGFwLzEuMC9zVHlwZS9SZXNvdXJjZVJlZiMiIHhtcDpDcmVhdG9yVG9vbD0iQWRvYmUgUGhvdG9zaG9wIENDIChXaW5kb3dzKSIgeG1wTU06SW5zdGFuY2VJRD0ieG1wLmlpZDpFMENDNTMxM0UxNzkxMUU3ODY3Q0Y0RjExMThDNERGRCIgeG1wTU06RG9jdW1lbnRJRD0ieG1wLmRpZDpFMENDNTMxNEUxNzkxMUU3ODY3Q0Y0RjExMThDNERGRCI+IDx4bXBNTTpEZXJpdmVkRnJvbSBzdFJlZjppbnN0YW5jZUlEPSJ4bXAuaWlkOkUwQ0M1MzExRTE3OTExRTc4NjdDRjRGMTExOEM0REZEIiBzdFJlZjpkb2N1bWVudElEPSJ4bXAuZGlkOkUwQ0M1MzEyRTE3OTExRTc4NjdDRjRGMTExOEM0REZEIi8+IDwvcmRmOkRlc2NyaXB0aW9uPiA8L3JkZjpSREY+IDwveDp4bXBtZXRhPiA8P3hwYWNrZXQgZW5kPSJyIj8+wtOBHwAAAaxJREFUeNpi/P//PwM5gImBTMDS1tbG8OzZM4afP38ycHNzM/z584fBxcWFwcTEhOHbt28MzMzMDBwcHAxnz57l6+jomH/9+vXvfn5+6Sz4TGVlZWVgZ2dn2Lt3r1R5efma58+fW4LET5w4IcLCyMgIVvD3718GJiaIy0FiIL9//PiR4dChQ0r19fUbPnz4oAszEOg6XiagIsajR4/27dmzZ8P379/FWFhYGNjY2MCaKysrtYF4J7ImGRmZ3QEBAb7M7969WwJ0fxqQ1nj8+LG7srLy7vdAsG3bNtvNQAD0pxxMk4qKynoHB4dwHh6eTyy/f/+WgEm8fPlSb+PGjVtkZWUnnzlzphUoJACT09bWnm9jY5MODLzfIG8xrwWCmzdvagJt0wQp+Pr1qwgwlL2BTA6YJiMjox6gphygv/+BQh0UykzCwsJfp0yZEuHo6LgIW8iam5s3WFhYlII0/Pv3D5EAoPH3q7+/PwHo6UlwCSamf3Z2dgXA+GwEaUJPYcwZGRlgQVCUuLq67gCG4N8HDx5IA51WAPTXnF+/fqFoANkKcioj3dMqQIABAK8HyVwimG3bAAAAAElFTkSuQmCC" alt="OK"></td>
                                                                    <td class="text-center" style="background-color:#EEEEEE; vertical-align: middle;width:3%"></td>
                                                                    <td class="text-center" style="background-color:#EEEEEE; vertical-align: middle;width:3%"></td>
                                                                    <td class="text-center" style="background-color:#EEEEEE; vertical-align: middle;width:3%"></td>
                                                                    <td class="text-center" style="background-color:#EEEEEE; vertical-align: middle;width:3%"></td> <!-- Right label of group -->
                                                                    <!-- <td class="text-center " style="text-align:right;border-right:10px solid #D0A9F5;">-->
                                                                    <td style="text-align:right;border-right:10px solid #D0A9F5;">
                                                                        <h3 style="">
                                                                            Openness-Imagination<br>
                                                                            <span class="hidden-xs show-on-pdf" style="font-size: 0.7em; font-weight: 100">Looks for what is new, Imaginative, Dreamer, Sensitive to aesthetics, Likes to keep several alternatives available</span>
                                                                        </h3>
                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>


                    <!-- /Table -->

                    <!-- Comments -->
                    @if (str_contains($item[6]['type'], 'ancre'))
                    <h2 class="card-title">{{ $item[6]["params"]["menuNumber"] }} - {{$item[6]["content"]["title"]}} </h2>
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
                                        <div class="box-score ec-first-bg-color ec-first-text-color" style="background-color:#{{$val["params"]["couleur"]}}; color:#000">
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
                                                        color:#000000; background-color: #{!!$val['params']['couleur']!!} ">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class=" img-calibration">
                                    <div class="gausse ec-first-bg-color" style="background-color:#DDA0DD;position: relative">
                                        <div class="pointer-gausse hidden-xs " style="left:{{4.83*$val["params"]["pourcentage_score"]}}px; z-index: 3"></div>
                                    </div>

                                    <div class="content text-center">
                                        <em> About 33% of the population has a score lower than or equal to yours. </em>
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
                                            {{ __('Definition') }}
                                        </div>
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
