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
                            <h5><i class="fa fa-align-justify"></i>{{ __('Орчуулгын жагсаалт') }}</h5>
                        </span> <span class="float-right">
                            <!-- <button type="button" id="deleteMultiple" class="btn btn-danger deleteMultiple"  href="javascript:void(0)" data-original-title="Delete">Олноор устгах</button> -->
                            <!-- @role('admin|super-admin')
                            <a class="btn btn-primary" href="{{ route('translations.create') }}"><i class="cil-pencil"></i>Орчуулга оруулах</a>
                            @endrole
                            @role('admin|super-admin|writer')
                            <a class="btn btn-success" href="{{ route('translations.new') }}"><i class="cil-plus"></i>Орчуулга нэмэх</a>
                            @endrole -->
                        </span>
                    </div>

                    <div class="card-body">
                        <div class="col-md-6">
                            <form action="/translations" class="form-horizontal">
                            <div class="form-group row">                                                            
                                <label class="col-md-3" for="ccmonth">Тест:</label>
                                <div class="col-md-9">
                                    <select name="test_id" id="test_id" class="form-control" type="input" onchange="this.form.submit();">
                                        <option value="0">Нэг утгийг сонго</option>
                                        @foreach ($tests as $test)
                                        <option @if( $test->id == request()->get('test_id')) selected @endif
                                            @if ( old('test_id') == $test->id ) selected @endif value="{{ $test->id}}" >{{ $test->label}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            </form>
                        </div>

                        @include('layouts.shared.alert')
                        
                        <table class="table table-bordered yajra-datatable translation_table" id="translation_table" style="verflow-x: auto; width: 100%; font-size:13.5px;">
                            <thead>
                                <tr>
                                    <!-- <th width="3px"><input type="checkbox" id="selectAll"/></th> -->
                                    <th width="5px">#</th>
                                    <th>Тест</th>
                                    <th>Нэр</th>
                                    <th>Орчуулга EN</th>
                                    <th>Орчуулга MN</th>
                                    <th>Төлөв</th>
                                    <th width="250px">Үйлдэл</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
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
        $(function() {
            var table = $('.yajra-datatable').DataTable({
                responsive: true,
                processing: true,
                serverSide: true,                
                ajax: {
                    url: "{{ route('translations.index') }}",
                    data: function (d) {
                        d.test_id = $('#test_id').val()
                    }
                },
                columns: [
                    {
                        data: 'id',
                        name: 'id'
                    },

                    {
                        data: 'test_id',
                        name: 'test_id'
                    },
                    {
                        data: 'label',
                        name: 'label',
                        render: function(data, type, row) {
                            return "<a href='/testapi/'>" + row.label + "</a>"
                        }
                    },
                    {
                        data: 'EN',
                        name: 'EN',
                        orderable: true,
                        searchable: true
                    },
                    {
                        data: "MN",
                        name: "MN",
                        orderable: true,
                        searchable: true
                    },
                    {
                        data: 'status',
                        name: 'status'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: true,
                        searchable: true

                    },
                ]
            });

        });
    </script>
    @endsection
