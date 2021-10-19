@extends('layouts.app')

@section('content')

<div class="container-fluid">
    <div class="animated fadeIn">
        <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">

                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0"><i class="fa fa-align-justify"></i>{{ __('Тохиргоо цэсний тусламж') }}</h5>
                    </div>
                    <div class="card-body">
                        
                        <div class="alert alert-info" role="alert"><b>"Системийн тохиргоо"-цэсний тусламжыг энд тайлбарлав.</b></div>
                                                
                        <p>
                            <strong>Тохиргоо</strong> нь системийг бүхэлд нь удирдах удирлагатай холбоотой дараах <strong> Системийн хэрэглэгчид </strong>, <strong>Эрх</strong>, <strong>Зөвшөөрөл</strong>,
                            <strong>Бүлэг</strong> гэсэн хэсгүүдээс бүрдэнэ.
                        </p>
                        <hr>

                        <div class="nav-tabs-boxed pt-3">
                            <ul class="nav nav-tabs" role="tablist">
                                <li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#home"
                                        role="tab" aria-controls="home"><strong>Системийн хэрэглэгчид</strong></a></li>
                                <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#role" role="tab"
                                        aria-controls="profile"><strong>Эрх</strong></a></li>
                                <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#permission" role="tab"
                                        aria-controls="messages"><strong>Зөвшөөрөл</strong></a></li>                               
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane active" id="home" role="tabpanel">
                                    <!-- Системийн хэрэглэгчид -->
                                    <p>
                                        <strong>Системийн хэрэглэгч <i class="cil-user"></i>: </strong>
                                        Тухайн хэрэглэгч нь системд тодорхой эрх (Эрх)-той хэрэглэгчид бөгөөд өөрийн эрхийн дагуу системд тодорхой үүрэгтэй оролцох хэрэглэгчид юм. <br> <i class="cil-warning"></i>
                                        Системийн эрхийг
                                        <strong>Систем хэрэглэгчид -> Эрх</strong> цэснээс орж харах боломжтой.
                                    </p>
                                    <p>Системийн Шинэ хэрэглэгчийг нэмэхдээ <button
                                            class="btn btn-primary">Шинэ</button> товч дээр
                                        дарж дараах формын утгуудыг бөглөөд <strong>Бүртгэх</strong> товчыг дарж
                                        үүсгэнэ.
                                    </p>
                                    <p>Системийн хэрэглэгчид дараах байдлаар харагдана. Үйлдэл цэснээс хэрэглэгчдийг
                                        <button class="btn btn-secondary btn-sm"> <i
                                                class="cil-magnifying-glass"></i></button>
                                        харах,
                                        <button class="btn btn-primary btn-sm"> <i class="cil-pencil"></i></button>
                                        засах,
                                        <button class="btn btn-danger btn-sm"> <i class="cil-trash"></i></button>
                                        устгах,
                                        <button class="btn btn-info btn-sm"> <i class="cil-people"></i></button>
                                        эрх нэмэх үйлдлүүдийг гүйцэтгэх боломжтой</p>
                                    <p><img src="{{ asset('assets/img/system_user.png') }}" width="90%"
                                            alt="Шинэ системийн хэрэглэгч"></p>

                                    <p>
                                        <strong>Шинэ хэрэглэгч нэмэх:</strong>
                                        Шиэн хэрэглэгч нэмэхэд дараах талбаруудын утгийг оруулах шаардлагатай.
                                        <ul>
                                            <li>Хэрэглэгчийн нэр:</li>
                                            <li>Хэрэглэгчийн овог</li>
                                            <li>Имэйл хаяг</li>
                                            <li>Эрх- Ямар эрхтэй хэрэглэгч болохыг сонгоно</li>
                                            <li>Бүлэг- Ямар бүлэгт харьяалагдах хэрэглэгч болохыг сонгоно</li>                                            
                                        </ul>
                                        <p>
                                        <img src="{{ asset('assets/img/add_system_user.png') }}" width="70%"
                                            alt="Шинэ системийн хэрэглэгч">
                                        </p>
                                    </p>
                                    <!-- /Системийн хэрэглэгчид -->
                                </div>
                                <div class="tab-pane" id="role" role="tabpanel">
                                    <!-- Эрх  -->
                                    <p>
                                        <strong> Эрх <i class="cil-people"></i>: </strong>
                                        Тухайн хэрэглэгч тодорхой эрхүүдтэй байх бөгөөд тэдгээр эрхийг энэ хэсэгт зохицуулж өгнө.                                        
                                        <br>
                                        Системд дараах төрлийн эрхүүд байх бөгөөд тухайн эрхээс хамааран хийгдэх үйлдлүүд нь тус бүр өөр өөр байх юм.  
                                        <br>
                                        <img class="pt-3" src="{{ asset('assets/img/role_list.png') }}" width="90%"
                                            alt="Шинэ системийн хэрэглэгч">   
                                            
                                        <p>Системд доорх төрлийн хэрэглэгчид байх бөгөөд  тус бүрт нь өөр өөр эрх өгч үүсгэсэн болно.</p>
                                        <ul>
                                            <li><strong>super-admin</strong> хэрэглэгч бүх эрхүүдийг үүсгэх болон системийн хэрэглэгчийг засах эрхтэй байна. </li>
                                            <li><strong>admin</strong> хэрэглэгч нь системийн хэрэглэгчид хандахаас бусад эрх ба зөвшөөрөлтэй байна.</li>
                                            <li>
                                                <strong>writer</strong> хэрэглэгч нь орчуулга цэсрүү хандах эрхтэй байна.
                                            </li>                                            
                                        </ul>                                                                                 
                                        
                                    </p>
                                    
                                    <!-- /Эрх -->
                                </div>
                                <div class="tab-pane" id="permission" role="tabpanel"><p>
                                    <strong> Зөвшөөрөл <i class="cil-lock"></i>: </strong>
                                    Системд ашиглагдах үйлдлүүдийн зөвшөөрлийг удирдана. Зөвшөөрөл цэсэнд бүх системийн зөвшөөрлүүдийг харуулна. Шинэ хэсэгт шинэ зөвшөөрөл үүсгэж болно. Системд ашиглагдаж буй үндсэн зөвшөөрлүүдийг устгах, засах боломжгүй байна.
                                    <img class="pt-3" src="{{ asset('assets/img/permission.png') }}" width="90%"
                                            alt="Системийн зөвшөөрөл">  
                                </div>                                
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
</div>

@endsection
