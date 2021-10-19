@extends('layouts.app')

@section('content')

        <div class="container-fluid">
          <div class="animated fadeIn">
            <div class="row">
              <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                <div class="card">
                    <div class="card-header">                      
                      <div class="float-left"><h5 class="pt-2">{{ __('Эрх') }}</h5></div> 
                      <div class="float-right">
                          <a class="btn btn-primary" href="{{ route('role.create') }}">Шинэ
                            <svg class="c-icon">
                              <use xlink:href="{{ asset('icons/sprites/free.svg#cil-plus') }}"></use>                              
                            </svg>
                          </a>
                        </div>
                      </div>

                    <div class="card-body">

                        @include('layouts.shared.alert')

                        <table class="table table-responsive-sm table-striped">                    
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Нэр</th>                                                
                                <th scope="col">Хамгаалалт</th>                        
                                <th scope="col">Зөвшөөрөл</th>                        
                                <th scope="col">Үйлдэл</th>
                            </tr>
                            </thead>
                            <tbody>
                            
                            @php ($i = 1)               
                            @foreach ($roles as $role) 
                            <tr>
                                <th scope="row">{{ $i++ }} </th>
                                <td>{{ $role->name }}</td>
                                <td>{{ $role->guard_name }}</td>                            
                                <td>{{ $role->permissions->pluck('name') }}
                                </td>                            
                                <td>       
                                    <ul class="list-group list-group-horizontal list-unstyled">

                                        <li class="pr-1" title="Харах">
                                            <a href="{{ route('role.show', $role->id) }}" class="btn btn-secondary btn-sm">
                                            <i class="cil-magnifying-glass"></i>
                                            </a>
                                        </li>
                                                                                
                                        <li class="pr-1"><a href="/role/{{$role->id}}/edit"  class="btn btn-primary btn-sm" title="Засах">
                                          <i class="cil-pencil"></i></a></li>
                                       

                                        <li class="pr-1">
                                        <form  class="form-inline" action="/role/{{$role->id}}" method="POST">
                                            @method('DELETE')
                                            @csrf
                                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Та энэ бичлэгийг үнэхээр устгах уу?')"><i class="cil-trash"></i></button>                                    
                                        </form>
                                        </li>

                                        <li class="pr-1"><a href="/role/{{$role->id}}/permission"  class="btn btn-info btn-sm" title="Зөвшөөрөл"><i class="cil-lock-unlocked"></i></a></li>
                                    </ul>            
                                    
                                </td>                                
                            </tr>
                            @endforeach
                            </tbody>
                        </table>

                        {{ $roles->links() }}

                    </div>
                </div>
              </div>
            </div>
          </div>
        </div>

@endsection


@section('javascript')

@endsection
