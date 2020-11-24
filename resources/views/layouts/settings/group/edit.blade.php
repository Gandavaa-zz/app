@extends('layouts.app')

@section('content')

<div class="container">

    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <strong>{{ __('Групп засах') }}</strong></div>

                <div class="card-body">
                    <form method="POST" action="{{ route('group.update', $group->id) }}">
                        @csrf
                        @method('PUT')

                        <div class="form-group row">
                            <label for="firstname" class="col-md-4 col-form-label text-md-right">{{ __('Бүлэг') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $group->name }}" required autocomplete="name" autofocus>
                                
                                @error('name')
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

                                <a href="{{ route('group.index') }}" class="ml-1 btn btn-danger">
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
