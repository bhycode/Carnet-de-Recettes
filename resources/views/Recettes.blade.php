@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <h2 class="mb-4">Recettes List</h2>

        <!-- Barre de recherche -->
        <form action="{{ route('recettes.search') }}" method="GET" class="mb-4">
            <div class="input-group">
                <input type="text" name="search" class="form-control" placeholder="Rechercher une recette">
                <div class="input-group-append">
                    <button class="btn btn-outline-secondary" type="submit">Rechercher</button>
                </div>
            </div>
        </form>

        @foreach ($recettes as $recette)
            <div class="card mb-3" style="width: 300px;"> <!-- Adjust the width as needed -->
                @if ($recette->image_path)
                    <img src="{{ asset('storage/' . $recette->image_path) }}" alt="Recette Image" class="card-img-top img-fluid" style="width: 100%;">
                @endif
                <div class="card-body">
                    <h5 class="card-title">{{ $recette->title }}</h5>
                    <p class="card-text">{{ $recette->content }}</p>
                </div>
            </div>
        @endforeach
    </div>
@endsection
