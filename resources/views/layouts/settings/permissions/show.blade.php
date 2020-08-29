@extends('layouts.app')

@section('content')

<div class="container">

    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Зөвшөөрөл') }}</div>

                <div class="card-body">                    
                        
                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Нэр') }}</label>

                            <div class="col-md-6">                                
                                <label class="form-control">
                                    {{ $permission->name }}
                                </label>
                                                               
                            </div>

                        </div>
                        
                        <div class="form-group row">
                            <label for="guard_name" class="col-md-4 col-form-label text-md-right">{{ __('Хамгаалалт') }}</label>

                            <div class="col-md-6">
                                
                                <label class="form-control">
                                    {{ $permission->guard_name }}
                                </label>                                
                                
                            </div>

                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">                                
                                
                                <a href="{{ route('permission.index') }}" class="btn btn-primary">
                                    {{ __('Буцах') }}                                    
                                </a>
                            </div>
                        </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
