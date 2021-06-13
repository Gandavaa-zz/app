@extends('layouts.app')

@section('content')
        <meta name="csrf-token" content="{{ csrf_token() }}" />

        {{ $candidate }}
        <div class="container-fluid">
          <div class="animated fadeIn">
            <div class="row">
              <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                <div class="card">
                    <div class="card-header">
                        <span class="float-left"><h5><i class="fa fa-align-justify"></i>
                        {{ $candidate->full_name }} -ий өгсөн шалгалтууд
                        </h5></span> <span class="float-right">
                    </div>

                    <div class="card-body">
                    @include('layouts.shared.alert')

                        <table class="table table-bordered yajra-datatable user_table " id="user_table" style="width: 100%; font-size:13.5px;">
                            <thead>
                                <tr>
                                    <th>Шалгалтын #</th>
                                    <th>Тест </th>
                                    <th>Шалгалт эхэлсэн огноо</th>
                                    <th>Шалгалт дууссан огноо</th>
                                    <th>Үнэлсэн</th>
                                    <th>Тайлан холбоос</th>
                                    <th>Тайлан pdf холбоос</th>
                                    <th>Үйлдэл</th>
                                </tr>
                            </thead>
                            <tbody>

                                @if ($assessments)
                                    @foreach($assessments as $assessment)
                                    <tr>
                                        <td>{{ $assessment->id }}</td>
                                        <td>{{ $assessment->test }}</td>
                                        <td>{{ $assessment->assessment_start_date}}</td>
                                        <td>{{ $assessment->assessment_end_date }}</td>
                                        <td>
                                        @if( isset( $assessment->candidate_evaluator))
                                            {{ $assessment->candidate_evaluator->prenom }}
                                        @endif
                                        </td>
                                        <td>
                                            <a href="{{ $assessment->candidate_report_link }}">Тайлан холбоос</a>
                                        </td>
                                        <td>
                                            <a href="{{ $assessment->candidate_report_pdf_link }}">Тайлан PDF холбоос</a>
                                        </td>
                                        <td>
                                        <!-- <i class="cil-description"></i> -->
                                            <a href="/reports/result/{{ $assessment->id }}" target="_blank" title="Full result" class="btn btn-primary">Тайлан харах</a>
                                            <a href="/reports/result/{{ $assessment->id }}" target="_blank" title="Full result" class="btn btn-primary">Full Result Score</a>
                                            <a href="/reports/global/{{ $assessment->id }}" target="_blank" title="Global оноо" class="btn btn-primary">Global Score</a>
                                            <a href="/reports/factory/{{ $assessment->id }}" target="_blank" title="Factory оноо" class="btn btn-primary">Factory Score</a>
                                            <a href="/reports/groups/{{ $assessment->id }}" target="_blank" title="Factory оноо" class="btn btn-primary">Groups Score</a>
                                            <a href="/reports/referential/{{ $assessment->id }}" target="_blank" title="Factory оноо" class="btn btn-primary">Referential</a>
                                        </td>
                                    </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td rowspan="8">
                                            Өгсөн шалгалтууд олдсонгүй!
                                        </td>
                                    </tr>
                                @endif

                            </tbody>
                        </table>

                    </div>
                </div>
              </div>
            </div>
        </div>

@endsection
@section('javascript')

@endsection

