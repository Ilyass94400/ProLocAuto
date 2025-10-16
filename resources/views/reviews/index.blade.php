@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h1 class="mb-4">Laissez votre avis</h1>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form action="{{ route('reviews.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label>Nom</label>
            <input type="text" name="name" class="form-control" required>
            @error('name') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <div class="mb-3">
            <label>Note</label>
            <select name="rating" class="form-select" required>
                <option value="">-- Choisir une note --</option>
                @for ($i = 1; $i <= 5; $i++)
                    <option value="{{ $i }}">{{ $i }} ★</option>
                @endfor
            </select>
            @error('rating') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <div class="mb-3">
            <label>Commentaire</label>
            <textarea name="comment" class="form-control" rows="4" required></textarea>
            @error('comment') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <button type="submit" class="btn btn-primary">Envoyer</button>
    </form>

    <hr class="my-5">

    <h2>Les avis (simulés)</h2>
    @foreach ($reviews as $review)
        <div class="border rounded p-3 mb-3">
            <h5>{{ $review['name'] }} — {{ $review['rating'] }} ★</h5>
            <p>{{ $review['comment'] }}</p>
            <small class="text-muted">{{ \Carbon\Carbon::parse($review['created_at'])->format('d/m/Y H:i') }}</small>
        </div>
    @endforeach
</div>
@endsection
