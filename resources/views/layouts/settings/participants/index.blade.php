@extends('layouts.app')

@section('content')
        <meta name="csrf-token" content="{{ csrf_token() }}" />
        <div class="container-fluid">
          <div class="animated fadeIn">
            <div class="row">
              <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                <div class="card">
                    <div class="card-header">

                    <span class="float-left"><h5><i class="fa fa-align-justify"></i>{{ __('Харилцагчид') }}</h5></span> <span class="float-right">
                    {{-- <a class="btn btn-primary" href="{{ route('users.create') }}">Шинэ</a></span> --}}
                    <a class="btn btn-primary" href="javascript:void(0)" id="createNewItem"><i class="cil-plus"></i>Шинэ</a>
                    </div>

                    <div class="card-body">

                    @include('layouts.shared.alert')

                        <table class="table table-bordered yajra-datatable user_table" id="user_table">
                            <thead>
                                <tr>
                                    <th width="5px">#</th>
                                    <th>Овог нэр</th>
                                    <th>Цахим хаяг</th>
                                    <th>Бүртгэсэн огноо</th>
                                    {{-- <th>Үүсгэсэн</th> --}}
                                    <th>Групп</th>
                                    <th width="100px">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                      {{-- {{ $users->links() }}  --}}
                    </div>
                </div>
              </div>
            </div>

            <div class="modal fade" id="ajaxModel" aria-hidden="true">
                <div class="modal-dialog modal-md">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="modelHeading"></h4>
                        </div>
                        <div class="modal-body" >
                            <form id="PartipicantForm" name="PartipicantForm" class="form-horizontal">
                               <input type="hidden" name="id" id="id">
                               <div class="alert alert-danger print-error-msg" style="display:none">
                                <ul></ul>
                            </div>
                            <div class="form-group">
                                <label>{{ __('Овог') }}</label>
                                <div class="input-group">
                                    <div class="input-group-prepend"><span class="input-group-text">
                                    <svg class="c-icon">
                                        <use xlink:href="{{ env('APP_URL', '') }}/icons/sprites/free.svg#cil-user"></use>
                                    </svg></span></div>
                                <input type="text" name="lastname" id="lastname" class="form-control" placeholder="Эцэг/эх-н нэр оруулна уу..." autocomplete="lastname" autofocus>
                                <div class="alert-message" id="lastname_error"></div>
                            </div>

                            <div class="form-group">
                                <label>{{ __('Нэр') }}</label>
                                <input type="text" name="firstname" id="firstname" class="form-control" placeholder="Last Name">
                            </div>

                            <div class="form-group">
                                <label>{{ __('Цахим хаяг') }}</label>
                                <input type="text" name="email" id="email" class="form-control" placeholder="Email">
                            </div>

                            <div class="form-group">
                                <label>{{ __('Регистерийн дугаар') }}</label>
                                <input type="text" name="register" id="register" class="form-control" placeholder="register">
                            </div>

                            <div class="form-group">
                                <label>{{ __('Төрсөн огноо') }}</label>
                                <input class="form-control" id="dob" id="dob" type="date" name="dob" placeholder="age">
                            </div>

                            <div class="form-group row">
                                {{-- <label class="col-md-3 col-form-label">Inline Radios</label> --}}
                                <div class="col-md-9 col-form-label">
                                <div class="form-check form-check-inline mr-1">
                                <input class="form-check-input" id="gender" checked type="radio" value="male" name="gender">
                                <label class="form-check-label" for="gender">Male</label>
                                </div>
                                <div class="form-check form-check-inline mr-1">
                                <input class="form-check-input" id="gender" type="radio" value="female" name="gender">
                                <label class="form-check-label" for="gender">Female</label>
                                </div>
                                </div>
                                </div>

                            <div class="form-group">
                                <label>{{ __('Утасны дугаар') }}</label>
                                <input type="text" name="phone" id="phone" class="form-control" placeholder="phone">
                            </div>

                            <div class="form-group">
                                <label>{{ __('Гэрийн хаяг') }}</label>
                                <textarea  name="address" class="form-control" id="address" placeholder="address"></textarea>
                            </div>
                            <div class="modal-footer">
                                 <button type="submit" class="btn btn-primary" id="saveBtn" value="create"> {{ __('Бүртгэх') }}
                                 </button>
                                 <button type="button" data-dismiss="modal" class="btn btn-danger" id="" value=""> {{ __('Цуцлах') }}
                                </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
             </div>

          </div>
        </div>

@endsection
@section('javascript')
<style>
    div.dataTables_wrapper div.dataTables_length select {
    width: 60px!important;
    display: inline-block;
}
</style>

<script>

