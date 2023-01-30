@extends('componen.admin')
@section('title', 'Laporan Transaksi')
    
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
              <form action="{{ route('laporantransaksi.sort') }}"  method="GET">
                <div class=" d-flex " >

             
              <div class="form-group">
               <input type="date" name="tanggalAwal" id="" class="form-control" value="{{ $tanggalAwal }}">
              </div>
              <h3 class="ml-2 mr-2">-</h3>
              <div class="form-group">
               <input type="date" name="tanggalAkhir" id="" class="form-control" value="{{ $tanggalAkhir }}">
              </div>
            
              
              <div class="form-group d-flex ">
              <button type="submit" title="CARI" class="btn btn-success ml-2 btn-rounded"><i class="fa fa-search" aria-hidden="true"></i>
              </button>
              <a href="/laporantransaksi" title="REFRESH" class="btn btn-warning ml-1 btn-rounded"><i class="fa fa-retweet" aria-hidden="true"></i>
              </a>
              </div>
              
              </div>
              
            </form>
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
                        @if($transaksi->isEmpty())
                          <tr>
                            <td colspan="5" class="font-weght-bold">TIDAK ADA DATA YANG DITEMUKAN</td>
                          </tr>
                         @else 
                    @foreach ($transaksi as $i => $b)
                    <tr>
                        <td>{{ $transaksi->firstItem()+$i }}.</td>
                        <td>{{ $b->kode_pembelian }}</td>
                        <td>{{ $b->date }}</td>
                         <td>{{ number_format($b->hargatotal) }}</td>
                         <td width="8%"><a href="{{ route('laporantransaksi.show', $b->id) }}" title="Detail Transaksi" class="btn btn-info btn-rounded"><i class="fas fa-info"></i></a></td>
                        
                    </tr>
                    @endforeach
                    @endif

                        
                      
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

    
