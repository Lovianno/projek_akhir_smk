<?php

namespace App\Http\Controllers;
use App\Models\barang;
use App\Models\transaksi;
use App\Models\detail_transaksi;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Support\Facades\Session;

class laporanController extends Controller
{
    
  
       
    public function index(){
        $barang = barang::paginate(10);
        return view('menu.laporan.LdataBarang', compact('barang'));
    }

    public function cetak_pdf()
    {
    	$barang = barang::all();
 
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
        // $transaksi = transaksi::get();
        $pdf = PDF::loadview('menu.laporan.detailtransaksi_pdf',['transaksi'=>$transaksi, 'details'=>$details])->setPaper('a4', 'landscape');;
        return $pdf->stream('Kwitansi.pdf');
        // return view('menu.laporan.detailtransaksi_pdf', compact('details', 'transaksi'));

    }
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
}