$(function () {

    var table = $('.yajra-datatable').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('participants.index') }}",
        columns: [{
                data: 'DT_RowIndex',
                name: 'DT_RowIndex'
            },
            {
                data: 'firstname',
                name: 'firstname'
            },
            {
                data: 'email',
                name: 'email'
            },
            {
                data: 'created_at',
                name: 'created_at'
            },
            {
                data: 'name',
                name: 'name'
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

<<<<<<< HEAD

});

   var modalType = false;
   var url = '';
   $('#createNewItem').click(function () {
       document.getElementById('PartipicantForm').reset();
        $('#saveBtn').val("create-Item");
        $('#id').val('');
        modalType = true;
        $('#PartipicantForm').trigger("PartipicantForm");
        $('#modelHeading').html("Харилцагч бүртгэх");
        $('#ajaxModel').modal('show');
    });

     /* Edit customer */
     var participant_id = '';
     $('body').on('click', '.edit', function () {
        participant_id  = $(this).data('id');
      $.get("{{ route('participants.index') }}" +'/' + participant_id +'/edit', function (data) {
=======
$('#createNewItem').click(function () {
    $('#saveBtn').val("create-Item");
    $('#id').val('');
    $('#PartipicantForm').trigger("PartipicantForm");
    $('#modelHeading').html("Харилцагч бүртгэх");
    $('#ajaxModel').modal('show');
});

/* Edit customer */
$('body').on('click', '.edit', function () {
    var participant_id = $(this).data('id');
    $.get("{{ route('participants.index') }}" + '/' + participant_id + '/edit', function (data) {
>>>>>>> origin/ganaa
        $('#saveBtn').val("edit-Item");
        $('#saveBtn').html('Хадгалах');
        $('#modelHeading').html("Харилцагч засах");
        $('#ajaxModel').modal('show');
        $('#id').val(data.id);
        $('#firstname').val(data.firstname);
        $('#lastname').val(data.lastname);
        $('#phone').val(data.phone);
        $('#gender[value="'+ data.gender +'"]').attr('checked', true);
        $('#address').val(data.address);
        $('#dob').val(data.dob);
        $('#register').val(data.register);
        $('#email').val(data.email);
    })
});

$('body').on('click', '.view', function () {
    var participant_id = $(this).data('id');
    var url = "{{ route('participants.show', ':id')}}";
    url = url.replace(':id', participant_id);
    document.location.href = url;
});

<<<<<<< HEAD
    $('#saveBtn').click(function (e) {
        e.preventDefault();
        // alert(participant_id);
        if (modalType) {
            url = "{{ route('participants.store') }}";
        } else {
            url = "participants/update/"+participant_id

        }
        // alert(url);
        $.ajax({
          data: $('#PartipicantForm').serialize(),
          url: url,
          type: "POST",
          dataType: 'json',
          success: function (data) {
            // console.log('Success :', data);
              $('#PartipicantForm').trigger("reset");
              $('#ajaxModel').modal('hide');
            //   alert("Data saved");
              Swal.fire({
                position: 'middle',
                icon: 'success',
                title: "Мэдэгдэл",
                text: JSON.stringify(data.msg),
                showConfirmButton: true,
                timerProgressBar : true
          })

            $('#user_table').DataTable().ajax.reload();

          },
          error: function (data) {
            // $('#saveBtn').html('Save Changes');
              console.log('Алдаа гарсан :', data.responseJSON.errors);
              printErrorMsg(data.responseJSON.errors);
          }
      });
    });

    function printErrorMsg (msg) {
    var values = '<ul style="list-style-type: none;">';
    jQuery.each(msg, function (key, value) {
         values += "<li style = 'color:red;'>" + value + "</li>"
    });
    values += '</ul>';

            Swal.fire({
                position: 'top-end',
                icon : "info",
                toast: true,
                timerProgressBar: true,
                showClass: {
                popup: 'animate__animated animate__fadeInDown'
                },
                hideClass: {
                popup: 'animate__animated animate__fadeOutUp'
                },
                html:values,
                showConfirmButton: false,
                timer: 3000
            })
        }
=======
$('#saveBtn').click(function (e) {
e.preventDefault();
$(this).html('Илгээж байна..');
$.ajax({
    data: $('#PartipicantForm').serialize(),
    url: "{{ route('participants.store') }}",
    type: "POST",
    dataType: 'json',
    success: function (data) {
        console.log('Success :', data);
        $('#PartipicantForm').trigger("reset");
        $('#ajaxModel').modal('hide');
        table.draw();

    },
    error: function (data) {
        // $('#saveBtn').html('Save Changes');
        console.log('Алдаа гарсан :', data.responseJSON.errors);
        printErrorMsg(data.responseJSON.errors);
    }
});
});

function printErrorMsg(msg) {
$(".print-error-msg").find("ul").html('');
$(".print-error-msg").css('display', 'block');
$.each(msg, function (key, value) {
    $(".print-error-msg").find("ul").append('<li>' + value + '</li>');
});
}
>>>>>>> origin/ganaa

$('body').on('click', '.delete', function () {
var id = $(this).data("id");
//  var firstname = $(this).data("firstname");
<<<<<<< HEAD
//  console.log("participant id - " + id);
 Swal.fire({
  title: 'Are you sure?',
  text: "You won't be able to revert this!",
  icon: 'warning',
  showCancelButton: true,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  confirmButtonText: 'Yes, delete it!'
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
      'Your file has been deleted.',
      'success'
    )
  }
})


});
=======
console.log("participant id - " + id);
if (confirm("Are You sure want to delete - " + id)) {
    $.ajax({
        type: "get",
        url: "participants/destroy/" + id,
        success: function (data) {
            setTimeout(function () {
                $('#confirmModal').modal('hide');
                $('#user_table').DataTable().ajax.reload();
                alert('Data Deleted');
            }, 1000);
        },
        error: function (data) {
            console.log('Error:', data);
        }
    });
}
}); 
>>>>>>> origin/ganaa
</script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
@endsection

