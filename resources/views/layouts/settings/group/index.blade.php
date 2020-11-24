@extends('layouts.app')

@section('content')

        <div class="container-fluid">
          <div class="animated fadeIn">
            <div class="row">
              <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                <div class="card">
                    <div class="card-header">

                    <span class="float-left"><h5><i class="fa fa-align-justify"></i>{{ __('Бүлэг') }}</h5></span> <span class="float-right">
                    <a class="btn btn-primary" href="{{ route('group.create') }}">Шинэ</a></span>
                    </div>

                    <div class="card-body">

                    @include('layouts.shared.alert')

                    <table class="table table-responsive-sm table-striped">
                        <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Бүлэг</th>                            
                        </tr>
                        </thead>
                        <tbody>

                            @php ($i = 1)
                            @foreach ($groups as $group)
                            <tr>
                                <td>{{ $i++ }} </td>
                                <td>{{ $group->name }}</td>                                
                                <td>
                                    <ul class="list-group list-group-horizontal list-unstyled">
                                        <li class="pr-1">
                                            <a href="{{ route('group.show', $group->id) }}" class="btn btn-secondary btn-sm">
                                            <i class="cil-magnifying-glass"></i>
                                            </a>
                                        </li>
                                        <li class="pr-1">
                                            <a href="{{ route('group.edit', $group->id) }}" class="btn btn-primary btn-sm" title="Засах"><i class="cil-pencil"></i></a>
                                        </li>
                                        <li class="pr-1">
                                          <form class="form-inline" action="{{ route('group.destroy', $group->id) }}" method="POST">
                                            @method('DELETE')
                                            @csrf
                                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Та энэ бичлэгийг үнэхээр устгах уу?')"><i class="cil-trash"></i></button>
                                          <!-- <a href="" class="btn btn-danger btn-sm" title="Edit"><i class="fas fa-trash-alt"></i></a>                     -->
                                          </form>
                                        </li>                                        
                                    </ul>
                                    <!-- <a href="#" class="btn btn-primary btn-sm" title="Add"><i class="fas fa-plus"></i></a>                     -->

                                    <!-- form post here  -->
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                      </table>

                      {{ $groups->links() }}
                    </div>
                </div>
              </div>
            </div>
          </div>
        </div>

@endsection


@section('javascript')

@endsection

