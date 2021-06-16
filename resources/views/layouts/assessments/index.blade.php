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
                            <div class="form-group row">
                                <label class="col-md-1 col-form-label" for="test">Тест:</label>
                                <div class="col-md-4">
                                    <select name="test_id" id="test" class="form-control" onchange="this.form.submit()">
                                        <option value="0">Нэг утгийг сонго</option>
                                        @foreach ($tests as $test)
                                        <option @if( $test->id == request()->get('test_id')) selected @endif value="{{ $test->id}}" >{{ $test->label}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </form>

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
                                    @foreach( $assessments['result']['data']  as $item )
                                    <tr>
                                        <td>
                                            {{ $item['candidate_id'] }}
                                        </td>
                                        <td> @if(isset($item->candidate ))
                                                {{ $item->candidate->full_name }}
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
                                            <a href="#" class="btn btn-primary btn-sm">Харах</a>
                                            <a href="{{$item['candidate_report_link']}}" target="_blank" class="btn btn-primary btn-danger">Тайлан харах</a>
                                            <a href="/reports/getXml/{{$item['id']}}/{{$item['test']['id']}}" class="btn btn-warning btn-sm">Xml Татах</a>
                                            <a href="/assessment/salesProfile/{{$item['id']}}" class="btn btn-warning btn-sm">SalesProfile задлах</a>
                                        </td>
                                    </tr>
                                    @endforeach
                            </tbody>
                        </table>
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
