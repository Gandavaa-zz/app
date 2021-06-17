@extends('layouts.app')

@section('content')

<div class="container-fluid">
    <div class="animated fadeIn">
        <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                <div class="card">
                    <div class="card-header">
                        <span class="float-left">
                            <h5><i class="fa fa-align-justify"></i>{{ __('Тестийн үр дүнг импортлох') }}</h5>
                        </span> <span class="float-right">
                    </div>
                    <div class="card-body">
                        @include('layouts.shared.alert')

                        <!-- Тест импорт оруулах -->
                        <form method="POST" action="{{ route('import.store') }}" >
                            @csrf
                            <div class="form-group row">
                                <label class="col-md-1 col-form-label" for="select1">Тест</label>
                                <div class="col-md-6">
                                    <select class="form-control" id="test_id" name="test_id">
                                        @foreach ($tests as $test)
                                            <option value="{{$test->id}}"> {{ $test->label }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <button class="btn btn-primary">Импорт</button>
                                </div>
                            </div>

                        </form>
                        <!-- dropdown -->

                        <!-- /button -->



                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection


@section('javascript')

@endsection
