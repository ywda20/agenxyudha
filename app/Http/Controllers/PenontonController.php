<?php

namespace App\Http\Controllers;

use App\Models\Penonton;
use Illuminate\Http\Request;

class PenontonController extends Controller
{
     //Fungsi Read Genset
     public function index(){
        return view('backend.aset.index',[
            'title' => 'Penonton',
            'audience' => Penonton::all()
        ]);
    }

    //Fungsi Tambah Genset
    public function tambah(){
        return view('backend.aset.tambah',[
            'title' => 'Daftar',
            'audience' => Penonton::all(),
        ]);
    }

    //Fungsi Simpan Genset
    public function simpan(Request $request){
        $validatedData = $request->validate([
            'name'      => 'required|max:255',
            'umur'      => 'required|max:2',
            'telp'      => 'required|max:13'
        ]);
        
        Penonton::create($validatedData);
        return redirect('/dashboard/aset')->with('toast_success', 'Aset baru ditambah');
    }

    //Fungsi Hapus Genset
    public function hapus(Penonton $penonton){
        Penonton::destroy($penonton->id);
        return redirect('/dashboard/aset')->with('toast_error', 'Aset berhasil hapus!');
    }
    
    //Fungsi Edit Genset
    public function edit(Penonton $penonton){
        return view('backend.aset.edit',[
            'audience'  => $penonton,
            'title' => 'Edit Penonton',
        ]);
    }

    //Fungsi Update Genset
    public function update(Request $request, Penonton $penonton)
    {
        $validatedData = $request->validate([
            'name'      => 'required|max:255',
            'umur'      => 'required|max:2',
            'telp'      => 'required|max:13'
        ]);
        
        Penonton::where('id', $penonton->id)->update($validatedData);
            
        return redirect('/dashboard/aset')->with('toast_info', 'Aset berhasil diupdate');
    }
}