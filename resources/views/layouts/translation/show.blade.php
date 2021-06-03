@extends('layouts.app')
@section('content')

<div class="container">
   <div class="row justify-content-center">
      <div class="col-md-12">
         <div class="card">
            <div class="card-header">{{ __('Орчуулга дэлгэрэнгүй') }}</div>
            <div class="card-body">
               <div class="container py-5">
                  <div class="row">
                     <div class="col-md-6 mx-auto">
                        <label>Монгол </label>
                        <textarea class="form-control"  disabled>  {{$translation->MN}}</textarea>
                     </div>
                     <div class="col-md-6 mx-auto">
                        <label>Англи : </label>
                        <textarea  disabled class="form-control">  {{$translation->EN}}</textarea>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
<!-- Initialize the plugin: -->
@endsection
