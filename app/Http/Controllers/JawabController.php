<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Jawab_Model;
use App\JawabDetail_Model;
use Illuminate\Support\Facades\Validator;
use DB;

class JawabController extends Controller
{
    public function index()
    {
        $jawab = DB::table('tb_jawab')
                ->join('tb_siswa', 'tb_siswa.id_siswa', '=', 'tb_jawab.id_siswa')
                ->join('tb_pelajaran', 'tb_pelajaran.id_pelajaran', '=', 'tb_jawab.id_pelajaran')
                ->select('tb_jawab.*', 'tb_siswa.nama_siswa', 'tb_pelajaran.nama_pelajaran')
                ->get();
        return view(
            'page/jawab/index',
            [
                'jawab' => $jawab
            ]
        );
    }
    public function create()
    {
        $siswa = Siswa_Model::all();
        return view(
            'page/jawab/form',
            [
                'url' => 'jawab.store',
                'siswa' => $siswa
            ]
        );
    }
    public function store(Request $request, jawab_Model $jawab)
    {
        // dd($request->all());
        $validator = Validator::make($request->all(), [
            'id_siswa'          => 'required',
            'keterangan_jawab'   => 'required',
            'tgl_jawab'          => 'required',
            'foto_jawab'         => 'mimes:jpg,jpeg,png,bmp'
        ]);

        if ($validator->fails()) {
            return redirect()
                ->route('jawab.create')
                ->withErrors($validator)
                ->withInput();
        } else {
            $file = $request->file('foto_jawab'); 
            $filename = time() . "." . $file->getClientOriginalExtension(); 
            $file->move('backend/img/jawab/', $filename);

            $jawab->id_siswa = $request->input('id_siswa');
            $jawab->keterangan_jawab = $request->input('keterangan_jawab');
            $jawab->tgl_jawab = $request->input('tgl_jawab');
            $jawab->foto_jawab = $filename;
            $jawab->save();

            return redirect()
                ->route('jawab')
                ->with('message', 'Data berhasil ditambahkan');
        }
    }

    public function edit(jawab_Model $jawab)
    {
        $siswa = Siswa_Model::all();
        return view(
            'page/jawab/form',
            [
                'url' => 'jawab.update',
                'siswa' => $siswa,
                'jawab' => $jawab
            ]
        );
    }

    public function update(Request $request, jawab_Model $jawab)
    {
        $validator = Validator::make($request->all(),[
            'id_siswa'          => 'required',
            'keterangan_jawab'   => 'required',
            'tgl_jawab'          => 'required',
            'foto_jawab'         => 'mimes:jpg,jpeg,png,bmp'
        ]);

        if($validator->fails()){
            return redirect()
                ->route('jawab.update', $jawab->id_jawab)
                ->withErrors($validator)
                ->withInput();
        }else{
            if ($request->hasFile('foto_jawab')) {
                // cari nama foto lama lalu hapus 
                unlink('backend/img/jawab/' . $jawab->foto_jawab); 
                $file = $request->file('foto_jawab'); 
                $filename = time() . "." . $file->getClientOriginalExtension(); 
                $file->move('backend/img/jawab/', $filename); 
                $jawab->foto_jawab = $filename; 
            }
            $jawab->id_siswa = $request->input('id_siswa');
            $jawab->keterangan_jawab = $request->input('keterangan_jawab');
            $jawab->tgl_jawab = $request->input('tgl_jawab');
            $jawab->save();

            return redirect()
                ->route('jawab')
                ->with('message', 'Data berhasil diedit');
        }
    }

    public function destroy(jawab_Model $jawab)
    {
        $foto_jawab = $jawab->foto_jawab; 
        unlink('backend/img/jawab/' . $foto_jawab);         
        $jawab->forceDelete();
        return redirect()
            ->route('jawab')
            ->with('message', 'Data berhasil dihapus');
    }

    public function detail(Request $request)
    {
        $data = DB::table('tb_jawab_detail')
                ->join('tb_quis', 'tb_quis.id_quis', 'tb_jawab_detail.id_quis')
                ->where('tb_jawab_detail.id_jawab', $request->id_jawab)
                ->get();
        
        return view(
            'page/jawab/detail',
            [
                'data' => $data
            ]
        );
    }
}
