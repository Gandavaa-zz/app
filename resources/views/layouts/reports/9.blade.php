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

                    <div class="col-xs-12 col-sm-9">
                        <div class="progress score-bar">
                            @if( isset($item[1]["params"]["quotient"]))
                            <div class="progress-bar"
                                style='width:{{ $item[1]["params"]["quotient"]}}%; color:#000000; background-color: #1C3664'>
                            </div>
                            @endif
                        </div>
                    </div>

                    <div class="col-xs-12 col-md-12 clearfix">
                        <strong>
                            {{ $item[1]["params"]["nb_br"] }} right answers out of
                            {{ $item[1]["params"]["nb_question"] }} questions
                            Average score is {{ $item[1]["params"]["score"] }}/10
                        </strong>
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

    <!-- GENERAL DESCRIPTION -->
    @if (str_contains($item[2]['type'], 'ancre'))
    <h2 class="card-title">{{ $item[2]["params"]["menuNumber"] }} -
        {{$item[2]["content"]["title"]}} </h2>
    @endif

    <div class="col-md-12" id="comments">
        <div class="card">
            <div class="card-header .bg-secondary">
                {{ $item[2]["content"]["sub_title"]}}
            </div>
            <div class="card-body">
                <div class="group-header">
                    {!! $item[3]["content"]["introduction"] !!}
                </div>
            </div>
        </div>
    </div>
    <!-- end GENERAL DESCRIPTION -->

    <!-- Graph  -->
    @if (str_contains($item[4]['type'], 'ancre'))
    <h2 class="card-title">{{ $item[4]["params"]["menuNumber"] }} -
        {{$item[4]["content"]["title"]}} </h2>
    @endif

    <div class="col-md-12" id="comments">
        <div class="card">
            <div class="card-header .bg-secondary">
                {{ $item[4]["content"]["sub_title"]}}
            </div>
            <div class="card-body">
                <div class="group-header">
                    <!-- Graphic here -->
                </div>
            </div>
        </div>
    </div>
    <!-- end Graph -->

    <!-- Detailed  -->
    @if (str_contains($item[6]['type'], 'ancre'))
    <h2 class="card-title">{{ $item[6]["params"]["menuNumber"] }} -
        {{$item[6]["content"]["title"]}} </h2>
    @endif

    <div class="col-md-12" id="comments">
        <div class="card">
            <div class="card-header .bg-secondary">
                {{ $item[6]["content"]["sub_title"]}}
            </div>
            <div class="card-body">
                <!-- loop here -->
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

                            <div class=" img-calibration">
                                <div class="gausse ec-first-bg-color"
                                    style="background-color:#DDA0DD;position: relative">
                                    <div class="pointer-gausse hidden-xs "
                                        style="left:{{4.83*$val["params"]["pourcentage_score"]}}px; z-index: 3"></div>
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
                                        {{ __('Definition') }}</div>
                                </div>
                                <div class="box-content ec-first-border-color">
                                    {!! $val["content"]["description_long"] !!}
                                </div>
                            </div>

                            @endif
                            @endforeach
                            <!-- /end loop here -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
@endsection
