<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Session; 

class userController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::paginate(10);
        return view('menu.akun.datauser',compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('menu.akun.createUser');
        
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
            'required' => ":attribute Tidak Boleh Kosong",
            'min' => ':attribute Minimal :min Karakter',
            'max' => ':attribute Maksimal :max Karakter',
            'numeric' => ':attribute Wajib di isi Angka',
            
        ];
        $validateData =  $request->validate([
            'name'=>'required|max:50|min:1',
            'role'=>'required',
            'jk'=>'required',
            'username'=>'required|max:30| min:1',
            'password'=>'required|max:30| min:1'
        ], $message);
        // return $request;
        User::create($validateData);
        Session::flash('success', 'Data Berhasil ditambahkan');
        return redirect('/data-user');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find($id);
        return view('menu.akun.showUser', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $userId = User::find($id);
        return view('menu.akun.updateUser',compact('userId'));
        
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
            'name'=>'required|max:50|min:1',
            'role'=>'required',
            'jk'=>'required',
            'username'=>'required|max:30| min:1',
            'password'=>'required|max:30| min:1'
        ], $message);
        // return $request;
        User::find($id)->update($validateData);
        Session::flash('success', 'Data Berhasil di Update!!');
        return redirect('/data-user');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        User::find($id)->delete();
        Session::flash('success', 'Data Berhasil diHapus !!');
        return redirect('/data-user');
    }
    public function identitas()
    {
        
        return view('menu.akun.identitasUser');
    }
}
