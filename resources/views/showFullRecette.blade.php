@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <a href="{{ route('recettes.indexWithoutButtons') }}" class="btn btn-light mb-3">
            <svg xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 0 24 24" width="24" fill="skyblue">
                <path d="M0 0h24v24H0z" fill="none"/>
                <path d="M20 11H7.83l5.59-5.59L12 4l-8 8 8 8 1.41-1.41L7.83 13H20v-2z"/>
            </svg>
        </a>

        <div class="card">
            <div class="card-body">
                <h2 class="card-title">{{ $recette->title }}</h2>

                @if ($recette->image_path)
                    <img src="{{ asset('storage/' . $recette->image_path) }}" alt="Recette Image" class="img-fluid mb-3">
                @endif

                <p class="card-text">{{ $recette->content }}</p>
            </div>
        </div>
    </div>
@endsection
