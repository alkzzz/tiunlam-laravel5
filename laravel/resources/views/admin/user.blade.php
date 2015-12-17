@extends('_layout.admin')

@section('content')

@if (Session::has('message'))
         <div class="alert alert-info">
            <h3>{{ Session::get('message') }}</h3>
         </div>   
@endif
     <div class="panel panel-default">
        <div class="panel-heading">Daftar User</div>
        <div class="panel-body">
            <div class="pull-left">
                <div class="btn-toolbar">
                    <a href="{{ route('tambahuser') }}" class="btn btn-success">
                        <span class="glyphicon glyphicon-plus"></span>&nbsp;Tambah user
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
                        <th>Username</th>
                        <th>Role</th>
                        <th colspan="2">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $user)
                        <tr>
                        <td style="vertical-align:middle"> <h4>{{ $user->username }}</a></td>
                        @foreach ($user->roles as $role)
                        <td style="vertical-align:middle"> <h4> {{ $role->display_name }} </h4> </td>
                        @endforeach
                        <td style="vertical-align:middle"><a class="btn btn-warning" href="{{ route('edituser', $user->username) }}">Edit</a></td>
                        <td style="vertical-align:middle"><a class="btn btn-danger" href="{{ route('showdeleteuser', $user->username) }}">Delete</a></td>
                        </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
        </div>
        <div class="pull-left">
        {!! $users->render() !!}
        </div>
    </div>
</div>

@stop