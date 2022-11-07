<?php

namespace App\Http\Controllers;
use App\Models\barang;
use App\Models\kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
class barangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $barang = barang::with('kategori')->get();
        $barang = barang::paginate(5);
        // return [$barang, $barang->kategori];
        return view('menu.CRUDbarang.dataBarang', compact('barang'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $kategori = kategori::get();
        return view('menu.CRUDbarang.createBarang', compact('kategori'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $validateData =  $request->validate([
        //     'nama'=>'required|max:20',
        //     'kategori'=>'required',
        //     'harga '=>'required',
        //     'stok'=>'required'

        // ]);

        $message = [
            'required' => ":attribute Tidak Boleh Kosong",
            'min' => ':attribute Minimal :min Karakter',
            'max' => ':attribute Maksimal :max Karakter',
            'numeric' => ':attribute Wajib di isi Angka',
            
        ];
        
        // $this->validate($request, [
        //     'nama'=>'required|max:30|min:7',
        //     'kategori'=>'required|',
        //     'harga'=>'required|numeric',
        //     'stok'=>'required|numeric',
        // ]);
        $validateData =  $request->validate([
            'nama'=>'required|max: 40|min:1',
            'kategori_id'=>'required',
            'harga'=>'required|numeric',
            'stok'=>'required|numeric'
        ], $message);
        // return $request;
        barang::create($validateData);
        // barang::create([
        //     'nama'=>$request->nama,
        //     'kategori_id'=>$request->kategori,
        //     'harga'=>$request->harga,
        //     'stok'=>$request->stok
        // ]);
     
        Session::flash('success', 'Data Berhasil ditambahkan');
        return redirect('/data-barang');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $barang = barang::find($id);
        $kategoriId = kategori::find($id);
        return view('menu.CRUDbarang.showBarang', [
            'barang' => $barang,
            'kategoriId' => $kategoriId
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {   
        $barang = barang::find($id);
        $kategoriId = kategori::find($id);
        $kategori = kategori::get();
        return view('menu.CRUDbarang.updateBarang', [
            'kategori' => $kategori,
            'barang' => $barang,
            'kategoriId' => $kategoriId
        ]);
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
        $message = [
            'required' => ":attribute Tidak Boleh Kosong",
            'min' => ':attribute Minimal :min Karakter',
            'max' => ':attribute Maksimal :max Karakter',
            'numeric' => ':attribute Wajib di isi Angka',
            
        ];
        $validateData =  $request->validate([
            'nama'=>'required|max:40|min:1',
            'kategori_id'=>'required',
            'harga'=>'required|numeric',
            'stok'=>'required|numeric'
        ], $message);

        barang::find($id)->update($validateData);
        Session::flash('success', 'Data Berhasil di Update');
        return redirect('/data-barang');
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
    public function hapus($id)
    {
        barang::find($id)->delete();
        Session::flash('success', 'Data Berhasil di Hapus');
        return redirect('/data-barang');
    }
    public function tambahStok($id)
    {
       $barangId= barang::find($id);
        return view('menu.CRUDbarang.stokBarang', compact('barangId'));
    }
    public function storeStok(Request $request, $id)
    {
        $message = [
            'required' => "Stok Tidak Boleh Kosong",
            'min' => ':attribute Minimal :min Karakter',
            'max' => ':attribute Maksimal :max Karakter',
            'numeric' => ':attribute Wajib di isi Angka',
            
        ];
        $validateData =  $request->validate([
            'stok'=>'required|numeric'
        ], $message);
       $validateData['stok'] =  barang::find($id)->stok+$validateData['stok'];
        barang::find($id)->update($validateData);
        Session::flash('success', 'Stok Berhasil ditambahkan!!');
        return redirect('/data-barang');
       
    }
}
