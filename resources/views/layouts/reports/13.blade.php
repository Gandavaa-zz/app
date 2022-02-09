@extends('layouts.report')
<!-- Big Five test -->
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
    <!-- start -->
    @if (str_contains($item[0]['type'], 'ancre'))
    <h2 class="card-title">{{ $item[0]["params"]["menuNumber"] }} -
        {{ __($item[0]["content"]["title"]) }}
    </h2>
    @endif

    <div class="col-md-12" id="{{$item[0]["content"]["title"]}}">
        <div class="card">
            <div class="card-header .bg-secondary">
                {{ __($item[0]["content"]["sub_title"]) }}
            </div>

            <div class="card-body">
                <div class="score-bar-wrapper row">
                    <div class="col-xs-12 col-sm-3">
                        <h3 class="box-label">
                            {{ $item[1]["content"]["title"]}}
                        </h3>
                    </div>
                    <div class="box gray mb-2">
                        <div class="box-content ec-first-border-color" style="background-color: #EEEEEE">

                            @if(isset($item[1]["content"]["domain"][0]["contents"][0]["comment"]))
                            {!! $item[1]["content"]["domain"][0]["contents"][0]["comment"]!!}
                            @endif
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <!-- /End -->

    <!-- Graphic -->
    <!-- section 5 Graph -->
    @if (str_contains($item[2]['type'], 'ancre'))
    {{-- {{dd($item)}} --}}
    <h2 class="card-title">{{ $item[2]["params"]["menuNumber"] }} -
        {{ __($item[2]["content"]["title"]) }}
    </h2>
    @endif
    <div class="col-md-12" id="{{ $item[2]["content"]["title"]}}">
        <div class="card">
            <div class="card-header .bg-secondary">
                {{ __($item[2]["content"]["sub_title"]) }}
            </div>
            <div class="card-body">
                <div class="">
                    <figure class="highcharts-figure">
                        <div id="barChart" style="height: 600px; width: 1308px; margin:0 auto"></div>
                    </figure>
                </div>
            </div>
        </div>
    </div>
    <!-- /endsection 5 Graph -->

    <!-- Table -->
    @if (str_contains($item[4]['type'], 'ancre'))
    <h2 class="card-title mt-100">{{ $item[4]["params"]["menuNumber"] }} -
        {{ __($item[4]["content"]["title"]) }}
    </h2>
    @endif

    <div class="col-md-12" id="{{$item[4]["content"]["title"]}}">
        <div class="card">
            <div class="card-header .bg-secondary">
                {{ __($item["4"]["content"]["sub_title"]) }}
            </div>

            <div class="card-body">

                <div class="">
                    {{ $item["5"]["content"]["introduction"]}}
                </div>

                <div class="score-bar-wrapper row">

                    <div class="box gray mb-2">

                        <div class="page-breaker-inside">
                            <div class="responsive-table" data-swipe-message="Swipe to display other columns">
                                <div class="report-table">
                                    <div class="scrollable-area">
                                        <table class="table table-bordered table-color">
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
                                                        <h3 style="">{{ $val["content"]["libelle_facteur_opposition"]}}<br>
                                                            <span class="hidden-xs show-on-pdf factor">
                                                                {{ $val["content"]["description_courte"] }}</span>
                                                        </h3>
                                                    </td>
                                                    @for($n=0; $n<11; $n++) <td class="text-center" style="@if($n>3 && $n<7) background-color:#D3D3D3;  @else background-color:#EEEEEE; @endif; vertical-align: middle;width:3%">
                                                        @if ($n<5 && (float)$n+0.1 <=(float)$val["params"]["score_calculated"] && (float)$val["params"]["score_calculated"] <=(float)$n+0.9) <img class="check-img img-responsive" src="/assets/img/checkbox.png" alt="OK">
                                                            @endif
                                                            @if ($n>5 && (float)$n+0.1 <=(float)$val["params"]["score_calculated"]+1 && (float)$val["params"]["score_calculated"]+1 <=(float)$n+0.9) <img class="check-img img-responsive" src="/assets/img/checkbox.png" alt="OK">
                                                                @endif
                                                                </td>
                                                                @endfor
                                                                <!-- Factor scores -->

                                                                <!-- Right label of group -->
                                                                <!-- <td class="text-center disabled" style="text-align:right;border-right:10px solid #F781BE;">-->
                                                                <td style="text-align:right;border-right:10px solid #{{$val['params']['couleur']}};">
                                                                    <h3 style="">{{ $val["content"]["libelle_facteur"]}}<br>
                                                                        <span class="hidden-xs show-on-pdf factor">
                                                                            {{ $val["content"]["description_courte_opposition"] }}</span>
                                                                    </h3>
                                                                </td>
                                                </tr>
                                                @endif
                                                @endforeach
                                                <!-- Group description -->


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
    <h2 class="card-title mt-650">{{ $item[6]["params"]["menuNumber"] }} - {{ __($item[6]["content"]["title"]) }} </h2>
    @endif

    <div class="col-md-12" id="{{$item[6]["content"]["title"]}}">
        <div class="card">
            <div class="card-header .bg-secondary">
                {{ __($item[6]["content"]["sub_title"]) }}
            </div>
            <div class="card-body">

                @php $i =0; @endphp
                @foreach ($item as $val)

                @if($val['type']=='rapport_details_facteur')
                @php $i++; @endphp

                <div class="group-header @if($i==5) mt-300 @endif">
                    <h4 class="c-title-text-color">
                        {{ $val["content"]["title"] }}
                    </h4>
                </div>
                <div class="score-bar-wrapper row">
                    <div class="col-xs-12 col-sm-3">
                        <div class="factor-header">
                            <h5 class="c-title-text-color">
                                {{ $val["content"]["libelle_facteur"] }}
                            </h5>
                        </div>
                        <div class="box-score ec-first-bg-color ec-first-text-color" style="background-color:#{{$val["params"]["couleur"]}}; color:#000">
                            <div class="header">
                                Score<br>
                                {{ $val["params"]["score_calculated"]}}
                            </div>
                        </div>
                    </div>

                    <div class="col-xs-12 col-sm-6">
                        <div class="progress score-bar" style="width: 100%;">
                            <div class="progress-bar" style="width:{{$val["params"]["pourcentage_score"]}}%;
                                                color:#000000; background-color: #{!!$val['params']['couleur']!!} ">
                            </div>
                        </div>
                    </div>

                    <div class="col-xs-12 col-sm-3">
                        <div class="factor-header">
                            <h5 class="c-title-text-color">
                                {{ $val["content"]["libelle_facteur_opposition"] }}
                            </h5>
                        </div>
                        <div class="box-score" style="background-color:#{{$val["params"]["couleur"]}}; color:#000">

                            <div class="header">
                                Оноо<br>
                                {{ $val["params"]["score_opposition"]}}
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
                        <div class="title text-left"> <i class="fa fa-arrow-circle-o-right"></i>
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
@section('script')
<script>
    var barChart = [];
    var obj = {};
    @foreach($item as $idx => $row)
    @if($row['type'] == 'rapport_details_facteur') {
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

    $(document).ready(function() {
        $('#pdfExport').on('click', function() {
            $('.page-wrapper').removeClass("toggled");
            $('figure').css("margin-left", "-200px");
            window.print();
        });
    });
</script>
@endsection

@endsection