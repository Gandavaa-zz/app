@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <div class="pt-1 pb-4">
                                    <div class="row">
                                        <div class="col-md-2">
                                            <img class=" rounded-circle" width="150"  src="/storage/{{ $user->avatar_path }}" alt="{{ $user->fullname }}">                                             
                                        </div>                                        
                                        <div class="col-md-10">
                                            <h3 class="profile-username">{{ $user->fullname }} <a href="{{ route('participants.edit', $user->id) }}"
                                            class="btn btn-info"><b><i class="cil-pencil"></i></b>
                                            </a>
                                            <a class="btn btn-danger delete" href="javascript:void(0)" data-toggle="tooltip"
                                                data-id='{{ $user->id }}' data-original-title="Delete"><i class="cil-trash"></i>
                                            </a></h3>
                                            @foreach ($user->groups as $group_name)
                                                <span class="badge badge-primary">{{ $group_name->name }}</span>
                                            @endforeach
                                        </div>
                                    </div>                                    
                                    
                                </div>

                                <div class="clearfix">
                                    <ul class="nav nav-tabs" style="font-size: 16px;">
                                        <li class="nav-item"><a class="nav-link active" style="color:#3B4C64!important"
                                                href="#overview" data-toggle="tab"><i class="cil-clipboard"></i> Ерөнхий</a>
                                        </li>
                                        <li class="nav-item"><a class="nav-link" style="color:#3B4C64!important" href="#invite"
                                                data-toggle="tab"><i class="cil-cursor"></i> Урилга</a></li>
                                        <li class="nav-item"><a class="nav-link" style="color:#3B4C64!important"
                                                href="#assessment" data-toggle="tab"><i class="cil-graph"></i> Тест</a>
                                        </li>
                                        <li class="nav-item"><a class="nav-link" style="color:#3B4C64!important"
                                                href="#settings" data-toggle="tab"><i class="cil-vertical-align-bottom1"></i>
                                                Чадварын map</a></li>
                                    </ul>
                                    
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
                                                        <div class="card-body">
                                                            <div class="c100 p90 blue">
                                                                <span data-toggle="modal"
                                                                    data-target="#basicExampleModal"><strong style="color: #3B4C64; cursor: pointer;">90%</strong></span>
                                                                <div class="slice">
                                                                    <div class="bar"></div>
                                                                    <div class="fill"></div>
                                                                </div>
                                                            </div>

                                                            <div class="c100 p15 green">
                                                                <span data-toggle="modal"
                                                                    data-target="#basicExampleModal"><strong style="color: #3B4C64; cursor: pointer;">15%</strong></span>
                                                                <div class="slice">
                                                                    <div class="bar"></div>
                                                                    <div class="fill"></div>
                                                                </div>
                                                            </div>

                                                            <div class="c100 p74 orange">
                                                                <span data-toggle="modal"
                                                                    data-target="#basicExampleModal"><strong style="color: #3B4C64; cursor: pointer;">74%</strong></span>
                                                                <div class="slice">
                                                                    <div class="bar"></div>
                                                                    <div class="fill"></div>
                                                                </div>
                                                            </div>
                                                        <h4><span class="badge badge-primary">Social</span></h4>
                                                        </div>

                                                        <!-- Modal -->
                                                        <div class="modal fade" id="basicExampleModal" tabindex="-1"
                                                            role="dialog" aria-labelledby="exampleModalLabel"
                                                            aria-hidden="true">
                                                            <div class="modal-dialog modal-lg" role="document">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h3 class="modal-title" id="exampleModalLabel">
                                                                            <strong>Professional Profile 2</strong>
                                                                        </h3>
                                                                        <button type="button" class="close" data-dismiss="modal"
                                                                            aria-label="Close">
                                                                            <span aria-hidden="true">&times;</span>
                                                                        </button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <div class="row">
                                                                            <div class="col-12 col-sm-5">
                                                                                <div
                                                                                    class="d-flex align-items-center justify-content-center m-auto">
                                                                                    <div>
                                                                                        <div
                                                                                            class="chart-wrapper row align-items-center justify-content-center">
                                                                                            <div class="c100 p90 blue">
                                                                                                <span><strong style="color: #3B4C64; cursor: pointer;">90%</strong></span>
                                                                                                <div class="slice">
                                                                                                    <div class="bar"></div>
                                                                                                    <div class="fill"></div>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="text-center ml-1 mb-1 mt-1">
                                                                                            <div
                                                                                                class="synthetic-box-label-donuts badge text-white p-2 red-background">
                                                                                                Social </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-12 col-sm-7">
                                                                                <div>Social individuals are gregarious by nature
                                                                                    and have the need to belong to a group. They
                                                                                    enjoy networking and can easily form good
                                                                                    professional and personal bonds with others.
                                                                                    They enjoy working in teams and tend to
                                                                                    spread their enthusiasm to their
                                                                                    team-members. As a result, they integrate
                                                                                    very easily into different teams.</div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>



                                            </div>
                                        </div>
                                        <!-- /.tab-pane -->
                                        <div class="tab-pane" id="invite">
                                                <div class="card">
                                                    <div class="card-header d-flex justify-content-between" id="headingCollapse1">
                                                        <div>
                                                            <a class="collapsed" data-toggle="collapse" href="#collapse1" aria-expanded="false" aria-controls="collapse1">
                                                                Card Header
                                                            </a>
                                                        </div>
                                                        <div>
                                                            <a data-toggle="collapse" class="collapsed btn btn-default btn-xs text-right" href="#collapse1" aria-label="Expand/Collapse Card 1" aria-expanded="false" role="button">
                                                                <i class="fa" aria-hidden="true"></i>
                                                                <span class="sr-only">Expand/Collapse Card 1</span>
                                                            </a>
                                                        </div>
                                                    </div>
                                                    <div id="collapse1" class="collapse" aria-labelledby="headingCollapse1">
                                                        <div class="card-body">
                                                            Here is some wonderful content that you can't see...until expanded!
                                                        </div>
                                                    </div>
                                            </div>
                                        </div>
                                        <!-- /.tab-pane -->

                                        <div class="tab-pane" id="assessment">
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
                                </div>
                            </div>
                            <!-- /.card-header -->
                           
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
{{-- <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script> --}}
<script src="https://code.jquery.com/jquery-2.2.4.min.js"></script>
<script>

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
                            setTimeout(function() {
                                window.history.back();
                            }, 1000);
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
