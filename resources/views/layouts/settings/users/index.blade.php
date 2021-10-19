@extends('layouts.app')

@section('content')

<div class="container-fluid">
    <div class="animated fadeIn">
        <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                <div class="card">
                    <div class="card-header">
                        <span class="float-left">
                            <h5><i class="fa fa-align-justify"></i>{{ __('Системийн хэрэглэгч') }}</h5>
                        </span>
                        <span class="pl-2 float-right">
                            <button class="btn btn-info" data-toggle="modal" data-target="#helpModal">Тусламж 
                            <svg class="c-icon">
                              <use xlink:href="{{ asset('icons/sprites/free.svg#cil-life-ring') }}"></use>                              
                              </svg>
                            </button>
                        </span>
                        <span class="float-right">
                            <a class="btn btn-primary" href="{{ route('users.create') }}">
                              Шинэ
                              <svg class="c-icon">
                              <use xlink:href="{{ asset('icons/sprites/free.svg#cil-plus') }}"></use>                              
                              </svg>
                            </a></span>
                    </div>

                    <div class="card-body">

                        @include('layouts.shared.alert')

                        <table class="table table-responsive-sm table-bordered ">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Нэр, Овог</th>
                                    <th scope="col">Имэйл</th>
                                    <th scope="col">Үүрэг /role/</th>
                                    <th scope="col">Үйлдэл</th>
                                </tr>
                            </thead>
                            <tbody>

                                @php ($i = 1)
                                @foreach ($users as $user)
                                <tr>
                                    <th scope="row">{{ $i++ }} </th>
                                    <td>{{ $user->firstname }}, {{ Str::limit($user->lastname, 10) }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $user->getRoleNames()->implode(',')}}</td>
                                    <td>
                                        <ul class="list-group list-group-horizontal list-unstyled">
                                            <li class="pr-1">
                                                <a href="{{ route('users.show', $user->id) }}" title ="Харах"
                                                    class="btn btn-secondary btn-sm">
                                                    <i class="cil-magnifying-glass"></i>
                                                </a>
                                            </li>
                                            <li class="pr-1">
                                                <a href="{{ route('users.edit', $user->id) }}"
                                                    class="btn btn-primary btn-sm" title="Засах"><i
                                                        class="cil-pencil"></i></a>
                                            </li>
                                            <li class="pr-1">
                                                <form class="form-inline"
                                                    action="{{ route('users.destroy', $user->id) }}" method="POST">
                                                    @method('DELETE')
                                                    @csrf
                                                    <button type="submit" class="btn btn-danger btn-sm" title="Устгах"
                                                        onclick="return confirm('Та энэ бичлэгийг үнэхээр устгах уу?')"><i
                                                            class="cil-trash"></i></button>
                                                    <!-- <a href="" class="btn btn-danger btn-sm" title="Edit"><i class="fas fa-trash-alt"></i></a>                     -->
                                                </form>
                                            </li>
                                            <li class="pr-1">
                                                <a href="{{ route('user.roles', $user->id) }}"
                                                    class="btn btn-info btn-sm" title="Зөвшөөрөл"><i
                                                        class="cil-people"></i></a>
                                            </li>
                                        </ul>
                                        <!-- <a href="#" class="btn btn-primary btn-sm" title="Add"><i class="fas fa-plus"></i></a>                     -->

                                        <!-- form post here  -->
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>

                        {{ $users->links() }}
                    </div>

                    <!-- modal here -->
                    <div class="modal fade" id="helpModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Тусламж: Системийн хэрэглэгчид</h5>
                                    <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span
                                            aria-hidden="true">×</span></button>
                                </div>
                                <div class="modal-body">
                                    <p>
                                        <strong>Системийн хэрэглэгч <i class="cil-user"></i>: </strong>
                                        Тухайн  хэрэглэгч нь системд шинэ хэрэглэгчдийг нэмэх, хасах, засах эрх бүхий системийн тодорхой эрх (Роль)-той хэрэглэгчид юм. <br> <i class="cil-warning"></i> Системийн эрхийг <strong>Систем хэрэглэгчид -> Эрх</strong> цэснээс орж харах боломжтой.
                                      </p>
                                      <p>Системийн Шинэ хэрэглэгчийг нэмэхдээ <button class="btn btn-primary">Шинэ</button> товч дээр дарж дараах формын утгуудыг бөглөөд <strong>Бүртгэх</strong> товчыг дарж үүсгэнэ. 
                                      </p>
                                      <p>Системийн хэрэглэгчид дараах байдлаар харагдана. Үйлдэл цэснээс хэрэглэгчдийг
                                      <button class="btn btn-secondary btn-sm"> <i class="cil-magnifying-glass"></i></button>
                                         харах, 
                                      <button class="btn btn-primary btn-sm"> <i class="cil-pencil"></i></button>
                                         засах, 
                                      <button class="btn btn-danger btn-sm"> <i class="cil-trash"></i></button>
                                         устгах, 
                                      <button class="btn btn-info btn-sm"> <i class="cil-people"></i></button>
                                        эрх нэмэх үйлдлүүдийг гүйцэтгэх боломжтой</p>
                                      <p><img src="{{ asset('assets/img/system_user.png') }}" width="90%" alt="Шинэ системийн хэрэглэгч"></p>
                                </div>
                                <div class="modal-footer">
                                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Хаах</button>                                    
                                </div>
                            </div>
                            <!-- /.modal-content-->
                        </div>
                    </div>
                    <!-- /.modal-->

                </div>
                <!-- /card -->
            </div>
        </div>
    </div>
</div>

@endsection


@section('javascript')

@endsection
