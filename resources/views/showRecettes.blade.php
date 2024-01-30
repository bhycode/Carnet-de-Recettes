@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <h2 class="mb-4">Liste de Recettes</h2>

        {{-- Add button --}}
        <a href="{{ route('recettes.create') }}" class="btn btn-success mb-4">Ajouter</a>

        @foreach ($recettes as $recette)
            <div class="card mb-3" style="width: 300px;"> <!-- Adjust the width as needed -->
                @if ($recette->image_path)
                    <img src="{{ asset('storage/' . $recette->image_path) }}" alt="Recette Image" class="card-img-top img-fluid" style="width: 100%;">
                @endif
                <div class="card-body">
                    <h5 class="card-title">{{ $recette->title }}</h5>
                    <p class="card-text">{{ $recette->content }}</p>


                    <!-- Update Button -->
                    <a href="{{ route('recettes.edit', $recette->id) }}" class="btn btn-primary">Modifier</a>

                    <!-- Delete Form -->
                    <form action="{{ route('recettes.destroy', $recette->id) }}" method="POST" style="display: inline;" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cette Recette?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Supprimer</button>
                    </form>
                </div>
            </div>
        @endforeach
    </div>
@endsection
