<?php

namespace App\Http\Controllers;

use App\Models\polylinesModel;
use Illuminate\Http\Request;

class PolylinesController extends Controller
{
    protected $polyline; // ← tambahkan ini

    public function __construct()
    {
        $this->polyline = new polylinesModel();
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
                'geometry_polyline' => 'required',
                'name' => 'required|string|max:255',
                'description' => 'required|string',
                'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            ],
            [
                'geometry_polyline.required' => 'Field geometry polyline harus diisi.',
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
            $name_image = time() . "_polyline." . strtolower($image->getClientOriginalExtension());
            $image->move('storage/images', $name_image);
        } else {
        $name_image = null;
        }

        $data = [
            'geom' => $request->geometry_polyline,
            'name' => $request->name,
            'description' => $request->description,
            'image' => $name_image
        ];

        //simpan data ke database
        if ($this->polyline->create($data)) {
            //kembalikan ke halaman peta
            return redirect()->route('map')->with('success', 'Data Polyline berhasil ditambahkan!');
        }

        return redirect()->route('map')->with('error', 'Data Polyline gagal ditambahkan!');
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
        $image = $this->polyline->find($id)->image;

        //menghapus file gambar jika ada
        if ($image != null) {
            if (file_exists('./storage/images/' . $image)) {
                unlink('./storage/images/' . $image);
            }
        }

        //menghapus data dari database
        if (!$this->polyline->destroy($id)) {
            return redirect()->route('map')
                ->with('error', 'Gagal menghapus data polyline.');
        }

        //kembali ke halaman peta
        return redirect()->route('map')
            ->with('success', 'Data polyline berhasil dihapus.');
    }
}
