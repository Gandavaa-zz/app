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
                    <div class="input-group mb-3">
                    <div class="input-group-prepend">
                      <span class="input-group-text">
                        <svg class="c-icon">
                          <use xlink:href="assets/icons/coreui/free-symbol-defs.svg#cui-user"></use>
                        </svg>
                      </span>
                    </div>
                    <input class="form-control" type="text" placeholder="{{ __('Имэйл хаяг') }}" name="email" value="{{ old('email') }}" required autofocus>
                    </div>
                    <div class="input-group mb-4">
                    <div class="input-group-prepend">
                      <span class="input-group-text">
                        <svg class="c-icon">
                          <use xlink:href="assets/icons/coreui/free-symbol-defs.svg#cui-lock-locked"></use>
                        </svg>
                      </span>
                    </div>
                    <input class="form-control" type="password" placeholder="{{ __('Нууц үг') }}" name="password" required>
                    </div>
                    <div class="row">
                      <div class="col-6">
                        <input class="" type="checkbox" placeholder="{{ __('Нууц үг') }}" name="remember_me" id="remember_me">
                        <label for="remember_me">Намайг сана</label>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-6">
                          <button class="btn btn-primary px-4" type="submit">{{ __('Нэвтрэх') }}</button>
                      </div>
                      <div class="col-6 text-right">
                          <a href="{{ route('password.request') }}" class="btn btn-link px-0">{{ __('Нууц үгээ мартсан?') }}</a>
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