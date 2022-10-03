@extends('componen.admin')
@section('title', 'Data Kategori')
    
{{-- @section('content-title', 'Data Barang') --}}
@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card shadow mb-4">
            <div class="card-header py-4">
                <h1 class="h1 mb-1 text-gray-800 text-center">Data Kategori</h1>
                {{-- <a href="{{ route('mastersiswa.create') }}" class="btn btn-success">Tambah Data</a> --}}
               
            </div>
            <div class="card-body">
              <a href="" class="btn btn-success mb-3"> <i class="fa fa-plus" aria-hidden="true"></i>
                Data Kategori</a>
                {{-- <p class="mb-1 h6 text-dark">Total Data Barang :  {{ count($all) }}</p> --}}
                <div class="table-responsive-xl"> 
                <table class="table text-center">
                    <thead class=" bg-danger text-light">
                        <tr class="">
                          <th class=""scope="col">No</th>
                          <th scope="col">Nama Kategori</th>
                          <th scope="col">Action</th>
                        </tr>
                      </thead>
                      <tbody>
                    @foreach ($kategori as $i => $b)
                    <tr>
                        <td>{{ ++$i }}</td>
                        <td>{{ $b->kategori }}</td>
                       
                         <td>
                            <a href="" class="btn btn-sm btn-info btn-circle"><i class="fas fa-info"></i></a>
                            <a href="" class="btn btn-sm btn-warning btn-circle"><i class="fas fa-edit"></i></a>
                            <a href="" class="btn btn-sm btn-danger btn-circle"><i class="fas fa-trash"></i></a>
                            
                          </td>
                    </tr>
                    @endforeach
                       
                        
                      
                      </tbody>
                  </table>
                  <div class="card-footer d-flex justify-content-start ">
                    {{-- {{  $kategori->links() }} --}}
              </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection