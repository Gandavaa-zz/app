@if(Session::has('message'))
<div class="row">
    <div class="col-12">
        <div class="alert alert-success" role="alert">{{ Session::get('message') }}</div>
    </div>
</div>
@endif  