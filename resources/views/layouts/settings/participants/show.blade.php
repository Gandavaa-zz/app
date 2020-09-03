@extends('layouts.app')

@section('content')

<div class="container">

    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <strong>{{ $user->firstname }}</strong>
                    </div>

                <div class="card-body">                    

                        <div class="form-group row">
                            <label for="firstname" class="col-md-4 col-form-label text-md-right">{{ __('Нэр') }}</label>

                            <div class="col-md-6">
                                <label  class="form-control">{{ $user->firstname }}</label>
                                
                            </div>

                        </div>
                        
                        <div class="form-group row">
                            <label for="last" class="col-md-4 col-form-label text-md-right">{{ __('Овог') }}</label>

                            <div class="col-md-6">
                                <label class="form-control">{{ $user->lastname }}</label>
                                
                            </div>

                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('Имэйл') }}</label>

                            <div class="col-md-6">
                                <label  class="form-control">{{ $user->email }}</label>
                            </div>
                        </div>
                        
                        @if($user->getRoleNames())
                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('Роль') }}</label>

                            <div class="col-md-6">
                                <label  class="form-control">{{ $user->getRoleNames()->implode('name', ', ') }}</label>
                            </div>
                        </div>
                        @endif
            
                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">                                
                                <a href="{{ route('users.index') }}" class="btn btn-primary">
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
