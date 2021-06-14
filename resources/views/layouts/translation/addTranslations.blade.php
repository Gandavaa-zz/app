@extends('layouts.app')
@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Орчуулга оруулах')}} (Тестийн дугаар: <span class="badge badge-success badge-2x">{{ $test[0]['id'] }}</span>)      <img src="{{$test[0]['logo']}}" ></div>
                <div class="card-body">
                    {!! Form::open(['route' => ['translations.save'],
                     'method' => 'post',
                     'enctype' => 'multipart/form-data']) !!}
                        @csrf
                        <div class="container py-5">
                            <h2 class="text-center">{{ $test[0]['label'] }}</h2>
                            <div class="row">
                                <div class="col-md-10 mx-auto">
                                        <div class="form-group row">
                                            @foreach($data as $row)
                                            <div class="col-sm-6">
                                                <label for="en"></label>
                                                <input type="hidden" value="{{ $row->id }}" name="id[]">
                                                <input type="hidden" value="{{ $row->test_id }}" name="test_id">
                                                <textarea
                                                    placeholder="Текст оруулна уу..." class="form-control"
                                                    name="en[]" value="{{ $row->EN }}">{{ $row->EN }}</textarea>
                                            </div>
                                            <div class="col-sm-6">
                                                <label for="mn"></label>
                                                <textarea placeholder="Монгол орчуулга оруулна уу..." type="text"
                                                    class="form-control @error('mn') is-invalid @enderror"
                                                    name="mn[]"
                                                    autocomplete="mn" autofocus></textarea>
                                                @error('mn')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                            @endforeach
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
<script type="text/javascript">
    jQuery(document).ready(function ()
    {
            jQuery('select[name="country"]').on('change',function(){
               var countryID = jQuery(this).val();
               if(countryID)
               {
                  jQuery.ajax({
                     url : 'dropdownlist/getstates/' +countryID,
                     type : "GET",
                     dataType : "json",
                     success:function(data)
                     {
                        console.log(data);
                        jQuery('select[name="state"]').empty();
                        jQuery.each(data, function(key,value){
                           $('select[name="state"]').append('<option value="'+ key +'">'+ value +'</option>');
                        });
                     }
                  });
               }
               else
               {
                  $('select[name="state"]').empty();
               }
            });
    });
    </script>

<!-- Initialize the plugin: -->
@endsection
