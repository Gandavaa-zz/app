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
                        <li class="header-menu">
                            <span>Reports</span>
                        </li>
                        <li>
                            <a href="#graph">
                                <span>the graph</span>
                            </a>
                        </li>
                        <li>
                            <a href="#inv_graph">
                                <span>the inverted graph</span>
                            </a>
                        </li>
                        <li>
                            <a href="#p_an">
                                <span>personalised analyses</span>
                            </a>
                        </li>
                        <li>
                            <a href="#detailed_table">
                                <span>the detailed table</span>
                            </a>
                        </li>
                        <li>
                            <a href="#comments">
                                <span>the comments</span>
                            </a>
                        </li>
                        <li>
                            <a href="#ge_pro">
                                <span>general profile</span>
                            </a>
                        </li>
                        <li>
                            <a href="#pot">
                                <span>potentials</span>
                            </a>
                        </li>
                        <li>
                            <a href="#how">
                                <span>how different professions suit the profile</span>
                            </a>
                        </li>
                    </ul>
                </div>
                <!-- sidebar-menu  -->
            </div>
        </nav>
        <!-- sidebar-wrapper  -->
        <main class="page-content">
            <div class="main">
                <div class="text-center">
                    <img src="https://app.centraltest.com/files/logos/PP_II/PP-2__log2_us.png" alt="Professional Profile 2 " class="img-responsive">
                    <!-- <h2>Professional Profile 2 </h2> -->
                    <h6>Test taken on the 13th of September 2019 in 14 min 24 sec</h6>
                    <hr />
                </div>
                <div class="row">
                    <h2 class="card-title">1 - THE GRAPH </h2>
                    <div class="col-md-12" id="graph">
                        <div class="card">
                            <div class="card-header .bg-secondary">Results on main factors (Score out of 10)</div>
                            <div class="card-body">
                                <figure class="highcharts-figure">
                                    <div id="chart"></div>
                                </figure>
                            </div>
                        </div>
                    </div>

                    <h2 class="card-title">3 - PERSONALISED ANALYSIS </h2>
                    <div class="col-md-12" id="p_an">
                        <div class="card">
                            <div class="card-header .bg-secondary">Personality traits that are specific to the profile</div>
                            <div class="card-body">
                                <div class="row">
                                    <strong>In this section you will find the traits that stand out the most in the profile of the candidate.
                                    </strong> <br> A few precautions in interpreting the results:&nbsp;<br>- Certain personality traits may contradict each other, this is true for human behaviour. <br>- We recommend
                                    to look at the "The Comments" section of this report for a more personalised description of the profile.
                                </div>
                                <div class="group-list">
                                    <div class="group-header">
                                        <div class="row">
                                            <h2 class="ec-title">Strengths</h2>
                                        </div>
                                    </div>
                                    <div class="box">
                                        <div class="box-content">Organised and methodical, Ichinkhorloo E strictly plans her tasks and sticks to well defined schedules.</div>
                                    </div>
                                    <div class="box">
                                        <div class="box-content">Ichinkhorloo E enjoys working with others and values teams characterised by mutual support and cohesiveness.</div>
                                    </div>
                                    <div class="box">
                                        <div class="box-content">Rather pragmatic, Ichinkhorloo E focuses on her personal growth and encourages others to be self-sufficient.</div>
                                    </div>
                                    <div class="box">
                                        <div class="box-content">Ichinkhorloo E is ready to learn from the experience of others. She does not hesitate to approach others for advice.</div>
                                    </div>
                                </div>

                                <div class="group-list">
                                    <div class="group-header">
                                        <div class="row">
                                            <h2 class="ec-title">Weaker points, points to develop:</h2>
                                        </div>
                                    </div>
                                    <div class="box">
                                        <div class="box-content">Ichinkhorloo E could benefit from accepting a certain degree of ambiguity in her work by adapting easily when faced with unexpected events.</div>
                                    </div>
                                    <div class="box">
                                        <div class="box-content">Ichinkhorloo E could be more helpful to her co-workers by spending some time in assisting them.</div>
                                    </div>
                                    <div class="box">
                                        <div class="box-content">Ichinkhorloo E is ready to learn from the experience of others. She does not hesitate to approach others for advice.</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <h2 class="card-title">4 - THE DETAILED TABLE </h2>
                    <div class="col-md-12" id="detailed_table">
                        <div class="card">
                            <div class="card-header .bg-secondary">A tabular representation of the results on the main and opposing factors</div>
                            <div class="card-body">
                                <div class="card-content">
                                    <p>The following table summarises the candidate's results from the questionnaire. The column on the right describes the main factor. The column on the left describes the opposing factor. The "✔" represents where the
                                        candidate stands in relation to the dimension.</p>
                                    <p><br>Therefore the closer the "✔" is to the right, the stronger is the tendency for the main factor. The closer the "✔" is to the left, the stronger is the tendency for the opposing factor.</p>
                                    <div class="responsive-table">
                                        <table class="table table-bordered">
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
                                                <tr class="group">
                                                    <td colspan="13" class="text-center left-label" style="background-color: #C9E6AE;padding: 5px;">
                                                        <h3 class="f-title">
                                                            Behaviour and Personality<br>
                                                            <span style="font-size: 0.7em; font-weight: 100"></span>
                                                        </h3>
                                                    </td>
                                                </tr>
                                                <tr class="factor">
                                                    <td class="left-label">
                                                        <h3>
                                                            Straightforwardness<br>
                                                            <span class="behaviour"><span>Genuine, Needs objectivity, Transparent</span></span>
                                                        </h3>
                                                    </td>
                                                    <!-- Factor scores -->
                                                    <td class="text-center factor-score"></td>
                                                    <td class="text-center factor-score"></td>
                                                    <td class="text-center factor-score"></td>
                                                    <td class="text-center factor-score">x</td>
                                                    <td class="text-center factor-score-grey"></td>
                                                    <td class="text-center factor-score-grey"></td>
                                                    <td class="text-center factor-score-grey"></td>
                                                    <td class="text-center factor-score"></td>
                                                    <td class="text-center factor-score"></td>
                                                    <td class="text-center factor-score"></td>
                                                    <td class="text-center factor-score"></td>
                                                    <td style="text-align:right;">
                                                        <h3>
                                                            Persuasiveness<br>
                                                            <span class="behaviour">Convincing, Influential, Strategic</span>
                                                        </h3>
                                                    </td>
                                                </tr>
                                                <tr class="factor">
                                                    <!-- <td class="text-center " > -->
                                                    <td class="left-label">
                                                        <h3>
                                                            Firmness<br>
                                                            <span class="behaviour">Decisive, Resolute, Strong-willed</span>
                                                        </h3>
                                                    </td>
                                                    <!-- Factor scores -->
                                                    <td class="text-center" style="background-color:#EEEEEE; vertical-align: middle;width:3%"></td>
                                                    <td class="text-center" style="background-color:#EEEEEE; vertical-align: middle;width:3%"></td>
                                                    <td class="text-center" style="background-color:#EEEEEE; vertical-align: middle;width:3%"></td>
                                                    <td class="text-center" style="background-color:#EEEEEE; vertical-align: middle;width:3%">x</td>
                                                    <td class="text-center" style="background-color:#D3D3D3; vertical-align: middle;width:3%"></td>
                                                    <td class="text-center" style="background-color:#D3D3D3; vertical-align: middle;width:3%"></td>
                                                    <td class="text-center" style="background-color:#D3D3D3; vertical-align: middle;width:3%"></td>
                                                    <td class="text-center" style="background-color:#EEEEEE; vertical-align: middle;width:3%"></td>
                                                    <td class="text-center" style="background-color:#EEEEEE; vertical-align: middle;width:3%"></td>
                                                    <td class="text-center" style="background-color:#EEEEEE; vertical-align: middle;width:3%"></td>
                                                    <td class="text-center" style="background-color:#EEEEEE; vertical-align: middle;width:3%"></td>
                                                    <!-- Right label of group -->
                                                    <!-- <td class="text-center disabled" style="text-align:right;">-->
                                                    <td style="text-align:right;">
                                                        <h3>
                                                            Flexibility<br>
                                                            <span class="hidden-xs show-on-pdf">Adjusting, Seeks consensus, Open-minded</span>
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
                    <h2 class="card-title">5 - THE COMMENTS </h2>
                    <div class="col-md-12" id="comments">
                        <div class="card">
                            <div class="card-header .bg-secondary">An interpretation of the scores on each factor with personalised comments</div>
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
                    <h2 class="card-title">6 - GENERAL PROFILE </h2>
                    <div class="col-md-12" id="g_po">
                        <div class="card">
                            <div class="card-header .bg-secondary">Suitability of the profile in relation to various work-personality profile types</div>
                            <div class="card-body">
                                This section analyses the extent to which the candidate's profile matches the various work-personality types.
                                <p>A perfect match corresponds to 100%.</p>
                                <table class="b-table table">
                                    <tbody>
                                        <tr>
                                            <td style="width: 10%">1</td>
                                            <td style="width: 40%">Conscientious</td>
                                            <td style="width: 30%">
                                                <div class="progress">
                                                    <div class="progress-bar" role="progressbar" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100" style="width:70%">
                                                    </div>
                                                </div>
                                                <span class="percentage">70%</span>
                                            </td>
                                            <td style="width: 140px;" data-toggle="collapse" data-target="#demo1" class="accordion-toggle">
                                                <p class="t-right">Details</p>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="12" class="hiddenRow">
                                                <div class="accordian-body collapse hiddenRow" id="demo1">
                                                    Conscientious individuals are meticulous by nature. They stick to set procedures and adhere to rules because they believe that closely following these can contribute to the quality of their work. They prefer using conventional and well established methods
                                                    that they can count on to be efficient. They also have a keen eye for detail and rely on factual information to make decisions.
                                                    <hr>

                                                    <!-- <figure class="highcharts-figure">
                                                            <div id="chart2"></div>
                                                        </figure> -->
                                                    <div class="legend-match">
                                                        <div class="col-xs-12 text-center">
                                                            <b>Match</b>
                                                        </div>
                                                        <div class="col-xs-12 text-center">
                                                            <span class="">High match</span>
                                                            <i class="match-icon fa fa-plus  " style="color: #28ad1f"></i> &nbsp;
                                                            <span class="color" style="background-color: #28ad1f"></span><span class="color" style="background-color: #a7cd2c"></span><span class="color" style="background-color: #f9d423"></span>
                                                            <span class="color" style="background-color: #fc913a"></span><span class="color" style="background-color: #e40000"></span> &nbsp;
                                                            <span class="">Low match</span>
                                                            <i class="match-icon fa fa-minus  hidden-lg" style="color: #e40000"></i>
                                                        </div>
                                                        <div class="col-md-6 col-md-offset-3 legends">
                                                            <p>
                                                                <span class="color" style="background-color: #dddddd"></span>
                                                                <span class=""> Irrelevant dimension</span>
                                                            </p>
                                                            <p>
                                                                <img class="color img-responsive" src="https://app.centraltest.com/images/assessment/legend_candidate.png"> <span>Candidate score</span>
                                                            </p>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-12 bordered">
                                                        <div class="text-center legend-scores-title">
                                                            Strong points
                                                        </div>
                                                        <div class="row columns">
                                                            <div class="column col-md-4 text-center">Dimension</div>
                                                            <div class="column col-md-4 text-center">Optimal</div>
                                                            <div class="column col-md-4 text-center">Candidate</div>
                                                        </div>
                                                    </div>

                                                    <div class="row" style="margin-top:20px;">
                                                        <div class="container">
                                                            <div class="p-title">
                                                                <h3>Conscientious
                                                                    <span class="badge badge-pill badge-secondary">
                                                                        72%</span>
                                                                </h3>
                                                            </div>
                                                        </div>
                                                        <div class="container">
                                                            <div class="col-xs-12"> Conscientious individuals are meticulous by nature. They stick to set procedures and adhere to rules because they believe that closely following these can contribute to the quality of their
                                                                work. They prefer using conventional and well established methods that they can count on to be efficient. They also have a keen eye for detail and rely on factual information to make
                                                                decisions.
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td style="width: 10%">2</td>
                                            <td style="width: 40%">Social</td>
                                            <td style="width: 30%">
                                                <div class="progress">
                                                    <div class="progress-bar" role="progressbar" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100" style="width:70%">
                                                    </div>
                                                </div>
                                                <span class="percentage">70%</span>
                                            </td>
                                            <td data-toggle="collapse" data-target="#demo2" class="accordion-toggle">
                                                <p class="t-right">Details</p>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="12" class="hiddenRow">
                                                <div class="accordian-body collapse" id="demo1">
                                                    bbb
                                                </div>
                                            </td>
                                        </tr>

                                    </tbody>
                                </table>

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