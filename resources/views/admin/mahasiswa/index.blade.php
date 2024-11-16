@extends('layouts.app') 
@section('content') 
<div class="container p-4"> 
    <div class="card"> 
        <div class="card-header"> 
            <p>Data Mahasiswa </p>
        </div> 
        <div class="card-body"> 
            <div class="d-flex mb-3"> 
                <form action="{{ route('mahasiswa.index') }}">
                    <input type="text" name="keyword" class="form-control"
                    placeholder="pencarian . . ." value="{{ old('keyword') }}">   
                </form>
                <div class="ms-auto"> 
                    <a href="{{route('mahasiswa.print')}}" class="btn btn-success me-2" target="__blank">Cetak Data</a>
                    <a href="{{route('mahasiswa.create')}}" class="btn btn-primary">+ Tambah</a>

                </div> 
            </div> 
             
                             
        <table class="table table-bordered"> 
        <thead> 
            <tr> 
            <th scope="col">No</th> 
            <th scope="col">Jurusan</th> 
            <th scope="col">NPM</th> 
            <th scope="col">Nama</th> 
            <th scope="col">Tanggal Lahir</th> 
            <th scope="col">Foto</th> 
            <th scope="col">Aksi</th> 
            </tr> 
        </thead> 
        <tbody> 
            @foreach ($mahasiswa as $data)
                
            <tr> 
            
            <td>{{ $loop ->iteration }}</td> 
            <td>{{ $data ->jurusan }}</td> 
            <td>{{ $data ->npm }}</td> 
            <td>{{ $data ->nama }}</td>
            <td>{{ Carbon\carbon::parse($data ->tanggal_lahir)->format('d-m-Y') }}</td> 
            <td> 
                <img src="{{ asset('storage/mahasiswa/'.$data->foto) }}" alt="" width="60">
            </td> 
            <td> 
                <form action="{{ route('mahasiswa.delete',$data->id) }}" method="post">
                    @csrf
                    @method('delete')
                    <a href="{{route('mahasiswa.edit',$data->id)}}" class="btn btn-warning">Edit</a>
                    <a href="" class="btn btn-danger">Hapus</a>

            </td> 
            </tr> 
            @endforeach
        </tbody> 
        </table> 
        </div> 
    </div> 
</div> 
     
@endsection