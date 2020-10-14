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
                    <button type="button" id="deleteMultiple" class="btn btn-danger deleteMultiple"  href="javascript:void(0)" data-original-title="Delete">Олноор устгах</button>
                    <a class="btn btn-primary" href="{{ route('participants.create') }}"><i class="cil-plus"></i>Шинэ</a></span>

                    </div>

                    <div class="card-body">
                    @include('layouts.shared.alert')

                        <table class="table table-bordered yajra-datatable user_table " id="user_table" style="width: 100%; font-size:13.5px;">
                            <thead>
                                <tr>
                                    <th width="3px"><input type="checkbox" id="selectAll"/></th>
                                    <!-- <th width="5px">#</th> -->
                                    <th>Нэр, овог</th>                                    
                                    <th>Үүссэн.огноо</th>
                                    <th>Үүсгэсэн</th>
                                    <th width="10px">Групп</th>
                                    <th width="500px">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                        <div class="modal fade" id="groupModal" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog .modal-dialog-centered" role="document">
                              <div class="modal-content">
                                  <div class="modal-header">
                                      <h4 class="modal-title">Групп-д нэмэх</h4>
                                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                      </button>
                                  </div>
                                  <div class="modal-body">
                                    <div class="form-group">
                                        <form method="POST" action="">
                                            @csrf
                                            <input type="hidden" name="user_id" id="user_id">
                                            <div class="form-group row">
                                                <label for="groups" class="col-md-2 col-form-label text-md-right">{{ __('Групп') }}</label>
                                                <div class="col-md-8">
                                                    <group {{--:selected="{{ $group_names->pluck('name') }}"--}} class="@error('groups') is-invalid @enderror"></group>
                                                    @error('groups')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                            <button type="submit" class="btn btn-success" >Хадгалах</button>
                                            </div>
                                      </form>
                                    </div>
                                  </div>
                              </div>
                            </div>
                          </div>

                      {{-- {{ $users->links() }}  --}}
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
        columns: [
            {
                data: 'checkbox',
                name: 'checkbox',
                orderable: false,
                searchable: false
            },
            // {
            //     data: 'DT_RowIndex',
            //     name: 'DT_RowIndex'
            // },
            {
                data: 'fullname',
                name: 'fullname',
                render: function(data, type, row) {
                    return "<a style='color:#4F5D73;font-weight:bold' href='/participants/show/"+ row.id +"'>" + row.fullname + "</a>"
                }
            },
            // {
            //     data: 'email',
            //     name: 'email'
            // },
            {
                data: 'created_at',
                name: 'created_at'
            },
            {
                data: 'created_by',
                name: 'created_by'
            },
            {
                data: "groups.0.name",
                name: "groups"
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
@endsection

