@extends('layouts.app')

@section('content')
    <div class="container mt-5">

        <!-- Barre de navigation -->
        <nav class="navbar navbar-expand-lg navbar-light bg-light mb-4">
            <a class="navbar-brand" href="{{ route('recettes.indexWithoutButtons')}}">Recettes</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('recettes.index')}}">Recettes Manager</a>
                    </li>
                </ul>
            </div>
        </nav>

        <!-- Barre de recherche -->
        <form action="{{ route('recettes.search') }}" method="GET" class="mb-4">
            <div class="input-group">
                <input type="text" name="search" class="form-control" placeholder="Rechercher une recette">
                <div class="input-group-append">
                    <button class="btn btn-outline-secondary" type="submit">Rechercher</button>
                </div>
            </div>
        </form>

        <div class="row">
            @forelse($recettes as $recette)
                <div class="col-md-4 mb-3">
                    <div class="card animate__animated animate__swing">
                        @if ($recette->image_path)
                            <img src="{{ asset('storage/' . $recette->image_path) }}" alt="Recette Image" class="card-img-top img-fluid">
                        @endif
                        <div class="card-body">
                            <h5 class="card-title">{{ $recette->title }}</h5>
                            <p class="card-text">{{ Str::limit($recette->content, 100, '...') }}</p>
                            <a href="{{ route('recettes.showFull', $recette->id) }}" class="btn btn-primary animate__animated animate__fadeInUp">Afficher la suite</a> <!-- Use a different animation class -->
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-md-12 text-center">
                    <img src="{{ asset('storage/images\search-no-results.gif') }}" alt="Empty Search Results" style = "width: 300px;" class="img-fluid">
                    <p class="mt-3 lead">Aucun résultat trouvé</p>
                </div>
            @endforelse
        </div>
    </div>

    <!-- Include animate.css -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
@endsection
