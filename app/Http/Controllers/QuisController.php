<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Quis_Model;
use App\Kelas_Model;
use App\Pelajaran_Model;
use DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

class QuisController extends Controller
{
    public function index()
    {
        $quis = DB::table('tb_quis')
                ->join('tb_pelajaran', 'tb_pelajaran.id_pelajaran', '=', 'tb_quis.id_pelajaran')
                ->join('tb_kelas', 'tb_kelas.id_kelas', '=', 'tb_quis.id_kelas')
                ->select('tb_quis.*', 'tb_pelajaran.nama_pelajaran',
                        'tb_kelas.nama_kelas', 'tb_kelas.grup_kelas')
                ->get();

        $kelas = DB::table('tb_kelas')
                ->get();
        $pelajaran = DB::table('tb_pelajaran')
                ->get();

        return view(
            'page/quis/index',
            [
                'quis' => $quis,
                'kelas'=>$kelas,
                'pelajaran'=>$pelajaran
            ]
        );
    }
    public function create()
    {
        $pelajaran = Pelajaran_Model::all();
        $kelas = Kelas_Model::all();
        return view(
            'page/quis/form',
            [
                'url' => 'quis.store',
                'pelajaran' => $pelajaran,
                'kelas' => $kelas
                ]
            );
        }
    public function store(Request $request, Quis_Model $quis)
    {
        $validator = Validator::make($request->all(), [
            'id_kelas'     => 'required',
            'id_pelajaran' => 'required',
            'soal'         => 'required',
            'kunci'        => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()
                ->route('quis.create')
                ->withErrors($validator)
                ->withInput();
        } else {

            $quis->id_kelas = $request->input('id_kelas');
            $quis->id_pelajaran = $request->input('id_pelajaran');
            $quis->soal = $request->input('soal');
            $quis->kunci = $request->input('kunci');
            $quis->save();

            return redirect()
                ->route('quis.addcreate')
                ->with('message', 'Data berhasil ditambahkan');
        }
    }

    public function edit(Quis_Model $quis)
    {
        $pelajaran = Pelajaran_Model::all();
        $kelas = Kelas_Model::all();
        return view(
            'page/quis/form',
            [
                'url' => 'quis.edit',
                'quis' => $quis,
                'pelajaran' => $pelajaran,
                'kelas' => $kelas
            ]
        );
    }

    public function update(Request $request, Quis_Model $quis)
    {
        $validator = Validator::make($request->all(),[
            'id_kelas'     => 'required',
            'id_pelajaran' => 'required',
            'soal'         => 'required',
            'kunci'        => 'required',
        ]);

        if($validator->fails()){
            return redirect()
                ->route('quis.update', $quis->id_quis)
                ->withErrors($validator)
                ->withInput();
        }else{

            $quis->id_kelas = $request->input('id_kelas');
            $quis->id_pelajaran = $request->input('id_pelajaran');
            $quis->soal = $request->input('soal');
            $quis->kunci = $request->input('kunci');
            $quis->save();

            return redirect()
                ->route('quis')
                ->with('message', 'Data berhasil diedit');
        }
    }

    public function destroy(Quis_Model $quis)
    {
        $quis->forceDelete();
        return redirect()
            ->route('quis')
            ->with('message', 'Data berhasil dihapus');
    }

    public function cariQuis(Request $request){

        $cari_kelas = $request->cari_kelas;
        $cari_matpel = $request->cari_matpel;
        // dd($request->all());

        $quis = DB::table('tb_quis')
                ->join('tb_kelas', 'tb_kelas.id_kelas', '=', 'tb_quis.id_kelas')
                ->join('tb_pelajaran', 'tb_pelajaran.id_pelajaran', '=', 'tb_quis.id_pelajaran')
                ->where('tb_pelajaran.id_pelajaran','=',$cari_matpel)
                ->where('tb_kelas.id_kelas','=',$cari_kelas)
                ->select('tb_quis.*', 'tb_pelajaran.nama_pelajaran',
                        'tb_kelas.nama_kelas', 'tb_kelas.grup_kelas')
                ->get();
        $kelas = DB::table('tb_kelas')->get();
        $pelajaran = DB::table('tb_pelajaran')->get();

        return view(
            'page/quis/index',
            [
                'quis' => $quis,
                'kelas'=>$kelas,
                'pelajaran'=>$pelajaran
            ]
        );

    }

    public function addCreate()
    {
        $pelajaran = Pelajaran_Model::all();
        $kelas = Kelas_Model::all();
        return view(
            'page/quis/add_form',
            [
                'url' => 'quis.addstore',
                'pelajaran' => $pelajaran,
                'kelas' => $kelas
                ]
            );
        }

        public function addStore(Request $request, Quis_Model $quis)
        {
            // dd($pelajaran_x);
            // dd("x");
            // dd($request->all());
            $validator = Validator::make($request->all(), [
                'id_kelas'     => 'required',
                'id_pelajaran' => 'required',
                'soal'         => 'required',
                'kunci'        => 'required',
            ]);

            if ($validator->fails()) {
                return redirect()
                ->route('quis.addcreate')
                ->withErrors($validator)
                ->withInput();
            } else {

            $kelas_x =$request->id_kelas;
            $pelajaran_x =$request->id_pelajaran;
            $request->session()->put('kelas_x', $kelas_x);
            $request->session()->put('pelajaran_x', $pelajaran_x);

            $quis->id_kelas = $request->input('id_kelas');
            $quis->id_pelajaran = $request->input('id_pelajaran');
            $quis->soal = $request->input('soal');
            $quis->kunci = $request->input('kunci');
            $quis->save();


            return redirect()
            ->route('quis.addcreate')
            ->with('message', 'Data berhasil ditambahkan');
        }
    }


}
