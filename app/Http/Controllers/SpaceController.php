<?php

namespace App\Http\Controllers;

use App\Models\CoworkSpace;
use Illuminate\Http\Request;

class SpaceController extends Controller
{
    public function index()
    {
        $spaces = CoworkSpace::all();
        return view('admin.manageSpaces', compact('spaces'));
    }

    public function create()
    {
        return view('admin.createSpace');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        CoworkSpace::create($validated);

        return redirect()->route('admin.manageSpaces')->with('success', 'Espacio creado correctamente');
    }

    public function edit($id)
    {
        $coworkSpace = CoworkSpace::findOrFail($id);
        return view('admin.editSpace', compact('coworkSpace'));
    }


    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string|max:1000',
        ]);
        $space = CoworkSpace::findOrFail($id);
        $space->update($validated);

        return redirect()->route('admin.manageSpaces')->with('success', 'Espacio actualizado correctamente');
    }


    public function destroy($id)
    {
        $space = CoworkSpace::findOrFail($id);
        $space->delete();

        return redirect()->route('admin.manageSpaces')->with('success', 'Espacio eliminado correctamente');
    }
}