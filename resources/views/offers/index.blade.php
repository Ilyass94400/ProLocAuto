@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6">
    <h1 class="text-3xl font-bold mb-6">Nos offres pour auto-entrepreneurs</h1>

    @if(empty($offers))
        <p class="text-gray-600">Aucune offre disponible pour le moment. Revenez bientôt !</p>
    @else
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($offers as $offer)
                <div class="border rounded-lg p-4 shadow hover:shadow-lg transition">
                    <h2 class="text-xl font-semibold">{{ $offer->title }}</h2>
                    <p class="mt-2">{{ $offer->description }}</p>
                    <p class="mt-2 text-gray-500">{{ $offer->location }}</p>
                    <p class="mt-2 font-bold">{{ $offer->price }} € / mois</p>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection
