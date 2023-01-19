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
                <h1 class="h1 mb-1 text-gray-800 text-center" id="tes">Data Barang</h1>
                {{-- <a href="{{ route('mastersiswa.create') }}" class="btn btn-success">Tambah Data</a> --}}
               
            </div>
            <div class="card-body">
              
                <input type="text" name="search" class="form-control" id="search" placeholder="Cari"><hr>
              
              <a href="{{ route('data-barang.create') }}" class="btn btn-success mb-3"> <i class="fa 
                fa-plus" aria-hidden="true"></i> Data Barang</a><br>

                <form action="{{ route('data-barang.cari') }}"  method="GET">
                  <div class=" d-flex " >

                <div class="form-group  w-50">
                <input type="text" name="nama" value="{{ $hasilnama }}" id="" class="form-control" placeholder="CARI BARANG">
                </div>
                <div class="form-group  ml-2">
                  <select class="custom-select mr-sm-2" id="" name="kategori">
                    <option selected value="">PILIH KATEGORI</option>
                  
                    @foreach($kategori as $item)
                    <option value="{{ $item->id }}">{{ $item->kategori }}</option>
                      @endforeach
                  </select>
                </div>
                
                <div class="form-group">
                <button type="submit" title="CARI" class="btn btn-success ml-1 btn-rounded"><i class="fa fa-search" aria-hidden="true"></i>
                </button>
                <a href="/data-barang" title="REFRESH" class="btn btn-warning ml-0 btn-rounded"><i class="fa fa-retweet" aria-hidden="true"></i>
                </a>
                </div>
                
                </div>
                
              </form>
                
                <p class="mb-1 h6 text-dark font-weight-bold">Menampilkan {{ $barang->firstItem() }} - {{ $barang->lastItem()  }} data dari total  {{ $barang->total() }} data</p>
                <div class="table-responsive-xl"> 
                <table class="table text-center" id="tabel">
                    <thead class=" bg-primary text-light">
                        <tr class="">
                          <th class=""scope="col">No</th>
                          <th scope="col">Nama Barang</th>
                          <th scope="col">Kategori</th>
                          <th scope="col">Harga</th>
                          <th scope="col">Stok</th>
                          <th scope="col">Action</th>
                        </tr>
                      </thead>
                      <tbody id="allData">
                    @foreach ($barang as $i => $b)
                    <tr id="listBarang">
                        <td width="5%">{{ $barang->firstItem()+$i }}.</td>
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
                             
                    
                          </td>
                    </tr>
                    @endforeach
                    
                      </tbody>
                      {{-- ==================================================== --}}
                      <tbody id="Content"></tbody>
                  </table>
                 
                  <div class="card-footer d-flex justify-content-between " id="paginateAll">
                    
                    {{  $barang->links() }}
                </div>
                 
                </div>
            </div>
        </div>
    </div>
</div>


  <script type="text/javascript">
  
  
   $(document).ready(function(){
    $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });
       $(document).on('keyup', '#search', function(){
            $search = $(this).val();
            
            $.ajax({
              method: "post",
              url: 'search',
              data: JSON.stringify({
                search: $search
              }),
              headers: {
                'Accept': 'application/json',
                'Content-Type': 'application/json'
              },
              success: function(data){

                $("#allData").hide();
                $("#Content").html(data);
              }
            })
          });
       
  });

    </script>
@endsection

    
