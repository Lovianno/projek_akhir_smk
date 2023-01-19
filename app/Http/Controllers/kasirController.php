<?php

namespace App\Http\Controllers;
use App\Models\barang;
use App\Models\detail_transaksi;
use App\Models\keranjang;
use App\Models\transaksi;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use function PHPUnit\Framework\isEmpty;

class kasirController extends Controller
{
     

    public function index(){
        $hasilpencarian = "";
        $keranjang = keranjang::get();
        $totalHarga = keranjang::sum('subtotal');
        $barangs = barang::where('stok', '>' , 0)->paginate(5);
        return view('menu.kasir.menuKasir',compact('barangs', 'keranjang', 'totalHarga', 'hasilpencarian'));
    }

    public function addToCart(Request $request){
        $message = [
            'required' => ":attribute Tidak Boleh Kosong",
            'min' => ':attribute Minimal :min Karakter',
            'max' => ':attribute Maksimal :max Karakter',
            'numeric' => ':attribute Wajib di isi Angka',
            
        ];
        $barangId = $request->barang_id;
        $cek = keranjang::where('barang_id',$barangId )->get();
        if($cek->isEmpty()){
           
              keranjang::create([
                'barang_id' => $request->barang_id,
                'qty' => $request->qty,
                'subtotal'=>  $request->harga*$request->qty
              ]);

      
             Session::flash('success', 'Barang Telah Ditambahkan di Keranjang!!');
            return redirect('/kasir');
        }
        else{
            Session::flash('fail', 'Barang Sudah Ada di Keranjang!!');
            return redirect('/kasir');

        }
       
    }

    public function deleteItemKeranjang($id){
        keranjang::find($id)->delete();
        Session::flash('success', 'Barang Berhasil Dihapus dari Keranjang!!');
            return redirect('/kasir');
    }

    public function cariBarang(Request $request){
        
        $hasilpencarian = $request->cari;
        
        $pencarian = $request->cari;

        $keranjang = keranjang::get();
        $totalHarga = keranjang::sum('subtotal');

        $barangs = barang::where('nama','like',"%".$pencarian."%")
                    ->where('stok', '>' , 0)
                    ->paginate(5);
        return view('menu.kasir.menuKasir', compact('barangs','keranjang','totalHarga','hasilpencarian'));
        
    }

    public function updateKeranjang(Request $request){
        
        $message = [
            'required' => "Quantity Tidak Boleh Kosong",
            'min' => 'Quantity Minimal :min',
            'max' => ':attribute Maksimal :max Karakter',
            'numeric' => ':attribute Wajib di isi Angka',
            
        ];
        for($j = 0; $j < count($request->id); $j++){
            $this->validate($request, [
                'qty.'.$j=>'required|min:1|numeric', 
            ], $message);
        }
        

        $data = ['id'=>$request->id, 'qty'=> $request->qty, 'harga'=> $request->harga];
        
        
        for($i = 0; $i < count($data['id']); $i++){
            keranjang::find($data['id'][$i])->update([
                'qty' => $data['qty'][$i],
                'subtotal' => $data['qty'][$i] * $data['harga'][$i]
            ]);
        }
        Session::flash('success', 'Berhasil Update Keranjang!!');
        return redirect('/kasir');
    }


    
    public function checkoutKeranjang(Request $request){
        $keranjang = keranjang::all();

        //random string untuk kode
        function generateRandomString($length = 3) {
            $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
            $charactersLength = strlen($characters);
            $randomString = '';
            for ($i = 0; $i < $length; $i++) {
                $randomString .= $characters[rand(0, $charactersLength - 1)];
            }
            return $randomString;
        }
        
        $message = [
            'required' => "Uang Bayar Tidak Boleh Kosong",
            'min' => ' Uang Bayar Minimal :min Karakter',
            'max' => ':attribute Maksimal :max Karakter',
            'numeric' => ':attribute Wajib di isi Angka',
            
        ];
        if($keranjang->isEmpty()){
            Session::flash('fail', 'Keranjang Tidak Boleh Kosong !!');
            return redirect('/kasir');
        }
        else{
        $this->validate($request, [
            'paytotal'=>'required|max:100000000|min:0|numeric', 
        ], $message);

        if($request->paytotal < $request->hargatotal){
            Session::flash('kurang', 'Uang Bayar Kurang!!');
            return redirect('/kasir');
        }
        else{
            
                $kode = "T-".date("Ymd")."-".generateRandomString();
                date_default_timezone_set('Asia/Jakarta');
                $date = date('Y-m-d H:i:s');
                $pegawai = Auth()->user()->id;
                $totalHarga = keranjang::sum('subtotal');
                $bayar = $request->paytotal;


              $hasil =  transaksi::create([
                    'kode_pembelian' => $kode,
                    'date' => $date,
                    'pegawai_id'=> $pegawai,
                    'hargatotal'=>$totalHarga,
                    'paytotal'=>$bayar
                ]);


            $idTransaksi = $hasil['id'];
            $data = ['idBarang'=>$request->idBarang, 'quantity'=> $request->qty, 'subtotal'=> $request->subtotal];
           
            for($i=0; $i< count($data['idBarang']); $i++){
                detail_transaksi::create([
                    'transaksi_id' => $idTransaksi,
                    'barang_id' => $data['idBarang'][$i],
                    'quantity'=> $data['quantity'][$i],
                    'subtotal'=>$data['subtotal'][$i]
                ]);
            }
            keranjang::truncate();
            Session::flash('success', 'Transaksi Berhasil!!');
            return redirect('/kasir');
    }
}
    }

    public function resetkeranjang(){
        $keranjang = keranjang::all();
        if($keranjang->isEmpty()){
            Session::flash('fail', 'Keranjang Sudah Kosong !!');
            return redirect('/kasir');
        }
        else{
            keranjang::truncate();
            Session::flash('success', 'Berhasil Reset Keranjang!!');
             return redirect('/kasir');
        }
      
    }
}
