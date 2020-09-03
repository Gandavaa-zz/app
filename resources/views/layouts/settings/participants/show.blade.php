@extends('layouts.app')

@section('content')

<div class="c-main">

    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3>User detail</h3>
                    </div>
                <div class="card-body">
                    <div class="container">
                        <div class="row my-2">
                            <div class="col-lg-8 order-lg-2">
                                <ul class="nav nav-tabs">
                                    <li class="nav-item">
                                        <a href="" data-target="#profile" data-toggle="tab" class="nav-link active">Profile</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="" data-target="#messages" data-toggle="tab" class="nav-link">Contact info</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="" data-target="#edit" data-toggle="tab" class="nav-link">other info</a>
                                    </li>
                                </ul>
                                <div class="tab-content py-4">
                                    <div class="tab-pane active" id="profile">
                                        <h5 class="mb-3">{{ $user->firstname }}</h5>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <h6>About</h6>
                                                <p>
                                                    Web Designer, UI/UX Engineer
                                                </p>
                                                <h6>Hobbies</h6>
                                                <p>
                                                    Indie music, skiing and hiking. I love the great outdoors.
                                                </p>
                                            </div>
                                            <div class="col-md-6">
                                                <h6>Recent badges</h6>
                                                <a href="#" class="badge badge-dark badge-pill">html5</a>
                                                <a href="#" class="badge badge-dark badge-pill">react</a>
                                                <a href="#" class="badge badge-dark badge-pill">codeply</a>
                                                <a href="#" class="badge badge-dark badge-pill">angularjs</a>
                                                <a href="#" class="badge badge-dark badge-pill">css3</a>
                                                <a href="#" class="badge badge-dark badge-pill">jquery</a>
                                                <a href="#" class="badge badge-dark badge-pill">bootstrap</a>
                                                <a href="#" class="badge badge-dark badge-pill">responsive-design</a>
                                                <hr>
                                                <span class="badge badge-primary"><i class="fa fa-user"></i> 900 Followers</span>
                                                <span class="badge badge-success"><i class="fa fa-cog"></i> 43 Forks</span>
                                                <span class="badge badge-danger"><i class="fa fa-eye"></i> 245 Views</span>
                                            </div>
                                            <div class="col-md-12">
                                                <h5 class="mt-2"><span class="fa fa-clock-o ion-clock float-right"></span> Recent Activity</h5>
                                                <table class="table table-sm table-hover table-striped">
                                                    <tbody>
                                                        <tr>
                                                            <td>
                                                                <strong>Abby</strong> joined ACME Project Team in <strong>`Collaboration`</strong>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                <strong>Gary</strong> deleted My Board1 in <strong>`Discussions`</strong>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                <strong>Kensington</strong> deleted MyBoard3 in <strong>`Discussions`</strong>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                <strong>John</strong> deleted My Board1 in <strong>`Discussions`</strong>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                <strong>Skell</strong> deleted his post Look at Why this is.. in <strong>`Discussions`</strong>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        <!--/row-->
                                    </div>
                                    <div class="tab-pane" id="messages">
                                        <div class="alert alert-info alert-dismissable">
                                            <a class="panel-close close" data-dismiss="alert">×</a> This is an <strong>.alert</strong>. Use this to show important messages to the user.
                                        </div>
                                     <div class="row"><div class="col-sm-6 col-lg-3"><div class="card text-white bg-primary"><div class="card-body pb-0"><div class="btn-group float-right"><button type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="btn btn-transparent dropdown-toggle p-0"><svg class="c-icon"><use xlink:href="assets/icons/coreui/free-symbol-defs.svg#cui-settings"></use></svg></button> <div class="dropdown-menu dropdown-menu-right"><a href="#" class="dropdown-item">Action</a><a href="#" class="dropdown-item">Another action</a><a href="#" class="dropdown-item">Something else here</a></div></div> <div class="text-value-lg">9.823</div> <div>Members online</div></div> <div class="c-chart-wrapper mt-3 mx-3" style="height: 70px;"><div class="chartjs-size-monitor"><div class="chartjs-size-monitor-expand"><div class=""></div></div><div class="chartjs-size-monitor-shrink"><div class=""></div></div></div><canvas id="card-chart1" height="70" class="chart chartjs-render-monitor" style="display: block; width: 339px; height: 70px;" width="339"></canvas></div></div></div> <div class="col-sm-6 col-lg-3"><div class="card text-white bg-info"><div class="card-body pb-0"><button type="button" class="btn btn-transparent p-0 float-right"><svg class="c-icon"><use xlink:href="assets/icons/coreui/free-symbol-defs.svg#cui-location-pin"></use></svg></button> <div class="text-value-lg">9.823</div> <div>Members online</div></div> <div class="c-chart-wrapper mt-3 mx-3" style="height: 70px;"><div class="chartjs-size-monitor"><div class="chartjs-size-monitor-expand"><div class=""></div></div><div class="chartjs-size-monitor-shrink"><div class=""></div></div></div><canvas id="card-chart2" height="70" class="chart chartjs-render-monitor" width="339" style="display: block; width: 339px; height: 70px;"></canvas></div></div></div> <div class="col-sm-6 col-lg-3"><div class="card text-white bg-warning"><div class="card-body pb-0"><div class="btn-group float-right"><button type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="btn btn-transparent dropdown-toggle p-0"><svg class="c-icon"><use xlink:href="assets/icons/coreui/free-symbol-defs.svg#cui-settings"></use></svg></button> <div class="dropdown-menu dropdown-menu-right"><a href="#" class="dropdown-item">Action</a><a href="#" class="dropdown-item">Another action</a><a href="#" class="dropdown-item">Something else here</a></div></div> <div class="text-value-lg">9.823</div> <div>Members online</div></div> <div class="c-chart-wrapper mt-3" style="height: 70px;"><div class="chartjs-size-monitor"><div class="chartjs-size-monitor-expand"><div class=""></div></div><div class="chartjs-size-monitor-shrink"><div class=""></div></div></div><canvas id="card-chart3" height="70" class="chart chartjs-render-monitor" width="371" style="display: block; width: 371px; height: 70px;"></canvas></div></div></div> <div class="col-sm-6 col-lg-3"><div class="card text-white bg-danger"><div class="card-body pb-0"><div class="btn-group float-right"><button type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="btn btn-transparent dropdown-toggle p-0"><svg class="c-icon"><use xlink:href="assets/icons/coreui/free-symbol-defs.svg#cui-settings"></use></svg></button> <div class="dropdown-menu dropdown-menu-right"><a href="#" class="dropdown-item">Action</a><a href="#" class="dropdown-item">Another action</a><a href="#" class="dropdown-item">Something else here</a></div></div> <div class="text-value-lg">9.823</div> <div>Members online</div></div> <div class="c-chart-wrapper mt-3 mx-3" style="height: 70px;"><div class="chartjs-size-monitor"><div class="chartjs-size-monitor-expand"><div class=""></div></div><div class="chartjs-size-monitor-shrink"><div class=""></div></div></div><canvas id="card-chart4" height="70" class="chart chartjs-render-monitor" width="339" style="display: block; width: 339px; height: 70px;"></canvas></div></div></div></div>
                                    </div>
                                    <div class="tab-pane" id="edit">
                                        <form role="form">
                                            <div class="form-group row">
                                                <label class="col-lg-3 col-form-label form-control-label">First name</label>
                                                <div class="col-lg-9">
                                                    <input class="form-control" type="text" value="Jane">
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 order-lg-1 text-center">
                                <img src="//placehold.it/150" class="mx-auto img-fluid img-circle d-block" alt="avatar">
                                <label class=""><br/>
                                {{ $user->lastname }} {{ $user->firstname }}</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
