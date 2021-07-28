@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Шинэ харилцагч бүртгэх') }}</div>
                <div class="card-body">
                    <form method="POST" action="{{ route('candidate.store') }}">
                        @csrf
                        <div class="container py-5">
                            <div class="row">
                                <div class="col-md-10 mx-auto">
                                    <form>
                                        <div class="form-group row">
                                            <div class="col-sm-6">
                                                <label for="lastname">Эцэг/эх-н нэр</label>
                                                <input id="lastname" placeholder="Нэр оруулна уу..." type="lastname" class="form-control @error('lastname') is-invalid @enderror" name="lastname" value="{{ old('lastname') }}" autocomplete="lastname" autofocus>
                                                @error('lastname')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                            <div class="col-sm-6">
                                                <label for="firstname">Нэр</label>
                                                <input id="firstname" placeholder="Нэр оруулна уу..." type="firstname" class="form-control @error('firstname') is-invalid @enderror" name="firstname" value="{{ old('firstname') }}" autocomplete="firstname" autofocus>
                                                @error('firstname')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <!-- <div class="col-sm-6">
                                                <label for="register">Регистерийн дугаар</label>
                                                <input id="register" placeholder="Регистер оруулна уу..." type="register" class="form-control @error('register') is-invalid @enderror" name="register" value="{{ old('register') }}" autocomplete="register" autofocus>
                                                @error('register')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div> -->
                                            <div class="col-sm-6">
                                                <label for="phone">Утасны дугаар</label>
                                                <input id="phone" placeholder="Утасны дугаар оруулна уу..." type="phone" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ old('phone') }}" autocomplete="phone" autofocus>
                                                @error('phone')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                            <div class="col-sm-6">
                                                <label for="email">Имэйл хаяг</label>
                                                <input id="email" placeholder="Имэйл хаяг оруулах" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" autocomplete="email" autofocus>
                                                @error('email')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group row">

                                            <div class="col-sm-6">
                                                <label for="dob">Төрсөн огноо</label>
                                                <input id="dob" placeholder="Огноо сонгоно уу..." type="date" class="form-control @error('dob') is-invalid @enderror" name="dob" value="{{ old('dob') }}" autocomplete="dob" autofocus>
                                                @error('dob')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                            <div class="col-sm-6">
                                                <label for="gender">Хүйс</label>
                                                <div class="col-form-label">
                                                    <div class="form-check form-check-inline mr-1">
                                                        <input class="form-check-input" id="gender"  checked type="radio" value="male" name="gender">
                                                        <label class="form-check-label" for="gender">Эр</label>
                                                    </div>
                                                    <div class="form-check form-check-inline mr-1">
                                                        <input class="form-check-input" id="gender" type="radio" value="female" name="gender">
                                                        <label class="form-check-label" for="gender">Эм</label>
                                                    </div>
                                                </div>
                                              </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-sm-6">
                                                <label for="groups">Group</label>  <group  class="@error('groups') is-invalid @enderror"></group>
                                                @error('groups')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-3 float-right">
                                <button type="submit" class="btn btn-success">
                                    {{ __('Хадгалах') }}
                                </button>

                                <a href="{{ route('candidate.index') }}" class="ml-1 btn btn-primary">
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
<!-- Initialize the plugin: -->
@endsection
