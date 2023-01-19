<?php

namespace App\Http\Controllers;
use App\Models\kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
class kategoriController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $kategori = kategori::paginate(10);
        return view('menu.CRUDkategori.kategoriBarang', compact('kategori'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('menu.CRUDkategori.createKategori');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $message = [
            'required' => "Nama Kategori Tidak Boleh Kosong",
            'min' => ':attribute Minimal :min Karakter',
            'max' => ':attribute Maksimal :max Karakter',
            'numeric' => ':attribute Wajib di isi Angka',
            
        ];
        $validateData =  $request->validate([
            'kategori'=>'required|max:30|min:1',
        ], $message);

        kategori::create($validateData);
        Session::flash('success', 'Data Berhasil di Tambahkan!!');
        return redirect('/data-kategori');
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
        $kategori = kategori::find($id);
        return view('menu.CRUDKategori.updateKategori', [
            'kategori' => $kategori
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
            'required' => "Nama Kategori Tidak Boleh Kosong",
            'min' => ':attribute Minimal :min Karakter',
            'max' => ':attribute Maksimal :max Karakter',
            'numeric' => ':attribute Wajib di isi Angka',
            
        ];
        $validateData =  $request->validate([
            'kategori'=>'required|max:30|min:1',
        ], $message);

        kategori::find($id)->update($validateData);
        Session::flash('success', 'Data Berhasil di Update!!');
        return redirect('/data-kategori');
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
        kategori::find($id)->delete();
        Session::flash('success', 'Data Berhasil di Hapus!!');
        return redirect('/data-kategori');
    }
}
