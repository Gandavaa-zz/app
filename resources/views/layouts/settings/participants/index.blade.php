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

                    {{-- <a class="btn btn-primary" href="javascript:void(0)" id="createNewItem"><i class="cil-plus"></i>Шинэ</a>1 --}}
                    </div>

                    <div class="card-body">
                    @include('layouts.shared.alert')

                        <table class="table table-bordered yajra-datatable user_table " id="user_table">
                            <thead>
                                <tr>
                                    <th width="3px"><input type="checkbox" id="selectAll"/></th>
                                    <!-- <th width="5px">#</th> -->
                                    <th>Нэр, овог</th>                                    
                                    <th>Үүссэн.огноо</th>
                                    <th>Үүсгэсэн</th>
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
                name: 'fullname'
            },
            {
                data: 'created_date',
                name: 'created_date'
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
    text: "You won't be able to revert this!",
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Yes, delete it!'
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
                        text: 'Оролцогч сонгоно уу!'
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

});
</script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
@endsection

