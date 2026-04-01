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
            ],
            [
                'geometry_polygon.required' => 'Field geometry polygon harus diisi.',
                'name.required' => 'Field name harus diisi.',
                'name.string' => 'Field name harus berupa string.',
                'name.max' => 'Field name tidak boleh lebih dari 255 karakter.',
                'description.required' => 'Field description harus diisi.',
                'description.string' => 'Field description harus berupa string.',
            ]
        );
        $data = [
            'geom' => $request->geometry_polygon,
            'name' => $request->name,
            'description' => $request->description,
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
        //
    }
}
