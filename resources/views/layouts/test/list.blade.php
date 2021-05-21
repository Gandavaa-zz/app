@extends('layouts.app')

@section('content')

        <div class="container-fluid">
          <div class="animated fadeIn">
            <div class="row">
              <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                <div class="card">
                    <div class="card-header">
                        <span class="float-left"><h5><i class="fa fa-align-justify"></i>{{ __('Тест') }}</h5></span> <span class="float-right">
                    </div>
                    <div class="card-body">
                        <table class="table table-responsive-sm table-striped test-table">
                        <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Төрөл</th>
                            <th scope="col">Тест нэр</th>
                            <th scope="col">Лого</th>
                            <th scope="col">Кредит</th>
                            <th scope="col">Үйлдэл</th>
                        </tr>
                        </thead>
                        <tbody>
                            @php ($i = 1)
                            @foreach ($tests as $test)
                            <tr>
                                <th scope="row">{{ $test->id }} </th>
                                <td>{{ $test->category }}</td>
                                <td>{{ $test->label }}</td>
                                <td><img src="{{ $test->logo }}" alt=""></td>
                                <td>{{ $test->duration }}</td>
                                <td>{{ $test->price_in_credits }}</td>
                                <td>
                                    <!-- <a href="#" class="btn btn-primary btn-sm" title="Add"><i class="fas fa-plus"></i></a>                     -->
                                    <a href="/admin/tests/{{$test->id}}/edit" class="btn btn-primary btn-sm" title="Edit"><i class="faы fa-pencil-alt"></i></a>
                                    <a href="#" class="btn btn-danger btn-sm" title="Edit"><i class="fas fa-trash-alt"></i></a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>

                    </table>
                        <div>
                            {{ $tests->links() }}
                        </div>
                    </div>
                </div>
              </div>
            </div>
          </div>
        </div>

@endsection


@section('javascript')
<script>
// $(function () {

// var table = $('.test-table').DataTable({
//     processing: true,
//     serverSide: true,
//     ajax: "{{ route('settings.test') }}",
//     columns: [{
//             data: 'DT_RowIndex',
//             name: 'DT_RowIndex'
//         },
//         {
//             data: 'firstname',
//             name: 'firstname'
//         },
//         {
//             data: 'email',
//             name: 'email'
//         },
//         {
//             data: 'created_at',
//             name: 'created_at'
//         },
//         {
//             data: 'name',
//             name: 'name'
//         },
//         {
//             data: 'action',
//             name: 'action',
//             orderable: true,
//             searchable: true

//         },
//     ]
// });

// });

</script>
@endsection

