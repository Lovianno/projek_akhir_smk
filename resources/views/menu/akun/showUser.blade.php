@extends('componen.admin')
@section('title', 'Tambah User')
    

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
                <h1 class="h1 mb-1 text-gray-800 text-center">Tambah Data User</h1>
              
               
            </div>
        <div class="card-body">
            
          {{-- <form method="post" action="{{ route('data-user.update', $userId->id) }}" >
            @csrf
            @method('put') --}}
            {{-- @csrf ditambahkan ke codingan form view jika berhubungan dengan database
                    seperti ingin input data ke database --}}

            <div class="form-group">
                <label for="nama">Nama : </label>
                <input disabled type="text" class="form-control" id="nama" name="name" value="{{ $userId->name }}">
            </div>

            <div class="form-group">
                <label for="nama">Role : </label>
                <input type="text" class="form-control" id="username" name="username"disabled value="{{ $userId->role }}">
            </div>

            <div class="form-group">
                <label for="nama">Jenis Kelamin : </label>
                <input type="text" class="form-control" id="username"disabled name="username" value="{{ $userId->jk }}">
            </div>
            
            <div class="form-group">
                <label for="nama">Username : </label>
                <input type="text" class="form-control" id="username" disabled name="username" value="{{ $userId->username }}">
            </div>
            
            
            
            <div class="form-group">
                <label for="nama">Password : </label>
                <input type="text" class="form-control" id="password"disabled name="password" value="{{ $userId->password}}">
            </div>
            
            <a href="{{ route('data-user.edit', $userId->id) }}" class="btn btn-warning"><i class="fa fa-edit" aria-hidden="true"></i>
                Edit User</a>
            <a href="{{ route('data-user.index') }}" class="btn btn-danger">Kembali</a>
        {{-- </form>   --}}
        </div>
    </div>
    </div>
</div>
@endsection