<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use Illuminate\Http\Request;

class PatientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(Patient::all());
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
        $request->validate([
            'nama' => 'required|string|max:255',
            'nik' => 'required|string|size:16|unique:patients',
            'hp' => 'required|string|max:15',
            'alamat' => 'required|string',
            'dusun' => 'required|string|max:255',
            'kecamatan' => 'required|string|max:255',
            'kategori' => 'nullable|in:ibu,balita,lansia',
            'anakKe' => 'nullable|integer|min:1',
            'tglKunjungan' => 'nullable|date',
            'usiaHamil' => 'nullable|integer|min:1',
        ]);

        $patient = Patient::create($request->all());
        return response()->json($patient, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $patient = Patient::findOrFail($id);
        return response()->json($patient);
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
        $patient = Patient::findOrFail($id);

        $request->validate([
            'nama' => 'required|string|max:255',
            'nik' => 'required|string|size:16|unique:patients,nik,' . $id,
            'hp' => 'required|string|max:15',
            'alamat' => 'required|string',
            'dusun' => 'required|string|max:255',
            'kecamatan' => 'required|string|max:255',
            'kategori' => 'nullable|in:ibu,balita,lansia',
            'anakKe' => 'nullable|integer|min:1',
            'tglKunjungan' => 'nullable|date',
            'usiaHamil' => 'nullable|integer|min:1',
        ]);

        $patient->update($request->all());
        return response()->json($patient);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $patient = Patient::findOrFail($id);
        $patient->delete();
        return response()->json(['message' => 'Patient deleted']);
    }
}
