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
                    <a class="btn btn-primary" href="javascript:void(0)" id="createNewItem">Шинэ</a>
                    </div>

                    <div class="card-body">

                    @include('layouts.shared.alert')

                        <table class="table table-bordered yajra-datatable">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>fullname</th>
                                    <th>email</th>
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
                                <input type="text" name="lastname" class="form-control" placeholder="Эцэг/эх-н нэр оруулна уу..." autocomplete="lastname" autofocus>
                            </div>

                            <div class="form-group">
                                <label>{{ __('Нэр') }}</label>
                                <input type="text" name="firstname" class="form-control" placeholder="Last Name">
                            </div>

                            <div class="form-group">
                                <label>{{ __('Цахим хаяг') }}</label>
                                <input type="text" name="email" class="form-control" placeholder="Email">
                            </div>

                            <div class="form-group">
                                <label>{{ __('Регистерийн дугаар') }}</label>
                                <input type="text" name="register" class="form-control" placeholder="register">
                            </div>

                            <div class="form-group">
                                <label>{{ __('Төрсөн огноо') }}</label>
                                <input class="form-control" id="dob" type="date" name="date-input" placeholder="age">
                            </div>

                            <div class="form-group row">
                                {{-- <label class="col-md-3 col-form-label">Inline Radios</label> --}}
                                <div class="col-md-9 col-form-label">
                                <div class="form-check form-check-inline mr-1">
                                <input class="form-check-input" id="gender" type="radio" value="male" name="gender">
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
                                <input type="text" name="phone" class="form-control" placeholder="phone">
                            </div>

                            <div class="form-group">
                                <label>{{ __('Гэрийн хаяг') }}</label>
                                <textarea  name="address" class="form-control" placeholder="address"></textarea>
                            </div>
                            <div class="modal-footer">
                                 <button type="submit" class="btn btn-primary" id="saveBtn" value="create"> {{ __('Бүртгэх') }}
                                 </button>
                                 <button type="submit" class="btn btn-danger" id="" value=""> {{ __('Цуцлах') }}
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

<script type="text/javascript">
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    </script>

<script>
   $('#createNewItem').click(function () {
        $('#saveBtn').val("create-Item");
        $('#id').val('');
        $('#PartipicantForm').trigger("PartipicantForm");
        $('#modelHeading').html("Харилцагч бүртгэх");
        $('#ajaxModel').modal('show');
    });
    $('body').on('click', '.editItem', function () {
      var Item_id = $(this).data('id');
      $.get("{{ route('participants.index') }}" +'/' + id +'/edit', function (data) {
          $('#modelHeading').html("Edit Item");
          $('#saveBtn').val("edit-user");
          $('#ajaxModel').modal('show');
          $('#id').val(data.id);
          $('#firstname').val(data.firstname);
          $('#lastname').val(data.lastname);
          $('#email').val(data.email);
      })
   });

    $('#saveBtn').click(function (e) {
        e.preventDefault();
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
              console.log('Алдаа гарсан :', data.responseJSON.errors);
              printErrorMsg(data.responseJSON.errors);
          }
      });
    });

    function printErrorMsg (msg) {
            $(".print-error-msg").find("ul").html('');
            $(".print-error-msg").css('display','block');
            $.each( msg, function( key, value ) {
                $(".print-error-msg").find("ul").append('<li>'+value+'</li>');
            });
        }


</script>
@endsection

