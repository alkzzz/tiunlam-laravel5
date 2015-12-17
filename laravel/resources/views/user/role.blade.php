@extends('_layout.admin')

@section('content')

@if (Session::has('message'))
         <div class="alert alert-info">
            <h3>{{ Session::get('message') }}</h3>
         </div>   
@endif
     <div class="panel panel-default">
        <div class="panel-heading">Daftar Role</div>
        <div class="panel-body">
            <div class="pull-left">
                <div class="btn-toolbar">
                    <a href="{{ route('tambahrole') }}" class="btn btn-success">
                        <span class="glyphicon glyphicon-plus"></span>&nbsp;Tambah role
                    </a>
                </div>
            </div>
            <br>
            <br>
            <br>
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th>Nama Role</th>
                        <th>Deskripsi</th>
                        <th colspan="2">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach($roles as $role)
                        <tr>
                        <td style="vertical-align:middle"> <h4> {{ $role->display_name }} </h4> </td>
                        <td style="vertical-align:middle"> <h4> {{ $role->description }} </h4> </td>
                        <td style="vertical-align:middle"><a class="btn btn-warning" href="{{ route('editrole', $role->name) }}">Edit</a></td>
                        <td style="vertical-align:middle"><a class="btn btn-danger" href="{{ route('showdeleterole', $role->name) }}">Delete</a></td>
                        </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
        </div>
        <div class="pull-left">
        {!! $roles->render() !!}
        </div>
    </div>
</div>

@stop