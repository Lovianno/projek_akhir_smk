<?php

namespace App\Http\Controllers;
use App\Models\barang;
use App\Models\transaksi;
use App\Models\detail_transaksi;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

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
   
    public function indexTransaksi(){
        $transaksi = transaksi::paginate(10);
        // return $transaksi;
        return view('menu.laporan.Ltransaksi', compact('transaksi'));
        
    }
    public function showTransaksi($id){
        $transaksi = transaksi::find($id);
        $details = detail_transaksi::where('transaksi_id', $id)->get();
        return view('menu.laporan.ShowTransaksi', compact('details', 'transaksi' ));
        
    }
    public function cetaktrans_pdf()
    {
        $transaksi = transaksi::get();

    	$pdf = PDF::loadview('menu.laporan.transaksi_pdf',['transaksi'=>$transaksi]);
    	return $pdf->stream('barang.pdf');
    }
}
