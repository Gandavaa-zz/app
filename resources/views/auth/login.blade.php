@extends('layouts.authBase')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card-group">
                <div class="card p-4">
                    <div class="card-body">
                        <h2>Нэвтрэх</h2>
                        <p class="text-muted"></p>
                        <form method="POST" action="{{ route('login') }}">
                            @csrf
                          
                            @if($errors->any())          
                                <ul class="alert alert-danger" role="alert">                              
                                    @foreach($errors->all() as $error)
                                    <li>{{ $error }} </li>
                                    @endforeach
                                </ul>
                            @endif
                            
                            <div class="input-group mb-3">                                
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="cil-user"></i>
                                    </span>
                                </div>
                                <input class="form-control" type="text" placeholder="{{ __('Имэйл хаяг') }}"
                                    name="email" value="{{ old('email') }}" required autofocus>
                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="input-group mb-4">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="cil-lock-locked"></i>
                                    </span>
                                </div>
                                <input class="form-control" type="password" placeholder="{{ __('Нууц үг') }}"
                                    name="password" required>
                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <input class="" type="checkbox" placeholder="{{ __('Нууц үг') }}" name="remember_me"
                                        id="remember_me">
                                    <label for="remember_me">Намайг сана</label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <button class="btn btn-primary px-4" type="submit">{{ __('Нэвтрэх') }}</button>
                                </div>
                                <div class="col-6 text-right">
                                    <a href="{{ route('password.request') }}"
                                        class="btn btn-link px-0">{{ __('Нууц үгээ мартсан?') }}</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

@endsection

@section('javascript')

@endsection
