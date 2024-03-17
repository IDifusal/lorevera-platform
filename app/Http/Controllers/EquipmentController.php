<?php

namespace App\Http\Controllers;

use App\Models\Equipment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class EquipmentController extends Controller
{
    public function list()
    {
        $equipment = Equipment::all();
        return response()->json(
            $equipment
        );
    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $path = null;
        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            // Obtener el archivo de imagen del request
            $file = $request->file('image');
            // Generar un nombre único para el archivo
            $fileName = time() . '_' . $file->getClientOriginalName();
            // Almacenar la imagen en el disco público y obtener la ruta
            // $path = $file->storeAs('equipment', $fileName, 'public');
            $path = $request->file('image')->storeAs('equipment', $fileName, 'public');
            // Almacenar solo el path relativo (sin 'storage/') en la base de datos
            $path = str_replace('public/', '', $path);
        }

        $equipment = new Equipment;
        $equipment->name = $request->name;
        $equipment->featured_image_url = $path;
        $equipment->save();

        return response()->json(['message' => 'Equipment created successfully!', 'equipment' => $equipment]);
    }

    public function delete($id)
    {
        $equipment = Equipment::find($id);
        if ($equipment) {
            if ($equipment->featured_image_url) {
                Storage::disk('public')->delete($equipment->featured_image_url);
            }
            $equipment->delete();
            return response()->json(['message' => 'Equipment deleted successfully!']);
        } else {
            return response()->json(['message' => 'Equipment not found!'], 404);
        }
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string',
        ]);
    
        $equipment = Equipment::find($id);
        if ($equipment) {
            $equipment->name = $request->name;
            // Explicitly compare $request->remove_image to the string "true"
            if($request->remove_image === "true"){
                $equipment->featured_image_url = null;
            }
            if ($request->hasFile('image') && $request->file('image')->isValid()) {
                if ($equipment->featured_image_url) {
                    Storage::disk('public')->delete($equipment->featured_image_url);
                }
                $file = $request->file('image');
                $fileName = time() . '_' . $file->getClientOriginalName();
                $path = $request->file('image')->storeAs('equipment', $fileName, 'public');
                $path = str_replace('public/', '', $path);
                $equipment->featured_image_url = $path;
            }
    
            $equipment->save();
            return response()->json(['message' => 'Equipment updated successfully!', 'equipment' => $equipment]);
        } else {
            return response()->json(['message' => 'Equipment not found!'], 404);
        }
    }
}
