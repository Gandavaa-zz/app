@extends('layouts.app')

@section('content')

<div class="container">

    <div class="row justify-content-center">

        <div class="col-md-12">

            <div class="card">

                <div class="card-header">{{ __('Шинэ хариулт') }}</div>

                <div class="card-body">
           
                    <form method="POST" action="{{ route('answer.store')}}">
                        @csrf
                        
                        <input type="hidden" name="quiz_id" value="{{ $quiz->id }} ">

                        <div class="form-group row">

                            <label for="number" class="col-md-4 col-form-label text-md-right">{{ __('Хариултын дугаар') }}</label>

                            <div class="col-md-6">

                                <input id="number" type="title" class="form-control @error('number') is-invalid @enderror" name="number" value="{{ old('number') }}" autocomplete="number" autofocus>

                                @error('number')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                        </div>

                        <div class="form-group row">

                            <label for="answer" class="col-md-4 col-form-label text-md-right">{{ __('Хариулт') }}</label>

                            <div class="col-md-6">
                                <textarea id="answer" class="form-control @error('answer') is-invalid @enderror" name="answer" value="{{ old('answer') }}" >
                                </textarea>

                                @error('answer')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <!-- Хэрвээ mестийн төрөл image бвал энэ утгийг харуулна -->                        
                        <div class="form-group row">
                            <label for="image" class="col-md-4 col-form-label text-md-right">{{ __('Зураг') }}</label>

                            <div class="col-md-6">
                                <input id="image" type="title" class="form-control @error('image') is-invalid @enderror" name="image" value="{{ old('image') }}" autocomplete="image" autofocus>

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
                                <a href="{{ route('answer.index', $quiz->id) }}" class="ml-1 btn btn-danger">
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
