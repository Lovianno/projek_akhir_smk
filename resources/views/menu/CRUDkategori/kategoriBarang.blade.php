@extends('componen.admin')
@section('title', 'Data Kategori')
    
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
                <h1 class="h1 mb-1 text-gray-800 text-center">Data Kategori</h1>
                {{-- <a href="{{ route('mastersiswa.create') }}" class="btn btn-success">Tambah Data</a> --}}
               
            </div>
            <div class="card-body">
              <a href="{{ route('data-kategori.create') }}" class="btn btn-success mb-3"> <i class="fa fa-plus" aria-hidden="true"></i>
                Data Kategori</a>

                <form action=""  >
                  <div class=" w-50 d-flex" >

                <div class="form-group">
                <input type="text" name="" id="" class="form-control" placeholder="CARI KATEGORI">
               
                </div>
                
                <div class="form-group">
                <button class="btn btn-warning ml-1">CARI</button>
                </div>
                
                </div>
                
              </form>
                <p class="mb-1 h6 text-dark font-weight-bold">Menampilkan {{ $kategori->firstItem() }} - {{ $kategori->lastItem()  }} data dari total  {{ $kategori->total() }} data</p>
              
                <table class="table text-center table-responsive-xl" >
                    <thead class=" bg-primary text-light">
                        <tr class="">
                          <th class=""scope="col">No</th>
                          <th scope="col">Nama Kategori</th>
                          <th scope="col">Action</th>
                        </tr>
                      </thead>
                      <tbody>
                    @foreach ($kategori as $i => $item)
                    <tr>
                        <td width="5%">{{ $kategori->firstItem() + $i }}.</td>
                        <td>{{ $item->kategori }}</td>
                       
                         <td>
                            {{-- <a href="" class="btn btn-sm btn-info btn-circle"><i class="fas fa-info"></i></a> --}}
                            <a href="{{ route('data-kategori.edit', $item->id ) }}" class="btn btn-sm btn-warning btn-circle"><i class="fas fa-edit"></i></a>

                            <a class="btn btn-sm btn-danger btn-circle" href="{{ route('data-kategori.hapus', $item->id) }}"><i class="fas fa-trash"></i></a>
                            
                            {{-- {{ route('data-kategori.edit') }} --}}

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
                            Apakah anda yakin untuk menghapus {{ $item->kategori  }} ? 
                          </div>
                          <div class="modal-footer">
                            <a href="{{ route('data-kategori.hapus', $item->id) }}" class="btn btn-danger">Hapus</a>
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
                  <div class="card-footer d-flex justify-content-start ">
                    {{  $kategori->links() }}
              </div>
                </div>
            </div>
        </div>
</div>
@endsection