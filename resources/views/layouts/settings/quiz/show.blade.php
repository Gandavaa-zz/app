@extends('layouts.app')

@section('content')

<div class="container">

    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <strong>{{ $test->title }}</strong></div>

                <div class="card-body">                    

                        <div class="form-group row">
                            <label for="title" class="col-md-4 col-form-label text-md-right">{{ __('Асуулт №:') }}</label>

                            <div class="col-md-6">
                                <label class="form-control @error('title') is-invalid @enderror" >{{ $quiz->number }}</label>
                            </div>

                        </div>
                        
                        <div class="form-group row">
                            <label for="info" class="col-md-4 col-form-label text-md-right">{{ __('Асуулт') }}</label>

                            <div class="col-md-6">

                                <textarea id="info" type="info" disabled class="form-control @error('info') is-invalid @enderror" name="info">{{ $quiz->quiz }}</textarea>

                            </div>
                        </div>

                        @if($quiz->quiz_path)
                        <div class="form-group row">
                            <label for="type" class="col-md-4 col-form-label text-md-right">{{ __('Зураг') }}</label>
                            <div class="col-md-6">                               

                               <img src="{{ asset('storage/'.$quiz->quiz_path) }}" class="img-fluid">

                            </div>
                        </div>
                        @endif

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">                                
                                <a href="{{ route('quiz.index', $test->id) }}" class="ml-1 btn btn-primary">
                                    {{ __('Буцах') }}                                    
                                </a>
                            </div>
                        </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
