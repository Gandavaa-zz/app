@extends('layouts.app')

@section('content')
        <meta name="csrf-token" content="{{ csrf_token() }}" />
        <div class="container-fluid">
          <div class="animated fadeIn">
            <div class="row">
              <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                <div class="card">
                    <div class="card-header">
                        <span class="float-left"><h5><i class="fa fa-align-justify"></i>{{ __('Орчуулга') }}</h5></span> <span class="float-right">
                        <!-- <button type="button" id="deleteMultiple" class="btn btn-danger deleteMultiple"  href="javascript:void(0)" data-original-title="Delete">Олноор устгах</button> -->
                        <a class="btn btn-primary" href="{{ route('translations.create') }}"><i class="cil-plus"></i>Шинэ</a></span>
                    </div>

                    <div class="card-body">
                    @include('layouts.shared.alert')
                        <table class="table table-bordered yajra-datatable translation_table " id="translation_table" style="width: 100%; font-size:13.5px;">
                            <thead>
                                <tr>
                                    <!-- <th width="3px"><input type="checkbox" id="selectAll"/></th> -->
                                    <th width="5px">#</th>
                                    <th>Тест</th>
                                    <th>Орчуулга MN</th>
                                    <th>Орчуулга EN</th>
                                    <th width="250px">Үйлдэл</th>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
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
        ajax: "{{ route('translations.index') }}",
        columns: [
            // {
            //     data: 'checkbox',
            //     name: 'checkbox',
            //     orderable: false,
            //     searchable: false
            // },

            {
                data: 'id',
                name: 'id'
            },

            {
                data: 'test_id',
                name: 'test_id'
            },
            {
                data: 'EN',
                name: 'en'
            },

            {
                data: "MN",
                name: "mn"
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


$('body').on('click', '.delete', function () {
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
       url:"translations/destroy/"+id,
       success: function (data) {
        setTimeout(function(){
     $('#confirmModal').modal('hide');
     $('#translation_table').DataTable().ajax.reload();
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
