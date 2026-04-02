<?php

namespace App\Http\Controllers;

use App\Models\OrangTua;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\OrangtuaImport;

class OrangtuaController extends Controller
{
    public function index()
    {
        $orangtuas = Orangtua::latest()->paginate(10);
        return view('orangtua.index', compact('orangtuas'));
    }

    public function create()
    {
        return view('orangtua.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,user_id',
            'nama_orangtua' => 'required',
            'nama_siswa' => 'required',
            'kelas_siswa' => 'required',
            'no_kontak' => 'required',
        ]);

        Orangtua::create($request->all());

        return redirect()
            ->route('orangtua.index')
            ->with('success', 'Data orangtua berhasil ditambahkan');
    }

    public function show(Orangtua $orangtua)
    {
        return view('orangtua.show', compact('orangtua'));
    }

    public function edit(Orangtua $orangtua)
    {
        return view('orangtua.edit', compact('orangtua'));
    }

    public function update(Request $request, Orangtua $orangtua)
    {
        $request->validate([
            'user_id' => 'required|exists:users,user_id',
            'nama_orangtua' => 'required',
            'nama_siswa' => 'required',
            'kelas_siswa' => 'required',
            'no_kontak' => 'required',
        ]);

        $orangtua->update($request->all());

        return redirect()
            ->route('orangtua.index')
            ->with('success', 'Data orangtua berhasil diperbarui');
    }

    public function destroy(Orangtua $orangtua)
    {
        $orangtua->delete();

        return redirect()
            ->route('orangtua.index')
            ->with('success', 'Data orangtua berhasil dihapus');
    }

    public function import(Request $request)
{
    $request->validate([
        'file' => 'required|mimes:xlsx,xls'
    ]);

    Excel::import(new OrangtuaImport, $request->file('file'));

    return redirect()->back()
        ->with('success', 'Data orangtua berhasil diimport');
}
}
