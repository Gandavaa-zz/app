@extends('layouts.app')

@section('content')

<div class="container">

    <div class="row justify-content-left">
        <div class="col-md-4 col-lg-4 col-xl-4">
            <div class="card">
               
                <div class="card-body">
                    <profile inline-template>
                        <div>
                            <div class="text-center mt-4">                         
                                <img class="rounded-circle"
                                    src="{{ $user->avatar() }}" width="150" alt="{{ $user->email }}">
                                    <h4 class="card-title mt-2">{{ $user->firstname}}, {{ $user->lastname}}</h4>
                                    
                                    @foreach( $user->groups as $group)                            
                                    <h6>{{ $group->name }}</h6>
                                    @endforeach
                                    <div class="row text-center justify-content-md-center pt-2">
                                        <!-- <button class="btn btn-sm btn-primary" @click="editing = true">Засах</button>      -->
                                        @can ('update', $user)
                                            <a class="btn btn-sm btn-primary" href="{{ route('edit.profile', $user->id) }}">Засах</a>
                                        @endcan
                                    </div>
                            </div>

                            <div class="card-body"> 
                                <small class="text-muted">Имэйл хаяг: </small>
                                <h6>{{ $user->email }}</h6> 
                                <small class="text-muted pt-4 db">Хүйс:</small>
                                @if($user->gender =='male') 
                                <h6> Эрэгтэй </h6> 
                                @else <h6> Эмэгтэй </h6> 
                                @endif
                                <small class="text-muted pt-4 db">Регистр:</small>
                                <h6> {{ $user->register }} </h6> 
                                <small class="text-muted pt-4 db">Утас:</small>
                                <h6> {{ $user->phone }} </h6> 
                                <small class="text-muted pt-4 db">Төрсөн он сар өдөр:</small>
                                <h6> {{ $user->dob }} </h6> 
                                <small class="text-muted pt-4 db">Хаяг:</small>
                                <h6>{{ $user->address }}</h6>                             
                            </div>
                        </div>
                    </profile>
                </div>
            </div>
        </div>
 
        <div class="col-md-8 col-lg-8 col-xl-8">
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
