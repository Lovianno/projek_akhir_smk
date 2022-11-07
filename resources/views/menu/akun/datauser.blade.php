@extends('componen.admin')
@section('title', 'Data User')
    
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
                <h1 class="h1 mb-1 text-gray-800 text-center">Data User</h1>
                {{-- <a href="{{ route('mastersiswa.create') }}" class="btn btn-success">Tambah Data</a> --}}
               
            </div>
            <div class="card-body">
              <a href="{{ route('data-user.create') }}" class="btn btn-success mb-3"> <i class="fa fa-plus" aria-hidden="true"></i>
                Data User</a>
                <p class="mb-1 h6 text-dark font-weight-bold">Menampilkan {{ $users->firstItem() }} - {{ $users->lastItem()  }} data dari total  {{ $users->total() }} data</p>
                <div class="table-responsive-xl"> 
                <table class="table text-center">
                    <thead class=" bg-danger text-light">
                        <tr class="">
                          <th class=""scope="col">No</th>
                          <th scope="col">Nama</th>
                          <th scope="col">Username</th>
                          <th scope="col">Role</th>
                          
                          <th scope="col">Action</th>
                        </tr>
                      </thead>
                      <tbody>
                    @foreach ($users as $i => $user)
                    <tr>
                        <td>{{ $users->firstItem() +$i }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->username }}</td>
                        <td>{{ $user->role }}</td>
                       
                         <td >
                            <a href="" class="btn btn-sm btn-info btn-circle"><i class="fas fa-info"></i></a>
                            <a href="{{ route('data-user.edit', $user->id) }}" class="btn btn-sm btn-warning btn-circle"><i class="fas fa-edit"></i></a>

                            <form action="/data-user/{{ $user->id }}" method="post">
                                @csrf
                                @method('delete')
                            <button type="submit" class="btn btn-sm btn-danger btn-circle"><i class="fas fa-trash"></i></button>
                            </form>
                            {{-- {{ route('data-kategori.edit') }} --}}

                            
                    @endforeach
                       
                        
                      
                      </tbody>
                  </table>
                  <div class="card-footer d-flex justify-content-start ">
                    {{  $users->links() }}
              </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection