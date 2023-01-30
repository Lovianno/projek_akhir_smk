<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\barang;
use App\Models\detail_transaksi;
use App\Models\transaksi;
use Illuminate\Support\Carbon;
use SebastianBergmann\CodeCoverage\Report\Xml\Totals;

class dashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        date_default_timezone_set('Asia/Jakarta');
        $tanggal = date('Y-m-d');
        $transaksi = transaksi::where('date', '<=', $tanggal.' 23:59:59')->count();
        $barang = barang::all()->count();

        // pendapatan harian
        $totalHarian = transaksi::where('date', '>=', $tanggal.' 00:00:00')->sum('hargatotal');

        // pendapatan bulanan
        $tanggalAwal = Carbon::parse(Carbon::now())->firstOfMonth()->toDateString();
        $tanggalAkhir = Carbon::parse(Carbon::now())->endOfMonth()->toDateString();
        $totalBulanan = transaksi::whereBetween('date', [$tanggalAwal. ' 00:00:00',
        $tanggalAkhir.' 23:59:00'])->sum('hargatotal');


        // top 5 data
        // $ok = detail_transaksi::select('barang_id', DB::raw('COUNT(DISTINCT portofolio.id) AS total'))
        $barangHabis = barang::where('stok', 0)->orderBy('kategori_id', 'DESC')->paginate(5);

        return view('menu.dashboard', compact('transaksi','barang', 'totalHarian', 'totalBulanan', 'barangHabis' ));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
