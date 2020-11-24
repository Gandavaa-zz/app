@extends('layouts.app')

@section('content')

<div class="container">

    <div class="row justify-content-center">
        <div class="col-md-4">
            <div class="card">
               
                <div class="card-body">
                    <profile inline-template>
                        <form action="">
                            <div class="text-center mt-4">                         
                                <img class="rounded-circle" src="{{ env('APP_URL', '') }}/assets/img/avatars/8.jpg" width="150" alt="{{ $user->email }}">
                                    <input type="file" id="avatar" name="filename">
                                    <h4 class="card-title mt-2">
                                        <input type="text" name="firstname" value="{{ $user->firstname }}" placeholder="Өөрийн нэр" required>,
                                        
                                        <input type="text" name="lastname" value="{{ $user->lastname }}" placeholder="Эцэг эхийн нэр" required>
                                    </h4>
                                    @foreach( $user->groups as $group)                            
                                    <h6 class="card-subtitle">
                                        {{ $group->name }}
                                    </h6>
                                    @endforeach
                                   
                            </div>

                            <div class="card-body"> 
                                <small class="text-muted">Имэйл хаяг: </small>
                                <h6>
                                    <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ $user->email }} " required>                                    
                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                     @enderror
                                </h6> 
                                <small class="text-muted pt-4 db">Хүйс:</small>                                    
                                @if($user->gender =='male') 
                                <h6> Эрэгтэй </h6> 
                                @else <h6> Эмэгтэй </h6> 
                                @endif
                                <small class="text-muted pt-4 db">Регистр:</small>
                                <h6>                                     
                                    <input type="register" name="register" class="form-control @error('register') is-invalid @enderror" value="{{ $user->register }} " required>
                                </h6> 
                                <small class="text-muted pt-4 db">Утас:</small>
                                <h6> {{ $user->phone }} </h6> 
                                <small class="text-muted pt-4 db">Төрсөн он сар өдөр:</small>
                                <h6> {{ $user->dob }} </h6> 
                                <small class="text-muted pt-4 db">Хаяг:</small>
                                <h6>{{ $user->address }}</h6>                             
                            </div>
                            <div class="row text-center justify-content-md-center pt-2">
                                        <!-- <button class="btn btn-sm btn-primary" @click="editing = true">Засах</button>                                 -->
                                        <a class="btn btn-sm btn-primary" href="{{ route('edit.profile', $user->id) }}">Хадгалах</a>
                            </div>
                        </form>
                    </profile>
                </div>
            </div>
        </div>
 
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"> <strong>Үйл явдал</strong> </div>
                <div class="card-body">
                    <ul class="list-unstyled">
                        @foreach ($activities as $date => $activity)
                            <h3 class="page-header">{{ $date }} </h3>
                            @foreach($activity as $record)
                        <li class="media media-border">                            
                            @if ($record->type =='created_test')                                 
                            <div class="media-body pt-3">
                                <small class="float-right text-navy">{{ $record->subject->created_at->diffForHumans() }}</small>                                  
                                <p><b>{{ $user->firstname }}</b> {{ $record->subject->title }} тест үүсгэсэн.</p>
                            </div>              
                            @endif
                        
                            @if ($record->type =='updated_test')                               
                            <div class="media-body pt-3">
                                <small class="float-right text-navy">{{ $record->subject->created_at->diffForHumans() }}</small>                                  
                                <p class="pt-3">
                                <b>{{ $user->firstname }}</b> {{ $record->subject->title }} тест засварласан.                             
                                </p>                                                                  
                            </div>                                                                                                 
                            @endif

                            @if ($record->type =='created_quiz')                                                        
                            <div class="media-body pt-3">
                                <small class="float-right text-navy">{{ $record->subject->created_at->diffForHumans() }}</small>                                  
                                <p>
                                <b>{{ $user->firstname }}</b> {{ $record->subject->title }} асуулт үүсгэсэн.                                 
                                </p>                                    
                            </div>                              
                            @endif                      

                            @if ($record->type =='updated_quiz')
                            <div class="media-body pt-3">
                                <small class="float-right text-navy">{{ $record->subject->created_at->diffForHumans() }}</small>                                  
                                <p >
                                <b>{{ $user->firstname }}</b> {{ $record->subject->title }} асуулт засварлав.                                 
                                </p>                                    
                            </div>  
                            @endif                                
                        </li>
                        @endforeach
                    @endforeach

                    </ul>
                </div>
            </div>                  

        </div>
    </div>
</div>
@endsection
