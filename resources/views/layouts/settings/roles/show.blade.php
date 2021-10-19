@extends('layouts.app')

@section('content')

<div class="container">

    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header"><strong>"{{ $role->name }}" {{ __('роль засах') }}</strong></div>
        
                <div class="card-body">
                    <form method="POST" action="/role/{{$role->id}}">
                        @csrf
                        @method('PUT')

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Нэр') }}</label>

                            <div class="col-md-6">
                                <label id="name" class="form-control @error('name') is-invalid @enderror">
                                {{ $role->name }}
                                </label>
                                
                            </div>

                        </div>
                        
                        <div class="form-group row">                            
                            <label for="tests" class="col-md-4 col-form-label text-md-right">{{ __('Зөвшөөрөл') }}</label>
                            
                            <div class="col-md-6">   
                                
                                <textarea id="guard_name" rows="5" class="form-control @error('guard_name') is-invalid @enderror" name="guard_name" >{{$role->permissions->pluck('name')}} </textarea>
                                
                                @error('guard_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">     
                                <a href="{{ route('role.index') }}" class="btn btn-danger">
                                    {{ __('Буцах') }}                                    
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
