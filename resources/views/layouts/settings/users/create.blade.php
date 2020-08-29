@extends('layouts.app')

@section('content')

<div class="container">

    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Шинэ хэрэглэгч') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('users.store') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="firstname" class="col-md-4 col-form-label text-md-right">{{ __('Нэр') }}</label>

                            <div class="col-md-6">
                                <input id="firstname" type="text" class="form-control @error('firstname') is-invalid @enderror" name="firstname" value="{{ old('firstname') }}" autocomplete="firstname" autofocus>
                                
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
                                <input id="lastname" type="text" class="form-control @error('lastname') is-invalid @enderror" name="lastname" value="{{ old('lastname') }}" required autocomplete="lastname" autofocus>
                                
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
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
<!-- 
                        <div class="form-group row">

                            <label for="user_type" class="col-md-4 col-form-label text-md-right">{{ __('Системийн хэрэглэгч үү?') }}</label>
                            
                            <div class="col-md-6">
                                
                               <input type="checkbox" v-model="user_type" name="user_type" id="user_type" class="ml-2 form-check-input @error('is_normal_user') is-invalid @enderror" autocomplete="user_type">                                
                                <a href="#" class="ml-4">Системийн хэрэглэгч гэж хэн бэ?</a>
                            </div>

                        </div> -->

                        <div class="form-group row" v-if="user_type">

                            <label for="user_type" class="col-md-4 col-form-label text-md-right">{{ __('Роль') }}</label>

                            <div class="col-md-6">

                            <select name="role" id="role" class="form-control @error('role') is-invalid @enderror">
                                    
                                    <option value="0">Дараах ролиос сонгоно уу!</option>
                                    @foreach($roles as $role)
                                    
                                    <option value="{{ $role->name }}">{{ $role->name }}</option>

                                    @endforeach

                                </select>                               

                                @error('role')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                        </div>

                        <!-- <div class="form-group row">
                            <label for="tests" class="col-md-4 col-form-label text-md-right">{{ __('Тест') }}</label>

                            <div class="col-md-6">

                               
                                @error('tests')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div> -->

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Бүртгэх') }}                                    
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
@endsection
