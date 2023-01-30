@extends('componen.admin')
@section('title', 'Dashboard')
    
{{-- @section('content-title', 'Data Barang') --}}
@section('content')
@if($message = Session::get('success'))
  <div class="alert alert-success alert-block">
      <button class="close" type="button" data-dismiss="alert">X</button>
      <strong>{{ $message }}</strong>
  </div>
@endif

{{-- <div class="row">
    <div class="col-lg-12">
        <div class="card shadow mb-4">
            <div class="card-header py-4">
                <h1 class="h1 mb-1 text-gray-800 text-center">Dashboard</h1>
                
               
            </div>
            <div class="card-body">

            </div>
           
        </div>
    </div>
</div> --}}

<div class="row">

    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                            Jumlah Barang</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $barang }}</div>
                    </div>
                    <div class="col-auto">
                        <i class="fa fa-cubes fa-2x text-gray-500" aria-hidden="true"></i>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-success shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                            TOTAL TRANSAKSI HARI INI</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $transaksi }}</div>
                    </div>
                    <div class="col-auto">
                        {{-- <i class="fas fa-dollar-sign fa-2x text-gray-300"></i> --}}
                        <i class="fas fa-clipboard-list fa-2x text-gray-500"></i>


                        


                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-warning shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                            TOTAL PEMASUKAN HARI INI</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">Rp. {{ number_format($totalHarian) }}</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-dollar-sign fa-2x text-gray-500"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-danger shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">
                            TOTAL PEMASUKAN BULAN INI</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">Rp. {{ number_format($totalBulanan) }}</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-dollar-sign fa-2x text-gray-500"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Earnings (Monthly) Card Example -->
    {{-- <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-info shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Tasks
                        </div>
                        <div class="row no-gutters align-items-center">
                            <div class="col-auto">
                                <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">50%</div>
                            </div>
                            <div class="col">
                                <div class="progress progress-sm mr-2">
                                    <div class="progress-bar bg-info" role="progressbar" style="width: 50%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}

    <!-- Pending Requests Card Example -->
    {{-- <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-warning shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                            Pending Requests</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">18</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-comments fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}
      <!-- Area Chart -->
      <div class="col-xl-12 col-lg-7">
        <div class="card shadow mb-4">
            <!-- Card Header - Dropdown -->
            <div
                class="card-header py-3 d-flex flex-row align-items-center justify-content-center">
                <h5 class="m-0 font-weight-bold text-primary">Stok Barang Habis</h5>
                <div class="dropdown no-arrow">
                   
                </div>
            </div>
            <!-- Card Body -->
            <div class="card-body border">
                <div class="table-responsive-xl"> 

                <table class="table  table-stripped">
                    <thead class="thead-light text-center bg-gradient-info text-light">
                        <td>No</td>
                        <td>Nama</td>
                        <td>Kategori</td>
                        <td>Action</td>
                    </thead>
                    <tbody class="text-center table-stripped" >
                        @foreach ($barangHabis as $i => $item)
                        <tr>
                       <td width="5%">{{ $barangHabis->firstItem()+$i }}.</td>
                       <td width="40%">{{ $item->nama }}</td>
                       <td>{{ $item->kategori->kategori }}</td>
                       <td>  <a href="{{ route('data-barang.tambahstok', $item->id) }}" class="btn btn-sm btn-primary btn-circle" title="Tambah Stok Barang"><i class="fa fa-cart-plus"></i></a></td>
                    </tr>
                       @endforeach
                    </tbody>
                    
                </table>
                {{ $barangHabis->links() }}
            </div>
            </div>
        </div>
    </div>

</div>
@endsection