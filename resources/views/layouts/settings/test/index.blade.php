@extends('layouts.app')

@section('content')

        <div class="container-fluid">
          <div class="animated fadeIn">
            <div class="row">
              <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                <div class="card">
                    <div class="card-header">                      
                        <span class="float-left"><h5><i class="fa fa-align-justify"></i>{{ __('Тест') }}</h5></span> <span class="float-right">
                    <a class="btn btn-primary" href="{{ route('settings.test.create') }}">Шинэ</a></span>
                    </div>

                    <div class="card-body">

                        @include('layouts.shared.alert')

                        <table class="table table-responsive-sm table-striped test-table">
                        <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Test</th>                                                
                            <th scope="col">Дэлгэрэнгүй</th>
                            <th scope="col">Төрөл</th>
                            <th scope="col">Үргэлж.хуг</th>
                            <th scope="col">Үйлдэл</th>
                        </tr>
                        </thead>                     
                    </table>
                    </div>
                </div>
              </div>
            </div>
          </div>
        </div>

@endsection


@section('javascript')
<script>
$(function () {

var table = $('.test-table').DataTable({
    processing: true,
    serverSide: true,
    ajax: "{{ route('settings.test') }}",
    columns: [{
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
            data: 'type',
            name: 'type'
        },
        {
            data: 'duration',
            name: 'duration'
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

</script>
@endsection

