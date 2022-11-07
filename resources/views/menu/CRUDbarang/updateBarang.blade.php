@extends('componen.admin')
@section('title', 'Update Barang')
    

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
                <h1 class="h1 mb-1 text-gray-800 text-center">Edit Data Barang</h1>
              
               
            </div>
        <div class="card-body">
            
          <form method="POST" action="{{ route('data-barang.update', $barang->id) }}" >
            @csrf
            @method('PUT')
            {{-- @csrf ditambahkan ke codingan form view jika berhubungan dengan database
                    seperti ingin input data ke database --}}

            <div class="form-group">
                <label for="nama">Nama : </label>
                <input type="text" class="form-control" id="nama" name="nama" value="{{ $barang->nama }}">
            </div>
            
            <div class="form-group">
                <label for="kategori">Kategori :</label>
                {{-- <input type="number" min="0" class="form-control" id="stok" name="kategori" value=""> --}}

            <select class="custom-select" id="kategori" name="kategori_id">
                <option selected value="">Pilih</option>
                @foreach($kategori as $k)
                 <option value="{{ $k->id }}">{{ $k->kategori }}</option>
                 @endforeach
             </select>
             
            </div>

            <div class="form-group">
                <label for="harga">Harga :</label>
            <div class="input-group mb-3">
                
                <div class="input-group-prepend">
                  <span class="input-group-text">Rp.</span>
                  
            </div>
                
                <input type="number" min="0"  class="form-control" id="harga" name="harga" value="{{ $barang->harga }}">
              </div>
            </div>

            <div class="form-group">
                <label for="nama">Stok : </label>
                <input type="number" disabled min="0" class="form-control" id="stok" name="stok" value="{{ $barang->stok }}">
            </div>
           
            <input type="submit" class="btn btn-success">
            <a href="{{ route('data-barang.index') }}" class="btn btn-danger">Kembali</a>
        </form>  
        </div>
    </div>
    </div>
</div>
@endsection