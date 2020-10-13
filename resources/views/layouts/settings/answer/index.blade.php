@extends('layouts.app')

@section('content')

        <div class="container-fluid"> 

          <div class="animated fadeIn">

          <div class="form-group row">

            <label for="test" class="col-md-3 text-md-right">
                <h5 class="mt-2">
                {{ __('Асуулт:') }}
                </h5>
            </label>

            <div class="col-md-6">
                                        
                    <select name="quiz_id" id="" class="form-control" onchange="javascript:location.href = this.value;">
                        <option>Нэг утгийг сонго</option>
                        @foreach($quizzes as $quiz)
                            <option value="{{ $quiz->id }}"> {{ $quiz->quiz }} </option>                                    
                        @endforeach
                    </select>
                    
                </div>
            </div>

            <div class="row">

              <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">

                 <div class="card">
                    <div class="card-header">

                        <span class="float-left"><h5><i class="fa fa-align-justify"></i>{{ __('Хариулт') }}</h5></span>

                        <span class="float-right px-1">                        
                            <a class="btn btn-primary" href="{{ route('answer.create', $quiz->id) }}">Шинэ хариулт</a>
                            <a class="btn btn-success" href="{{ route('quiz.index', $quiz->test->id) }}">Асуулт жагсаалт</a>
                        </span>      
                    </div>

                    <div class="card-body">
                        
                        @include('layouts.shared.alert')
                                                
                        <table class="table table-responsive-sm table-striped quiz-table">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Хариулт №</th>
                                <th scope="col">Хариулт</th>
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
        url: "{{ route('answer.index', $quiz->id) }}",
        type: 'get'       
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
            data: 'answer',
            name: 'answer'
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

