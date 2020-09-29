@extends('layouts.app')

@section('content')

<div class="container">

    <div class="row justify-content-center">
        <div class="col-md-4">
            <div class="card">
               
                <div class="card-body">
                   
                    <center class="mt-4">                         
                        <img class="rounded-circle"
                            src="{{ env('APP_URL', '') }}/assets/img/avatars/8.jpg" width="150" alt="{{ $user->email }}">
                            <h4 class="card-title mt-2">{{ $user->firstname}}, {{ $user->lastname}}</h4>
                            @foreach( $user->groups as $group)                            
                            <h6 class="card-subtitle">{{ $group->name }}</h6>
                            @endforeach
                            <div class="row text-center justify-content-md-center pt-2">
                                <button class="btn btn-sm btn-primary">Засах</button>                                
                            </div>
                        </center>

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
                                <div class="map-box">
                                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d470029.1604841957!2d72.29955005258641!3d23.019996818380896!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x395e848aba5bd449%3A0x4fcedd11614f6516!2sAhmedabad%2C+Gujarat!5e0!3m2!1sen!2sin!4v1493204785508" width="100%" height="150" frameborder="0" style="border: 0px; --darkreader-inline-border-top: initial; --darkreader-inline-border-right: initial; --darkreader-inline-border-bottom: initial; --darkreader-inline-border-left: initial;" allowfullscreen="" data-darkreader-inline-border-top="" data-darkreader-inline-border-right="" data-darkreader-inline-border-bottom="" data-darkreader-inline-border-left=""></iframe>
                                </div>                                 
                            </div>

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
