@extends('dashboard.base')

@section('content')

        <div class="container-fluid">
          <div class="animated fadeIn">
            <div class="row">
              <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                <div class="card">
                    <div class="card-header">
                      
                      <span class="float-left"><h5><i class="fa fa-align-justify"></i>{{ __('Тест') }}</h5></span> <span class="float-right">
                    <a class="btn btn-primary" href="{{ route('create.test') }}">Шинэ</a></span>
                    </div>
                    <div class="card-body">
                        <table class="table table-responsive-sm table-striped">
                        <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Test</th>                                                
                            <th scope="col">Дэлгэрэнгүй</th>
                            <th scope="col">Төрөл</th>
                            <th scope="col">Цаг</th>
                            <th scope="col">Үйлдэл</th>
                        </tr>
                        </thead>
                        <tbody>
                            
                            @php ($i = 1)               
                            @foreach ($tests as $test) 
                            <tr>
                                <th scope="row">{{ $i++ }} </th>
                                <td>{{ Str::limit($test->title, 20) }}</td>                                                        
                                <td>{{ Str::limit($test->info, 20) }}</td>
                                <td>{{ $test->type }}</td>
                                <td>{{ $test->duration }}</td>                          
                                <td>                    
                                    <!-- <a href="#" class="btn btn-primary btn-sm" title="Add"><i class="fas fa-plus"></i></a>                     -->
                                    <a href="/admin/tests/{{$test->id}}/edit" class="btn btn-primary btn-sm" title="Edit"><i class="fas fa-pencil-alt"></i></a>                    
                                    <a href="#" class="btn btn-danger btn-sm" title="Edit"><i class="fas fa-trash-alt"></i></a>                    
                                </td>                                
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    </div>
                </div>
              </div>
            </div>
          </div>
        </div>

@endsection


@section('javascript')

@endsection

