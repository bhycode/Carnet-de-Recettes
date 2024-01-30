@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <h2>{{ $recette->title }}</h2>

        <div class="card mb-3" style="width: 300px;">
            @if ($recette->image_path)
                <img src="{{ asset('storage/' . $recette->image_path) }}" alt="Recette Image" class="card-img-top img-fluid" style="width: 100%;">
            @endif
            <div class="card-body">
                <p class="card-text">{{ $recette->content }}</p>

                <!-- Delete Form -->
                <form action="{{ route('recettes.destroy', $recette->id) }}" method="POST" style="display: inline;" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cette Recette?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Supprimer</button>
                </form>

                <!-- Back Button -->
                <a href="{{ route('recettes.index') }}" class="btn btn-secondary">Retour</a>
            </div>
        </div>
    </div>
@endsection
