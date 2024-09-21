<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Juang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public function input(Request $request){
        $request->validate([
            'tanggal' => 'required|date',
            'kategori' => 'required|string',
            'jumlah' => 'required|numeric',           
            'keterangan' => 'nullable|string',
            'saldo' => 'required'
           ]);
       
       Juang::create([
        'tanggal' => carbon::parse($request->tanggal)->format('Y-m-d'),'kategori' => $request ->kategori,
           'jumlah' => $request ->jumlah,
           'keterangan'=> $request ->keterangan,
           'saldo' => $request -> saldo,
       ]);
       return redirect()->route('Hari');
    }


    // route edit
    public function editm($id){   
        $datas = Juang::find($id);
        return view('editm',compact('datas'));
    }
    public function editk($id){   
        $datas = Juang::find($id);
        return view('editk',compact('datas'));
    }



    // edit masuk
    public function updtm(Request $request, $id)
    {
        $data = Juang::find($id);
        $data->tanggal = $request->input('tanggal');
        $data->kategori = $request->input('kategori');
        $data->jumlah = $request->input('jumlah');
        $data->keterangan = $request->input('keterangan');
        $data->bodoa = 'Pemasukan'; 
        $data->save();
    
        return redirect('/Hari'); 
    }   
    
    //edit keluar
    public function updtk(Request $request, $id)
    {
        $data = Juang::find($id);
        $data->tanggal = $request->input('tanggal');
        $data->kategori = $request->input('kategori');
        $data->jumlah = $request->input('jumlah');
        $data->keterangan = $request->input('keterangan');
        $data->bodoa = 'Pengeluaran';
        $data->save();
    
        return redirect('/Hari');
    }

    //hapus
    public function destroy($id)
    {
        $juang = Juang::findOrFail($id);

        $juang->delete();

        return redirect()->back()->with('success', 'Data berhasil dihapus.');
    }}