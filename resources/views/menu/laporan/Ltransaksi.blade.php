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
                <h1 class="h1 mb-1 text-gray-800 text-center">Laporan Transaksi Penjualan</h1>
               
            </div>
            <div class="card-body">
              {{-- <a href="{{ route('data-barang.create') }}" class="btn btn-success mb-3"> <i class="fa fa-plus" aria-hidden="true"></i> Data Barang</a> --}}
              <a href="/laporantransaksi/cetak_pdf" target="_blank" class="btn btn-success mb-3">Cetak PDF</a>
              
                <p class="mb-1 h6 text-dark font-weight-bold">Menampilkan {{ $transaksi->firstItem() }} - {{ $transaksi->lastItem()  }} data dari total  {{ $transaksi->total() }} data</p>
                <table class="table text-center table-responsive-xl">
                    <thead class=" bg-primary text-light">
                        <tr class="">
                          <th class=""scope="col">No</th>
                          <th scope="col">Kode Pembelian</th>
                          <th scope="col">Tanggal</th>
                          <th scope="col">Harga Total</th>
                          <th scope="col">Aksi</th>
                        </tr>
                      </thead>
                      <tbody class="table-bordered ">
                    @foreach ($transaksi as $i => $b)
                    <tr>
                        <td>{{ $transaksi->firstItem()+$i }}.</td>
                        <td>{{ $b->kode_pembelian }}</td>
                        <td>{{ $b->date }}</td>
                         <td>{{ number_format($b->hargatotal) }}</td>
                         <td width="8%"><a href="{{ route('laporantransaksi.show', $b->id) }}" title="Detail Transaksi" class="btn btn-info btn-rounded"><i class="fas fa-info"></i></a></td>
                        
                    </tr>
                    @endforeach
                   

                        
                      
                      </tbody>
                  </table>
                 
                  <div class="card-footer d-flex justify-content-between ">
                    
                    {{  $transaksi->links() }}
                </div>
                </div>
            </div>
        </div>
    </div>


  

@endsection

    
