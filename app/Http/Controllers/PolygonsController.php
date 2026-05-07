<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\polygonsModel; // ← import model

class PolygonsController extends Controller
{
    protected $polygon; // ← deklarasi properti

    public function __construct() // ← fix typo
    {
        $this->polygon = new polygonsModel();
    }

    public function index()
    {
        //
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        // Validasi input
        $request->validate(
            [
                'geometry_polygon' => 'required',
                'name' => 'required|string|max:255',
                'description' => 'required|string',
                'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            ],
            [
                'geometry_polygon.required' => 'Field geometry polygon harus diisi.',
                'name.required' => 'Field name harus diisi.',
                'name.string' => 'Field name harus berupa string.',
                'name.max' => 'Field name tidak boleh lebih dari 255 karakter.',
                'description.required' => 'Field description harus diisi.',
                'description.string' => 'Field description harus berupa string.',
                'image.miness' => 'Field image harus berupa jpeg,png,jpg.',
                'image.max' => 'Field image tidak boleh lebih dari 2MB.',
                'image.image' => 'Field image harus berupa gambar.',
            ]
        );

        if (!is_dir('storage/images')) {
            mkdir('./storage/images', 0777);
        }

        //Get Upload
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $name_image = time() . "_polygon." . strtolower($image->getClientOriginalExtension());
            $image->move('storage/images', $name_image);
        } else {
        $name_image = null;
        }

        $data = [
            'geom' => $request->geometry_polygon,
            'name' => $request->name,
            'description' => $request->description,
            'image' => $name_image
        ];
        //simpan data ke database
        if ($this->polygon->create($data)) {
            //kembalikan ke halaman peta
            return redirect()->route('map')->with('success', 'Data Polygon berhasil ditambahkan!');
        }

        return redirect()->route('map')->with('error', 'Data Polygon gagal ditambahkan!');
    }

    public function show(string $id)
    {
        //
    }

    public function edit(string $id)
    {
        //
    }

    public function update(Request $request, string $id)
    {
        //
    }

    public function destroy(string $id)
    {
        //mencari nama file gambar
        $image = $this->polygon->find($id)->image;

        //menghapus file gambar jika ada
        if ($image != null) {
            if (file_exists('./storage/images/' . $image)) {
                unlink('./storage/images/' . $image);
            }
        }

        //menghapus data dari database
        if (!$this->polygon->destroy($id)) {
            return redirect()->route('map')
                ->with('error', 'Gagal menghapus data polygon.');
        }

        //kembali ke halaman peta
        return redirect()->route('map')
            ->with('success', 'Data polygon berhasil dihapus.');
    }
}
