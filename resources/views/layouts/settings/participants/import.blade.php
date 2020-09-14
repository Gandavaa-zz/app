@extends('layouts.app')

@section('content')

<div class="c-main">

    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3>xaxaxa</h3>
                    </div>
                <div class="card-body">
                    <div class="container">
                        <form method="post" enctype="multipart/form-data" action="{{ url('/participants/import_excel') }}">
                            {{ csrf_field() }}
                            <div class="form-group">
                             <table class="table">
                              <tr>
                               <td width="40%" align="right"><label>Select File for Upload</label></td>
                               <td width="30">
                                <input type="file" name="select_file" />
                               </td>
                               <td width="30%" align="left">
                                <input type="submit" name="upload" class="btn btn-primary" value="Upload">
                               </td>
                              </tr>
                              <tr>
                               <td width="40%" align="right"></td>
                               <td width="30"><span class="text-muted">.xls, .xslx</span></td>
                               <td width="30%" align="left"></td>
                              </tr>
                             </table>
                            </div>
                           </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
