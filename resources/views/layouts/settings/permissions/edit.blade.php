@extends('layouts.app')

@section('content')

<div class="container">

    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Зөвшөөрөл засах') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('permission.update', $permission->id) }}">
                        @csrf
                        @method('PUT')

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Нэр') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $permission->name }}" required autocomplete="name" autofocus>
                                
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                        </div>
                        
                        <div class="form-group row">
                            <label for="guard_name" class="col-md-4 col-form-label text-md-right">{{ __('Хамгаалалт') }}</label>

                            <div class="col-md-6">
                                <input id="guard_name" type="text" class="form-control @error('guard_name') is-invalid @enderror" name="guard_name" value="{{ $permission->guard_name }}" required autocomplete="guard_name" autofocus>
                                
                                @error('guard_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Хадгалах') }}                                    
                                </button>
                                
                                <a href="{{ route('permission.index') }}" class="btn btn-danger">
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
