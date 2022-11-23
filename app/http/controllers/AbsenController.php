<?php

namespace App\Http\Controllers;

use App\Models\Absen;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class AbsenController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = DB::table('absens')->orderBy('created_at', 'desc')->get();
        return view('absen.index',[
            'absens' => $data
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('absen.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'nip_karyawan' => 'required|numeric|unique:absens',
            'nama_karyawan' => 'required|max:255',
            'latitude' => 'required',
            'longitude' => 'required',
            'kode_mesin' => 'required',
            'kondisi_mesin' => 'required',
            'foto' =>  'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if($request->hasFile('foto')){
            $slug = Str::slug($request['nama_karyawan']);
            $extension = $request->file('foto')->getClientOriginalExtension();
            $fileName = $slug . '-' . time() . '.' . $extension;
            $request->file('foto')->storeAs('public/uploads', $fileName);
        }

        $absen = new Absen;
        $absen->nip_karyawan = $request->input('nip_karyawan');
        $absen->nama_karyawan = $request->input('nama_karyawan');
        $absen->latitude = $request->input('latitude');
        $absen->longitude = $request->input('longitude');
        $absen->kode_mesin = $request->input('kode_mesin');
        $absen->kondisi_mesin = $request->input('kondisi_mesin');
        $absen->foto = $fileName;
        $absen->save();

        return redirect()->route('absen.index')->with('message', "Data {$request['nama_karyawan']} berhasil ditambahkan!");
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Absen  $absen
     * @return \Illuminate\Http\Response
     */
    public function show(Absen $absen)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Absen  $absen
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = Absen::find($id);
        return view('absen.edit', [
            'absen' => $data
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Absen  $absen
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $absen = Absen::find($id);
        $absen->nip_karyawan = $request->input('nip_karyawan');
        $absen->nama_karyawan = $request->input('nama_karyawan');
        $absen->latitude = $request->input('latitude');
        $absen->longitude = $request->input('longitude');
        $absen->kode_mesin = $request->input('kode_mesin');
        $absen->kondisi_mesin = $request->input('kondisi_mesin');
        

        if($request->hasFile('foto')){

            $destination = 'public/uploads/'. $request->gambar;
            if(File::exists($destination)){
                File::delete($destination);
            }

            $slug = Str::slug($request['nama_karyawan']);
            $extension = $request->file('foto')->getClientOriginalExtension();
            $fileName = $slug . '-' . time() . '.' . $extension;
            $request->file('foto')->storeAs('public/uploads', $fileName);
            $absen->foto = $fileName;
        }

        $absen->update();

        return redirect()->route('absen.index')->with('message', "Data {$request['nama_karyawan']} berhasil diubah!");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Absen  $absen
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $absen = Absen::find($id);
        if($absen->foto){
            Storage::delete($absen->foto);
        }
        $absen->delete();
        return redirect()->route('absen.index')->with('message', "Data $absen->nama_karyawan berhasil dihapus!");
    }
}
