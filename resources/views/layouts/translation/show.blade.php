@extends('layouts.app') @section('content')

<div class="container">
	<div class="row justify-content-center">
		<div class="col-md-12">
			<div class="card">
				<div class="card-header">{{ __("Орчуулга дэлгэрэнгүй") }}</div>
				<div class="card-body py-4">
               <h6><span class="badge badge-primary">Үүсгэсэн: </span>  <strong>{{$translation->created_at}}</strong></h6>
               <h6><span class="badge badge-primary">Зассан: </span>  <strong>{{$translation->updated_at}}</strong></h6>
               <hr>
					<div class="container py-3">
						<div class="row">
							<div class="col-md-6 mx-auto">
								<label>Англи : </label>
								<textarea disabled class="form-control"  rows="10">{{$translation->EN}}</textarea>
							</div>
							<div class="col-md-6 mx-auto">
								<label>Монгол </label>
								<textarea class="form-control" disabled rows="10">{{$translation->MN}}</textarea>
							</div>
						</div>
					</div>
				</div>
				<div class="card-footer">
					<div class="form-group">
						<div class="col-sm-3 float-right">
							<a href="{{route('translations.edit', $translation->id)}}" class="btn btn-success btn-md" title="Засах">Засах</a>
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
