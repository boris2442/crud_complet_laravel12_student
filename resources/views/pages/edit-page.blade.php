@extends('layouts.index')
@section('title', 'creer un etudiant')
@section('content')


<form action="{{ route('student.update', $student->id) }}" method="post" enctype="multipart/form-data" class="bg-white p-6 rounded-xl shadow-md space-y-4 max-w-2xl mx-auto mt-6">
    @csrf
    @method('PATCH')

    <div>
        <label for="name" class="block font-semibold mb-1">Nom</label>
        <input type="text" name="name" id="name" value="{{ $student->name }}" class="w-full border border-gray-300 rounded px-3 py-2">
        @error('name')
        <span class="text-red-500 text-sm">{{ $message }}</span>
        @enderror
    </div>

    <div>
        <label for="email" class="block font-semibold mb-1">Email</label>
        <input type="email" name="email" id="email" value="{{ $student->email }}" class="w-full border border-gray-300 rounded px-3 py-2">
        @error('email')
        <span class="text-red-500 text-sm">{{ $message }}</span>
        @enderror
    </div>

    <div>
        <label for="password" class="block font-semibold mb-1">Mot de passe</label>
        <input type="password" name="password" id="password" value="{{ $student->password }}" class="w-full border border-gray-300 rounded px-3 py-2">
        @error('password')
        <span class="text-red-500 text-sm">{{ $message }}</span>
        @enderror
    </div>

    <div>
        <label for="file" class="block font-semibold mb-1">Image</label>
        <img src="{{ asset('images/students/'.$student->image) }}" alt="image" class="h-16 w-16 rounded-full mb-2">
        <input type="file" name="image" id="file" class="w-full">
        @error('image')
        <span class="text-red-500 text-sm">{{ $message }}</span>
        @enderror
    </div>

    <div>
        <label class="block font-semibold mb-1">Langages</label>
        @php
            $langs = explode(',', $student->languages);
        @endphp
        <div class="flex flex-wrap gap-4">
            @foreach(['php', 'Javascript', 'NodeJs', 'MongoDB'] as $lang)
                <label class="flex items-center space-x-2">
                    <input type="checkbox" name="languages[]" value="{{ $lang }}" {{ in_array($lang, $langs) ? 'checked' : '' }} class="accent-blue-500">
                    <span>{{ $lang }}</span>
                </label>
            @endforeach
        </div>
    </div>

    <div>
        <label class="block font-semibold mb-1">Sexe</label>
        <div class="flex gap-4">
            <label class="flex items-center space-x-2">
                <input type="radio" name="sexe" value="masculin" {{ $student->sexe === 'masculin' ? 'checked' : '' }} class="accent-blue-500">
                <span>Masculin</span>
            </label>
            <label class="flex items-center space-x-2">
                <input type="radio" name="sexe" value="feminin" {{ $student->sexe === 'feminin' ? 'checked' : '' }} class="accent-blue-500">
                <span>Féminin</span>
            </label>
        </div>
    </div>

    <div>
        <label for="hobbies" class="block font-semibold mb-1">Hobbies</label>
        <select name="hobbies" id="hobbies" class="w-full border border-gray-300 rounded px-3 py-2">
            <option value="football" {{ $student->hobbies === 'football' ? 'selected' : '' }}>Football</option>
            <option value="handball" {{ $student->hobbies === 'handball' ? 'selected' : '' }}>Handball</option>
            <option value="basketball" {{ $student->hobbies === 'basketball' ? 'selected' : '' }}>Basketball</option>
        </select>
    </div>

    <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Mettre à jour</button>
</form>
@endsection