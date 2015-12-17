@extends('_layout.admin')

@section('content')

@if (Session::has('message'))
         <div class="alert alert-info">
            <h3>{{ Session::get('message') }}</h3>
         </div>   
@endif

    <div class="panel panel-default">
        <div class="panel-heading">Daftar Kategori</div>
        <div class="panel-body">
            <div class="pull-left">
                <div class="btn-toolbar">
                    <a href="{{ route('tambahkategori') }}" class="btn btn-success">
                        <span class="glyphicon glyphicon-plus"></span>&nbsp;Tambah kategori
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
                        <th>Kategori (ID)</th>
                        <th>Kategori (EN)</th>
                        <th>Tanggal</th>
                        <th colspan="2">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach($daftar_kategori as $kategori)
                        <tr>
                        <td style="vertical-align:middle"> <h4><a href="{{ route('admin-kategoriartikel_id', $kategori->slug_id) }}">{{ $kategori->nama_id }}</a><h4></td>
                        <td style="vertical-align:middle"> <h4><a href="{{ route('admin-kategoriartikel_en', $kategori->slug_en) }}">{{ $kategori->nama_en }}</a><h4></td>
                        <td style="vertical-align:middle"> <h4> {{ $kategori->created_at->format('l j F Y H:i') }} </h4> </td>
                        <td style="vertical-align:middle"><a class="btn btn-warning" href="{{ route('editkategori', $kategori->slug_id) }}">Edit</a></td>
                        <td style="vertical-align:middle"><a class="btn btn-danger" href="{{ route('showdeletekategori', $kategori->slug_id) }}">Delete</a></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="pull-left">
        {!! $daftar_kategori->render() !!}
    </div>

@stop