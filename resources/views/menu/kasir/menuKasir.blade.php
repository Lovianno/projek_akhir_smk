@extends('componen.admin')
@section('title', 'Menu Kasir')
@section('content')

        @if($message = Session::get('success'))
        <div class="alert alert-success alert-block">
            <button class="close" type="button" data-dismiss="alert">X</button>
            <strong>{{ $message }}</strong>
        </div>
        @elseif($message = Session::get('fail'))
        <div class="alert alert-danger alert-block">
            <button class="close" type="button" data-dismiss="alert">X</button>
            <strong>{{ $message }}</strong>
            {{-- <script> alert("BARANG SUDAH ADA DI KERANJANG!!")</script> --}}
        </div>
        
        @endif

    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-4">
                <div class="card shadow mb-4">
                    <div class="card-header bg-primary text-light">
                        <h6 class="m-0 font-weight-bold"> <i class="fa fa-search" aria-hidden="true"></i>Cari Barang
                        </h6>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('cariBarang.index') }}" method="GET">

                        <input type="text" id="cari" class="form-control" name="cari"
                            placeholder="Masukan : Nama Barang  [ENTER]" value="{{ $hasilpencarian }}">
                            <div class="d-flex">
                         <button type="submit" class="btn btn-block btn-success pl-2 pr-2 mt-2 " title="CARI BARANG">CARI </button>
                         <a class="btn  btn-warning mt-2 ml-1 " href="/kasir" title="REFRESH"><i class="fa fa-retweet" aria-hidden="true"></i>
                         </a>
                        </div>
                    </div>
                </form>
               
                </div>
            </div>
            <div class="col-lg-8">
                <div class="card shadow mb-4">
                    <div class="card-header bg-primary text-light">
                        <h6 class="m-0 font-weight-bold"> <i class="fa fa-list" aria-hidden="true"></i> Hasil
                            Pencarian</h6>
                    </div>
                    <div class="card-body">
                        @if($barangs->isEmpty())
                            <h6 class="font-weight-bold text-center mt-2">Tidak Ada Barang Yang Ditemukan</h6>
                        @else
                        <table class="table table-responsive-xl">
                            <thead>
                                <tr>
                                    <th scope="col">No.</th>
                                    <th scope="col">Nama Barang</th>
                                    <th scope="col">Kategori</th>
                                    <th scope="col">Harga</th>
                                    <th scope="col">Stok</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($barangs as $i => $item)
                                <tr>  
                                    <th scope="row">{{ $barangs->firstItem()+$i }}</th>
                                    <td>{{ $item->nama }}</td>
                                    <td>{{ $item->kategori->kategori }}</td>
                                    <td>{{ number_format($item->harga) }}</td>
                                    <td>{{ $item->stok }}</td>
                                    <td>
                                        <form action="{{ route('keranjang.index') }}" method="POST">
                                        @csrf

                                        <input type="hidden" name="barang_id" value="{{ $item->id }}">
                                        <input type="hidden" name="harga" value="{{ $item->harga }}">
                                        <input type="hidden" name="qty" value="1">
                                        {{-- <a href="" class="btn btn-sm btn-success"><i class="fa fa-shopping-cart"aria-hidden="true"></i></a> --}}

                                        <input type="submit" class="btn btn-success" value="+">
                                        </form>
                                    </td>
                                </tr>             
                                @endforeach
                                

                            </tbody>
                        </table>
                        {{ $barangs->links() }}
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-12">
            <div class="card shadow mb-4">
                <div class="card-header bg-primary text-light ">
                    <h6 class="font-weight-bold d-flex justify-content-between align-items-center"> 
                        <i class="fa fa-shopping-cart" aria-hidden="true"> Kasir</i> 
                        {{--  onclick="javascript:return confirm('Apakah anda ingin reset keranjang ?');" --}}
                        <a class="btn btn-light"  href="/resetkeranjang">
                            <b>RESET KERANJANG</b></a>
                    </h6>

                </div>
                <div class="card-body">
                    <table class="table table-bordered table-responsive-xl">
                        @if (count($errors) > 0)

                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $item)
                                    <li>{{ $item }}</li>
                                @endforeach
                            </ul>
                        </div>
                        @elseif($message = Session::get('kurang'))
                     <div class="alert alert-danger alert-block">
                     <button class="close" type="button" data-dismiss="alert">X</button>
                        <strong>{{ $message }}</strong>
                     <script> alert("Uang Bayar Kurang!!")</script>
                    </div>
                        @endif

                        <tr>
                            <td><b>Tanggal</b></td>
                            <td><input type="text" readonly="readonly" class="form-control" 
                            value="{{ date("d F Y") }}"
                                    name="tgl"></td>
                        </tr>
                    </table>
                    <table class="table table-bordered table-responsive-xl" id="example1">
                        
                        <thead class="bg-success text-light text-center" >
                            <tr>
                                <td> No </td>
                                <td> Nama Barang</td>
                                <td style="width:10%;"> Quantity</td>
                                <td style="width:20%;"> SubTotal</td>
                                <td> Aksi</td>
                            </tr>
                        </thead>
                        <tbody class="text-center">
                        
                           @foreach ($keranjang as $i => $item)
                           <tr>
                            <td width="5%">{{ ++$i }}</td>
                            <td>{{ $item->barang->nama }}</td>
                            
                        <form method="POST" action="{{ route('updateKeranjang') }}">
                            @csrf
                            @method('PUT')
                            <td>
                                <input type="hidden" name="id[]" value="{{ $item->id }}">
                                <input type="hidden" name="harga[]" value="{{ $item->barang->harga }}">

                                <input type="number" min="0" max="{{ $item->barang->stok + $item->qty }}"id="qty"  name="qty[]" onchange="ubah()"   class="form-control" value="{{ $item->qty }}">
                            </td>
                            <td>

                                <input type="text" name="subtotal"  disabled id="subtotal"value="{{ number_format($item->subtotal) }}" class="form-control" >
                            </td>
                           
                            <td>
                                {{-- <button type="submit" class="btn btn-warning" class="d-flex justify-content-center">Update</button> --}}
                            <a href="{{route('keranjang.destroy', $item->id )  }}"  class="btn btn-danger"><i class="fa fa-times"></i> </a>
                        </td>
                        </tr> 
                           @endforeach
                           <tr ><td colspan="5">
                            <input type="submit" class="btn btn-warning form-control" style="display: none" value="UPDATE" id="update">
                </form>
                             </td>
                            </tr>
                            <form action="/checkoutKeranjang" method="post">
                                @csrf
                           <tr>
                            <td>Grand Total : </td>
                            <td colspan="4">
                                <input type="text" class="form-control"  readonly name="hargatotal"value="{{ $totalHarga }}" id="grandtotal"> </td>
                            </tr>                       
                           <tr>
                            <td>Pembayaran : </td>
                            <td colspan="4">
                                
                                <input type="number" min="0"class="form-control" id="uangbayar" name="paytotal" value="0" > 
                            </td>
                            </tr>                       
                           <tr>
                            <td>Kembalian : </td>
                            <td colspan="4">
                                <input type="text" class="form-control" readonly name="kembalian" value="0" id="uangkembalian"> </td>
                            </tr>                       
                           
                           <tr>
                          
                            <td colspan="5">
                                @foreach ($keranjang as $item)
                                    <input type="hidden" name="idBarang[]" value="{{ $item->barang->id }}">
                                    <input type="hidden" name="qty[]" value="{{ $item->qty }}">
                                    <input type="hidden" name="subtotal[]" value="{{ $item->subtotal }}">
                                @endforeach
                                <input type="submit"  class="btn btn-success form-control" style="display: " value="CHECKOUT" id="checkout"></td>
                            </form>
                            
                           </tr>
                           
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    {{-- <form method="POST" action="{{ route('updateKeranjang') }}">
    @csrf
    @method('PUT')
                            <td>
                                <input type="number" min="0" id="qty" name="qty" onchange="ubah()"   class="form-control" value="1">
                            </td>
                            <td>
                                <input type="text" name="subtotall"  id="subtotal"value="2000" class="form-control" >
                            </td>
                            <input type="submit" value="OK" class="btn btn-danger">
    </form> --}}
    {{-- <a href="{{route ('mastersiswa.index')}}" class="btn btn-danger">Keluar </a>  --}}

    <script type="text/javascript" >
           function ubah(){
            document.getElementById("update").style.display = "inline";
            document.getElementById("checkout").style.display = "none";
           }
           document.addEventListener("DOMContentLoaded", function(){
            var grandtotal =  document.getElementById("grandtotal").value;
           var uangbayar =  document.getElementById("uangbayar").value;
           });
           document.getElementById("uangbayar").addEventListener("change", function(){
            var grandtotal =  document.getElementById("grandtotal").value;
           var uangbayar =  document.getElementById("uangbayar").value;
           let kembalian = document.getElementById("uangkembalian").value = uangbayar-grandtotal;
           });
           
           
           
       
       </script>
@endsection



