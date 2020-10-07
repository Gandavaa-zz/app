@extends('layouts.app')

<style>
    .myaccordion {
        box-shadow: 0 0 1px rgba(0, 0, 0, 0.1);
    }

    .myaccordion .card,
    .myaccordion .card:last-child .card-header {
        border: none;
    }

    .myaccordion .card-header {
        border-bottom-color: #EDEFF0;
        background: transparent;
    }

    .myaccordion .fa-stack {
        font-size: 18px;
    }

    .myaccordion .btn {
        width: 100%;
        font-weight: bold;
        color: #004987;
        padding: 0;
    }

    .myaccordion .btn-link:hover,
    .myaccordion .btn-link:focus {
        text-decoration: none;
    }

    .myaccordion li+li {
        margin-top: 10px;
    }

</style>

@section('content')


    <div class="container-fluid">
        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-3">

                        <!-- Profile Image -->
                        <div class="card card-primary card-outline">
                            <div class="card-body box-profile">
                                <div class="text-center">
                                    <img class="profile-user-img img-fluid img-circle" src="/assets/img/avatars/1.jpg"
                                        alt="User profile picture">
                                </div>
                                {{-- <?php dd($user[0]->fullname); ?> --}}
                                <h3 class="profile-username text-center">{{ $user[0]->fullname }}</h3>
                                    <span class="badge badge-primary">html5</span>
                                    <span class="badge badge-primary">css3</span>
                                    <span class="badge badge-primary">jquery</span>
                                <ul class="list-group list-group-unbordered mb-3">
                                    <li class="list-group-item">
                                        <b>Followers</b> <a class="float-right">1,322</a>
                                    </li>
                                </ul>
                                <a href="{{route("participants.edit", $user[0]->id)}}" class="btn btn-info btn-block"><b><i class="cil-pencil"></i> Edit</b></a>
                                <a class="btn btn-danger btn-block delete" href="javascript:void(0)" data-toggle="tooltip"
                                    data-id='{{ $user[0]->id }}' data-original-title="Delete"><i class="cil-trash"></i>
                                    Delete</a>
                            </div>
                            <!-- /.card-body -->
                        </div>

                        <!-- /.card -->

                        <!-- About Me Box -->
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">About Me</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <strong><i class="fas fa-book mr-1"></i> Education</strong>

                                <p class="text-muted">
                                    B.S. in Computer Science from the University of Tennessee at Knoxville
                                </p>

                                <hr>

                                <strong><i class="fas fa-map-marker-alt mr-1"></i> Location</strong>

                                <p class="text-muted">Malibu, California</p>

                                <hr>

                                <strong><i class="fas fa-pencil-alt mr-1"></i> Skills</strong>

                                <p class="text-muted">
                                    <span class="tag tag-danger">UI Design</span>
                                    <span class="tag tag-success">Coding</span>
                                    <span class="tag tag-info">Javascript</span>
                                    <span class="tag tag-warning">PHP</span>
                                    <span class="tag tag-primary">Node.js</span>
                                </p>
                                <hr>
                                <strong><i class="far fa-file-alt mr-1"></i> Notes</strong>
                                <p class="text-muted">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam
                                    fermentum enim neque.</p>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                    <!-- /.col -->
                    <div class="col-md-9">
                        <div class="card">
                            <div class="card-header">
                                <ul class="nav nav-tabs" style="font-size: 20px;">
                                    <li class="nav-item"><a class="nav-link active" style="color:#3B4C64!important"
                                            href="#overview" data-toggle="tab"><i class="cil-clipboard"></i> Overview</a>
                                    </li>
                                    <li class="nav-item"><a class="nav-link" style="color:#3B4C64!important" href="#invite"
                                            data-toggle="tab"><i class="cil-cursor"></i> Invite</a></li>
                                    <li class="nav-item"><a class="nav-link" style="color:#3B4C64!important"
                                            href="#assessment" data-toggle="tab"><i class="cil-graph"></i> Assessment</a>
                                    </li>
                                    <li class="nav-item"><a class="nav-link" style="color:#3B4C64!important"
                                            href="#settings" data-toggle="tab"><i class="cil-vertical-align-bottom1"></i>
                                            Talent map</a></li>
                                </ul>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <div class="tab-content">
                                    <div class="active tab-pane" id="overview">
                                        <div class="row">
                                            <div class="col-sm-8 col-md-8">
                                                <div class="card">
                                                    <div class="card-header">
                                                        <h4>Talent map</h4>
                                                    </div>
                                                    <div class="card-body row">
                                                        <div class="wrapper col-md-6">
                                                            <h2 class="how-title">Skills</h2>
                                                            <div class="progress-group">
                                                                <div class="progress-group-header align-items-end">
                                                                    <div>Risk Management</div>
                                                                </div>
                                                                <div class="progress-group-bars">
                                                                    <div class="progress mb-3">
                                                                        <div class="progress-bar progress-bar bg-success"
                                                                            role="progressbar" style="width: 25%"
                                                                            aria-valuenow="25" aria-valuemin="0"
                                                                            aria-valuemax="100">25%</div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="progress-group">
                                                                <div class="progress-group-header align-items-end">
                                                                    <div>Strategic Planning</div>
                                                                </div>
                                                                <div class="progress-group-bars">
                                                                    <div class="progress mb-3">
                                                                        <div class="progress-bar progress-bar bg-success"
                                                                            role="progressbar" style="width: 25%"
                                                                            aria-valuenow="56" aria-valuemin="0"
                                                                            aria-valuemax="100">56%</div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="progress-group">
                                                                <div class="progress-group-header align-items-end">
                                                                    <div>Analytical Thinking</div>
                                                                </div>
                                                                <div class="progress-group-bars">
                                                                    <div class="progress mb-3">
                                                                        <div class="progress-bar progress-bar bg-success"
                                                                            role="progressbar" style="width: 25%"
                                                                            aria-valuenow="87" aria-valuemin="0"
                                                                            aria-valuemax="100">87%</div>
                                                                    </div>
                                                                </div>
                                                            </div>


                                                        </div>
                                                        <!-- end of /.coloumn -->
                                                        <div class="wrapper col-md-6">
                                                            <h2 class="how-title">Occupations</h2>
                                                            <div class="progress-group">
                                                                <div class="progress-group-header align-items-end">
                                                                    <div>Horticulturalist</div>
                                                                </div>
                                                                <div class="progress-group-bars">
                                                                    <div class="progress mb-3">
                                                                        <div class="progress-bar progress-bar bg-warning"
                                                                            role="progressbar" style="width: 25%"
                                                                            aria-valuenow="25" aria-valuemin="0"
                                                                            aria-valuemax="100">25%</div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="progress-group">
                                                                <div class="progress-group-header align-items-end">
                                                                    <div>Travel Agent</div>
                                                                </div>
                                                                <div class="progress-group-bars">
                                                                    <div class="progress mb-3">
                                                                        <div class="progress-bar progress-bar bg-warning"
                                                                            role="progressbar" style="width: 25%"
                                                                            aria-valuenow="56" aria-valuemin="0"
                                                                            aria-valuemax="100">56%</div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="progress-group">
                                                                <div class="progress-group-header align-items-end">
                                                                    <div>Network Administration</div>
                                                                </div>
                                                                <div class="progress-group-bars">
                                                                    <div class="progress mb-3">
                                                                        <div class="progress-bar progress-bar bg-warning"
                                                                            role="progressbar" style="width: 25%"
                                                                            aria-valuenow="87" aria-valuemin="0"
                                                                            aria-valuemax="100">87%</div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!-- end of /.coloumn -->

                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-8 col-md-4">
                                                <div class="card">
                                                    <div class="card-header">Card title</div>
                                                    <div class="card-body">Lorem ipsum dolor sit amet, consectetuer
                                                        adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet
                                                        dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam,
                                                        quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut
                                                        aliquip ex ea commodo consequat.</div>
                                                </div>
                                            </div>

                                            <div class="col-sm-8 col-md-8">
                                                <div class="card">
                                                    <div class="card-header">
                                                        <h4>Profile</h4>
                                                    </div>
                                                    <div class="card-body">Lorem ipsum dolor sit amet, consectetuer
                                                        adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet
                                                        dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam,
                                                        quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut
                                                        aliquip ex ea commodo consequat.</div>
                                                </div>
                                            </div>



                                        </div>
                                    </div>
                                    <!-- /.tab-pane -->
                                    <div class="tab-pane" id="invite">
                                        <div id="accordion" class="myaccordion">
                                            <div class="card">
                                                <div class="card-header" id="headingOne">
                                                    <h2 class="mb-0">
                                                        <button
                                                            class="d-flex align-items-center justify-content-between btn btn-link"
                                                            data-toggle="collapse" data-target="#collapseOne"
                                                            aria-expanded="true" aria-controls="collapseOne">
                                                            Undergraduate Studies
                                                            <span class="fa-stack fa-sm">
                                                                <i class="fas fa-circle fa-stack-2x"></i>
                                                                <i class="fas fa-minus fa-stack-1x fa-inverse"></i>
                                                            </span>
                                                        </button>
                                                    </h2>
                                                </div>
                                                <div id="collapseOne" class="collapse show" aria-labelledby="headingOne"
                                                    data-parent="#accordion">
                                                    <div class="card-body">
                                                        <ul>
                                                            <li>Computer Science</li>
                                                            <li>Economics</li>
                                                            <li>Sociology</li>
                                                            <li>Nursing</li>
                                                            <li>English</li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card">
                                                <div class="card-header" id="headingTwo">
                                                    <h2 class="mb-0">
                                                        <button
                                                            class="d-flex align-items-center justify-content-between btn btn-link collapsed"
                                                            data-toggle="collapse" data-target="#collapseTwo"
                                                            aria-expanded="false" aria-controls="collapseTwo">
                                                            Postgraduate Studies
                                                            <span class="fa-stack fa-2x">
                                                                <i class="fas fa-circle fa-stack-2x"></i>
                                                                <i class="fas fa-plus fa-stack-1x fa-inverse"></i>
                                                            </span>
                                                        </button>
                                                    </h2>
                                                </div>
                                                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo"
                                                    data-parent="#accordion">
                                                    <div class="card-body">
                                                        <ul>
                                                            <li>Informatics</li>
                                                            <li>Mathematics</li>
                                                            <li>Greek</li>
                                                            <li>Biostatistics</li>
                                                            <li>English</li>
                                                            <li>Nursing</li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card">
                                                <div class="card-header" id="headingThree">
                                                    <h2 class="mb-0">
                                                        <button
                                                            class="d-flex align-items-center justify-content-between btn btn-link collapsed"
                                                            data-toggle="collapse" data-target="#collapseThree"
                                                            aria-expanded="false" aria-controls="collapseThree">
                                                            Research
                                                            <span class="fa-stack fa-2x">
                                                                <i class="fas fa-circle fa-stack-2x"></i>
                                                                <i class="fas fa-plus fa-stack-1x fa-inverse"></i>
                                                            </span>
                                                        </button>
                                                    </h2>
                                                </div>
                                                <div id="collapseThree" class="collapse" aria-labelledby="headingThree"
                                                    data-parent="#accordion">
                                                    <div class="card-body">
                                                        <ul>
                                                            <li>Astrophysics</li>
                                                            <li>Informatics</li>
                                                            <li>Criminology</li>
                                                            <li>Economics</li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- /.tab-pane -->

                                    <div class="tab-pane" id="assessment">
                                        <fieldset class="responsive" style="border:none; ">
                                            <div class="col-sm-4">
                                                <div class="box">
                                                    <div class="lead">
                                                        <i class="fa fa-sign-in ec-title-text-color"></i> Authentication
                                                    </div>
                                                    <small class="text-muted">
                                                    </small>
                                                </div>
                                            </div>
                                            <div class="col-sm-7 col-sm-offset-1">

                                                <p class="responsive">
                                                    <i title="Authentication url" class="fa fa-link"></i>
                                                    https://app.centraltest.com/united-management-consulting/auth-participant
                                                    <br>
                                                    Username: <strong>tdanzansod4970440.daba</strong>
                                                    <br>
                                                    Password: <strong>***********</strong>
                                                    <br>
                                                </p>
                                            </div>
                                        </fieldset>

                                        <div class="form-group">
                                            <select id='status' class="form-control" style="width: 200px">
                                                <option value="">--Select Status--</option>
                                                <option value="1">Active</option>
                                                <option value="0">Deactive</option>
                                            </select>
                                        </div>
                                        <table class="table table-bordered yajra-datatable user_table " id="user_table">
                                            <thead>
                                                <tr>
                                                    <th width="3px"><input type="checkbox" id="selectAll" /></th>
                                                    <th width="5px">#</th>
                                                    <th>Тест нэр</th>
                                                    <th>Evaluator</th>
                                                    <th>Огноо</th>
                                                    <th>Гүйцэтгэсэн хугацаа</th>
                                                    <th width="100px">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            </tbody>
                                        </table>
                                    </div>
                                    <!-- /.tab-pane -->
                                </div>
                                <!-- /.tab-content -->
                            </div><!-- /.card-body -->
                        </div>
                        <!-- /.nav-tabs-custom -->
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
@endsection
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script>
    $(document).ready(function() {
        var table = $('.yajra-datatable').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('participants.assessment') }}",
            columns: [{
                    data: 'checkbox',
                    name: 'checkbox',
                    orderable: false,
                    searchable: false
                },
                {
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex'
                },
                {
                    data: 'title',
                    name: 'title'
                },
                {
                    data: 'info',
                    name: 'info'
                },
                {
                    data: 'created_at',
                    name: 'created_at'
                },
                {
                    data: "duration",
                    name: "duration"
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: true,
                    searchable: true

                },
            ]
        });

    });


    $(document).ready(function() {
        $('body').on('click', '.addToGroup', function() {
            var id = $(this).data('id');
            $('#user_id').val(id);
            $('#groupModal').modal('show');
            // alert(id);
        })
    });

    $(document).ready(function() {
        $(".delete").click(function(e) {
            var id = $(this).data("id");
            Swal.fire({
                title: 'Are you sure?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Тийм',
                cancelButtonText: 'Үгүй'
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        type: "get",
                        url: "/participants/destroy/" + id,
                        success: function(data) {
                                $('#confirmModal').modal('hide');
                                Swal.fire(
                                    'Deleted!',
                                    'Амжилттай устгагдлаа',
                                    'success'
                                )
                                setTimeout(function(){ window.history.back(); }, 1000);
                        },
                        error: function(data) {
                            alert('Error:', data);
                        }
                    });
                }
            })
            $('#select_all').click(function(event) {
                var $that = $(this);
                $(':checkbox').each(function() {
                    this.checked = $that.is(':checked');
                });
            });


            function addPost() {
                $('#add-group-modal').modal('show');
            }


        });
    });
</script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
