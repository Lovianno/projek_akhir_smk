@extends('componen.admin')
@section('title', 'Update User')
    

@section('content')
@if (count($errors) > 0)

<div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $item)
            <li>{{ $item }}</li>
        @endforeach
    </ul>
</div>
@endif

<div class="row">
    <div class="col-lg-12">
        <div class="card shadow mb-4">
            <div class="card-header py-4">
                <h1 class="h1 mb-1 text-gray-800 text-center">Update Data User</h1>
              
               
            </div>
        <div class="card-body">
            
          <form method="post" action="{{ route('data-user.update', $userId->id) }}" >
            @csrf
            @method('put')
            {{-- @csrf ditambahkan ke codingan form view jika berhubungan dengan database
                    seperti ingin input data ke database --}}

            <div class="form-group">
                <label for="nama">Nama : </label>
                <input type="text" class="form-control" id="nama" name="name" value="{{ $userId->name }}">
            </div>

            <div class="form-group">
                <label for="kategori">Role :</label>

            <select class="custom-select" id="kategori" name="role">
                <option  value="">Pilih</option>
                 <option value="admin" @if($userId->role == "admin") selected @endif>Admin</option>
                 <option value="kasir" @if($userId->role == "kasir") selected @endif>Kasir</option>
            </select>
            </div>

            <div class="form-group">
                <label for="kategori">Jenis Kelamin :</label>

            <select class="custom-select" id="kategori" name="jk">
                <option  value="">Pilih</option>
                 <option value="Laki-Laki" @if($userId->jk == "Laki-Laki") selected @endif>Laki-laki</option>
                 <option value="Perempuan"@if($userId->jk == "Perempuan") selected @endif>Perempuan</option>
            </select>
            </div>
            <div class="form-group">
                <label for="nama">Username : </label>
                <input type="text" class="form-control" id="username" name="username" value="{{ $userId->username }}">
            </div>
            
            
            
            <div class="form-group">
                <label for="nama">Password : </label>
                <input type="text" class="form-control" id="password" name="password" value="{{ $userId->password}}">
            </div>
            
            <input type="submit" class="btn btn-success">
            <a href="{{ route('data-user.index') }}" class="btn btn-danger">Kembali</a>
        </form>  
        </div>
    </div>
    </div>
</div>
@endsection