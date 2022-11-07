@extends('componen.admin')
@section('title', 'Laporan Data Barang')
    
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
                <h1 class="h1 mb-1 text-gray-800 text-center">Laporan Data Barang</h1>
               
            </div>
            <div class="card-body">
              {{-- <a href="{{ route('data-barang.create') }}" class="btn btn-success mb-3"> <i class="fa fa-plus" aria-hidden="true"></i> Data Barang</a> --}}
              <a href="/laporandatabarang/cetak_pdf" target="_blank" class="btn btn-success mb-3">Cetak PDF</a>
              
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

    
