@extends('layouts.app')

@section('content')

<div class="container">

    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header"><strong>"{{ $role->name }}" {{ __('эрх засах') }}</strong></div>
        
                <div class="card-body">
                    <form method="POST" action="/role/{{$role->id}}">
                        @csrf
                        @method('PUT')

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Нэр') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $role->name }}" required autocomplete="name" autofocus>
                                
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                        </div>
                        
                        <!-- <div class="form-group row">
                            <label for="guard_name" class="col-md-4 col-form-label text-md-right">{{ __('Хамгаалалт') }}</label>
                            
                            <div class="col-md-6">                                
                                
                                @if(array_keys(config('auth.guards')))
                                <select name="guard_name" id="permission" class="form-control @error('guard_name') is-invalid @enderror">
                                            @foreach(array_keys(config('auth.guards')) as $guard)
                                            <option value="{{ $guard }}">{{ $guard }}</option>
                                        @endforeach
                                </select>     
                            
                                @endif
                                    
                                @error('guard_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                        </div> -->

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Засах') }}                                    
                                </button>
                                <a href="{{ route('role.index') }}" class="btn btn-danger">
                                    {{ __('Цуцлах') }}                                    
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
