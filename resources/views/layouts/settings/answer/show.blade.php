@extends('layouts.app')

@section('content')

<div class="container">

    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <strong>{{ $test->test }}</strong></div>

                <div class="card-body">                    

                        <div class="form-group row">
                            <label for="title" class="col-md-4 col-form-label text-md-right">{{ __('Гарчиг') }}</label>

                            <div class="col-md-6">
                                <label class="form-control @error('title') is-invalid @enderror" >{{ $test->title }}</label>
                            </div>

                        </div>
                        
                        <div class="form-group row">
                            <label for="info" class="col-md-4 col-form-label text-md-right">{{ __('Мэдээлэл') }}</label>

                            <div class="col-md-6">

                                <textarea id="info" type="info" disabled class="form-control @error('info') is-invalid @enderror" name="info">{{ $test->info }}</textarea>

                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="type" class="col-md-4 col-form-label text-md-right">{{ __('Төрөл') }}</label>
                            <div class="col-md-6">                               

                                <select name="type" id="type" disabled class="form-control @error('type') is-invalid @enderror">
                                    @foreach($test_type as $type)
                                        <option value="{{ $test->type }}" 
                                            @if($test_type == $test->type) 
                                            selected @endif >{{ $type }}</option>
                                    @endforeach
                                </select>      

                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="type" class="col-md-4 col-form-label text-md-right">{{ __('Үргэлж.хугацаа') }}</label>

                            <div class="col-md-4">     
                                
                                <select name="duration" id="duration" disabled class="form-control @error('type') is-invalid @enderror">
                                    @foreach($durations as $minute)
                                        <option value="{{ $minute }}" 
                                            @if($minute == $test->duration) 
                                            selected @endif >{{ $minute }}</option>
                                    @endforeach
                                </select>  
                            </div>
                            <div class="col-md-2">
                                <label class="col-form-label">минут.</label>
                            </div>
                        </div>
                        
                        @foreach($test->parts as $part)
                        <hr>
                        <div class="form-group row">                                                                                       
                            <label class="col-md-4 col-form-label text-md-right">{{ $part->num }} -р хэсгийн гарчиг</label>
                            <div class="col-md-6">
                            
                                <input type="text" class="form-control" value="{{ $part->title }}" disabled>
                            </div>
                        </div>
                        <div class="form-group row">                                                                                       
                                                        
                            <label class="col-md-4 col-form-label text-md-right">{{ $part->num }} -р хэсгийн дэлгэрэнгүй</label>
                            <div class="col-md-6">
                                <textarea disabled class="form-control">{{ $part->info }}</textarea>
                            </div>                                                       
                        </div>
                        @endforeach

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">                                
                                <a href="{{ route('settings.test') }}" class="ml-1 btn btn-primary">
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
