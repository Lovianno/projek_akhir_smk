@extends('componen.admin')
@section('title', 'Data Barang')
    
{{-- @section('content-title', 'Data Barang') --}}
@section('content')
@if($message = Session::get('success'))
  <div class="alert alert-success alert-block">
      <button class="close" type="button" data-dismiss="alert">X</button>
      <strong>{{ $message }}</strong>
  </div>
@endif
<div class="row">
  
    <div class="col-lg-12">
        <div class="card shadow mb-4">
            <div class="card-header py-4">
                <h1 class="h1 mb-1 text-gray-800 text-center">Data Barang</h1>
                {{-- <a href="{{ route('mastersiswa.create') }}" class="btn btn-success">Tambah Data</a> --}}
               
            </div>
            <div class="card-body">
              <a href="{{ route('data-barang.create') }}" class="btn btn-success mb-3"> <i class="fa fa-plus" aria-hidden="true"></i> Data Barang</a>
              
                <p class="mb-1 h6 text-dark font-weight-bold">Menampilkan {{ $barang->firstItem() }} - {{ $barang->lastItem()  }} data dari total  {{ $barang->total() }} data</p>
                <div class="table-responsive-xl"> 
                <table class="table text-center">
                    <thead class=" bg-danger text-light">
                        <tr class="">
                          <th class=""scope="col">No</th>
                          <th scope="col">Nama Barang</th>
                          <th scope="col">Kategori</th>
                          <th scope="col">Harga</th>
                          <th scope="col">Stok</th>
                          <th scope="col">Action</th>
                        </tr>
                      </thead>
                      <tbody>
                    @foreach ($barang as $i => $b)
                    <tr>
                        <td>{{ $barang->firstItem()+$i }}</td>
                        <td>{{ $b->nama }}</td>
                        <td>{{ $b->kategori->kategori }}</td>
                        <td>{{ $b->harga }}</td>
                         <td>{{ $b->stok }}</td>
                         <td>
                           <a href="{{ route('data-barang.tambahstok', $b->id) }}" class="btn btn-sm btn-primary btn-circle" title="Tambah Stok Barang"><i class="fa fa-cart-plus"></i></a>
                            <a href="{{ route('data-barang.show', $b->id) }}" class="btn btn-sm btn-info btn-circle" title="Detail Barang"><i class="fas fa-info"></i></a>
                            <a href="{{ route('data-barang.edit', $b->id) }}" class="btn btn-sm btn-warning btn-circle" title="Edit Barang"><i class="fas fa-edit"></i></a>
                            <a href="{{ route('data-barang.hapus', $b->id) }}" class="btn btn-sm btn-danger btn-circle"title="Hapus Barang"><i class="fas fa-trash"></i></a>
                            {{-- <a class="btn btn-sm btn-danger btn-circle" data-toggle="modal" data-target="#exampleModal"><i class="fas fa-trash"></i></a> --}}
                             
                            {{-- --------------------Modal ---------------------------}}
                    <div class="modal fade " id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                      <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Konfirmasi</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <div class="modal-body">
                            Apakah anda yakin untuk menghapus {{ $b->nama  }} ? 
                          </div>
                          <div class="modal-footer">
                            <a href="{{ route('data-barang.hapus', $b->id) }}" class="btn btn-danger">Hapus</a>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                          </div>
                        </div>
                      </div>
                    </div>
                          </td>
                    </tr>
                    @endforeach
                   

                        
                      
                      </tbody>
                  </table>
                 
                  <div class="card-footer d-flex justify-content-between ">
                    
                    {{  $barang->links() }}
                </div>
                </div>
            </div>
        </div>
    </div>
</div>


  

@endsection

    
