@extends('componen.admin')
@section('title', 'Menu Kasir')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-4">
                <div class="card shadow mb-4">
                    <div class="card-header bg-danger text-light">
                        <h6 class="m-0 font-weight-bold"> <i class="fa fa-search" aria-hidden="true"></i>Cari
                            Barang
                        </h6>
                    </div>
                    <div class="card-body text-center">
                        <input type="text" id="cari" class="form-control" name="cari"
                            placeholder="Masukan : Kode / Nama Barang  [ENTER]">
                    </div>
                </div>
            </div>
            <div class="col-lg-8">
                <div class="card shadow mb-4">
                    <div class="card-header bg-danger text-light">
                        <h6 class="m-0 font-weight-bold"> <i class="fa fa-list" aria-hidden="true"></i> Hasil
                            Pencarian</h6>
                    </div>
                    <div class="card-body">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">ID Barang</th>
                                    <th scope="col">Nama Barang</th>
                                    <th scope="col">Kategori</th>
                                    <th scope="col">Harga</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                {{-- @foreach ($data as $i => $item) --}}
                                <tr>
                                    <th scope="row">abc1</th>
                                    <td>Pensil</td>
                                    <td>PerlengkapaN</td>
                                    <td>2500</td>
                                    <td>
                                        <a href="" class="btn btn-sm btn-success"><i class="fa fa-shopping-cart"
                                                aria-hidden="true"></i></a>
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row">abc1</th>
                                    <td>Pensil</td>
                                    <td>PerlengkapaN</td>
                                    <td>2500</td>
                                    <td>
                                        <a href="" class="btn btn-sm btn-success"><i class="fa fa-shopping-cart"
                                                aria-hidden="true"></i></a>
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row">abc1</th>
                                    <td>Pensil</td>
                                    <td>PerlengkapaN</td>
                                    <td>2500</td>
                                    <td>
                                        <a href="" class="btn btn-sm btn-success"><i class="fa fa-shopping-cart"
                                                aria-hidden="true"></i></a>

                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row">abc1</th>
                                    <td>Pensil</td>
                                    <td>PerlengkapaN</td>
                                    <td>2500</td>

                                    <td>
                                        <a href="" class="btn btn-sm btn-success"><i class="fa fa-shopping-cart"
                                                aria-hidden="true"></i></a>
                                    </td>
                                </tr>
                                {{-- @endforeach --}}


                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-13">
            <div class="card shadow mb-4">
                <div class="card-header bg-danger text-light">
                    <h6 class="font-weight-bold"> <i class="fa fa-shopping-cart" aria-hidden="true"></i> Kasir
                        <a class="btn btn-light" style="margin-left:900px; margin-top:10px"
                            onclick="javascript:return confirm('Apakah anda ingin reset keranjang ?');"
                            style="margin-top:-0.10pc;" href="">
                            <b>RESET KERANJANG</b></a>
                    </h6>

                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <tr>
                            <td><b>Tanggal</b></td>
                            <td><input type="text" readonly="readonly" class="form-control" value="<?php date_default_timezone_set('Asia/Jakarta');
                            echo date('d-m-Y H:i:s'); ?>"
                                    name="tgl"></td>
                        </tr>
                    </table>
                    <table class="table table-bordered" id="example1">
                        <thead>
                            <tr>
                                <td> No </td>
                                <td> Nama Barang</td>
                                <td style="width:10%;"> Jumlah</td>
                                <td style="width:20%;"> Total</td>
                                <td> Kasir</td>
                                <td> Aksi</td>
                            </tr>
                        </thead>
                        <tbody>
                            {{-- <tr>
                                    <th scope="row">1</th>
                                    <td>Pensil</td>
                                    <td>5</td>
                                    <td>12500</td>
                                    <td>Julian</td>
                                    <td>
                                        <a href="" class="btn btn-sm btn-success"><i class="fa fa-shopping-cart"
                                                aria-hidden="true"></i></a>
                                    </td>
                                </tr>
                                 <tr>
                                    <th scope="row">2</th>
                                    <td>Pensil</td>
                                    <td>5</td>
                                    <td>12500</td>
                                    <td>Julian</td>
                                    <td>
                                        <a href="" class="btn btn-sm btn-success"><i class="fa fa-shopping-cart"
                                                aria-hidden="true"></i></a>
                                    </td>
                                </tr>
                                 <tr>
                                    <th scope="row">3</th>
                                    <td>Pensil</td>
                                    <td>5</td>
                                    <td>12500</td>
                                    <td>Julian</td>
                                    <td>
                                        <a href="" class="btn btn-sm btn-success"><i class="fa fa-shopping-cart"
                                                aria-hidden="true"></i></a>
                                    </td>
                                </tr>
                                 <tr>
                                    <th scope="row">4</th>
                                    <td>Pensil</td>
                                    <td>5</td>
                                    <td>12500</td>
                                    <td>Julian</td>
                                    <td>
                                        <a href="" class="btn btn-sm btn-success"><i class="fa fa-shopping-cart"
                                                aria-hidden="true"></i></a>
                                    </td>
                                </tr> --}}
                            <tr>
                                <td>1</td>
                                <td>Pensil</td>
                                <td>
                                    <form method="POST" action="fungsi/edit/edit.php?jual=jual">
                                        <input type="" name="jumlah" value="" class="form-control">
                                        <input type="hidden" name="id" value="" class="form-control">
                                        <input type="hidden" name="id_barang" value="" class="form-control">
                                </td>
                                <td>Rp.12,500-</td>
                                <td>Julian</td>
                                <td>
                                    <button type="submit" class="btn btn-warning" class="d-flex justify-content-center">Update</button>
                                    </form>
                                <a href=""  class="btn btn-danger"><i class="fa fa-times"></i> </a>
							</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    {{-- <a href="{{route ('mastersiswa.index')}}" class="btn btn-danger">Keluar </a>  --}}
@endsection
