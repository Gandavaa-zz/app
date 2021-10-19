@extends('layouts.app')

@section('content')

<div class="container">

    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <strong>{{ __('Хэрэглэгч засах') }}</strong></div>

                <div class="card-body">
                    <form method="POST" action="{{ route('users.update', $user->id) }}">
                        @csrf
                        @method('PUT')

            

                        <div class="form-group row">
                            <label for="firstname" class="col-md-4 col-form-label text-md-right">{{ __('Нэр') }}</label>

                            <div class="col-md-6">
                                <input id="firstname" type="text" class="form-control @error('firstname') is-invalid @enderror" name="firstname" value="{{ $user->firstname }}" required autocomplete="firstname" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                        </div>

                        <div class="form-group row">
                            <label for="last" class="col-md-4 col-form-label text-md-right">{{ __('Овог') }}</label>

                            <div class="col-md-6">
                                <input id="lastname" type="text" class="form-control @error('lastname') is-invalid @enderror" name="lastname" value="{{ $user->lastname }}" required autocomplete="lastname" autofocus>

                                @error('lastname')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('Имэйл') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $user->email }}" autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                       <div class="form-group row">
                            <label for="tests" class="col-md-4 col-form-label text-md-right">{{ __('Роль') }}</label>

                            <div class="col-md-6">
                                <my-select :selected="{{$user->getRoleNames()->toJson()}}" class="@error('roles') is-invalid @enderror"></my-select>

                                @error('roles')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                       <div class="form-group row">
                            <label for="groups" class="col-md-4 col-form-label text-md-right">{{ __('Групп') }}</label>
                            <div class="col-md-6">
                                <group :selected="{{ $user->groups->pluck('name') }}" class="@error('groups') is-invalid @enderror"></group>
                                @error('groups')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">                            
                            <label class="col-md-4 col-form-label text-md-right">Нууц Үг солих уу?</label>
                            <div class="col-md-6 col-form-label">
                                <div class="form-check checkbox">
                                    <input class="form-check-input " id="showPassword" name="changePassword" type="checkbox" value="1" {{ old("changePassword") == 1 ? 'checked' : ''}} />                                    
                                    <label class="form-check-label" for="showPassword">Тийм</label>
                                </div>
                            </div>
                        </div>

                        <div id="PasswordWrapper">                            
                            <div class="form-group row">
                                <label for="password" class="col-md-4 col-form-label text-md-right">Одоогийн Нууц Үг</label>
    
                                <div class="col-md-6">
                                    <input id="password" type="password" class="form-control @error('current_password') is-invalid @enderror" name="current_password" autocomplete="current-password">

                                    @error('current_password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
    
                            <div class="form-group row">
                                <label for="new_password" class="col-md-4 col-form-label text-md-right">Шинэ Нууц Үг</label>
    
                                <div class="col-md-6">
                                    <input id="new_password" type="password" class="form-control @error('new_password') is-invalid @enderror" name="new_password" autocomplete="new_password">
                                    @error('new_password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                  
                            </div>
    
                            <div class="form-group row">
                                <label for="new_confirm_password" class="col-md-4 col-form-label text-md-right">Нууц Үг Давтах</label>
    
                                <div class="col-md-6">
                                    <input id="new_confirm_password" type="password" class="form-control @error('new_confirm_password') is-invalid @enderror" name="new_confirm_password" autocomplete="current-password">
                                    
                                    @error('new_confirm_password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                    
                                </div>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Засах') }}
                                </button>

                                <a href="{{ route('users.index') }}" class="ml-1 btn btn-danger">
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

@section('javascript')
    <script>          
        
        $(function() {
            $('#PasswordWrapper').hide();     
            if($('#showPassword').is(":checked"))
                $('#PasswordWrapper').show();

            $('#showPassword').click(function() {
                if ($(this).is(":checked")) {                    
                    $('#PasswordWrapper').show();
                    // $('#showPassword').val($(this).is(':checked'));    
                }else {                                      
                    $('#PasswordWrapper').hide();
                }

            });
             
            
        });
    </script>
@endsection
@endsection
