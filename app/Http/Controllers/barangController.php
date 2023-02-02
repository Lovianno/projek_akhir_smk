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
    public function __construct()
    {
        $this->middleware('admin')->except('index', 'show', 'cariBarang');
    }
    public function index()
    {
        // $barang = barang::with('kategori')->get();
        $hasilnama = "";
        $hasilkategori = "";
        $hasilStok = "";

        $barang = barang::orderBy('nama', 'asc')->paginate(5);
        $kategori = kategori::get();
        
        // return [$barang, $barang->kategori];
        return view('menu.CRUDbarang.dataBarang', compact('barang', 'kategori','hasilnama','hasilStok', 'hasilkategori'));
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

    public function search(Request $request){
        $cari = $request['search'];
        $barang = barang::where('nama','LIKE', '%'.$cari.'%')->paginate(2);
        // echo $barang;
        $output = '';
        foreach($barang as $i => $b){
            $output.='
            <tr>
            <td>'.$barang->firstItem()+$i .'</td>
            <td>'.$b->nama .'</td>
            <td>'. $b->kategori->kategori.'</td>
            <td>'. $b->harga .'</td>
             <td>'. $b->stok .'</td>
             <td>
             <a href="'. route('data-barang.tambahstok', $b->id) .'" class="btn btn-sm btn-primary btn-circle" title="Tambah Stok Barang"><i class="fa fa-cart-plus"></i></a>
             <a href="'. route('data-barang.show', $b->id) .'" class="btn btn-sm btn-info btn-circle" title="Detail Barang"><i class="fas fa-info"></i></a>
             <a href="'. route('data-barang.edit', $b->id) .'" class="btn btn-sm btn-warning btn-circle" title="Edit Barang"><i class="fas fa-edit"></i></a>
             <a href="'. route('data-barang.hapus', $b->id) .'" class="btn btn-sm btn-danger btn-circle"title="Hapus Barang"><i class="fas fa-trash"></i></a>
             </td>
            
            </tr> ';
        }
        return response($output);
      
       

}

    public function cariBarang(Request $request){
        $kategori = kategori::get();
        $hasilnama = $request->nama;
        $hasilkategori = $request->kategori;
        $hasilStok = $request->stok;
        if($request->stok == 'tersedia'){
            $barang = barang::where('nama', 'like', '%'.$request->nama.'%')
                        ->where('kategori_id', 'like','%'.$request->kategori.'%')
                        ->where('stok', '>', 0)
                        ->paginate(10)->withQueryString();
        }
        else if($request->stok == 'habis'){
            $barang = barang::where('nama', 'like', '%'.$request->nama.'%')
                        ->where('kategori_id', 'like','%'.$request->kategori.'%')
                        ->where('stok', 0)
                        ->paginate(10)->withQueryString();
        }
        else{
             $barang = barang::where('nama', 'like', '%'.$request->nama.'%')
                        ->where('kategori_id', 'like','%'.$request->kategori.'%')
                        
                        ->paginate(10)->withQueryString();
        }

        return view('menu.CRUDbarang.dataBarang', compact('barang', 'kategori','hasilnama', 'hasilkategori','hasilStok'));

    }


}

