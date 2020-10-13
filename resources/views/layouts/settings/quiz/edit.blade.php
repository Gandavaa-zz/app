@extends('layouts.app')

@section('content')

<div class="container">

    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <strong>{{ __('Хэрэглэгч засах') }}</strong></div>

                <div class="card-body">
                    <form method="POST" action="{{ route('quiz.update', $quiz->id) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <input type="hidden" name="test_id" value="{{ $test->id }}">

                        <div class="form-group row">

                            <label for="number" class="col-md-4 col-form-label text-md-right">{{ __('Асуултын дугаар') }}</label>

                            <div class="col-md-6">
                                <input id="number" type="text" class="form-control @error('number') is-invalid @enderror" name="number" value="{{ $quiz->number }}" required autocomplete="quiz" autofocus>

                                @error('number')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                        </div>

                        <div class="form-group row">
                            <label for="quiz" class="col-md-4 col-form-label text-md-right">{{ __('Гарчиг') }}</label>

                            <div class="col-md-6">
                                <textarea id="quiz" type="text" class="form-control @error('quiz') is-invalid @enderror" name="quiz" required >{{ $quiz->quiz }}</textarea>
                                
                                @error('quiz')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                        </div>

                        @if($quiz->quiz_path)
                        <div class="form-group row">
                            <label for="quiz" class="col-md-4 col-form-label text-md-right">{{ __('Зураг') }}</label>
                            
                            <div class="col-md-6">
                                
                                <quiz-picture :quiz="{{ $quiz }} ">
                                    
                                </quiz-picture>
                                                                        
                                    @error('image')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                        @endif

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Засах') }}
                                </button>

                                <a href="{{ route('quiz.index', $test->id) }}" class="ml-1 btn btn-danger">
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
