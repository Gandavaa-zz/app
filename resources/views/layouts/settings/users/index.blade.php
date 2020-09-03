@extends('layouts.app')

@section('content')

        <div class="container-fluid">
          <div class="animated fadeIn">
            <div class="row">
              <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                <div class="card">
                    <div class="card-header">

                    <span class="float-left"><h5><i class="fa fa-align-justify"></i>{{ __('Системийн хэрэглэгч') }}</h5></span> <span class="float-right">
                    <a class="btn btn-primary" href="{{ route('users.create') }}">Шинэ</a></span>
                    </div>

                    <div class="card-body">

                    @include('layouts.shared.alert')

                    <table class="table table-responsive-sm table-striped">
                        <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Нэр.Овог</th>
                            <th scope="col">Имэйл</th>
                            <th scope="col">Роль</th>
                            <th scope="col">Үйлдэл</th>
                        </tr>
                        </thead>
                        <tbody>

                            @php ($i = 1)
                            @foreach ($users as $user)
                            <tr>
                                <th scope="row">{{ $i++ }} </th>
                                <td>{{ $user->firstname }}. {{ Str::limit($user->lastname, 1) }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->getRoleNames()->implode('name', ', ')}}</td>
                                <td>
                                    <ul class="list-group list-group-horizontal list-unstyled">
                                        <li class="pr-1">
                                            <a href="{{ route('users.show', $user->id) }}" class="btn btn-secondary btn-sm">
                                            <i class="cil-magnifying-glass"></i>
                                            </a>
                                        </li>
                                        <li class="pr-1">
                                            <a href="{{ route('users.edit', $user->id) }}" class="btn btn-primary btn-sm" title="Edit"><i class="cil-pencil"></i></a>
                                        </li>
                                        <li class="pr-1">
                                          <form class="form-inline" action="{{ route('users.destroy', $user->id) }}" method="POST">
                                            @method('DELETE')
                                            @csrf
                                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Та энэ бичлэгийг үнэхээр устгах уу?')"><i class="cil-trash"></i></button>
                                          <!-- <a href="" class="btn btn-danger btn-sm" title="Edit"><i class="fas fa-trash-alt"></i></a>                     -->
                                          </form>
                                        </li>
                                        <li class="pr-1">
                                            <a href="{{ route('user.roles', $user->id) }}"  class="btn btn-info btn-sm" title="Зөвшөөрөл"><i class="cil-people"></i></a>
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
                </div>
              </div>
            </div>
          </div>
        </div>

@endsection


@section('javascript')

@endsection

