@extends('layouts.app')
   
@section('content')

<div class="container">
    <div class="row justify-content-center">

    <div class="col-md-12">

        <div class="card">
            <div class="card-header">
                <span class="float-left"><h5>Зөвшөөрөл</h5></span> 
                <span class="float-right"><a class="btn btn-primary" href="{{ route('permission.create')}} ">Шинэ</a></span>
            </div>

            <div class="card-body">

                @include('layouts.shared.alert')

                <table class="table">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Нэр</th>                                                
                        <th scope="col">Хамгаалалт</th>                        
                        <th scope="col">Үйлдэл</th>
                    </tr>
                    </thead>
                    <tbody>
                        
                        @php ($i = 1)               
                        @foreach ($permissions as $permission) 
                        <tr>
                            <th scope="row">{{ $i++ }} </th>
                            <td>{{ $permission->name }}</td>
                            <td>{{ $permission->guard_name }}</td>                            
                            <td>       
                                <ul class="list-group list-group-horizontal list-unstyled">
                                    <li class="pr-1">
                                        <a href="{{ route('permission.show', $permission->id ) }}"  class="btn btn-secondary btn-sm" title="Edit">
                                        <i class="cil-magnifying-glass"></i></a>
                                    </li>

                                    <li class="pr-1"><a href="{{ route('permission.edit', $permission->id ) }}"  class="btn btn-primary btn-sm" title="Edit">
                                        <i class="cil-pencil"></i></a>
                                    </li>
                                    <li class="pr-1">
                                    <form  class="form-inline" action="{{ route('permission.destroy', $permission->id) }}" method="POST">
                                        @method('DELETE')
                                        @csrf
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Та энэ бичлэгийг үнэхээр устгах уу?')">
                                            <i class="cil-trash"></i>
                                        </button>                                    
                                    </form>
                                    </li>
                                </ul>            
                                
                            </td>                                
                        </tr>
                        @endforeach
                    </tbody>
                </table>

                
                {{ $permissions->links() }}
            </div>

        </div>
        
    </div>

    </div>
</div>

@endsection
