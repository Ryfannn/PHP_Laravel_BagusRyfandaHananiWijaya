<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\kelasModel;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

class kelasController extends Controller
{
    public function getkelas()
    {
        $dt_kelas = kelasModel::get();
        return response()->json($dt_kelas);
    }
    public function addkelas(Request $req)
    {
        $validator = validator::make($req->all(), [
            'nama_kelas' => 'required',
            'kelompok' => 'required'
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors()->toJson());
        }
        $save =  kelasModel::create([
            'nama_kelas' => $req->get('nama_kelas'),
            'kelompok' => $req->get('kelompok')
        ]);
        if ($save) {
            return response()->json(['status' => true, 'message' => 'SuksesLur']);
        } else {
            return response()->json(['status' => false, 'message' => 'GagalLur']);
        }
    }
    public function updatekelas(Request $req, $id)
    {
        $validator = Validator::make($req->all(), [
            'nama_kelas' => 'required',
            'kelompok' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors()->toJson());
        }

        $ubah = kelasModel::where('id_kelas', $id)->update([
            'nama_kelas' => $req->get('nama_kelas'),
            'kelompok' => $req->get('kelompok')
        ]);

        if ($ubah) {
            return response()->json(['status' => true, 'message' => 'Sukses Masbro']);
        } else {
            return response()->json(['status' => false, 'message' => 'Gagal Masbro']);
        }
    }
    public function deletekelas($id)
    {
        $hapus=kelasModel::where('id_kelas',$id)->delete();
        if ($hapus) {
            return response()->json(['status' => true, 'message' => 'Sukses Masbro']);
        } else {
            return response()->json(['status' => false, 'message' => 'Gagal Masbro']);
        }
    }

}
