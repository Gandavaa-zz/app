@extends('layouts.app')

@section('content')

<div class="container">

    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <strong>{{ __('Хэрэглэгч засах') }}</strong></div>

                <div class="card-body">
                    <form method="POST" action="{{ route('settings.test.update', $test->id) }}">
                        @csrf
                        @method('PUT')

                        <div class="form-group row">
                            <label for="title" class="col-md-4 col-form-label text-md-right">{{ __('Гарчиг') }}</label>

                            <div class="col-md-6">
                                <input id="title" type="text" class="form-control @error('title') is-invalid @enderror" name="title" value="{{ $test->title }}" required autocomplete="title" autofocus>
                                
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                        </div>
                        
                        <div class="form-group row">
                            <label for="info" class="col-md-4 col-form-label text-md-right">{{ __('Мэдээлэл') }}</label>

                            <div class="col-md-6">

                                <textarea id="info" type="info" class="form-control @error('info') is-invalid @enderror" name="info">{{ $test->info }}</textarea>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="type" class="col-md-4 col-form-label text-md-right">{{ __('Төрөл') }}</label>

                            <div class="col-md-6">                               

                                <select name="type" id="type" class="form-control @error('type') is-invalid @enderror">
                                    @foreach($test_type as $type)
                                        <option value="{{ $test->type }}" 
                                            @if($test_type == $test->type) 
                                            selected @endif >{{ $type }}</option>
                                    @endforeach
                                </select>      

                                @error('type')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="type" class="col-md-4 col-form-label text-md-right">{{ __('Үргэлж.хугацаа') }}</label>

                            <div class="col-md-4">     
                                
                                <select name="duration" id="duration" class="form-control @error('type') is-invalid @enderror">

                                    @foreach($durations as $minute)
                                        <option value="{{ $minute }}" 
                                            @if($minute == $test->duration) 
                                            selected @endif >{{ $minute }}</option>
                                    @endforeach
                                </select>  

                                @error('duration')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-md-2">
                                <label class="col-form-label">минут.</label>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Засах') }}                                    
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
