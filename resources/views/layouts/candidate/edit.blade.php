@extends('layouts.app')

@section('content')

<div class="container">

    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <strong>{{ __('Хэрэглэгч засах') }}</strong></div>

                <div class="card-body">

                    <form method="POST" action="{{ route('candidate.update', ['candidate'=>$candidate->id] ) }}" enctype="multipart/form-data" >
                        @csrf
                        @method('PUT')
                        <div class="container">
                            <div class="row">
                                <div class="col-md-10 mx-auto">
                                    @foreach ($errors->all() as $message)
                                            {{ $message }}
                                        @endforeach
                                        <div class="form-group row">
                                            <div class="col-sm-6">
                                                <label for="firstname">Нэр</label>
                                                <input id="firstname" value="{{ $candidate->firstname }}" placeholder="Нэр оруулна уу..." type="firstname" class="form-control @error('firstname') is-invalid @enderror" name="firstname" value="{{ old('firstname') }}" autocomplete="firstname" autofocus>
                                                @error('firstname')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                            <div class="col-sm-6">
                                                <label for="lastname">Эцэг/эх-н нэр</label>
                                                <input id="lastname" value="{{ $candidate->lastname }}" placeholder="Нэр оруулна уу..." type="lastname" class="form-control @error('lastname') is-invalid @enderror" name="lastname" value="{{ old('lastname') }}" autocomplete="lastname" autofocus>
                                                @error('lastname')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <div class="col-sm-6">
                                                <label for="email">Цахим хаяг</label>
                                                <input id="email" value="{{ isset($candidate->email) ? $candidate->email : old('email') }}" placeholder="...@example.com" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" autocomplete="email" autofocus>
                                                @error('email')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                            <div class="col-sm-6">
                                                <label for="birthday">Төрсөн огноо</label>
                                                <input id="birthday" value="{{ isset($candidate->birthday) ? $candidate->birthday : old('birthday') }}"
                                                    placeholder="Огноо сонгоно уу..."
                                                    type="date"
                                                    class="form-control @error('dob') is-invalid @enderror"
                                                    name="birthday"
                                                    value="{{ old('birthday') }}"
                                                    autocomplete="birthday" autofocus>
                                                @error('birthday')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-sm-6">
                                                <label for="gender">Хүйс</label>
                                                <div class="col-form-label">
                                                    <div class="form-check form-check-inline mr-1">
                                                        <input class="form-check-input" id="gender"  {{ $candidate->gender =="male" ? "checked" : "" }} type="radio" value="male" name="gender">
                                                        <label class="form-check-label" for="gender">Эр</label>
                                                    </div>
                                                    <div class="form-check form-check-inline mr-1">
                                                        <input class="form-check-input" id="gender" {{ $candidate->gender  == 'female' ? "checked" : "" }} type="radio" value="female" name="gender">
                                                        <label class="form-check-label" for="gender">Эм</label>
                                                    </div>
                                                </div>
                                                @error('gender')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                            <div class="col-sm-6">
                                                <label for="groups">Байгууллага</label>
                                                <select class="form-control" id="company_id" name="company_id">
                                                    @foreach ($company as $item )
                                                        <option @if($item->id == $candidate->company_id) 'selected' @endif value="{{ $item->id }}">{{$item->company}}</option>
                                                    @endforeach

                                                </select>

                                                @error('company')
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
                                    {{ __('ЗАСАХ') }}
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
@endsection
