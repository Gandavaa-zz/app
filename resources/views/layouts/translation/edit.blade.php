@extends('layouts.app')
@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Орчуулга засах') }}</div>
                <div class="card-body">
                    <form method="POST" action="/translations/{{$translation->id}}">
                        @method('PUT')
                        @csrf
                        <div class="container py-5">
                            <div class="row">
                                <div class="col-md-10 mx-auto">
                                    <div class="form-group row">
                                        <div class="col-sm-6">
                                            <input type="hidden" class="form-control" name="test_id" value="{{ $translation->test_id }}" autocomplete="en">
                                            <input type="hidden" class="form-control" name="id" value="{{ $translation->id }}" autocomplete="en">
                                            <label for="en">Англи: <img src="{{url('/icons/en.png')}}" class="flag" alt="Image" /></label>
                                            <textarea placeholder="Текст оруулна уу..." type="text" rows="10" class="form-control @error('en') is-invalid @enderror" name="en" value="{{ $translation->EN }}" autocomplete="en" autofocus>{{ $translation->EN }}</textarea>
                                            @error('en')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                        <div class="col-sm-6">
                                            <label for="mn">Монгол: <img src="{{url('/icons/mn.png')}}" class="flag" alt="Image" /></label>
                                            <textarea placeholder="Текст оруулна уу..." type="text" class="form-control @error('mn') is-invalid @enderror" name="mn" rows="10" value="{{ $translation->MN}}" autocomplete="mn" autofocus>{{ $translation->MN}}</textarea>
                                            @error('mn')
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
                                <a href="{{ route('translations.index') }}" class="ml-1 btn btn-primary">
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