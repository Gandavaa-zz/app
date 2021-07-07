@extends('layouts.app')

@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}" />
<div class="container-fluid">
    <div class="animated fadeIn">
        <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                <div class="card">
                    <div class="card-header">
                        <span class="float-left">
                            <h5><i class="fa fa-align-justify"></i>{{ __('Үнэлгээ') }}</h5>
                        </span>
                        <span class="float-right">
                            <!-- <button type="button" id="deleteMultiple" class="btn btn-danger deleteMultiple"  href="javascript:void(0)" data-original-title="Delete">Олноор устгах</button> -->
                    </div>

                    <div class="card-body">
                        @include('layouts.shared.alert')

                        <form action="/assessment" method="GET">
                            <div class="row">
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label for="ccmonth">Групп:</label>
                                        <select name="group_id" id="group_id" class="form-control" type="input">
                                            <option value="0">Нэг утгийг сонго</option>
                                            @foreach ($groups as $group)
                                            <option @if( $group->id == request()->get('group_id')) selected @endif value="{{ $group->id}}" >{{ $group->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group col-sm-3">
                                    <label for="ccmonth">Тест:</label>
                                    <select name="test_id" id="test" class="form-control" type="input" onchange="this.form.submit()">
                                        <option value="0">Нэг утгийг сонго</option>
                                        @foreach ($tests as $test)
                                        <option @if( $test->id == request()->get('test_id')) selected @endif value="{{ $test->id}}" >{{ $test->label}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-sm-2">
                                    <label for="ccyear">Тест эхэлсэн огноо:</label>
                                    <input id="from_date" name="from_date" placeholder="Огноо сонгоно уу..." type="date" class="form-control @error('dob') is-invalid @enderror" autofocus>
                                </div>
                                <div class="form-group col-sm-2">
                                    <label for="ccyear">Тест дууссан огноо:</label>
                                    <input id="to_date" name="to_date" placeholder="Огноо сонгоно уу..." type="date" class="form-control @error('dob') is-invalid @enderror" autofocus>
                                </div>

                                <div class="col-sm-2 d-flex">
                                    <button class="btn btn-primary align-self-center mt-2" type="submit">Шүүх</button>
                                </div>


                                <table class="table table-bordered yajra-datatable user_table " id="user_table" style="width: 100%; font-size:13.5px;">
                                    <thead>
                                        <tr>
                                            <th width="3px">
                                                #
                                            </th>
                                            <th>Оролцогч</th>
                                            <th>Тест</th>
                                            <th>Эхэлсэн.огноо</th>
                                            <th>Дуусгасан.огноо</th>
                                            <th width="250px">Үйлдэл</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach( $assessments['result']['data'] as $item )
                                        <tr>
                                            <td>
                                                {{ $item['candidate_id'] }}
                                            </td>
                                            <td> @if(isset($item['candidate'] ))
                                                {{ $item['candidate']['firstname'] }}, {{ $item['candidate']['lastname']}}
                                                @else
                                                Холбогдоогүй байна
                                                @endif
                                            </td>
                                            <td>
                                                {{ $item['test']['label'] }}
                                            </td>
                                            <td>
                                                {{ $item['assessment_start_date']}}
                                            </td>
                                            <td>
                                                {{ $item['assessment_end_date']}}
                                            </td>
                                            <td>
                                                <a target="_blank" href="/reports/getHtml/{{$item['id']}}" class="btn btn-primary btn-sm">Харах</a>
                                                <a href="/reports/getXml/{{$item['id']}}/{{$item['test']['id']}}" class="btn btn-warning btn-sm">Xml Татах</a>
                                                <a target="_blank" href="{{$item['candidate_report_link']}}" class="btn btn-warning btn-sm">Тайлан харах</a>
                                                <a target="_blank" href="/reports/data/{{$item['id']}}" class="btn btn-warning btn-sm">Data харах</a>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>


                                <div class="container-fluid">
                                    <div class="form-group row">
                                        <label class="offset-md-4 col-md-1 col-form-label text-right" for="text-input">
                                            Хуудас:
                                        </label>
                                        @php $pages = array(10, 15, 20, 25, 40, 50); @endphp
                                        <select name="current_page_count" id="current_page_count" class="col-sm-4 col-md-1 form-control mr-3" type="input" onchange="this.form.submit()">
                                            @foreach ($pages as $page)
                                            <option @if($page==$pagination['current_page_count']) selected @endif value="{{$page}}">{{ $page}}</option>
                                            @endforeach
                                        </select>

                                        @php
                                        $previous_page = $pagination['previous_page'];
                                        $current_page = $pagination['current_page'];
                                        $next_page = $pagination['next_page'];
                                        $last_page = $pagination['last_page'];
                                        $page = $pagination['current_page'];
                                        @endphp
                                        <nav aria-label="Page navigation example" class="offset-md-3">
                                            <ul class="pagination">
                                                @if($previous_page)
                                                <li class="page-item @if($previous_page == $page) active @endif"><button name="page" class="page-link" value="0" onclick="this.form.submit()">{{$pagination['previous_page']}}</button></li>
                                                @endif

                                                @if($current_page && $current_page !==$last_page)
                                                <li class="page-item @if($current_page == $page) active @endif"><button name="page" class="page-link" onclick="this.form.submit()">{{ $current_page}}</button>
                                                </li>
                                                @endif

                                                @if($next_page)
                                                <li class="page-item @if($next_page == $page) active @endif"><button class="page-link" name="page" value="{{$next_page}}" onclick="this.form.submit()">{{ $next_page}}</button></li>
                                                @endif

                                                @if($page !== $last_page)
                                                <li class="page-item"><button class="page-link">...</button></li>
                                                @endif

                                                @if($last_page)
                                                <li class="page-item @if($last_page == $page) active @endif"><button class="page-link" name="page" value="{{ $pagination['last_page']}}" onclick="this.form.submit()">Сүүлд</button></li>
                                                @endif
                                            </ul>
                                        </nav>
                                    </div>
                                </div>
                        </form>

                        <div class="modal fade" id="groupModal" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog .modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title">Групп-д нэмэх</h4>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <form method="POST" action="">
                                                @csrf
                                                <input type="hidden" name="user_id" id="user_id">
                                                <div class="form-group row">
                                                    <label for="groups" class="col-md-2 col-form-label text-md-right">{{ __('Групп') }}</label>
                                                    <div class="col-md-8">
                                                        <group {{--:selected="{{ $group_names->pluck('name') }}"--}} class="@error('groups') is-invalid @enderror"></group>
                                                        @error('groups')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="submit" class="btn btn-success">Хадгалах</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- {{ $users->links() }} --}}
                    </div>
                </div>
            </div>
        </div>
    </div>

    @endsection
    @section('javascript')
    <style>
        div.dataTables_wrapper div.dataTables_length select {
            width: 60px !important;
            display: inline-block;
        }
    </style>

    <script>
        $(document).ready(function() {
            $('#test').change(function() {
                // var id = $(this).children("option:selected").val();

            });
        });
    </script>

    @endsection
