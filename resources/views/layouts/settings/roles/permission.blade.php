@extends('layouts.app')

@section('content')

<div class="container">

    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header"><strong>"{{ $role->name }}" {{ __('рольд зөвшөөрөл өгөх') }}</strong></div>

                <div class="card-body">

                    @include('layouts.shared.alert')

                    <form method="POST" action="{{ route('give.permission', $role->id) }}">
                        @csrf

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Нэр') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $role->name }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                        </div>

                        <div class="form-group row">
                            <label for="guard_name" class="col-md-4 col-form-label text-md-right">{{ __('Хамгааллат') }}</label>

                            <div class="col-md-6">
                                <input id="guard_name" type="text" class="form-control @error('guard_name') is-invalid @enderror" name="guard_name" value="{{ $role->guard_name }}" required autocomplete="guard_name" autofocus>

                                @error('guard_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                        </div>

                        <div class="form-group row">
                            <label for="tests" class="col-md-4 col-form-label text-md-right">{{ __('Зөвшөөрөл') }}</label>

                            <div class="col-md-6">

                                @foreach($role->permissions as $perm)
                                    <input type="hidden" name="permission[]" value="{{ $perm->id }}" :value="selected">
                                @endforeach

                                @if(isset($permission_names))
                                    <select name="permission[]" multiple id="permission" class="form-control @error('permission') is-invalid @enderror">
                                        <option value="0">Нэг зөвшөөрлийг сонгоно уу!</option>
                                        @foreach($permissions as $permission)
                                        <option value="{{ $permission->id }}"
                                            @if( in_array( $permission->id, $role->permissions->pluck('id')->toArray()))
                                            selected @endif
                                            >{{ $permission->name }}</option>
                                        @endforeach
                                    </select>

                                    @error('permissions')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                @else
                                    <a class="btn btn-primary" href=" ">Шинэ нэмэх</a>
                                @endif

                            </div>
                        </div>                      

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Хадгалах') }}
                                </button>
                                <a href="{{ route('role.index') }}" class="btn btn-danger">
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
