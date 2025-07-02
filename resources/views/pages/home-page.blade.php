@extends('layouts.index')
@section('title', 'creer un etudiant')
@section('content')



<h1 class="text-2xl font-bold mb-4">Liste des élèves</h1>

<div class="mb-4">
    <a href="{{route('student.create')}}" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">Ajouter</a>
</div>

@if(session()->has('success'))
    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-2 rounded mb-4">
        {{ session('success') }}
    </div>
@endif

<table class="min-w-full bg-white rounded-lg shadow overflow-hidden">
    <thead class="bg-gray-100 text-left text-sm uppercase font-semibold text-gray-600">
        <tr>
            <th class="p-3">Nom</th>
            <th class="p-3">Email</th>
            <th class="p-3">Image</th>
            <th class="p-3">Langages</th>
            <th class="p-3">Sexe</th>
            <th class="p-3">Hobbies</th>
            <th class="p-3">Créé</th>
            <th class="p-3">Mis à jour</th>
            <th class="p-3">Modifier</th>
            <th class="p-3">Supprimer</th>
        </tr>
    </thead>
    <tbody class="text-sm divide-y divide-gray-200">
        @foreach($students as $student)
        <tr>
            <td class="p-3">{{ $student->name }}</td>
            <td class="p-3">{{ $student->email }}</td>
            <td class="p-3">
                <img src="{{ asset('images/students/'.$student->image ) }}" alt="{{ $student->name }}" class="h-12 w-12 rounded-full object-cover">
            </td>
            <td class="p-3">
                @foreach(explode(',', $student->languages) as $lang)
                    <span class="inline-block bg-blue-100 text-blue-800 px-2 py-1 rounded-full text-xs mr-1">{{ $lang }}</span>
                @endforeach
            </td>
            <td class="p-3">{{ $student->sexe }}</td>
            <td class="p-3">{{ $student->hobbies }}</td>
            <td class="p-3">{{ $student->created_at }}</td>
            <td class="p-3">{{ $student->updated_at }}</td>
            <td class="p-3">
                <a href="{{ route('student.edit', $student->id) }}" class="text-blue-600 hover:underline">Modifier</a>
            </td>
            <td class="p-3">
                <form action="{{ route('student.delete', $student->id) }}" method="post" onsubmit="return confirm('Êtes-vous sûr ?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="text-red-500 hover:underline">Supprimer</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection