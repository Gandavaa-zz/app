@extends('layouts.app')

@section('content')

<div class="container">

    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Шинэ Асуулт') }}</div>

                <div class="card-body">
           
                    <form method="POST" action="{{ route('quiz.store')}}" enctype="multipart/form-data">
                       
                        @csrf
                        
                        @if(count($errors))
                        <ul>
                        @foreach ($errors->all() as $error)
                            <li><strong>{{ $error }}</strong></li>
                        @endforeach
                        </ul>
                        @endif
                        <input type="hidden" name="test_id" value="{{ $test->id }} ">
                        <div class="form-group row">

                            <label for="number" class="col-md-4 col-form-label text-md-right">{{ __('Тоо') }}</label>

                            <div class="col-md-6">

                                <input id="number" type="title" class="form-control @error('title') is-invalid @enderror" name="number" value="{{ old('number') }}" autocomplete="number" autofocus>

                                @error('number')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                        </div>

                        <div class="form-group row">

                            <label for="quiz" class="col-md-4 col-form-label text-md-right">{{ __('Асуулт') }}</label>

                            <div class="col-md-6">
                                <textarea id="quiz" class="form-control @error('quiz') is-invalid @enderror" name="quiz" value="{{ old('quiz') }}" >
                                </textarea>

                                @error('quiz')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <!-- Хэрвээ mестийн төрөл image бвал энэ утгийг харуулна -->                        
                        <div class="form-group row">
                            <label for="info" class="col-md-4 col-form-label text-md-right">{{ __('Зураг оруулах') }}</label>                                                        
                            <div class="col-md-6">
                                <input type="file" name="image" class="form-control-file" id="exampleFormControlFile1">
                                @error('image')
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
                                <a href="{{ route('settings.test') }}" class="ml-1 btn btn-danger">
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
