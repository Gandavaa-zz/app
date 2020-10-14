@extends('layouts.app')

@section('content')

<div class="container">

    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <strong>{{ __('Асуулт засах') }}</strong></div>

                <div class="card-body">
                    <form method="POST" action="{{ route('answer.update', $answer->id) }}">
                        @csrf
                        @method('PUT')

                        <input type="hidden" name="quiz_id" value="{{ $answer->quiz->id }}">

                        <div class="form-group row">

                            <label for="number" class="col-md-4 col-form-label text-md-right">{{ __('Хариултын дугаар') }}</label>

                            <div class="col-md-6">
                                
                                <input id="number" type="text" class="form-control @error('number') is-invalid @enderror" name="number" value="{{ $answer->number }}" required autocomplete="answer" autofocus>

                                @error('number')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                        </div>

                        <div class="form-group row">

                            <label for="number" class="col-md-4 col-form-label text-md-right">{{ __('Асуулт') }}</label>

                            <div class="col-md-6">
                                
                                <input id="quiz" type="text" class="form-control @error('quiz') is-invalid @enderror" value="{{ $answer->quiz->quiz }}">
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
                                <textarea id="answer" type="text" class="form-control @error('answer') is-invalid @enderror" name="answer" required >{{ $answer->answer }}</textarea>
                                
                                @error('quiz')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                        </div>


                        <div class="form-group row">
                            <label for="quiz" class="col-md-4 col-form-label text-md-right">{{ __('Зураг') }}</label>

                            <div class="col-md-6">
                                <answer-picture :answer="{{ $answer}}"></answer-picture>

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
                                    {{ __('Засах') }}
                                </button>

                                <a href="{{ route('answer.index', $answer->id) }}" class="ml-1 btn btn-danger">
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
