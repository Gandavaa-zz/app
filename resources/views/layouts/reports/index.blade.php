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
                    <img class="img-responsive img-rounded" src="https://raw.githubusercontent.com/azouaoui-med/pro-sidebar-template/gh-pages/src/img/user.jpg" alt="User picture">
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
                    <!-- <h2>Professional Profile 2 </h2> -->
                    <h6>Test taken on the 13th of September 2019 in 14 min 24 sec</h6>
                    <hr />
                </div>
                <div class="row">
                    @foreach($data["parties"]["party"] as $menu)
                    @if (str_contains($menu['type'], 'ancre'))
                    <h2 class="card-title">{{$menu["params"]["menuNumber"]}} - {{$menu["content"]["title"]}} </h2>
                    <div class="col-md-12" id="comments">
                        <div class="card">
                            <div class="card-header .bg-secondary">{{$menu["content"]["sub_title"]}}</div>
                            <div class="card-body">
                                <div class="group-header">
                                    <h2 class="ec-title">BEHAVIOUR AND PERSONALITY</h2>
                                    <h2 class="ec-title">Straightforwardness
                                        <<>> Persuasiveness
                                    </h2>
                                </div>
                                <div class="score-bar-wrapper row">

                                    <div class="col-xs-12 col-sm-3">
                                        <h3 class="box-label"> Straightforwardness </h3>
                                        <div class="box-score" style="
                                     color:#000000; background-color: #f1ffd6">
                                            <div class="header">
                                                Score<br>6.2 </div>
                                        </div>
                                    </div>

                                    <div class="col-xs-12 col-sm-6">
                                        <div class="progress score-bar">
                                            <div class="progress-bar" style="width:62%;
                                                             color:#000000; background-color: #f1ffd6   "></div>
                                            <div class="progress-bar" style="width:38%;
                                                             color:#000000; background-color: #C9E6AE"></div>
                                        </div>
                                    </div>


                                    <div class="col-xs-12 col-sm-3">

                                        <h3> Persuasiveness </h3>
                                        <div class="box-score" style="
                                         color:#000000; background-color: #C9E6AE					">
                                            <div class="header">
                                                Score<br>3.8 </div>
                                        </div>
                                    </div>

                                </div>
                                <div class="box gray">
                                    <div class="box-content ec-first-border-color" style="background-color: #EEEEEE">
                                        Ichinkhorloo E is rather frank. She tends not to persuade or influence others and is likely to present information in an objective way. Fairly straightforward, Ichinkhorloo E generally says things in a direct manner. However, she may use persuasive arguments
                                        on topics that she knows well and considers very important.<br><br>Environment and Roles: Organisations in which transparency and authenticity are appreciated suit
                                        her best.<br><br>Interaction with others: Generally transparent and does not seek to influence others at all costs.<br><br>Strength: Can be counted upon to give an honest opinion.<br><br>Potential weakness:
                                        May find it difficult when required to persuade others. </div>
                                </div>
                                <div class="box">
                                    <div class="box-header box-header-small">
                                        <div class="title text-left"> <i class="fa fa-arrow-alt-circle-right"></i> Definition</div>
                                    </div>
                                    <div class="box-desc">
                                        <div>
                                            "Persuasiveness" is defined as the ease with which an individual is convincing and influencing others by using tact and adapting their speech for an audience, while "Straightforwardness" refers to being authentic and direct in communication, with a need
                                            to remain transparent. </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif
                    @endforeach
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
    Highcharts.chart('chart', {

        chart: {
            polar: true,
            type: 'line'
        },

        // accessibility: {
        //   description: 'A spiderweb chart compares the allocated budget against actual spending within an organization. The spider chart has six spokes. Each spoke represents one of the 6 departments within the organization: sales, marketing, development, customer support, information technology and administration. The chart is interactive, and each data point is displayed upon hovering. The chart clearly shows that 4 of the 6 departments have overspent their budget with Marketing responsible for the greatest overspend of $20,000. The allocated budget and actual spending data points for each department are as follows: Sales. Budget equals $43,000; spending equals $50,000. Marketing. Budget equals $19,000; spending equals $39,000. Development. Budget equals $60,000; spending equals $42,000. Customer support. Budget equals $35,000; spending equals $31,000. Information technology. Budget equals $17,000; spending equals $26,000. Administration. Budget equals $10,000; spending equals $14,000.'
        // },

        title: {
            text: 'Budget vs spending',
            x: -80
        },

        pane: {
            size: '80%'
        },

        xAxis: {
            categories: ['Sales', 'Marketing', 'Development', 'Customer Support',
                'Information Technology', 'Administration'
            ],
            tickmarkPlacement: 'on',
            lineWidth: 0
        },

        yAxis: {
            gridLineInterpolation: 'polygon',
            lineWidth: 0,
            min: 0
        },

        tooltip: {
            shared: true,
            pointFormat: '<span style="color:{series.color}">{series.name}: <b>${point.y:,.0f}</b><br/>'
        },

        legend: {
            align: 'bottom',
            verticalAlign: 'bottom',
            x: 0,
            y: 0
        },

        series: [{
            name: 'Allocated Budget',
            data: [43000, 19000, 60000, 35000, 17000, 10000],
            pointPlacement: 'on'
        }, {
            name: 'Actual Spending',
            data: [50000, 39000, 42000, 31000, 26000, 14000],
            pointPlacement: 'on'
        }],

        responsive: {
            rules: [{
                condition: {
                    maxWidth: 500
                },
                chartOptions: {
                    legend: {
                        align: 'center',
                        verticalAlign: 'bottom',
                        layout: 'horizontal'
                    },
                    pane: {
                        size: '100%'
                    }
                }
            }]
        }

    });

    Highcharts.chart('chart2', {

        chart: {
            polar: true,
            type: 'line'
        },

        // accessibility: {
        //   description: 'A spiderweb chart compares the allocated budget against actual spending within an organization. The spider chart has six spokes. Each spoke represents one of the 6 departments within the organization: sales, marketing, development, customer support, information technology and administration. The chart is interactive, and each data point is displayed upon hovering. The chart clearly shows that 4 of the 6 departments have overspent their budget with Marketing responsible for the greatest overspend of $20,000. The allocated budget and actual spending data points for each department are as follows: Sales. Budget equals $43,000; spending equals $50,000. Marketing. Budget equals $19,000; spending equals $39,000. Development. Budget equals $60,000; spending equals $42,000. Customer support. Budget equals $35,000; spending equals $31,000. Information technology. Budget equals $17,000; spending equals $26,000. Administration. Budget equals $10,000; spending equals $14,000.'
        // },

        title: {
            text: 'Budget vs spending',
            x: -80
        },

        pane: {
            size: '80%'
        },

        xAxis: {
            categories: ['Sales', 'Marketing', 'Development', 'Customer Support',
                'Information Technology', 'Administration'
            ],
            tickmarkPlacement: 'on',
            lineWidth: 0
        },

        yAxis: {
            gridLineInterpolation: 'polygon',
            lineWidth: 0,
            min: 0
        },

        tooltip: {
            shared: true,
            pointFormat: '<span style="color:{series.color}">{series.name}: <b>${point.y:,.0f}</b><br/>'
        },

        legend: {
            align: 'bottom',
            verticalAlign: 'bottom',
            x: 0,
            y: 0
        },

        series: [{
            name: 'Allocated Budget',
            data: [43000, 19000, 60000, 35000, 17000, 10000],
            pointPlacement: 'on'
        }, {
            name: 'Actual Spending',
            data: [50000, 39000, 42000, 31000, 26000, 14000],
            pointPlacement: 'on'
        }],

        responsive: {
            rules: [{
                condition: {
                    maxWidth: 600
                },
                chartOptions: {
                    legend: {
                        align: 'center',
                        verticalAlign: 'bottom',
                        layout: 'horizontal'
                    },
                    pane: {
                        size: '70%'
                    }
                }
            }]
        }

    });
</script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/esm/popper.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.1/js/bootstrap.js"></script>
<script type="text/javascript" src="{{ asset('js/custom.js') }}"></script>


</html>