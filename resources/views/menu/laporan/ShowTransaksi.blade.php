@extends('componen.admin')
@section('title', 'Laporan Data Barang')
    
{{-- @section('content-title', 'Data Barang') --}}
@section('content')
<div class="container">
  <div class="row justify-content-center">
      <div class="col-md-12">
          <div class="card ">
              <div class="card-header bg-primary text-light">{{ __('Detail Transaction') }}</div>

              <div class="card-body">
                  @if (session('status'))
                      <div class="alert alert-success" role="alert">
                          {{ session('status') }}
                      </div>
                  @endif

                  {{-- {{ __('You are logged in!') }} --}}

                  <table class="table ">
                      <tr>
                          <td class="col-md-2">Kode Pembelian : {{ $transaksi->kode_pembelian }}</td>
                      </tr>
                      <tr>
                          <td class="col-md-2">Tanggal : {{ $transaksi->date }}</td>
                      </tr>
                      <tr>
                          <td class="col-md-2">Kasir : {{ $transaksi->pegawai->name }} </td>
                      </tr>
                  </table>
                  <table class="table table-responsive-xl  table-bordered">
                      <thead class="bg-primary text-light">
                          <td>#</td>
                          <td>Nama Barang</td>
                          <td>Jumlah</td>
                          <td>Harga Satuan</td>
                          <td>Subtotal</td>
                      </thead>
                      <tbody>
                        @foreach ($details as $detail)
                            
                          <tr>
                          <td>{{ $loop->iteration }}</td>
                          <td>{{ $detail->barang->nama }}</td>
                          <td>{{ $detail->quantity }}</td>
                          <td>Rp. {{ number_format($detail->barang->harga) }}</td>
                          <td>
                            Rp. {{ number_format($detail->subtotal) }}
                          </td>
                      </tr>
                      @endforeach

                      <tr class="font-weight-bold">
                          <td colspan="4" class="text-right">Grand Total</td>
                          <td>Rp. {{ number_format($transaksi->hargatotal )}}</td>
                      </tr>
                      <tr class="font-weight-bold">
                          <td colspan="4"class="text-right">Uang Bayar</td>
                          <td>Rp. {{ number_format($transaksi->paytotal) }}</td>
                      </tr>
                      <tr class="font-weight-bold">
                          <td colspan="4"class="text-right">Kembalian</td>
                          <td>Rp. {{ number_format($transaksi->kembalian) }}</td>
                      </tr>
                      </tbody>
                  </table>


              </div>
          <a href="{{ route('cetakdetail.transaksi') }}" target="_blank" class="btn btn-success mb-1">Cetak</a>
          <a href="/laporantransaksi" class="btn btn-warning">Kembali</a>
              
          </div>
      </div>
      
  </div>
</div>


  

@endsection

    
