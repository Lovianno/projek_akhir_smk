<?php

namespace App\Http\Controllers;
use App\Models\barang;
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
    	return $pdf->stream('barang.pdfx');
    }
   
}
