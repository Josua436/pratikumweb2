<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use Illuminate\Http\Request;

class MahasiswaController extends Controller
{
    //halaman data mahasiswa
    public function index(Request $request)
  {
    // Simpan input pencarian agar tetap muncul di form setelah submit
    $request->flash();

    // Mulai query Mahasiswa
    $mahasiswa = Mahasiswa::query();

    // Cek apakah keyword ada dan filter data jika ada
    if (isset($request->keyword)) {
      $mahasiswa = $mahasiswa->where('nama', 'LIKE', "%{$request->keyword}%")
                             ->orWhere('npm', 'LIKE', "%{$request->keyword}%")
                             ->orWhere('jurusan', 'LIKE', "%{$request->keyword}%");
    }

    // Ambil data mahasiswa
    $mahasiswa = $mahasiswa->get();

    // Return ke view
    return view('admin.mahasiswa.index', compact('mahasiswa'));
  }
    //halaman create mahasiswa
    public function create()
    {
        return view ('admin.mahasiswa.create');
    }
    //halaman store mahasiswa
    public function store(Request $request)
    {
        
        $input = $request->all();
        //proses upload file
        {
            $input['foto'] = $request->foto->getClientOriginalName();
            $request->file('foto')->move('storage/mahasiswa',$input['foto']);
        }
        //funsi simpan data
        Mahasiswa::create($input);
        return redirect('/admin/mahasiswa');
    }
    //halaman edit mahasiswa
    public function edit($id)
    {
        $mahasiswa = Mahasiswa::findOrFail($id);
        return view('admin.mahasiswa.edit',compact('mahasiswa'));
    }
    //halaman update mahasiswa
    public function update(request $request, $id)
    {
        $mahasiswa  = Mahasiswa::findOrFail($id);
        $input      =  $request->all();
        //proses upload file

        if ($request->foto) {
            $input['foto'] = $request->foto->getClientOriginalName();
            $request->file('foto')->move('storage/mahasiswa', $input['foto']);
        }

        //proses update data
        $mahasiswa->update($input);

        return redirect()->route('mahasiswa.index');
    }
    //halaman delete mahasiswa
    public function delete($id)
    {
        $mahasiswa = Mahasiswa::find($id);
        $mahasiswa->delete();
        return redirect('/admin/mahasiswa');
    }
    //halaman print mahasiswa
    public function print()
    {
        $mahasiswa = Mahasiswa::all();
        return view('admin.mahasiswa.print',compact('mahasiswa'));
    }
}
