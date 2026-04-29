<?php

namespace App\Http\Controllers;

use App\Models\pointsModel;
use Illuminate\Http\Request;

class PointsController extends Controller
{
    public $point;

    public function __construct()
    {
        $this->point = new pointsModel();
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi input
        $request->validate(
            [
                'geometry_point' => 'required',
                'name' => 'required|string|max:255',
                'description' => 'required|string',
                'image' => 'nullable|image|miness:jpeg,png,jpg|max:2048',
            ],
            [
                'geometry_point.required' => 'Field geometry point harus diisi.',
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
            $name_image = time() . "_point." . strtolower($image->getClientOriginalExtension());
            $image->move('storage/images', $name_image);
        } else {
        $name_image = null;
        }

        $data = [
            'geom'=>$request->geometry_point,
            'name'=>$request->name,
            'description'=>$request->description,
            'image' => $name_image
        ];

        //simpan data ke database
        if ($this->point->create($data)) {
            //kembalikan ke halaman peta
            return redirect()->route('map')->with('success', 'Data Point berhasil ditambahkan!');
        }

        return redirect()->route('map')->with('error', 'Data Point gagal ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
