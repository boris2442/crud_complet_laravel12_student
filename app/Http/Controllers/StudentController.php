<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\Student;

class StudentController extends Controller
{
    //
    public function index()
    {
        $students = Student::all();
        return view('pages.home-page', compact('students'));
    }
    public function create()
    {
        return view('pages.create-page');
    }


    public function store(Request $request)
    {
        $validate = $request->validate([
            "name" => "required|string|max:255",
            "email" => "required|string|max:255",
            'password' => 'required|string|min:6',
            'languages' => 'required|array',
            'sexe' => 'required|string|max:255',
            'hobbies' => 'required|string|max:255',
            'image' => 'required|image|mimes:jpg,gif,png,jpeg|max:2048',

        ]);
        $validate['languages'] = implode(',', $request->languages);
        $validate['password'] = Hash::make($validate['password']);
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images/students'), $imageName);
            $validate['image'] = "$imageName";
        }
        Student::create($validate);
        return redirect()->route('student.index')->with('success', 'Étudiant creer avec succès');
    }
    public function delete($id)
    {
        $student = Student::findOrFail($id);
        $student->delete();
        return redirect()->route('student.index')->with('success', 'Étudiant delete avec succès');
    }

    public function edit($id)
    {
        $student = Student::findOrFail($id);
        return view('pages.edit-page', compact('student'));
    }
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'password' => 'nullable|string|min:6',
            'languages' => 'required|array',
            'sexe' => 'required|string',
            'hobbies' => 'required|string',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
        ]);

        $student = Student::findOrFail($id); // ✅ On récupère l'objet

        // Traitement image
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images/students'), $imageName);
            $validated['image'] = $imageName;
        } else {
            $validated['image'] = $student->image;
        }

        // Traitement mot de passe (optionnel)
        if (!empty($validated['password'])) {
            $validated['password'] = Hash::make($validated['password']);
        } else {
            unset($validated['password']); // Ne pas toucher si vide
        }

        // Traitement languages (array → string)
        $validated['languages'] = implode(',', $validated['languages']);

        $student->update($validated); // ✅ Mise à jour réussie

        return redirect()->route('student.index')->with('success', 'Étudiant mis à jour avec succès');
    }
}
