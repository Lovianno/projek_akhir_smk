<?php

namespace App\Http\Controllers;
use App\Models\barang;
use App\Models\transaksi;
use App\Models\detail_transaksi;
use App\Models\kategori;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Support\Facades\Session;

class laporanController extends Controller
{
    
  
    // public function __construct()
    // {
    //     $this->middleware('admin')->except('index', 'cetakdetailtrans_pdf', 'cetaktrans_pdf');
    // }
    
    public function index(){
        $kategori = kategori::get();
         $hasilkategori = "";
        $barang = barang::orderBy('nama', 'ASC')->paginate(10);
        session(['barang'=>$barang]);

        return view('menu.laporan.LdataBarang', compact('barang', 'kategori', 'hasilkategori'));
    }

    public function cetak_pdf()
    {
    	// $barang = barang::all();
        $barang = session("barang");
    	$pdf = PDF::loadview('menu.laporan.barang_pdf',['barang'=>$barang]);
    	return $pdf->stream('barang.pdf');
    }
   




    // Transaksi
    public function indexTransaksi(){
        $tanggalAwal = "";
        $tanggalAkhir="";
        $transaksi = transaksi::paginate(10);
        $transaksis = transaksi::get();
        session(['transaksi'=>$transaksis]);
        return view('menu.laporan.Ltransaksi',  compact('transaksi', 'tanggalAwal', 'tanggalAkhir'));
        
    }
    public function cetaktrans_pdf()
    {

        $transaksi = session("transaksi");
        
        // $transaksi = transaksi::get();

        $pdf = PDF::loadview('menu.laporan.transaksi_pdf',['transaksi'=>$transaksi]);
        return $pdf->stream('transaksi.pdf');
    }

    public function showTransaksi($id){
        $transaksi = transaksi::find($id);
        
        $details = detail_transaksi::where('transaksi_id', $id)->get();
        session(['transaksis'=>$transaksi]);
        session(['detailtransaksi'=>$details]);
        return view('menu.laporan.ShowTransaksi', compact('details', 'transaksi' ));
        
    }

    public function cetakdetailtrans_pdf()
    {
        $transaksi = session("transaksis");
        $details = session("detailtransaksi");
        $i = 357;
        $jumlahData = count($details);
        for($j=5; $j <= $jumlahData; $j++ ){
            $i+=30;
        }
        $i+=40;
        // $transaksi = transaksi::get();
        $pdf = PDF::loadview('menu.laporan.detailtransaksi_pdf',['transaksi'=>$transaksi, 'details'=>$details])->setPaper(array(0, 0, $i, 350), 'landscape');
        // titik aman
        // 327 - 358 = 31
        return $pdf->stream('Kwitansi.pdf');
        // return count($details);
       

    }
    // Sorting Tanggal Transaksi
    public function sortingTanggal(Request $request)
    {
                date_default_timezone_set('Asia/Jakarta');
                
                if(empty($request->tanggalAwal) && empty($request->tanggalAkhir) ){
                    
                    return redirect('/laporantransaksi');
                    // return view('menu.laporan.Ltransaksi');
                }

                else{

                if(empty($request->tanggalAwal)){
                    $tanggalAwal = date('Y-m-d');
                }
                else{
                    $tanggalAwal = $request->tanggalAwal;

                }

                if(empty($request->tanggalAkhir)){
                    $tanggalAkhir = date('Y-m-d');
                }
                else{
                    $tanggalAkhir = $request->tanggalAkhir;

                }

                $transaksi = transaksi::whereBetween('created_at', [$tanggalAwal. ' 00:00:00',
                $tanggalAkhir.' 23:59:00   '] )->paginate(10)->withQueryString();

                $transaksis = transaksi::whereBetween('created_at', [$tanggalAwal. ' 00:00:00',
                $tanggalAkhir.' 23:59:00   '] )->get();
                session(['transaksi'=>$transaksis]);
              
                
                return view('menu.laporan.Ltransaksi', compact('transaksi', 'tanggalAwal', 'tanggalAkhir'));
            }

                
            
            }

            public function indexBarangHabis(){
                $hasilkategori = "";
                $barang = barang::where('stok',0)->orderBy('nama', 'ASC')->paginate(10);
                $kategori = kategori::all();
                return view('menu.laporan.Lbaranghabis', compact('barang', 'kategori','hasilkategori'));
            }

            public function sorting($request){
                $barang = barang::where('kategori_id', 'like','%'.$request.'%')
                ->orderBy('nama', 'ASC')->paginate(10)->withQueryString();
                return $barang;
            }

            // Laporan Barang Habis
            public function sortingKategori(Request $request){
             $kategori = kategori::get();
                $hasilkategori = $request->kategori;
               $barang =  $this->sorting($hasilkategori);
               return view('menu.laporan.Lbaranghabis', compact('barang', 'kategori','hasilkategori'));
            }
            // Laporan data barang
            public function sortingKategori2(Request $request){
             $kategori = kategori::get();
                $hasilkategori = $request->kategori;
               $barang =  $this->sorting($hasilkategori);
               session(['barang'=>$barang]);
               return view('menu.laporan.Ldatabarang', compact('barang', 'kategori','hasilkategori'));
            }
        }
