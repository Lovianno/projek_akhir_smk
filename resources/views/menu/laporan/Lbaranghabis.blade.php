@extends('componen.admin')
@section('title', 'Laporan Barang Habis')
    
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
                <h1 class="h1 mb-1 text-gray-800 text-center">Laporan Barang Habis</h1>
               
            </div>
            <div class="card-body">
           
              {{-- <a href="/laporandatabarang/cetak_pdf" target="_blank" class="btn btn-success mb-3">Cetak PDF</a> --}}
                

               {{-- CARI BARANG --}}
               <form action="{{ route('laporanbaranghabis.sort') }}"  method="GET">
                <div class=" d-flex " >

              <div class="form-group  ml-2">
                <select class="custom-select mr-sm-2" id="" name="kategori">
                  <option selected value="">PILIH KATEGORI</option>
                
                  @foreach($kategori as $item)
                  <option value="{{ $item->id }} " @if($item->id == $hasilkategori) selected @endif>{{ $item->kategori }}</option>
                    @endforeach
                </select>
              </div>
              
              <div class="form-group d-flex ">
              <button type="submit" title="CARI" class="btn btn-success ml-2 btn-rounded"><i class="fa fa-search" aria-hidden="true"></i>
              </button>
              <a href="/laporanbaranghabis" title="REFRESH" class="btn btn-warning ml-1 btn-rounded"><i class="fa fa-retweet" aria-hidden="true"></i>
              </a>
              </div>
              
              </div>
              
            </form>



                <p class="mb-1 h6 text-dark font-weight-bold">Menampilkan {{ $barang->firstItem() }} - {{ $barang->lastItem()  }} data dari total  {{ $barang->total() }} data</p>
                <div class="table-responsive-xl"> 
                <table class="table text-center">
                    <thead class=" bg-primary text-light">
                        <tr class="">
                          <th class=""scope="col">No</th>
                          <th scope="col">Nama Barang</th>
                          <th scope="col">Kategori</th>
                          {{-- <th scope="col">Harga</th> --}}
                          <th scope="col">Stok</th>
                        </tr>
                      </thead>
                      <tbody>
                        @if($barang->isEmpty())
                        <tr>
                          <td colspan="5" class="font-weght-bold">TIDAK ADA DATA YANG DITEMUKAN</td>
                        </tr>
                       @else 
                    @foreach ($barang as $i => $b)
                    <tr>
                        <td width="5%">{{ $barang->firstItem()+$i }}.</td>
                        <td>{{ $b->nama }}</td>
                        <td>{{ $b->kategori->kategori }}</td>
                        {{-- <td>{{ $b->harga }}</td> --}}
                         <td>{{ $b->stok }}</td>
                        
                    </tr>
                    @endforeach
                   

                        @endif
                      
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

    
