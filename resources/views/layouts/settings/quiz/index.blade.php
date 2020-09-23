@extends('layouts.app')

@section('content')

        <div class="container-fluid"> 

          <div class="animated fadeIn">

          <div class="form-group row">

            <label for="test" class="col-md-3 text-md-right">
                <h5 class="mt-2">
                {{ __('Тест:') }}
                </h5>
            </label>

            <div class="col-md-6">
                    <select name="" id="" class="form-control">
                        @foreach($tests as $test)
                            <option value="{{ $test->id }}"> {{ $test->title }} </option>                                    
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="row">

              <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">

                 <div class="card">
                    <div class="card-header">
                        <span class="float-left"><h5><i class="fa fa-align-justify"></i>{{ __('Асуулт') }}</h5></span>                        
                        <span class="float-right ">
                            <a class="btn btn-success" href="{{ route('settings.test') }}">Тест жагсаалт</a>
                            <a class="btn btn-danger px-1" href="#">Импорт Асуулт</a>
                            <a class="btn btn-primary" href="{{ route('quiz.create', $test->id) }}">Шинэ асуулт</a>
                        </span>
                    </div>

                    <div class="card-body">
                        
                        @include('layouts.shared.alert')
                                                
                        <table class="table table-responsive-sm table-striped quiz-table">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Асуулт №</th>
                                <th scope="col">Асуулт</th>
                                <th scope="col">Зураг</th>
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

var table = $('.quiz-table').DataTable({
    processing: true,
    serverSide: true,
    ajax: { 
        url: "{{ route('quiz.index', $test->id) }}",
        type: 'get',
        data: {
            test_id: "{{ $test->id }}"
               }    
    },
    columns: [{
            data: 'DT_RowIndex',
            name: 'DT_RowIndex'
        },
        {
            data: 'number',
            name: 'number'
        },
        {
            data: 'quiz',
            name: 'quiz'
        },        
        {
            data: 'image',
            name: 'image'
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

