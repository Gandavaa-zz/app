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
                                    <form>
                                        <div class="form-group row">
                                            <div class="col-sm-6">
                                            <input
                                                    type="hidden"
                                                    class="form-control"
                                                    name="test_id" value="123" autocomplete="en">

                                                <label for="en">Англи</label>
                                                <input
                                                    placeholder="Текст оруулна уу..."
                                                    type="text"
                                                    class="form-control @error('en') is-invalid @enderror"
                                                    name="en" value="{{ $translation->EN }}" autocomplete="en" autofocus>
                                                @error('en')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                            <div class="col-sm-6">
                                                <label for="firstname">Монгол</label>
                                                <input placeholder="Текст оруулна уу..." type="text"
                                                    class="form-control @error('mn') is-invalid @enderror"
                                                    name="mn"
                                                    value="{{ $translation->MN}}"
                                                    autocomplete="mn" autofocus>
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
