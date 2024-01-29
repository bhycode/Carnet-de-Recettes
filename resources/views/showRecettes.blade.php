@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <h2 class="mb-4">Recettes List</h2>

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
