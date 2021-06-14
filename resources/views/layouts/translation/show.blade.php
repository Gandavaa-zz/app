@extends('layouts.app') @section('content')

<div class="container">
	<div class="row justify-content-center">
		<div class="col-md-12">
			<div class="card">
				<div class="card-header">{{ __("Орчуулга дэлгэрэнгүй") }}</div>
				<div class="card-body py-4">
					<div class="container-fluid">
						<div class="row">
							<div class="col-lg-6">
								<h6><span class="badge badge-secondary">Тест #: </span> <strong>{{$translation[0]->test_id}}</strong></h6>
								<h6><span class="badge badge-secondary">Нэр: </span> <strong>{{$translation[0]->label}}</strong></h6>
								<h6><span class="badge badge-secondary">Лого: </span> <strong><img src="{{$translation[0]->logo}}"></strong></h6>
							</div>
							<div class="col-lg-6">
								<h6><span class="badge badge-secondary">Үүсгэсэн: </span> <strong>{{$translation[0]->created_at}}</strong></h6>
								<h6><span class="badge badge-secondary">Зассан: </span> <strong>{{$translation[0]->updated_at}}</strong></h6>
							</div>
						</div>
					</div>
					<hr>
					<div class="container py-3">
						<div class="row">
							<div class="col-md-6 mx-auto">
								<label>Англи : </label>
								<textarea disabled class="form-control" rows="10">{{$translation[0]->EN}}</textarea>
							</div>
							<div class="col-md-6 mx-auto">
								<label>Монгол </label>
								<textarea class="form-control" disabled rows="10">{{$translation[0]->MN}}</textarea>
							</div>
						</div>
					</div>
				</div>
				<div class="card-footer">
					<div class="form-group">
						<div class="col-sm-3 float-right">
							<a href="{{route('translations.edit', $translation[0]->id)}}" class="btn btn-success btn-md" title="Засах">Засах</a>
							<a href="{{ route('translations.index') }}" class="ml-1 btn btn-primary">{{ __('Буцах') }}</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- Initialize the plugin: -->
@endsection