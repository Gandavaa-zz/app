@extends('layouts.app')
@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Орчуулга нэмэх') }}</div>
                <div class="card-body">
                    <form method="POST" action="{{ route('translations.store') }}">
                        @csrf
                        <div class="container py-5">
                            <div class="row">
                                <div class="col-md-10 mx-auto">
                                    <form>
                                        <div class="form-group row">
                                            <div class="form-group col-sm-12">                                                   
                                                <select class="form-control @error('test_id') is-invalid @enderror" name="test_id">
                                                    <option value="">Нэг тестийг сонго...</option>
                                                    @foreach($assessments as $item)
                                                    <option value="{{$item->id}}">{{$item->label}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-sm-6">                                                
                                                <label for="en">Англи: <img src="{{url('/icons/en.png')}}" class="flag" alt="Image" />
                                            </label>                                                
                                                 <label class="col-form-label" for="prependedInput">Prepended text</label>
                                                <textarea placeholder="Текст оруулна уу..." 
                                                type="text" 
                                                id="en" 
                                                rows="15" 
                                                class="form-control @error('en') is-invalid @enderror" 
                                                name="en" 
                                                autocomplete="en" autofocus>{{ old('en') }}
                                                </textarea>
                                                @error('en')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                            <div class="col-sm-6">
                                                <label for="firstname">Монгол: <img src="{{url('/icons/mn.png')}}" class="flag" alt="Image" /></label>                                                
                                                <textarea placeholder="Текст оруулна уу..." 
                                                type="text" 
                                                class="form-control @error('mn') is-invalid @enderror" 
                                                name="mn" 
                                                id="mn"
                                                rows="20" autocomplete="mn" autofocus>
                                                {{ old('mn') }}
                                            </textarea>

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
@section('javascript')
<script>
    CKEDITOR.replace('en');
    CKEDITOR.replace('mn');
</script>
@endsection