@extends('layouts.app')

@section('content')

<div class="container">

    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header"><strong>"{{ $user->firstname }}" {{ __('рольд өгөх') }}</strong></div>

                <div class="card-body">

                    @include('layouts.shared.alert')

                    <form method="POST" action="{{ route('user.giveRoles', $user->id) }}">
                        @csrf

                        <div class="form-group row">
                            <label for="lastname" class="col-md-4 col-form-label text-md-right">{{ __('Эцэг/Эх-н нэр') }}</label>

                            <div class="col-md-6">
                                <label  class="form-control">{{ $user->lastname }}</label>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                        </div>

                        <div class="form-group row">
                            <label for="firstname" class="col-md-4 col-form-label text-md-right">{{ __('Өөрийн нэр') }}</label>

                            <div class="col-md-6">
                            <label id="firstname"  class="form-control">{{ $user->firstname }}</label>

                            </div>

                        </div>

                        <div class="form-group row">
                            <label for="firstname" class="col-md-4 col-form-label text-md-right">{{ __('Имэйл') }}</label>

                            <div class="col-md-6">
                            <label id="firstname"  class="form-control">{{ $user->email }}</label>

                            </div>

                        </div>

                        <div class="form-group row">
                            <label for="tests" class="col-md-4 col-form-label text-md-right">{{ __('Роль') }}</label>

                            <div class="col-md-6">
                                    <my-select></my-select>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Хадгалах') }}
                                </button>
                                <a href="{{ route('users.index') }}" class="btn btn-danger">
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
