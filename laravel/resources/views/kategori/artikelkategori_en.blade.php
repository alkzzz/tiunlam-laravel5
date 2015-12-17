@extends('_layout.admin')

@section('content')

<div class="panel panel-default">
        <div class="panel-heading">Daftar artikel dengan kategori {{ $slug }}</div>
        <div class="panel-body">
            <div class="pull-left">
                <div class="btn-toolbar">
                    <a href="{{ route('tambahartikel_en') }}" class="btn btn-success">
                        <span class="glyphicon glyphicon-plus"></span>&nbsp;Tambah artikel
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
                        <th>Judul</th>
                        <th>Kategori</th>
                        <th>Tanggal</th>
                        <th colspan="2">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach($daftar_artikel as $artikel)
                        <tr>
                        <td style="vertical-align:middle"> <h4><a href="{{ url('id', [$artikel->kategori->slug_id, $artikel->slug]) }}">{{ $artikel->judul_artikel }}</a><h4></td>
                        <td style="vertical-align:middle"> <h4><a href="">{{ $artikel->kategori->nama_en }}</a><h4></td>
                        <td style="vertical-align:middle"> <h4> {{ $artikel->created_at->format('l j F Y H:i') }} </h4> </td>
                        <td style="vertical-align:middle"><a class="btn btn-warning" href="">Edit</a></td>
                        <td style="vertical-align:middle"><a class="btn btn-danger" href="{{ route('showdeleteartikel_id', $artikel->slug) }}">Delete</a></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
</div>

{!! $daftar_artikel->render() !!}

@stop