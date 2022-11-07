@extends('componen.admin')
@section('title', 'Tambah Kategori')
    

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
                <h1 class="h1 mb-1 text-gray-800 text-center">Tambah Stok Barang </h1>
              
               
            </div>
        <div class="card-body">
            
          <form method="post" action=" {{ route('data-barang.storestok', $barangId->id) }}" >
           
            @csrf
            {{-- @csrf ditambahkan ke codingan form view jika berhubungan dengan database
                    seperti ingin input data ke database --}}

            <div class="form-group">
                <label for="nama">Nama Barang : </label>
                <input type="text" class="form-control" id="nama" name="nama" value="{{ $barangId->nama }}" disabled>
            </div>
            <div class="form-group">
                <label for="stoks">Stok Sebelum: </label>
                <input type="text" class="form-control" id="stoks" name="stoklama" value="{{ $barangId->stok }}" disabled>
            </div>
            <div class="form-group">
                <label for="stok">Stok yang akan ditambahkan : </label>
                <input type="number" class="form-control" id="stokk" name="stok" value="{{ old('stok') }}" >
            </div>
            
            <input type="submit" class="btn btn-success" value="Simpan">
            <a href="{{ route('data-barang.index') }}" class="btn btn-danger">Kembali</a>
        </form>  
        </div>
    </div>
    </div>
</div>



<script>
    let inputStok = document.getElementById("stokk");

var invalidChars = ["-", "+", "e"];

inputStok.addEventListener("keydown", function (e) {
    if (invalidChars.includes(e.key)) {
        e.preventDefault();
    }
});
</script>
@endsection

