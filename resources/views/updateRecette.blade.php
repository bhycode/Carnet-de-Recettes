@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <div class="card">
            <div class="card-header">Modifier la Recette</div>

            <div class="card-body">
                <form action="{{ route('recettes.update', $recette->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="form-group">
                        <label for="title">Titre :</label>
                        <input type="text" name="title" class="form-control" value="{{ old('title', $recette->title) }}" required>
                    </div>

                    <div class="form-group">
                        <label for="content">Contenu :</label>
                        <textarea name="content" class="form-control" rows="4" required>{{ old('content', $recette->content) }}</textarea>
                    </div>

                    <div class="form-group">
                        <label for="image">Image actuelle :</label>
                        @if ($recette->image_path)
                            <img src="{{ asset('storage/' . $recette->image_path) }}" alt="Recette Image" class="img-fluid mb-2">
                        @else
                            <p>Aucune image actuellement.</p>
                        @endif
                        <input type="file" name="image" class="form-control-file">
                        <small class="form-text text-muted">Laissez vide si vous ne souhaitez pas mettre à jour l'image.</small>
                    </div>

                    <button type="submit" class="btn btn-primary">Modifier la Recette</button>
                </form>
            </div>
        </div>
    </div>
@endsection
