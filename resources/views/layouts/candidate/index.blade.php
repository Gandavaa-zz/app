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
                            <h5><i class="fa fa-align-justify"></i>{{ __('Харилцагчид') }}</h5>
                        </span>
                        <span class="float-right">
                            <!-- <button type="button" id="deleteMultiple" class="btn btn-danger deleteMultiple"  href="javascript:void(0)" data-original-title="Delete">Олноор устгах</button> -->
                            <a class="btn btn-primary" href="{{ route('candidate.create') }}">
                                <svg class="c-icon">
                                    <use xlink:href="{{ asset('icons/sprites/free.svg#cil-plus') }}"></use>
                                </svg> Шинэ</a>
                    </div>

                    <div class="card-body">
                        @include('layouts.shared.alert')

                        <table class="table table-bordered yajra-datatable user_table " id="user_table"
                            style="width: 100%; font-size:13.5px;">
                            <thead>
                                <tr>
                                    <th width="3px"><input type="checkbox" id="selectAll" /></th>
                                    <!-- <th width="5px">#</th> -->
                                    <th>Нэр, овог</th>
                                    <th>Имэйл</th>
                                    <th>Байгууллага</th>
                                    <th>Үүссэн.огноо</th>
                                    <th width="250px">Үйлдэл</th>
                                </tr>
                            </thead>
                            <tbody>
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
                                                    <label for="groups"
                                                        class="col-md-2 col-form-label text-md-right">{{ __('Групп') }}</label>
                                                    <div class="col-md-8">
                                                        <group {{--:selected="{{ $group_names->pluck('name') }}"--}}
                                                            class="@error('groups') is-invalid @enderror"></group>
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

var table = $('.yajra-datatable').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('candidate.index') }}",
                columns: [{
                        data: 'checkbox',
                        name: 'checkbox',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'fullname',
                        name: 'fullname',
                        render: function (data, type, row) {
                            return "<a style='color:#4F5D73;font-weight:bold' href='/participants/" +
                                row.id + "'>" + row.fullname + "</a>"
                        }
                    },
                    {
                        data: 'email',
                        name: 'email'
                    },
                    {
                        data: 'company.company',
                        name: 'company'
                    },
                    {
                        data: 'created_at',
                        name: 'created_at'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: true,
                        searchable: true

                    },
                ]
            });
        // $(function () {



        // });

        $(document).ready(function () {
            $('body').on('click', '.addToGroup', function () {
                var id = $(this).data('id');
                $('#user_id').val(id);
                $('#groupModal').modal('show');
            })




        });

        $(document).ready(function () {
            $('body').on('click', '#selectAll', function () {
                if ($(this).hasClass('allChecked')) {
                    $('input[type="checkbox"]', '#user_table').prop('checked', false);
                } else {
                    $('input[type="checkbox"]', '#user_table').prop('checked', true);
                }
                $(this).toggleClass('allChecked');
            })
        });

        $('body').on('click', '.delete', function () {
            var id = $(this).data("id");

            $('#select_all').click(function (event) {
                var $that = $(this);

                $(':checkbox').each(function () {
                    this.checked = $that.is(':checked');
                });
            });

        });

        function destroy(candidate){
            var r = confirm("Та энэ хэрэглэгчийг устгахдаа итгэлтэй байна уу устгах уу?");
            if (r == true) {
                axios.delete('/candidate/'+candidate).then(res => {
                    flash(res.data.msg, res.data.status);
                    table.ajax.reload();
                });
            }
        }

    </script>

    @endsection
