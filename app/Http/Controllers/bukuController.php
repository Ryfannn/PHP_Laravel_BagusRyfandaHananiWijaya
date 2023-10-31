<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\bukuModel;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

class bukuController extends Controller
{
    public function getbuku()
    {
        $dt_buku = bukuModel::get();
        return response()->json($dt_buku);
    }
    public function addbuku(Request $req)
    {
        $validator = validator::make($req->all(), [
            'nama_buku' => 'required',
            'pengarang' => 'required',
            'deskripsi' => 'required',
            'foto' => 'required'
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors()->toJson());
        }
        $save =  bukuModel::create([
            'nama_buku' => $req->get('nama_buku'),
            'kelompok' => $req->get('kelompok')
        ]);
        if ($save) {
            return response()->json(['status' => true, 'message' => 'SuksesLur']);
        } else {
            return response()->json(['status' => false, 'message' => 'GagalLur']);
        }
    }
    public function updatebuku(Request $req, $id)
    {
        $validator = Validator::make($req->all(), [
            'nama_buku' => 'required',
            'pengarang' => 'required',
            'deskripsi' => 'required',
            'foto' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors()->toJson());
        }

        $ubah = bukuModel::where('id_buku', $id)->update([
            'nama_buku' => $req->get('nama_buku'),
            'pengarang' => $req->get('pengarang'),
            'deskripsi' => $req->get('deskripsi'),
            'foto' => $req->get('foto')
        ]);

        if ($ubah) {
            return response()->json(['status' => true, 'message' => 'Sukses Masbro']);
        } else {
            return response()->json(['status' => false, 'message' => 'Gagal Masbro']);
        }
    }
    public function deletebuku($id)
    {
        $hapus=bukuModel::where('id_buku',$id)->delete();
        if ($hapus) {
            return response()->json(['status' => true, 'message' => 'Sukses Masbro']);
        } else {
            return response()->json(['status' => false, 'message' => 'Gagal Masbro']);
        }
    }
}
