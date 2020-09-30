@extends('layouts.app')
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
                    <img class="profile-user-img img-fluid img-circle"
                         src="/assets/img/avatars/1.jpg"
                         alt="User profile picture">
                  </div>

                  <h3 class="profile-username text-center">{{ $user->firstname }} {{ $user->lastname }}</h3>

                  <p class="text-muted text-center">Software Engineer</p>

                  <ul class="list-group list-group-unbordered mb-3">
                    <li class="list-group-item">
                      <b>Followers</b> <a class="float-right">1,322</a>
                    </li>
                    <li class="list-group-item">
                      <b>Following</b> <a class="float-right">543</a>
                    </li>
                    <li class="list-group-item">
                      <b>Friends</b> <a class="float-right">13,287</a>
                    </li>
                  </ul>

                  <a href="#" class="btn btn-primary btn-block"><b>Follow</b></a>
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
                  <p class="text-muted">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam fermentum enim neque.</p>
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
                    <li class="nav-item" ><a class="nav-link active" href="#overview" data-toggle="tab"><i class="cil-clipboard"></i> Overview</a></li>
                    <li class="nav-item"><a class="nav-link" href="#timeline" data-toggle="tab"><i class="cil-cursor"></i> Invite</a></li>
                    <li class="nav-item"><a class="nav-link" href="#assessment" data-toggle="tab"><i class="cil-graph"></i> Assessment</a></li>
                    <li class="nav-item"><a class="nav-link" href="#settings" data-toggle="tab"><i class="cil-vertical-align-bottom1"></i> Talent map</a></li>
                  </ul>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                  <div class="tab-content">
                    <div class="active tab-pane" id="overview">
                        <div class="row">
                        <div class="col-sm-8 col-md-8">
                        <div class="card">
                        <div class="card-header"><h4>Talent map</h4></div>
                        <div class="card-body row">
                            <div class="wrapper col-md-6">
                                    <h2 class="how-title">Skills</h2>
                                    <div class="progress-group">
                                       <div class="progress-group-header align-items-end">
                                          <div>Risk Management</div>
                                        </div>
                                        <div class="progress-group-bars">
                                            <div class="progress mb-3">
                                                <div class="progress-bar progress-bar bg-success" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">25%</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="progress-group">
                                        <div class="progress-group-header align-items-end">
                                           <div>Strategic Planning</div>
                                         </div>
                                         <div class="progress-group-bars">
                                             <div class="progress mb-3">
                                                 <div class="progress-bar progress-bar bg-success" role="progressbar" style="width: 25%" aria-valuenow="56" aria-valuemin="0" aria-valuemax="100">56%</div>
                                             </div>
                                         </div>
                                     </div>
                                     <div class="progress-group">
                                        <div class="progress-group-header align-items-end">
                                           <div>Analytical Thinking</div>
                                         </div>
                                         <div class="progress-group-bars">
                                             <div class="progress mb-3">
                                                 <div class="progress-bar progress-bar bg-success" role="progressbar" style="width: 25%" aria-valuenow="87" aria-valuemin="0" aria-valuemax="100">87%</div>
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
                                            <div class="progress-bar progress-bar bg-warning" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">25%</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="progress-group">
                                    <div class="progress-group-header align-items-end">
                                       <div>Travel Agent</div>
                                     </div>
                                     <div class="progress-group-bars">
                                         <div class="progress mb-3">
                                             <div class="progress-bar progress-bar bg-warning" role="progressbar" style="width: 25%" aria-valuenow="56" aria-valuemin="0" aria-valuemax="100">56%</div>
                                         </div>
                                     </div>
                                 </div>
                                 <div class="progress-group">
                                    <div class="progress-group-header align-items-end">
                                       <div>Network Administration</div>
                                     </div>
                                     <div class="progress-group-bars">
                                         <div class="progress mb-3">
                                             <div class="progress-bar progress-bar bg-warning" role="progressbar" style="width: 25%" aria-valuenow="87" aria-valuemin="0" aria-valuemax="100">87%</div>
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
                        <div class="card-body">Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat.</div>
                        </div>
                        </div>

                        <div class="col-sm-8 col-md-8">
                            <div class="card">
                            <div class="card-header"><h4>Profile</h4></div>
                            <div class="card-body">Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat.</div>
                            </div>
                            </div>



                    </div>
                    </div>
                    <!-- /.tab-pane -->
                    <div class="tab-pane" id="timeline">
                      <!-- The timeline -->
                      <div class="timeline timeline-inverse">
                        <!-- timeline time label -->
                        <div class="time-label">
                          <span class="bg-danger">
                            10 Feb. 2014
                          </span>
                        </div>
                        <!-- /.timeline-label -->
                        <!-- timeline item -->
                        <div>
                          <i class="fas fa-envelope bg-primary"></i>

                          <div class="timeline-item">
                            <span class="time"><i class="far fa-clock"></i> 12:05</span>

                            <h3 class="timeline-header"><a href="#">Support Team</a> sent you an email</h3>

                            <div class="timeline-body">
                              Etsy doostang zoodles disqus groupon greplin oooj voxy zoodles,
                              weebly ning heekya handango imeem plugg dopplr jibjab, movity
                              jajah plickers sifteo edmodo ifttt zimbra. Babblely odeo kaboodle
                              quora plaxo ideeli hulu weebly balihoo...
                            </div>
                            <div class="timeline-footer">
                              <a href="#" class="btn btn-primary btn-sm">Read more</a>
                              <a href="#" class="btn btn-danger btn-sm">Delete</a>
                            </div>
                          </div>
                        </div>
                        <!-- END timeline item -->
                        <!-- timeline item -->
                        <div>
                          <i class="fas fa-user bg-info"></i>

                          <div class="timeline-item">
                            <span class="time"><i class="far fa-clock"></i> 5 mins ago</span>

                            <h3 class="timeline-header border-0"><a href="#">Sarah Young</a> accepted your friend request
                            </h3>
                          </div>
                        </div>
                        <!-- END timeline item -->
                        <!-- timeline item -->
                        <div>
                          <i class="fas fa-comments bg-warning"></i>

                          <div class="timeline-item">
                            <span class="time"><i class="far fa-clock"></i> 27 mins ago</span>

                            <h3 class="timeline-header"><a href="#">Jay White</a> commented on your post</h3>

                            <div class="timeline-body">
                              Take me to your leader!
                              Switzerland is small and neutral!
                              We are more like Germany, ambitious and misunderstood!
                            </div>
                            <div class="timeline-footer">
                              <a href="#" class="btn btn-warning btn-flat btn-sm">View comment</a>
                            </div>
                          </div>
                        </div>
                        <!-- END timeline item -->
                        <!-- timeline time label -->
                        <div class="time-label">
                          <span class="bg-success">
                            3 Jan. 2014
                          </span>
                        </div>
                        <!-- /.timeline-label -->
                        <!-- timeline item -->
                        <div>
                          <i class="fas fa-camera bg-purple"></i>

                          <div class="timeline-item">
                            <span class="time"><i class="far fa-clock"></i> 2 days ago</span>

                            <h3 class="timeline-header"><a href="#">Mina Lee</a> uploaded new photos</h3>

                            <div class="timeline-body">
                              <img src="http://placehold.it/150x100" alt="...">
                              <img src="http://placehold.it/150x100" alt="...">
                              <img src="http://placehold.it/150x100" alt="...">
                              <img src="http://placehold.it/150x100" alt="...">
                            </div>
                          </div>
                        </div>
                        <!-- END timeline item -->
                        <div>
                          <i class="far fa-clock bg-gray"></i>
                        </div>
                      </div>
                    </div>
                    <!-- /.tab-pane -->

                    <div class="tab-pane" id="assessment">
                        <fieldset class="responsive" style="border:none; ">
                            <div class="col-sm-4">
                                  <div class="box">
                                    <div class="lead">
                                           <i class="fa fa-sign-in ec-title-text-color"></i> Authentication</div>
                                    <small class="text-muted">
                                                    </small>
                                </div>
                            </div>
                                <div class="col-sm-7 col-sm-offset-1">

                                <p class="responsive">
                                <i title="Authentication url" class="fa fa-link"></i>  https://app.centraltest.com/united-management-consulting/auth-participant					<br>
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
                                    <th width="3px"><input type="checkbox" id="selectAll"/></th>
                                    <th width="5px">#</th>
                                    <th>Овог нэр</th>
                                    <th>Evaluator</th>
                                    <th>Бүртгэсэн огноо</th>
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
                columns: [
                    {
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
                        data: 'fullname',
                        name: 'fullname'
                    },
                    {
                        data: 'created_at',
                        name: 'created_at'
                    },
                    {
                        data: 'created_by',
                        name: 'created_by'
                    },
                    {
                        data: "name",
                        name: "name"
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


        $(document).ready(function () {
          $('body').on('click', '.addToGroup', function () {
            var id  = $(this).data('id');
            $('#user_id').val(id);
            $('#groupModal').modal('show');
            // alert(id);
          })
        });

        $(document).ready(function () {
          $('body').on('click', '#selectAll', function () {
            if ($(this).hasClass('allChecked')) {
                $('input[type="checkbox"]', '#user_table').prop('checked', false);
            } else {
                $('input[type="checkbox"]', '#user_table').prop('checked', true);
            }
            $(this).toggleClass('allChecked');
          })
        });

        $(document).on('click', '#deleteMultiple', function(){
            var id = [];
            Swal.fire({
            title: 'Are you sure?',
            // text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Тийм',
            cancelButtonText: 'Үгүй'
            }).then((result) => {
            if (result.value) {
                $('.participant_checkbox:checked').each(function(){
                        id.push($(this).val());
                    });
                    if(id.length > 0)
                    {
                        $.ajax({
                            url:"{{ route('participants.deleteMultiple')}}",
                            method:"get",
                            data:{id:id},
                            success:function(data)
                            {
                                Swal.fire(
                                'Deleted!',
                                'Амжилттай устгагдлаа',
                                'success'
                                )
                                $('#user_table').DataTable().ajax.reload();
                            }
                        });
                    }
                    else
                    {
                                Swal.fire({
                                icon: 'error',
                                title: 'Алдаа...',
                                text: 'Харилцагч сонгоно уу!'
                                })

                    };
            }
            })
            });


        $('body').on('click', '.delete', function () {
        var id = $(this).data("id");
        //  var firstname = $(this).data("firstname");
        //  console.log("participant id - " + id);
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
               url:"participants/destroy/"+id,
               success: function (data) {
                setTimeout(function(){
             $('#confirmModal').modal('hide');
             $('#user_table').DataTable().ajax.reload();
            });
               },
               error: function (data) {
                   console.log('Error:', data);
               }
           });
            Swal.fire(
              'Deleted!',
              'Амжилттай устгагдлаа',
              'success'
            )
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
        </script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>

